<x-app-layout>
    <h1 class="text-3xl font-bold">{{ $news->title }}</h1>
    <p class="mt-4 text-gray-600">{{ $news->content }}</p>

    @if ($news->image_path)
        <img src="{{ asset('storage/' . $news->image_path) }}" alt="News Image" class="mt-4 rounded-md">
    @endif

    <hr class="my-6">

    <!-- Comments Section -->
    <h2 class="text-2xl font-bold mt-8">Comments</h2>

    @if ($comments->isEmpty())
        <p class="text-gray-600">No comments yet. Be the first to comment!</p>
    @else
        @foreach ($comments as $comment)
            <div class="mt-4">
                <p class="font-bold">{{ $comment->user->name }}</p>
                <p class="text-gray-600">{{ $comment->content }}</p>
                <p class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    @endif

    <!-- Add Comment Form -->
    @auth
        <form method="POST" action="{{ route('news.addComment', $news->id) }}" class="mt-6">
            @csrf
            <textarea name="content" rows="4" required placeholder="Write your comment here..."
                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            <x-primary-button class="mt-4">{{ __('Add Comment') }}</x-primary-button>
        </form>
    @else
        <p class="text-gray-600 mt-6">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to leave a comment.</p>
    @endauth
</x-app-layout>
