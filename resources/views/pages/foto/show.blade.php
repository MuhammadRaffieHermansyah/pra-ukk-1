@extends('layouts.main')
@section('content')
    <div class="mx-auto w-4/5 h-full my-10 bg-black">
        <div class="bg-black">
            <img class="h-64 w-96 mx-auto" src="{{ url('storage/' . $foto->file_location) }}" alt="">
            <div class="flex flex-row justify-between items-center py-4 px-8">
                <div class="text-white">
                    <small class="font-bold text-lg">{{ $foto->user->username }}</small><br>
                    <small>{{ $foto->description }}</small>
                </div>
                <div class="mx-5"></div>
                <div class="mr-5"><i class="{{ $foto->isLike ? 'fa-solid' : 'fa-regular' }} fa-heart text-white"
                        id="like-icon" onclick="likeFoto()"></i></div>
            </div>
            <div class="px-8 my-3">
                <!-- Textarea -->
                <form class="relative w-full" action="{{ route('comment-foto.store') }}" method="POST">
                    @csrf
                    <textarea id="hs-default-height-with-autoheight-script" name="comment"
                        class="max-h-36 py-3 ps-4 pe-20 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 resize-none overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500"
                        placeholder="Tambah Komentar" rows="1" data-hs-default-height="48"></textarea>
                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    <input type="text" name="foto_id" value="{{ $foto->id }}" hidden>
                    <!-- Button Group -->
                    <input type="submit" hidden>
                    <div class="absolute top-2 end-3 z-10">
                        <button type="submit"
                            class="py-1.5 px-3 inline-flex shrink-0 justify-center items-center text-sm font-medium rounded-lg text-white bg-transparent hover:bg-transparent focus:outline-none focus:bg-transparent disabled:opacity-50 disabled:pointer-events-none">
                            Kirim
                        </button>
                    </div>
                </form>
                <!-- End Textarea -->
            </div>
        </div>
        <hr class="text-white my-4">
        {{-- Komentar --}}
        <div class="bg-black py-4 px-8">
            @foreach ($foto->commentFotos as $comment)
                <div class="text-white mb-7">
                    <small class="font-bold text-[15px]">{{ $comment->user->username }}</small><br>
                    <small class="font-thin tracking-wide">{{ $comment->comment }}</small>
                    <small class="font-thin tracking-wide block mt-3 text-xs">{{ $comment->created_at->diffForHumans() }}</small>
                    <hr class="border-gray-900 mt-4 opacity-60">
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('script')
    <script>
        const likeIcon = document.getElementById('like-icon');
        const likeFoto = () => {
            // Mengecek apakah ikon menggunakan kelas `fa-solid`
            if (likeIcon.classList.contains("fa-regular")) {
                // Mengubah dari `solid` ke `regular` untuk "like"
                fetch("http://127.0.0.1:8000/api/like-foto/store", {
                    method: "POST",
                    body: JSON.stringify({
                        user_id: @json(Auth::user()->id),
                        foto_id: @json($foto->id),
                    }),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                    }
                }).
                then((res) => {
                    likeIcon.classList.remove("fa-regular");
                    likeIcon.classList.add("fa-solid");
                });
            } else {
                // Mengubah dari `regular` ke `solid` untuk "unlike"
                fetch(`http://127.0.0.1:8000/api/like-foto/destroy`, {
                    method: "POST",
                    body: JSON.stringify({
                        user_id: @json(Auth::user()->id),
                    }),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                    }
                }).
                then((res) => {
                    likeIcon.classList.remove("fa-solid");
                    likeIcon.classList.add("fa-regular");
                });
            }
        };
    </script>
@endpush
