<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Private Messages</h1>

    <!-- Received Messages -->
    <h2 class="text-xl font-bold mb-4">Received Messages</h2>
    @forelse ($receivedMessages as $message)
        <div class="border p-4 mb-4 rounded-md">
            <p><strong>From:</strong> {{ $message->sender->name }}</p>
            <p>{{ $message->content }}</p>
            <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
        </div>
    @empty
        <p class="text-gray-600">No messages received yet.</p>
    @endforelse

    <!-- Sent Messages -->
    <h2 class="text-xl font-bold mb-4 mt-8">Sent Messages</h2>
    @forelse ($sentMessages as $message)
        <div class="border p-4 mb-4 rounded-md">
            <p><strong>To:</strong> {{ $message->receiver->name }}</p>
            <p>{{ $message->content }}</p>
            <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
        </div>
    @empty
        <p class="text-gray-600">No messages sent yet.</p>
    @endforelse

    <!-- Send New Message -->
    <h2 class="text-xl font-bold mb-4 mt-8">Send a New Message</h2>
<form method="POST" action="{{ route('messages.store') }}">
    @csrf

    <!-- Select Recipient -->
    <label for="receiver_id" class="block font-medium text-sm text-gray-700">Select User:</label>
    <select id="receiver_id" name="receiver_id" required class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 mb-4">
        <option value="" disabled selected>-- Select a User --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <!-- Message Content -->
    <label for="content" class="block font-medium text-sm text-gray-700">Message:</label>
    <textarea id="content" name="content" rows="4" required placeholder="Write your message..."
        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>

    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">
        Send Message
    </button>
</form>

</x-app-layout>
