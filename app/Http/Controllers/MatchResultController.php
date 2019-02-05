<?php

namespace App\Http\Controllers;

use App\Services\MatchResultService;
use Illuminate\Http\Request;

/**
 * Class MatchResultController.
 *
 * @package App\Http\Controllers
 */
class MatchResultController extends Controller {

  protected $matchResultService;

  /**
   * MatchResultController constructor.
   *
   * @param \App\Services\MatchResultService $matchResultService
   */
  public function __construct(MatchResultService $matchResultService) {
    $this->matchResultService = $matchResultService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $filters = $request->all();
    $data = $this->matchResultService->index($filters);
    return json_encode($data);
  }

  public function update(Request $request) {
    $this->matchResultService->update($request->all());
  }

}
