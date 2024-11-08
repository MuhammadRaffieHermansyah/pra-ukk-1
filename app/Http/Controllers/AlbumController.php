<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.album.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);
        Album::create($request->all());
        return redirect('/')->with('success', 'Album berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('pages.album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('pages.album.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'album_name' => '',
            'description' => '',
            'user_id' => '',
        ]);
        $album = Album::findOrFail($id)->update($request->all());
        return redirect('/')->with('success', 'Album berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Album berhasil dihapus');
    }
}
