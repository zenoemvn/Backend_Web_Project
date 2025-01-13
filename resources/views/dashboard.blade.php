<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h2 class="text-xl font-bold mb-4">Update Your Track & Field Records</h2>

        <!-- Performance Update Form -->
        <form method="POST" action="{{ route('track_events.update') }}" class="bg-white shadow rounded-lg p-6">
            @csrf

            <!-- Event Dropdown -->
            <div class="mb-4">
                <label for="track_event" class="block font-medium text-sm text-gray-700">Select Your Event</label>
                <select id="track_event" name="track_event_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Choose an event...</option>
                    @foreach (auth()->user()->trackEvents as $event)
                        <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Performance Input -->
            <div class="mb-4">
                <label for="performance" class="block font-medium text-sm text-gray-700">Your Performance (Time/Distance)</label>
                <input id="performance" name="performance" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Enter your record (e.g., 12.5s or 6.23m)" required>
            </div>

            <!-- Submit Button -->
            <div>
                <x-primary-button>{{ __('Save Record') }}</x-primary-button>
            </div>
        </form>

        <!-- Records History -->
        <div class="mt-8">
            <h3 class="text-lg font-bold mb-4">Your Records History</h3>
            @foreach (auth()->user()->trackEvents as $event)
                <h4 class="font-semibold">{{ $event->event_name }}</h4>
                <ul class="list-disc pl-6">
                    @foreach ($event->records as $record)
                        <li>{{ $record->performance }} ({{ $record->created_at->format('d M Y') }})</li>
                    @endforeach
                </ul>
            @endforeach
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="mt-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif
    </div>
    
    @isset($users)
        <x-user-search-results :users="$users" />
    @endisset
</x-app-layout>

 




