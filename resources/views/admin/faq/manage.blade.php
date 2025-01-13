<x-app-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-8">Manage FAQs</h1>

        <!-- Form to Add a New Category -->
        <div class="mb-8 bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Add a New Category</h2>
            <form method="POST" action="{{ route('faq.category.store') }}">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium">Category Name</label>
                    <input id="name" name="name" type="text" class="block mt-1 w-full" required>
                </div>
                <button class="bg-indigo-600 text-white px-4 py-2 mt-4 rounded-md shadow-md hover:bg-indigo-700">
                    Add Category
                </button>
            </form>
        </div>

        <!-- Form to Add a New FAQ -->
        <form method="POST" action="{{ route('faq.store') }}" class="mb-8 bg-white shadow rounded-lg p-6">
            @csrf
            <h2 class="text-xl font-bold mb-4">Add a New FAQ</h2>

            <div>
                <label for="category_id" class="block text-sm font-medium">Category</label>
                <select id="category_id" name="category_id" class="block mt-1 w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="question" class="block text-sm font-medium">Question</label>
                <input id="question" name="question" type="text" class="block mt-1 w-full" required>
            </div>

            <div>
                <label for="answer" class="block text-sm font-medium">Answer</label>
                <textarea id="answer" name="answer" class="block mt-1 w-full" required></textarea>
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 mt-4 rounded-md shadow-md hover:bg-indigo-700">
                Add FAQ
            </button>
        </form>

        <!-- Existing FAQs Section -->
        <h2 class="text-2xl font-bold mb-4">Existing FAQs</h2>
        @foreach ($categories as $category)
            <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
            <ul>
                @foreach ($category->faqs as $faq)
                    <li class="mb-2">
                        <p class="font-semibold">{{ $faq->question }}</p>
                        <p>{{ $faq->answer }}</p>
                        <a href="{{ route('faq.edit', $faq->id) }}" class="text-indigo-500">Edit</a>
                        <form method="POST" action="{{ route('faq.delete', $faq->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</x-app-layout>
