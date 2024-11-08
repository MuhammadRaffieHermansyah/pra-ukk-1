<?php

namespace App\Http\Controllers;

use App\Models\FotoCategory;
use Illuminate\Http\Request;

class FotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.foto-category.index');
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
