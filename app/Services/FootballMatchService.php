<?php


namespace App\Services;


use App\Repositories\FootballMatchRepository;
use Illuminate\Http\Request;

class FootballMatchService
{

    protected $footballMatchRepository;

    public function __construct(FootballMatchRepository $footballMatchRepository
    ) {
        $this->footballMatchRepository = $footballMatchRepository;
    }

    public function index()
    {
        $matches = $this->footballMatchRepository->all();
        $data = [];
        foreach ($matches as $match) {
            $this->calculatePlayedGames($data, $match);
            $this->calculatePoints($data, $match);
            $this->calculateGoals($data, $match);
            $this->calculateWinLose($data, $match);
            $this->calculateDraw($data, $match);
        }
        return $data;
    }

    private function calculatePlayedGames(&$data, $match)
    {
        $this->coreCalculation($data, ['homeTeam', 'awayTeam'], $match,
            'playedGames', 1);

    }

    private function calculateGoalsAgainst()
    {

    }

    private function calculateGoals(&$data, $match)
    {
        $scoreArray = explode(':', $match->score);
        $this->coreCalculation($data, ['awayTeam'], $match, 'goals',
            $scoreArray[1]);
        $this->coreCalculation($data, ['homeTeam'], $match, 'goals',
            $scoreArray[0]);
    }

    private function calculateWinLose(&$data, $match)
    {
        $scoreArray = explode(':', $match->score);
        if ($scoreArray[0] > $scoreArray[1]) {
            $this->coreCalculation($data, ['homeTeam'], $match, 'win', 1);
            $this->coreCalculation($data, ['awayTeam'], $match, 'lose', 1);
        } elseif ($scoreArray[0] < $scoreArray[1]) {
            $this->coreCalculation($data, ['awayTeam'], $match, 'win', 1);
            $this->coreCalculation($data, ['homeTeam'], $match, 'lose', 1);
        }
    }

    private function calculateDraw(&$data, $match)
    {
        $scoreArray = explode(':', $match->score);
        if ($scoreArray[0] == $scoreArray[1]) {
            $this->coreCalculation($data, ['awayTeam', 'homeTeam'], $match,
                'draw', 1);
        }
    }

    private function calculatePoints(&$data, $match)
    {
        $scoreArray = explode(':', $match->score);
        if ($scoreArray[0] == $scoreArray[1]) {
            $this->coreCalculation($data, ['awayTeam', 'homeTeam'], $match,
                'points', 1);
        } elseif ($scoreArray[0] > $scoreArray[1]) {

            $this->coreCalculation($data, ['homeTeam'], $match, 'points', 3);
        } else {
            $this->coreCalculation($data, ['awayTeam'], $match, 'points', 3);

        }
    }

    private function coreCalculation(
        array &$data,
        array $teams = [],
        $match,
        $label,
        int $points
    ) {
        foreach ($teams as $team) {
            if (isset($data[$match->group][$match->$team][$label])) {
                $data[$match->group][$match->$team][$label] += $points;
            } else {
                $data[$match->group][$match->$team][$label] = $points;
            }
        }

    }

    public function create(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $content = file_get_contents($destinationPath . '/' . $file->getClientOriginalName());
            $matches = json_decode($content, true);
            foreach ($matches as $match) {
                $this->footballMatchRepository->create($match);
            }
        } elseif ($request->all()) {
            $this->footballMatchRepository->create($request->all());
        }

    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        return $this->footballMatchRepository->update($id, $attributes);
    }

    public function show($id)
    {
        $this->footballMatchRepository->show($id);
    }

}
