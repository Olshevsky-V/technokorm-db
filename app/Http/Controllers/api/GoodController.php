<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Http\Requests\StoreGoodRequest;
use App\Http\Requests\UpdateGoodRequest;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Good::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoodRequest $request, Good $good)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Good $good)
    {
        //
    }
}
