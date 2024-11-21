<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\FotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        return view('pages.album.index', compact('albums'));
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
        Album::create($request->except('_token'));
        return redirect(route('album.index'))->with('success', 'Album berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($albumName)
    {
        $album = Album::where('album_name', $albumName)->first();
        $fotoCategories = FotoCategory::all();
        $fotos = Foto::where('album_id', $album->id)->with(['user', 'fotoLikes', 'commentFotos.user', 'album', 'category'])->get();

        $fotos = $fotos->map(function ($foto) {
            // Tambahkan properti tambahan untuk setiap foto
            $foto['isLike'] = $foto->fotoLikes->contains('user_id', Auth::id());
            $foto['total_like'] = $foto->fotoLikes->count();
            $foto['total_comment'] = $foto->commentFotos->count();
            return $foto;
        });

        // Kembalikan response JSON atau tampilan
        // return response()->json(['fotos' => $fotos]);

        // Jika ingin mengembalikan ke view
        return view('pages.album.show', compact('album', 'fotos', 'fotoCategories'));
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
        return redirect(route('album.index'))->with('success', 'Album berhasil dihapus');
    }
}
