<?php


namespace App\Repositories;


use App\FootballMatch;

class MatchResultRepository {
    protected $footBallMatch;

    public function __construct(FootballMatch $footBallMatch) {
        $this->footBallMatch=$footBallMatch;
    }

    public function index(){
        return $this->footBallMatch->all();
    }

}
