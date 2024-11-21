<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\FotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $fotos = Foto::with(['user', 'fotoLikes', 'commentFotos.user', 'album', 'category'])->get();
            $categories = FotoCategory::all();
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
            return view('pages.home.index', compact('fotos', 'categories'));
        }
    }
}
