<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.foto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedFoto = $request->validate([
            'foto' => 'required',
            'description' => 'required',
            'album_id' => 'required',
            'user_id' => 'required',
        ]);
        $imageName = time() . '.' . $request->foto->extension();
        $fileLocation = $request->foto->move(public_path('foto_iamges'), $imageName);
        $validatedFoto['name'] = $imageName;
        $validatedFoto['file_location'] = $fileLocation;

        Foto::create($validatedFoto);
        return redirect('/')->with('success', 'Foto berhasil diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        return view('pages.foto.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto, $id)
    {
        return view('pages.foto.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $fotoToUpdate = Foto::find($id);
        $validatedFoto = $request->validate([
            'foto' => '',
            'description' => '',
            'album_id' => '',
            'user_id' => '',
        ]);

        if ($request->file('foto')) {
            // upload image
            $imageName = time() . '.' . $request->foto->extension();
            $fileLocation = $request->foto->move(public_path('foto_iamges'), $imageName);
            $validatedFoto['name'] = $imageName;
            $validatedFoto['file_location'] = $fileLocation;

            Storage::delete($fotoToUpdate->file_location);
        }
        $fotoToUpdate->update($validatedFoto);
        return redirect('/')->with('success', 'Foto berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Foto::find($id)->delete();
        return redirect('/')->with('success', 'Foto berhasil dihapus');
    }
}
