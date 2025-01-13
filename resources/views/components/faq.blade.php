<x-app-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-8">Frequently Asked Questions</h1>

        @foreach ($categories as $category)
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">{{ $category->name }}</h2>
                <ul>
                    @foreach ($category->faqs as $faq)
                        <li class="mb-4">
                            <p class="font-semibold">{{ $faq->question }}</p>
                            <p class="text-gray-700">{{ $faq->answer }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-app-layout>
