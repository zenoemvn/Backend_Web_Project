
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-bold mb-6">Search Results</h1>

        @if($users->isEmpty())
            <p class="text-gray-600">No users found.</p>
        @else
            <ul class="bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
                @foreach($users as $user)
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <a href="{{ route('profile.show', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                                View Profile
                            </a>

                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

