<?php

namespace App\Http\Controllers;

use App\Models\FotoLike;
use Illuminate\Http\Request;

class FotoLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        FotoLike::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(FotoLike $fotoLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FotoLike $fotoLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FotoLike $fotoLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        FotoLike::find($id)->delete();
    }
}