@extends('layouts.main')
@section('content')
    @php
        $categories = ['Alam', 'Sedih', 'Seram', 'Hewan', 'Bayi', 'Sekolah', 'Programming'];
    @endphp
    <div class="grid grid-cols-7 gap-2 py-5 my-5 px-10">
        @for ($i = 0; $i < count($categories); $i++)
            <div
                class="px-2 py-1 rounded border border-slate-700 hover:bg-slate-700 hover:text-white text-black transition duration-300 text-center cursor-pointer">
                {{ $categories[$i] }}
            </div>
        @endfor
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-1.5 p-10">
        <a href="{{ route('foto.show', 'foto-example') }}">
            <img class="h-auto max-w-full rounded-md" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg"
                alt="">
        </a>
    </div>
@endsection
