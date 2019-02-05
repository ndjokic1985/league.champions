<?php

namespace App\Repositories;

use App\FootballMatch;

/**
 * Class FootballMatchRepository.
 *
 * @package App\Repositories
 */
class FootballMatchRepository {

  protected $footBallMatch;

  /**
   * FootballMatchRepository constructor.
   *
   * @param \App\FootballMatch $footBallMatch .
   */
  public function __construct(FootballMatch $footBallMatch) {
    $this->footBallMatch = $footBallMatch;
  }

  /**
   * Create match/es.
   *
   * @param $attributes
   *   Match/es parameter.
   *
   * @return mixed
   *   Return result of creation.
   */
  public function create($attributes) {
    return $this->footBallMatch->create($attributes);
  }

  /**
   * Get all matches.
   *
   * @return \App\FootballMatch[]|\Illuminate\Database\Eloquent\Collection
   *   Get collection matches.
   */
  public function all() {
    return $this->footBallMatch->all();
  }

}
