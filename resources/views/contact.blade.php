<x-app-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-8">Contact Us</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Contact Form -->
        <form method="POST" action="{{ route('contact.send') }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Your Name</label>
                <input id="name" name="name" type="text" class="block mt-1 w-full" required>
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-medium">Your Email</label>
                <input id="email" name="email" type="email" class="block mt-1 w-full" required>
            </div>

            <div class="mt-4">
                <label for="message" class="block text-sm font-medium">Your Message</label>
                <textarea id="message" name="message" class="block mt-1 w-full" rows="5" required></textarea>
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 mt-4 rounded-md shadow-md hover:bg-indigo-700">
                Send Message
            </button>
        </form>
    </div>
</x-app-layout>
