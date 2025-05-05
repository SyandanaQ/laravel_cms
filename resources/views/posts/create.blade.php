<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tambah Berita Baru</h2>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Gambar</label>
            <input type="file" name="image" id="image" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium">Deskripsi</label>
            <textarea name="description" id="description" class="w-full border rounded p-2" rows="8"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

{{-- Tambahkan editor TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 300
    });
</script>
@endsection
