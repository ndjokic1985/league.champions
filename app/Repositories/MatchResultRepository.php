<?php

namespace App\Repositories;

use App\FootballMatch;

/**
 * Class MatchResultRepository.
 *
 * @package App\Repositories.
 */
class MatchResultRepository {

  protected $footBallMatch;

  /**
   * MatchResultRepository constructor.
   *
   * @param \App\FootballMatch $footBallMatch
   */
  public function __construct(FootballMatch $footBallMatch) {
    $this->footBallMatch = $footBallMatch;
  }

  /**
   * Get all matches or filter by kickoff date,team and group.
   *
   * @return \App\FootballMatch[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   *   Get matched result.
   */
  public function index($filters) {
    $noFilters = (!isset($filters['team']) && !isset($filters['group']) && !isset($filters['from']) && !isset($filters['to']));

    if ($noFilters) {
      return $this->footBallMatch->all();
    }
    else {
      $query = $this->footBallMatch->query();
      if (isset($filters['group'])) {
        $query->where('group', $filters['group']);
      }
      if (isset($filters['team'])) {
        $team = $filters['team'];
        $query->where(function ($q) use ($team) {
          $q->where('homeTeam', $team);
          $q->orWhere('awayTeam', $team);
        });
      }
      if (isset($filters['from']) && isset($filters['to'])) {
        $from = date('Y-m-d h:i:s', strtotime($filters['from']));
        $to = date('Y-m-d h:i:s', strtotime($filters['to']));
        $query->whereBetween('kickoffAt', [
          $from,
          $to,
        ]);
      }
      return $query->get();
    }
  }

}
