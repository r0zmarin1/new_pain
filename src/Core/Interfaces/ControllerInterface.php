<?php

interface ControllerInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     */
    public function store($request);

    /**
     * Display the specified resource.
     */
    public function show($resource);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($resource);

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $resource);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($resource);

}