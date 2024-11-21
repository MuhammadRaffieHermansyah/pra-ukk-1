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
            <h1 class="font-bold text-3xl">Album</h1>
            <button @click="modalIsOpen = true" type="button"
                class="cursor-pointer whitespace-nowrap px-4 py-2 bg-gray-800 rounded-lg text-white">
                Tambah Album
            </button>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($albums as $album)
                <a href="{{ route('album.show', $album->album_name) }}"
                    class="w-full rounded-lg flex flex-row justify-between items-center bg-gray-800 px-6 py-3 hover:bg-opacity-95 cursor-pointer transitio duration-300">
                    <div class="flex flex-col">
                        <h1 class="font-bold text-lg text-white">{{ $album->album_name }}</h1>
                        <small class="text-white">{{ $album->description }}</small>
                    </div>
                    <div href="/album/destroy/{{ $album->id }}" onclick="customeConfirmDialog(event, this)"
                        class="py-2 px-4 rounded-lg border group border-white hover:bg-white transition duration-300">
                        <button type="button"
                            class="fa-solid fa-trash text-lg text-white group-hover:text-red-500 transition duration-300"></button>
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
                    Tambah Album
                </h3>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('album.store') }}" method="POST">
                @csrf
                <!-- Dialog Body -->
                <div class="p-6">
                    <div class="">
                        <label class="mb-2" for="album_name">Nama</label>
                        <input name="album_name" id="album_name"
                            class="my-2 max-h-36 border py-3 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                            placeholder="Nama Album" rows="1" data-hs-default-height="48">
                    </div>
                    <br>
                    <div class="">
                        <label class="mb-2" for="description">Deskripsi</label>
                        <input name="description" id="description"
                            class="my-2 max-h-36 border py-3 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                            placeholder="Deskripsi Album" rows="1" data-hs-default-height="48">
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
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
@endsection
@push('script')
    <script>

        function customeConfirmDialog(event, element) {
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
