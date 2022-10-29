<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperimentRequest;
use App\Http\Requests\UpdateExperimentRequest;
use App\Models\Experiment;

class ExperimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExperimentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperimentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function show(Experiment $experiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function edit(Experiment $experiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExperimentRequest  $request
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperimentRequest $request, Experiment $experiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experiment $experiment)
    {
        //
    }
}
