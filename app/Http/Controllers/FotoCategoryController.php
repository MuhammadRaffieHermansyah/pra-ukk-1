<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\FotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($name)
    {
        // Ambil semua kategori untuk digunakan di view
        $categories = FotoCategory::all();

        // Filter foto berdasarkan kategori dengan nama yang sesuai
        $fotos = Foto::with(['user', 'fotoLikes', 'commentFotos.user', 'album', 'category'])
            ->whereHas('category', function ($query) use ($name) {
                $query->where('name', $name);
            })
            ->get();

        // Tambahkan properti tambahan untuk setiap foto
        $fotos = $fotos->map(function ($foto) {
            $foto['isLike'] = $foto->fotoLikes->contains('user_id', Auth::id());
            $foto['total_like'] = $foto->fotoLikes->count();
            $foto['total_comment'] = $foto->commentFotos->count();
            return $foto;
        });

        // Kembalikan response ke view
        return view('pages.home.index', compact('fotos', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.foto-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        FotoCategory::create($request->all());
        return redirect('/')->with('success', 'Kategori Foto berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(FotoCategory $fotoCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FotoCategory $fotoCategory)
    {
        return view('pages.foto-category.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FotoCategory $fotoCategory)
    {
        FotoCategory::findOrFail($fotoCategory->id)->update($request->all());
        return redirect('/')->with('success', 'Kategori Foto berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FotoCategory $fotoCategory)
    {
        FotoCategory::findOrFail($fotoCategory->id)->delete();
        return redirect('/')->with('success', 'Kategori Foto berhasil dihapus');
    }
}
