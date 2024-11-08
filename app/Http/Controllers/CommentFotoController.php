<?php

namespace App\Http\Controllers;

use App\Models\CommentFoto;
use Illuminate\Http\Request;

class CommentFotoController extends Controller
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
        CommentFoto::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentFoto $commentFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentFoto $commentFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        CommentFoto::findOrFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CommentFoto::find($id)->delete();
    }
}
