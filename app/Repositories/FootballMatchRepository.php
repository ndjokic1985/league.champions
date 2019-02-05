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
   * Create match.
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
   * Query all league matches.
   *
   * @return \App\FootballMatch[]|\Illuminate\Database\Eloquent\Collection
   *   Return list.
   */
  public function all() {
    return $this->footBallMatch->all();
  }

  /**
   * Query league matches based on group name.
   *
   * @param $group
   *   Group name parameter like 'A','B'.
   *
   * @return mixed
   *   Return list.
   */
  public function show($group) {
    return $this->footBallMatch->where('group', $group)->get();
  }
}
