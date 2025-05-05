<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" alt="Image" class="mb-4" width="100%">
    @endif

    <div>{!! $post->description !!}</div>

    <div class="mt-6">
        <a href="{{ route('posts.index') }}" class="text-blue-500">Kembali ke Daftar Berita</a>
    </div>
</div>
@endsection
