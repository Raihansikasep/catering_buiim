@extends('layouts.backend')

@section('content')

<div class="p-6">

    <h2 class="text-xl font-bold mb-4">Tambah Blog</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul" class="w-full border p-2 mb-3">

        <textarea name="content" class="w-full border p-2 mb-3" placeholder="Content">{{ old('content') }}</textarea>

        <input type="file" name="image" class="mb-3">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>

@endsection
