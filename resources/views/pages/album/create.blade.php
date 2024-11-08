@extends('layouts.main')
@section('content')
    <div class="bg-gray-900 w-2/5 mx-auto">
        <div class="max-w-sm mx-auto">
            <div class="flex justify-between items-center text-white">
                <label for="with-corner-hint" class="block text-sm font-medium mb-2">Name</label>
            </div>
            <input type="email" id="with-corner-hint"
                class="py-3 px-4 block w-full ring-0 border-gray-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
    </div>
@endsection
