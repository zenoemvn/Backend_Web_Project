<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Edit News Item</h1>

    <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
            <input id="title" type="text" name="title" value="{{ $news->title }}" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label for="content" class="block font-medium text-sm text-gray-700">Content</label>
            <textarea id="content" name="content" rows="6" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $news->content }}</textarea>
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
            <input id="image" type="file" name="image"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
            @if ($news->image_path)
                <img src="{{ asset('storage/' . $news->image_path) }}" alt="News Image" class="mt-4 w-32 h-32 rounded-md">
            @endif
        </div>

        <!-- Publication Date -->
        <div class="mb-4">
            <label for="publication_date" class="block font-medium text-sm text-gray-700">Publication Date</label>
            <input id="publication_date" type="date" name="publication_date" value="{{ $news->publication_date->format('Y-m-d') }}" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button>{{ __('Update News Item') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
