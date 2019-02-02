<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{

    protected $fillable = [
        'leagueTitle',
        'matchDay',
        'group',
        'homeTeam',
        'awayTeam',
        'kickoffAt',
        'score',
    ];

    protected $table = 'football_matches';
}
