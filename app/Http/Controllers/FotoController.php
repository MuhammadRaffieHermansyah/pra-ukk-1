<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        // Validasi input data
        $validatedFoto = $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'album_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            // Upload foto baru
            $fileLocation = $request->file('foto')->store('foto_images', 'public');

            // Simpan nama dan lokasi file di database
            $validatedFoto['file_location'] = $fileLocation;

            // Simpan data ke database
            Foto::create($validatedFoto);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Foto berhasil diupload');
        }

        return redirect()->back()->with('error', 'Tolong masukan foto yang ingin di unggah!');
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        // dd($name);
        $foto = Foto::with(['user', 'fotoLikes', 'commentFotos' => ['user'], 'album', 'category'])->where('name', $name)->first();
        $foto['isLike'] = $foto->fotoLikes->contains('user_id', Auth::id());
        $foto['total_like'] = $foto->fotoLikes->count();
        $foto['total_comment'] = $foto->commentFotos->count();
        // return response()->json(['foto' => $foto]);
        return view('pages.foto.show', compact('foto'));
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
    public function update(Request $request, $id)
    {
        // Temukan foto berdasarkan ID
        $fotoToUpdate = Foto::findOrFail($id);

        // Validasi data yang masuk
        $validatedFoto = $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // contoh validasi untuk file gambar
            'description' => 'string|nullable',
            'album_id' => 'integer|exists:albums,id', // validasi foreign key
            'user_id' => 'integer|exists:users,id', // validasi foreign key
        ]);

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Upload foto baru
            $fileLocation = $request->file('foto')->store('foto_images', 'public');

            // Simpan nama dan lokasi file di database
            $validatedFoto['file_location'] = $fileLocation;
        }

        // Update data di database
        $fotoToUpdate->update($validatedFoto);

        // Redirect dengan pesan sukses
        return redirect('/')->with('success', 'Foto berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Foto::find($id)->delete();
        return redirect()->back();
    }

    public function likedFoto()
    {
        $fotos = Foto::with(['user', 'fotoLikes', 'commentFotos.user', 'album', 'category'])
            ->whereHas('fotoLikes', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        $fotos = $fotos->map(function ($foto) {
            // Tambahkan properti tambahan untuk setiap foto
            $foto['isLike'] = true; // Karena sudah difilter, pasti user telah nge-like foto ini
            $foto['total_like'] = $foto->fotoLikes ? $foto->fotoLikes->count() : 0;
            $foto['total_comment'] = $foto->commentFotos ? $foto->commentFotos->count() : 0;

            return $foto;
        });

        // Kembalikan response JSON atau tampilan
        // return response()->json(['fotos' => $fotos]);

        // Jika ingin mengembalikan ke view
        return view('pages.foto.liked-foto', compact('fotos'));
    }
}
