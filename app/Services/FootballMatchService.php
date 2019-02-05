<?php


namespace App\Services;


use App\Repositories\FootballMatchRepository;
use Illuminate\Http\Request;

/**
 * Class FootballMatchService.
 *
 * @package App\Services
 */
class FootballMatchService {

  protected $footballMatchRepository;

  /**
   * FootballMatchService constructor.
   *
   * @param \App\Repositories\FootballMatchRepository $footballMatchRepository
   *   DI FootballMatchRepository $footballMatchRepository.
   */
  public function __construct(FootballMatchRepository $footballMatchRepository) {
    $this->footballMatchRepository = $footballMatchRepository;
  }

  /**
   * Get all league groups matches.
   */
  public function index() {
    $matches = $this->footballMatchRepository->all();
    $table = $this->getLeagueTable($matches);
    return $table;
  }

  /**
   * Get league table.
   */
  protected function getLeagueTable($matches) {
    $data = $this->prepareLeagueTable($matches);
    return $this->createLeagueTable($data);

  }

  /**
   * Calculate points for every team in group.
   *
   * @return array
   *   Return calculated result.
   */
  private function prepareLeagueTable($matches) {
    $data = [];
    foreach ($matches as $match) {
      $this->calculatePoints($data, $match);
      $data[$match->group]['leagueTitle'] = $match->leagueTitle;
    }
    return $data;

  }

  /**
   * Calculate additional data and group information.
   *
   * @param $data
   *   Calculated teams parameter.
   *
   * @return array
   *   Return ready data for client
   */
  private function createLeagueTable($data) {
    $groups = [];
    $tableLeague = [];
    $keys1 = array_keys($data);
    for ($i = 0; $i < count($keys1); $i++) {
      $keys2 = array_keys($data[$keys1[$i]]);
      $teams = [];
      for ($j = 0; $j < count($keys2); $j++) {
        $team =& $data[$keys1[$i]][$keys2[$j]];
        if (is_array($team)) {
          $team['goalDifference'] = $team['goals'] - $team['goalsAgainst'];
          $team['points'] = (isset($team['points'])) ? $team['points'] : 0;
          $teams[] = $team;
        }
      }
      $this->sortTeams($teams);
      $group =& $data[$keys1[$i]];
      $groups['leagueTitle'] = $group['leagueTitle'];
      $groups['matchday'] = $teams[0]['playedGames'];
      $groupName = $keys1[$i];
      $groups['group'] = $groupName;
      $groups['standing'] = $teams;
      $tableLeague[] = $groups;
    }
    return $tableLeague;
  }

  /**
   * Sort teams by points.goals,goalDifference.
   *
   * @param $array
   *   Input teams parameter.
   */
  private function sortTeams(&$array) {
    $s = 0;
    for ($m = 0; $m < count($array); $m++) {
      $maxIndex = $m;
      for ($n = $m + 1; $n < count($array); $n++) {
        if ($array[$n]['points'] > $array[$maxIndex]['points']) {
          $maxIndex = $n;
        }
        elseif ($array[$n]['points'] == $array[$maxIndex]['points']) {
          if ($array[$n]['goals'] > $array[$maxIndex]['goals']) {
            $maxIndex = $n;
          }
          elseif ($array[$n]['goals'] == $array[$maxIndex]['goals']) {
            if ($array[$n]['goalDifference'] > $array[$maxIndex]['goalDifference']) {
              $maxIndex = $n;
            }
          }
        }
      }
      $temp = $array[$maxIndex];
      $array[$maxIndex] = $array[$m];
      $array[$m] = $temp;
      $array[$m]['rank'] = ++$s;
      $array[$m] = $this->orderTeamHeadings($array[$m]);
    }
  }

  /**
   * Order team headings as per attachment 2.
   *
   * @param $team
   *   Team parameter.
   *
   * @return array
   *   Return ordered team headings.
   */
  private function orderTeamHeadings($team) {
    $data = [];
    foreach ($this->getTeamHeadings() as $heading) {
      if (!isset($team[$heading])) {
        $data[$heading] = 0;
      }
      else {
        $data[$heading] = $team[$heading];
      }
    }
    return $data;
  }

  /**
   * List of team headings.
   *
   * @return array
   *   Return list of headings.
   */
  private function getTeamHeadings() {
    return [
      'rank',
      'team',
      'playedGames',
      'points',
      'goals',
      'goalsAgainst',
      'goalDifference',
      'win',
      'lose',
      'draw',
    ];
  }

  /**
   * Calculate all team points.
   *
   * @param $data
   *   Represent groups and teams with calculated value.
   *
   * @param $match
   *   Represent current match.
   */
  private function calculatePoints(&$data, $match) {
    $scoreArray = explode(':', $match->score);
    $this->coreCalculation($data, ['homeTeam', 'awayTeam'], $match,
      'playedGames', 1);
    $this->coreCalculation($data, ['awayTeam'], $match, 'goalsAgainst',
      $scoreArray[0]);
    $this->coreCalculation($data, ['homeTeam'], $match, 'goalsAgainst',
      $scoreArray[1]);
    $this->coreCalculation($data, ['awayTeam'], $match, 'goals',
      $scoreArray[1]);
    $this->coreCalculation($data, ['homeTeam'], $match, 'goals',
      $scoreArray[0]);
    if ($scoreArray[0] == $scoreArray[1]) {
      $this->coreCalculation($data, ['awayTeam', 'homeTeam'], $match,
        'draw', 1);
      $this->coreCalculation($data, ['awayTeam', 'homeTeam'], $match,
        'points', 1);
    }
    elseif ($scoreArray[0] > $scoreArray[1]) {
      $this->coreCalculation($data, ['homeTeam'], $match, 'win', 1);
      $this->coreCalculation($data, ['awayTeam'], $match, 'lose', 1);
      $this->coreCalculation($data, ['homeTeam'], $match, 'points', 3);
    }
    elseif ($scoreArray[0] < $scoreArray[1]) {
      $this->coreCalculation($data, ['awayTeam'], $match, 'win', 1);
      $this->coreCalculation($data, ['homeTeam'], $match, 'lose', 1);
      $this->coreCalculation($data, ['awayTeam'], $match, 'points', 3);
    }
  }

  /**
   * Core calculation function.
   */
  private function coreCalculation(array &$data, array $teams = [], $match, $label, int $points) {
    foreach ($teams as $team) {
      $data[$match->group][$match->$team]['team'] = $match->$team;
      if (isset($data[$match->group][$match->$team][$label])) {
        $data[$match->group][$match->$team][$label] += $points;
      }
      else {
        $data[$match->group][$match->$team][$label] = $points;
      }
    }

  }

  /**
   * Create match/es from file or single input.
   *
   * @param \Illuminate\Http\Request $request
   *   Request $request parameter.
   */
  public function create(Request $request) {
    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $destinationPath = 'uploads';
      $file->move($destinationPath, $file->getClientOriginalName());
      $content = file_get_contents($destinationPath . '/' . $file->getClientOriginalName());
      $matches = json_decode($content, TRUE);
      foreach ($matches as $match) {
        $this->footballMatchRepository->create($match);
      }
    }
    elseif ($request->all()) {
      $this->footballMatchRepository->create($request->all());
    }

  }

  /**
   * Get league table by group name.
   *
   * @param $group
   *   Group name parameter.
   *
   * @return array
   *   Return league table.
   */
  public function show($group) {
    $matches = $this->footballMatchRepository->show($group);
    $table = $this->getLeagueTable($matches);
    return $table;
  }

}
