@extends('layouts.backend')

@section('content')
<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Tambah Blog</h2>

            <a href="{{ route('admin.blogs.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
          <div class="mx-6 mt-4 p-3 text-white bg-red-500 rounded">
            @foreach ($errors->all() as $error)
              <div>• {{ $error }}</div>
            @endforeach
          </div>
        @endif

        {{-- BODY --}}
        <div class="p-6">
          <div class="flex flex-wrap -mx-3">

            {{-- JUDUL --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Judul</label>
              <input type="text" name="title"
                     value="{{ old('title') }}"
                     class="w-full px-3 py-2 border rounded-lg"
                     required>
            </div>

            {{-- GAMBAR --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Gambar</label>
              <input type="file" name="image"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            {{-- CONTENT --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Konten</label>
              <textarea name="content"
                        class="w-full px-3 py-2 border rounded-lg"
                        rows="6"
                        required>{{ old('content') }}</textarea>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3 mt-6">
              <button type="submit"
                      class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
                Simpan
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</form>
@endsection
