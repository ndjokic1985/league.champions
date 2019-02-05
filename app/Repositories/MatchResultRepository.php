<?php


namespace App\Repositories;


use App\FootballMatch;

class MatchResultRepository {

    protected $footBallMatch;

    public function __construct(FootballMatch $footBallMatch) {
        $this->footBallMatch = $footBallMatch;
    }

    public function index($filters) {
        $noFilters=(!isset($filters['team']) && !isset($filters['group']) && !isset($filters['dateFrom']) && !isset($filters['toDate']));

        if ($noFilters) {
            return $this->footBallMatch->all();
        }
        else {
            if(isset($filters['group'])) {
                $footballMatch=$this->footBallMatch->where('group',$filters['group']);
            }
            if (isset($filters['team'])) {
                $footballMatch = $this->footBallMatch->where('homeTeam', $filters['team'])->orWhere('awayTeam',$filters['team']);
            }

           return  $footballMatch->get();

        }
    }

}
