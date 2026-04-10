@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4">
        <h6 class="text-lg font-semibold">Edit Blog</h6>
      </div>

      {{-- ERROR --}}
      @if ($errors->any())
        <div class="mx-6 mb-4 p-3 text-white bg-red-500 rounded">
          @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
          @endforeach
        </div>
      @endif

      {{-- FORM --}}
      <div class="p-6 pt-0">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- TITLE --}}
          <div class="mb-4">
            <label class="block mb-1 text-sm font-bold">Judul</label>
            <input type="text" name="title"
                   value="{{ old('title', $blog->title) }}"
                   class="w-full px-3 py-2 border rounded">
          </div>

          {{-- CONTENT --}}
          <div class="mb-4">
            <label class="block mb-1 text-sm font-bold">Konten</label>
            <textarea name="content"
                      class="w-full px-3 py-2 border rounded"
                      rows="5">{{ old('content', $blog->content) }}</textarea>
          </div>

          {{-- IMAGE --}}
          <div class="mb-4">
            <label class="block mb-1 text-sm font-bold">Gambar</label>
            <input type="file" name="image">

            @if($blog->image)
              <img src="{{ asset('storage/'.$blog->image) }}"
                   class="mt-2 h-20 rounded">
            @endif
          </div>

          {{-- BUTTON --}}
          <button class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-4 py-2 text-white rounded">
            Update
          </button>

        </form>
      </div>

    </div>
  </div>
</div>
@endsection
