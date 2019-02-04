<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FootballMatchService;
use App\Http\Resources\FootballMatch as FootballMatchResource;

/**
 * Class FootballMatchController.
 *
 * @package App\Http\Controllers
 */
class FootballMatchController extends Controller {

  protected $footballMatchService;

  /**
   * FootballMatchController constructor.
   *
   * @param \App\Services\FootballMatchService $footballMatchService
   *   DI FootballMatchService $footballMatchService parameter.
   */
  public function __construct(FootballMatchService $footballMatchService) {
    $this->footballMatchService = $footballMatchService;
  }

  /**
   * Get a league table from service and encode array into json data.
   *
   * @return \Illuminate\Http\Response
   *   Return json response.
   */
  public function index() {
    $tableResults = $this->footballMatchService->index();
    return json_encode($tableResults);
  }


  /**
   * Send incoming request to service processing, get league table and encode
   * array into json data.
   *
   * @param \Illuminate\Http\Request $request
   *   Incoming Request $request parameter.
   *
   * @return false|string
   *   Return json response.
   */
  public function store(Request $request) {
    $this->footballMatchService->create($request);
    $tableResults = $this->footballMatchService->index();
    return json_encode($tableResults);
  }

  /**
   * @param $id
   */
  public function show($id) {
    //
  }
  
  /**
   * @param \Illuminate\Http\Request $request
   * @param $id
   */
  public function update(Request $request, $id) {
    //
  }

}
