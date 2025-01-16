<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Manage News</h1>

    <!-- Button to add a new news item -->
    <a href="{{ route('admin.news.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Add News Item
    </a>

    <!-- News Items Table -->
    @if ($newsItems->isEmpty())
        <p>No news items found.</p>
    @else
        <table class="w-full bg-white shadow rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Publication Date</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsItems as $news)
                    <tr class="border-b">
                        <td class="p-4">{{ $news->title }}</td>
                        <td class="p-4">{{ $news->publication_date->format('d M Y') }}</td>
                        <td class="p-4">
                            <a href="{{ route('admin.news.edit', $news->id) }}" class="text-blue-500">Edit</a> |
                            <form method="POST" action="{{ route('admin.news.destroy', $news->id) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>
