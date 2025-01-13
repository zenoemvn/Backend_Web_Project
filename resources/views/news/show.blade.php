<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">{{ $news->title }}</h1>
    <p class="text-sm text-gray-500">{{ $news->publication_date->format('d M Y') }}</p>

    @if ($news->image_path)
        <img src="{{ asset('storage/' . $news->image_path) }}" alt="News Image" class="my-4">
    @endif

    <p>{{ $news->content }}</p>
</x-app-layout>
