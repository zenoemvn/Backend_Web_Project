<x-app-layout>
    <div class="flex">
        <!-- Sidebar: List of users -->
        <div class="w-1/3 border-r h-screen overflow-y-auto">
    <h2 class="text-xl font-bold p-4">Users</h2>
    @forelse ($usersWithMessages as $user)
        <!-- Exclude the logged-in user -->
        @if ($user->id != auth()->id())
            <a href="{{ route('messages.index', ['user_id' => $user->id]) }}"
               class="flex items-center p-4 hover:bg-gray-100 {{ $selectedUserId == $user->id ? 'bg-gray-200' : '' }}">
                <img src="{{ $user->profile_picture ?? asset('default-profile.png') }}" 
                     alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                <span>{{ $user->name }}</span>
            </a>
        @endif
    @empty
        <p class="p-4 text-gray-600">No messages yet.</p>
    @endforelse
</div>


        <!-- Messages Area -->
        <div class="w-2/3 p-6">
            @if ($selectedUserId)
                <h2 class="text-xl font-bold mb-4">
                    Messages with {{ $usersWithMessages->firstWhere('id', $selectedUserId)->name }}
                </h2>
                <div class="overflow-y-auto h-[70vh] border rounded p-4">
                    @forelse ($messages as $message)
                        <div class="mb-4">
                            <p>
                                <strong>{{ $message->sender->id == auth()->id() ? 'You' : $message->sender->name }}:</strong>
                                {{ $message->content }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-600">No messages exchanged yet.</p>
                    @endforelse
                </div>

                <!-- Send a New Message -->
                <form method="POST" action="{{ route('messages.store') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $selectedUserId }}">
                    <textarea name="content" rows="3" required placeholder="Write your message..."
                              class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Send Message</button>
                </form>
            @else
                <p class="text-gray-600">Select a user to view messages.</p>
            @endif
        </div>
    </div>
</x-app-layout>
