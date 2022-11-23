<?php

namespace App\Http\Controllers\Experiment;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperimentSettingsRequest;
use App\Http\Requests\UpdateExperimentSettingsRequest;
use App\Models\ExperimentSettings;

class ExperimentSettingsController extends Controller
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
     * @param  \App\Http\Requests\StoreExperimentSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperimentSettingsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExperimentSettings  $experimentSettings
     * @return \Illuminate\Http\Response
     */
    public function show(ExperimentSettings $experimentSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExperimentSettings  $experimentSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(ExperimentSettings $experimentSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExperimentSettingsRequest  $request
     * @param  \App\Models\ExperimentSettings  $experimentSettings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperimentSettingsRequest $request, ExperimentSettings $experimentSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExperimentSettings  $experimentSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperimentSettings $experimentSettings)
    {
        //
    }
}
