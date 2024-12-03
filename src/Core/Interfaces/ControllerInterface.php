<?php
namespace App\Core\Interfaces;
use Laminas\Diactoros\ServerRequest;

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
    public function store(ServerRequest $request);

    /**
     * Display the specified resource.
     */
    public function show();

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id);

    /**
     * Update the specified resource in storage.
     */
    public function update(ServerRequest $request);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id);

}