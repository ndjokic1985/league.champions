<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FootballMatchService;
use App\Http\Resources\FootballMatch as FootballMatchResource;

class FootballMatchController extends Controller
{

    protected $footballMatchService;

    public function __construct(FootballMatchService $footballMatchService)
    {
        $this->footballMatchService = $footballMatchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tableResults = $this->footballMatchService->index();
        return json_encode($tableResults);
    }


    /**
     * @param \App\Http\Requests\FootballMatchRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(Request $request)
    {
        $this->footballMatchService->create($request);
        $tableResults = $this->footballMatchService->index();
        return json_encode($tableResults);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param \App\Http\Requests\FootballMatchRequest $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
