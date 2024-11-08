@extends('layouts.main')
@section('content')
    <div class="p-10 w-ful h-screen rounded-sm">
        <div class="flex flex-row items-center justify-between my-4 mb-10">
            <h1 class="font-bold text-3xl">Album</h1>
            <a href="{{ route('album.create') }}" class="px-4 py-2 bg-gray-800 rounded-lg text-white">Tambah Album</a>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div
                class="w-full rounded-lg flex flex-col justify-center items-start bg-gray-800 px-6 py-3 hover:bg-opacity-95 cursor-pointer transitio duration-300">
                <h1 class="font-bold text-lg text-white">Keluarga</h1>
                <small class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo vitae sit atque
                    officiis minima totam
                    dicta
                    quod molestias voluptates neque.</small>
            </div>
        </div>
    </div>
@endsection
