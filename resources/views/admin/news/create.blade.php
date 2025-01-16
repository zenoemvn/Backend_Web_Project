<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Add News Item</h1>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
            <input id="title" type="text" name="title" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label for="content" class="block font-medium text-sm text-gray-700">Content</label>
            <textarea id="content" name="content" rows="6" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
            <input id="image" type="file" name="image"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>

        <!-- Publication Date -->
        <div class="mb-4">
            <label for="publication_date" class="block font-medium text-sm text-gray-700">Publication Date</label>
            <input id="publication_date" type="date" name="publication_date" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button>{{ __('Save News Item') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
