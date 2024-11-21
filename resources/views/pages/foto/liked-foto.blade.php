@extends('layouts.main')
@section('content')
    {{-- @php
        $categories = ['Alam', 'Sedih', 'Seram', 'Hewan', 'Bayi', 'Sekolah', 'Programming'];
    @endphp
    <div class="grid grid-cols-7 gap-2 py-5 my-5 px-10">
        @for ($i = 0; $i < count($categories); $i++)
            <div
                class="px-2 py-1 rounded border border-slate-700 hover:bg-slate-700 hover:text-white text-black transition duration-300 text-center cursor-pointer">
                {{ $categories[$i] }}
            </div>
        @endfor
    </div> --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-1.5 p-10">
        @foreach ($fotos as $foto)
            <a href="{{ route('foto.show', $foto->name) }}" class="group relative block h-fit w-fit">
                <!-- Gambar Utama -->
                <img class="h-52 w-72 rounded-md group-hover:brightness-[0.6] duration-300 object-fill"
                    src="{{ url('storage/' . $foto->file_location) }}" alt="">

                <!-- Ikon Mata di Tengah -->
                <div
                    class="absolute inset-0 flex items-center justify-center z-10 text-white font-bold opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fa-regular fa-eye text-lg"></i>
                </div>

                <!-- Ikon Comment dan Like di Pojok Kanan Bawah -->
                <div
                    class="absolute bottom-0 right-0 flex items-center space-x-4 z-10 text-white font-bold opacity-0 group-hover:opacity-100 transition duration-300 p-4">
                    <!-- Komentar -->
                    <div class="flex items-center">
                        <i class="fa-regular fa-comment text-lg"></i>
                        <span class="ml-1 text-sm">{{ $foto->total_comment }}</span>
                    </div>
                    <!-- Like -->
                    <div class="flex items-center">
                        <i class="{{ $foto->isLike ? 'fa-solid' : 'fa-regular' }} fa-heart text-lg"></i>
                        <span class="ml-1 text-sm">{{ $foto->total_like }}</span>
                    </div>
                </div>
            </a>
        @endforeach
        </a>
    </div>
@endsection
