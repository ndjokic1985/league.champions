<?php

namespace App\Repositories;

use App\FootballMatch;

class FootballMatchRepository
{

    protected $footBallMatch;

    public function __construct(FootballMatch $footBallMatch)
    {
        $this->footBallMatch = $footBallMatch;
    }

    public function create($attributes)
    {
        return $this->footBallMatch->create($attributes);
    }

    public function all()
    {
        return $this->footBallMatch->all();
    }

    public function update($id, $attributes)
    {
        return $this->footBallMatch->find($id)->update($attributes);
    }

    public function show($id)
    {
        return $this->footBallMatch->find($id);
    }

}
