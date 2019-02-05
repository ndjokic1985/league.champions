<?php

namespace App\Services;

use App\Repositories\MatchResultRepository;

/**
 * Class MatchResultService.
 *
 * @package App\Services
 */
class MatchResultService {

  protected $matchResultRepository;

  public function __construct(MatchResultRepository $matchResultRepository) {
    $this->matchResultRepository = $matchResultRepository;
  }

  /**
   * Get matches.
   *
   * @return \App\FootballMatch[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   *   Return matched result.
   */
  public function index($filters) {
    return $this->matchResultRepository->index($filters);
  }

  public function update($attributes) {
    if (isset($attributes['id'])) {
      $this->matchResultRepository->update($attributes);
    }
  }

}
