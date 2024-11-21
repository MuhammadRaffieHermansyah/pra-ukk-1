@extends('layouts.authentication')
@section('content')
    <div class="flex flex-col justify-center items-center bg-white w-full my-10">
        <div class="mx-auto flex flex-col justify-center lg:px-6 w-full">
            <div class="my-auto mb-auto flex flex-col mx-auto bg-slate-800 px-8 py-8 rounded-3xl w-[42%]">
                <p class="text-[32px] font-bold text-white ">Sign Up</p>
                <div class="relative my-4">
                    <div class="relative flex items-center py-1 my-2">
                        <div class="grow border-t border-white dark:border-white"></div>
                    </div>
                </div>
                <div>
                    <form class="w-full" method="POST" action="{{ route('do-registration') }}">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="full_name">
                                    Nama Lengkap
                                </label>
                                <input
                                    class="@error('full_name') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="full_name" name="full_name" type="text" placeholder="">
                                @error('full_name')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="username">
                                    Nama Pengguna
                                </label>
                                <input
                                    class="@error('username') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="username" name="username" type="text" placeholder="">
                                @error('username')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="email">
                                    Email
                                </label>
                                <input
                                    class="@error('email') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="email" name="email" type="text" placeholder="">
                                @error('email')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="password">
                                    Password
                                </label>
                                <input
                                    class="@error('password') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="password" name="password" type="password" placeholder="">
                                @error('password')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="confirm_password">
                                    Confirm Password
                                </label>
                                <input
                                    class="@error('confirm_password') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="confirm_password" name="confirm_password" type="password" placeholder="">
                                @error('confirm_password')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2"
                                    for="address">
                                    Address
                                </label>
                                <input
                                    class="@error('address') invalid:border-red-500 @enderror appearance-none block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-200 focus:bg-slate-800"
                                    id="address" name="address" type="text" placeholder="">
                                @error('address')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="my-14">
                            <div class="grow border-t border-white dark:border-white"></div>
                        </div>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3">
                                <button
                                    class="appearance-none text-center block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none hover:border-gray-200 transition duration-300"
                                    id="grid-password" type="submit" placeholder="">
                                    Register</button>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3">
                                <a href="{{ route('login') }}"
                                    class="appearance-none text-center block w-full bg-slate-800 text-white border border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none hover:border-gray-200 transition duration-300"
                                    id="grid-password" type="password" placeholder="">
                                    Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
