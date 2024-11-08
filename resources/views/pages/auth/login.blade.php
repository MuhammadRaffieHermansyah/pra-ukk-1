@extends('layouts.authentication')
@section('content')
    <div class="flex flex-col justify-center items-center my-16 bg-whitew-full">
        <div class="mx-auto flex flex-col justify-center lg:px-6 w-full">
            <div class="my-auto mb-auto flex flex-col mx-auto bg-slate-200 px-8 py-8 rounded-3xl w-[40%]">
                <p class="text-[32px] font-bold text-zinc-950 ">Sign In</p>
                <div class="relative my-4">
                    <div class="relative flex items-center py-1 my-2">
                        <div class="grow border-t border-zinc-200 dark:border-zinc-700"></div>
                    </div>
                </div>
                <div class="bg-red-600 w-full text-white">{{ session('message') }}</div>
                <div>
                    <form class="w-full" method="POST" action="{{ route('do-login') }}">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="email">
                                    Email
                                </label>
                                <input
                                    class="@error('email') is-invalid @enderror appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="email" name="email" type="text" placeholder="email@example.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="password">
                                    Password
                                </label>
                                <input
                                    class="@error('password') is-invalid @enderror appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="password" name="password" type="password" placeholder="***********">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="my-8">
                            <div class="relative flex items-center">
                                <div class="grow border-t border-zinc-200 dark:border-zinc-700"></div>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3">
                                <button
                                    class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 hover:bg-slate-800 hover:text-white transition duration-300"
                                    id="grid-password" type="submit" placeholder="">
                                    Login</button>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3">
                                <a href="{{ route('register') }}"
                                    class="appearance-none text-center block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 hover:bg-slate-800 hover:text-white transition duration-300"
                                    id="grid-password" type="password" placeholder="">
                                    Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection