<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FootballMatch.
 *
 * @package App
 */
class FootballMatch extends Model {

  protected $fillable = [
    'leagueTitle',
    'matchday',
    'group',
    'homeTeam',
    'awayTeam',
    'kickoffAt',
    'score',
  ];

  protected $table = 'football_matches';
}
