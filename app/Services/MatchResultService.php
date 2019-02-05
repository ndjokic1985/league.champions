<?php

namespace App\Services;

use App\Repositories\MatchResultRepository;
use Illuminate\Http\Request;

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
   * Get all league matches.
   *
   * @return \App\FootballMatch[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   *   Return result.
   */
  public function index($filters) {
    return $this->matchResultRepository->index($filters);
  }

  /**
   * Update single or multiple league matches.
   *
   * @param \Illuminate\Http\Request $request
   *   Request $request parameter.
   */
  public function update(Request $request) {
    $elements = $request->all();
    if (isset($elements[0]) && is_array($elements[0])) {
      foreach ($elements as $element) {
        if (isset($element['id'])) {
          $this->matchResultRepository->update($element);
        }
      }
    }
    else {
      if (isset($elements['id'])) {
        $this->matchResultRepository->update($elements);
      }
    }
  }

}
