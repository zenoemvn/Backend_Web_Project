<x-app-layout>
    <h1 class="text-2xl font-bold">News</h1>

    @foreach ($newsItems as $news)
        <div class="border-b py-4">
            <h2 class="text-xl font-semibold">
                <a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
            </h2>
            <p class="text-sm text-gray-500">{{ $news->publication_date->format('d M Y') }}</p>
        </div>
    @endforeach
</x-app-layout>
