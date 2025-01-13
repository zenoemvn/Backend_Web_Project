<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Users') }}
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('status'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        d
        <!-- Container with flex layout -->
        <div class="flex flex-row gap-12">
        <!-- Left Column: Users Table -->
            <div class="w-2/3">
                <h3 class="text-lg font-semibold mb-3">Existing Users</h3>

                <table class="min-w-full text-left border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Usertype</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->usertype }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.updateUser', $user) }}" method="POST">
                                        @csrf
                                        <select name="usertype" class="border rounded px-2 py-1">
                                            <option value="user"  {{ $user->usertype === 'user' ? 'selected' : '' }}>
                                                User
                                            </option>
                                            <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                        </select>
                                        <button 
                                            type="submit" 
                                            class="bg-blue-600 text-white px-3 py-1 ml-2 rounded"
                                        >
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Right Column: Create New User -->
            <div class="w-1/3">
                <h3 class="text-lg font-semibold mb-3">Create New User</h3>

                <form action="{{ route('admin.storeUser') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block font-medium text-gray-700 mb-1">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('name') }}"
                            required
                        />
                        @error('name')
                            <div class="text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <div class="text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block font-medium text-gray-700 mb-1">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                        @error('password')
                            <div class="text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Usertype -->
                    <div>
                        <label for="usertype" class="block font-medium text-gray-700 mb-1">Usertype</label>
                        <select
                            id="usertype"
                            name="usertype"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                            <option value="user"  {{ old('usertype') === 'user'  ? 'selected' : '' }}>
                                User
                            </option>
                            <option value="admin" {{ old('usertype') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>
                        @error('usertype')
                            <div class="text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded
                               hover:bg-green-700 transition-colors"
                    >
                        Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
