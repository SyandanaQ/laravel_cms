@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 mt-2">Selamat datang di dashboard. Berikut adalah postingan terbaru.</p>
        </div>

        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Postingan Terbaru</h2>

        @if ($latestPosts->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestPosts as $post)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Image"
                                class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($post->description)), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="inline-block text-sm font-medium text-blue-600 hover:underline">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $latestPosts->links() }}
            </div>
        @else
            <p class="text-gray-500">Belum ada postingan.</p>
        @endif
    </div>
@endsection
