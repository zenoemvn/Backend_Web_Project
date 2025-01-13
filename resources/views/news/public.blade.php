<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">News</h1>

    @if ($newsItems->isEmpty())
        <p>No news items available yet.</p>
    @else
        @foreach ($newsItems as $news)
            <div class="border-b py-4">
                <h2 class="text-xl font-semibold">
                    {{ $news->title }}
                </h2>
                <p class="text-sm text-gray-500">{{ $news->publication_date->format('d M Y') }}</p>
                <p>{{ Str::limit($news->content, 150) }}</p>
                <a href="{{ route('news.show', $news->id) }}" class="text-blue-500 hover:underline">Read more</a>
            </div>
        @endforeach
    @endif
</x-app-layout>
