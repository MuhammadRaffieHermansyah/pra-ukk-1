@extends('layouts.main')
@section('content')
    {{-- <div x-data="snackbar()">
        <button @click="showSnackbar('My Message', 'bg-green-500')">Open Snackbar</button>
        <div class="w-full z-50 bottom-0 fixed" :class="color" x-show="isOpen()"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-50 transform translate-y-6"
            x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-50 transform translate-y-6">
            <div class="max-w-screen-xl mx-auto flex justify-between py-3 text-white font-semibold font-div">
                <div x-text="message"></div>
                <i class="icon-cancel-squared cursor-pointer" @click="close"></i>
            </div>
        </div>
    </div> --}}

    <div x-data="{
        modalIsOpen: false,
        notifications: [],
        displayDuration: 3000,
        soundEffect: false,

        addNotification({ variant = 'info', sender = null, title = null, message = null }) {
            const id = Date.now()
            const notification = { id, variant, sender, title, message }

            // Keep only the most recent 20 notifications
            if (this.notifications.length >= 20) {
                this.notifications.splice(0, this.notifications.length - 19)
            }

            // Add the new notification to the notifications stack
            this.notifications.push(notification)

            if (this.soundEffect) {
                // Play the notification sound
                const notificationSound = new Audio('https://res.cloudinary.com/ds8pgw1pf/video/upload/v1728571480/penguinui/component-assets/sounds/ding.mp3')
                notificationSound.play().catch((error) => {
                    console.error('Error playing the sound:', error)
                })
            }
        },
        removeNotification(id) {
            setTimeout(() => {
                this.notifications = this.notifications.filter(
                    (notification) => notification.id !== id,
                )
            }, 400);
        },
    }"
        x-on:notify.window="addNotification({
        variant: $event.detail.variant,
        sender: $event.detail.sender,
        title: $event.detail.title,
        message: $event.detail.message,
    })">
        <!-- Triggers  -->
        @if (session()->has('success'))
            <div x-init="$nextTick(() => {
                $dispatch('notify', { variant: 'success', title: 'Success!', message: '{{ session()->get('success') }}' })
            })">
            </div>
        @endif
        @if (session()->has('error'))
            <div x-init="$nextTick(() => {
                $dispatch('notify', { variant: 'Danger', title: 'Error!', message: '{{ session()->get('error') }}' })
            })">
            </div>
        @endif
        @error('*')
            <div x-init="$nextTick(() => {
                $dispatch('notify', { variant: 'Danger', title: 'Error!', message: '{{ $message }}' })
            })">
            </div>
        @enderror
        {{-- <button
            @click="$dispatch('notify', { variant: 'success', title: 'Success!',  message: 'Your changes have been saved. Keep up the great work!' })"
            type="button"
            class="cursor-pointer whitespace-nowrap rounded-md bg-green-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Success</button> --}}

        <!-- Success Trigger  -->

        <!-- Notifications -->

        <div x-on:mouseenter="$dispatch('pause-auto-dismiss')" x-on:mouseleave="$dispatch('resume-auto-dismiss')"
            class="group pointer-events-none fixed inset-x-8 top-0 z-[99] flex max-w-full flex-col gap-2 bg-transparent px-6 py-6 md:bottom-0 md:left-[unset] md:right-0 md:top-[unset] md:max-w-sm">
            <template x-for="(notification, index) in notifications" x-bind:key="notification.id">
                <!-- Success Notification  -->
                <template x-if="notification.variant === 'success'">
                    <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible"
                        class="pointer-events-auto relative rounded-md border border-green-500 bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300"
                        role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)"
                        x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)"
                        x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id) }, displayDuration))" x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8"
                        x-transition:leave="transition duration-300 ease-in"
                        x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24"
                        x-transition:leave-start="translate-x-0 opacity-100">
                        <div
                            class="flex w-full items-center gap-2.5 bg-green-500/10 rounded-md p-4 transition-all duration-300">

                            <!-- Icon -->
                            <div class="rounded-full bg-green-500/15 p-0.5 text-green-500" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-5" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Title & Message -->
                            <div class="flex flex-col gap-2">
                                <h3 x-cloak x-show="notification.title" class="text-sm font-semibold text-green-500"
                                    x-text="notification.title"></h3>
                                <p x-cloak x-show="notification.message" class="text-pretty text-sm"
                                    x-text="notification.message"></p>
                            </div>

                            <!--Dismiss Button -->
                            <button type="button" class="ml-auto" aria-label="dismiss notification"
                                x-on:click="(isVisible = false), removeNotification(notification.id)">
                                <svg xmlns="http://www.w3.org/2000/svg viewBox="0 0 24 24 stroke="currentColor"
                                    fill="none" stroke-width="2" class="size-5 shrink-0" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>

        </div>
        </template>
    </div>

    <div class="p-10 w-ful h-screen rounded-sm">
        <div class="flex flex-row items-center justify-between my-4 mb-10">
            <h1 class="font-bold text-3xl"><a class="hover:underline" href="/album">Album</a> > {{ $album->album_name }}</h1>
            <button @click="modalIsOpen = true" type="button"
                class="cursor-pointer whitespace-nowrap px-4 py-2 bg-gray-800 rounded-lg text-white">
                Tambah Foto
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 2xl:grid-cols-5 gap-4 p-10">
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

                    <!-- Ikon Sampah di Pojok Kanan Atas -->
                    <form href="{{ route('foto.destroy', $foto->id) }}" method="POST"
                        class="absolute top-0 right-0 z-10 p-4 text-white opacity-0 group-hover:opacity-100 transition duration-300 hover:text-red-500"
                        onclick="dialogToDelete(event, this)">
                        <i class="fa-solid fa-trash text-lg cursor-pointer"></i>
                    </form>

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
        </div>
    </div>
    {{-- MODAL --}}
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
        @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            class="flex w-1/2 h-fit flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
                    Tambah Foto
                </h3>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Dialog Body -->
                <div class="p-6">
                    <div class="">
                        <label class="mb-2" for="name">Nama</label>
                        <input name="name" id="name"
                            class="my-2 border py-2.5 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                            placeholder="Nama Foto" rows="1" data-hs-default-height="48">
                    </div>
                    <br>
                    <div class="relative flex w-full flex-col gap-1">
                        <label class="w-full pl-0.5 text-sm text-neutral-600 dark:text-neutral-300 mb-2"
                            for="foto">Upload
                            File</label>
                        <input id="foto" name="foto" type="file"
                            class="w-full py-0.5 overflow-clip rounded-md border border-neutral-300 bg-neutral-50/50 text-sm text-neutral-600 file:mr-4 file:cursor-pointer file:border-none file:bg-neutral-50 file:px-4 file:py-2 file:font-medium file:text-neutral-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-300 dark:file:bg-neutral-900 dark:file:text-white dark:focus-visible:outline-white" />
                    </div>
                    <br>
                    <div class="relative flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                        <label for="os" class="w-fit pl-0.5 text-sm mb-2">Kategori</label>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="absolute pointer-events-none right-4 top-11 h-5 w-5">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                        <select id="category_id" name="category_id"
                            class="w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 px-4 py-2.5 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                            <option selected>Please Select</option>
                            @foreach ($fotoCategories as $fotoCategory)
                                <option value="{{ $fotoCategory->id }}">{{ $fotoCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="">
                        <label class="mb-2" for="description">Deskripsi</label>
                        <input name="description" id="description"
                            class="my-2 border py-2.5 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                            placeholder="Deskripsi Foto" rows="1" data-hs-default-height="48">
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" name="album_id" value="{{ $album->id }}" hidden>
                    </div>

                </div>
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                    <button type="button" @click="modalIsOpen = false"
                        class="cursor-pointer whitespace-nowrap rounded-md px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">
                        Batal</button>
                    <button type="submit" @click="modalIsOpen = false"
                        class="cursor-pointer whitespace-nowrap rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="fixed inset-0 items-center justify-center z-50 backdrop-blur confirm-dialog hidden">
        <div class="relative px-4 min-h-screen md:flex md:items-center md:justify-center">
            <div class=" opacity-25 w-full h-full absolute z-10 inset-0"></div>
            <div
                class="bg-white rounded-lg md:max-w-md md:mx-auto p-4 fixed inset-x-0 bottom-0 z-50 mb-4 mx-4 md:relative shadow-lg">
                <div class="md:flex items-center">
                    <div
                        class="rounded-full border border-gray-300 flex items-center justify-center w-16 h-16 flex-shrink-0 mx-auto">
                        <i class="bx bx-error text-3xl">
                            &#9888;
                        </i>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                        <p class="font-bold" id="confirm-dialog-title">Perhatian!</p>
                        <p class="text-sm text-gray-700 mt-1" id="confirm-dialog-description">
                            apakah kamu yakin ingin menghapus foto ini ?
                        </p>
                    </div>
                </div>
                <div class="text-center md:text-right mt-4 md:flex md:justify-end">
                    <button id="confirm-delete-btn"
                        class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 bg-red-200 text-red-700 rounded-lg font-semibold text-sm md:ml-2 md:order-2">
                        Hapus
                    </button>
                    <button id="confirm-cancel-btn"
                        class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 bg-gray-200 rounded-lg font-semibold text-sm mt-4 md:mt-0 md:order-1">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function dialogToDelete(event, element) {
            event.preventDefault();

            document.querySelector('.confirm-dialog').style.display = 'block';

            const cancelBtn = document.querySelector('#confirm-cancel-btn');

            const deleteBtn = document.querySelector('#confirm-delete-btn');

            cancelBtn.addEventListener('click', function() {
                document.querySelector('.confirm-dialog').style.display = 'none';
            })

            deleteBtn.addEventListener('click', function() {
                window.location.href = element.getAttribute('href');
            })
        }
    </script>
@endpush
