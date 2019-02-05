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


  /**
   * Display the specified resource.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

}
