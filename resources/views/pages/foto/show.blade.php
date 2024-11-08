@extends('layouts.main')
@section('content')
    <div class="mx-auto w-4/5 h-full my-10 bg-black">
        <div class="bg-black">
            <img class="h-64 w-96 mx-auto" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg"
                alt="">
            <div class="flex flex-row justify-between items-center py-4 px-8">
                <div class="text-white">
                    <small class="font-bold text-lg">wordfangs</small><br>
                    <small>📸 @martinusragitaa vs Bangli’s heavy rain. 🎨 @foldermod @phantom.killah Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                        adipisci! A, totam voluptatibus?</small>
                </div>
                <div class="mx-5"></div>
                <div class="mr-5"><i class="fa-solid fa-heart text-white"></i><i
                        class="fa-regular fa-heart text-white"></i></div>
            </div>
            <div class="px-8 my-3">
                <!-- Textarea -->
                <div class="relative w-full">
                    <textarea id="hs-default-height-with-autoheight-script"
                        class="max-h-36 py-3 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                        placeholder="Tambah Komentar" rows="1" data-hs-default-height="48"></textarea>

                    <!-- Button Group -->
                    <div class="absolute top-2 end-3 z-10">
                        <button type="button"
                            class="py-1.5 px-3 inline-flex shrink-0 justify-center items-center text-sm font-medium rounded-lg text-white bg-transparent hover:bg-transparent focus:outline-none focus:bg-transparent disabled:opacity-50 disabled:pointer-events-none">
                            Kirim
                        </button>
                    </div>
                </div>
                <!-- End Textarea -->
            </div>
        </div>
        <hr class="text-white my-4">
        <div class="bg-black py-4 px-8">
            <div class="text-white mb-7">
                <small class="font-bold text-[15px]">wordfangs</small><br>
                <small class="font-thin tracking-wide">Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                    adipisci! A, totam voluptatibus?</small>
                <small class="font-thin tracking-wide block mt-3 text-xs">1 menit lalu</small>
                <hr class="border-gray-900 mt-4 opacity-60">
            </div>
            <div class="text-white mb-7">
                <small class="font-bold text-[15px]">wordfangs</small><br>
                <small class="font-thin tracking-wide">Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                    adipisci! A, totam voluptatibus?</small>
                <small class="font-thin tracking-wide block mt-3 text-xs">1 menit lalu</small>
                <hr class="border-gray-900 mt-4 opacity-60">
            </div>
            <div class="text-white mb-7">
                <small class="font-bold text-[15px]">wordfangs</small><br>
                <small class="font-thin tracking-wide">Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                    adipisci! A, totam voluptatibus?</small>
                <small class="font-thin tracking-wide block mt-3 text-xs">1 menit lalu</small>
                <hr class="border-gray-900 mt-4 opacity-60">
            </div>
            <div class="text-white mb-7">
                <small class="font-bold text-[15px]">wordfangs</small><br>
                <small class="font-thin tracking-wide">Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                    adipisci! A, totam voluptatibus?</small>
                <small class="font-thin tracking-wide block mt-3 text-xs">1 menit lalu</small>
                <hr class="border-gray-900 mt-4 opacity-60">
            </div>
            <div class="text-white mb-7">
                <small class="font-bold text-[15px]">wordfangs</small><br>
                <small class="font-thin tracking-wide">Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Aut quaerat itaque nobis. Eaque reprehenderit asperiores velit
                    adipisci! A, totam voluptatibus?</small>
                <small class="font-thin tracking-wide block mt-3 text-xs">1 menit lalu</small>
                <hr class="border-gray-900 mt-4 opacity-60">
            </div>
        </div>
    </div>
@endsection
