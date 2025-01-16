<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
<header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("View and update your profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-1 block w-full"
                :value="old('username', $user->username)"
                autofocus
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input
                id="birthday"
                name="birthday"
                type="date"  
                class="mt-1 block w-full"
                :value="old('birthday', $user->birthday)"
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>
        <div>
    <x-input-label for="aboutme" :value="__('About Me')" />
    <x-text-input
        id="aboutme"
        name="aboutme"
        type="text"
        class="mt-1 block w-full"
        :value="old('aboutme', $user->aboutme)"
        required
    />

    <x-input-error class="mt-2" :messages="$errors->get('aboutme')" />
    </div>

        <!-- Profile Image -->
        <div> 
    @if($user->image)
    <div class="mt-2">
        <img 
            src="{{ asset('storage/' . $user->image) }}" 
            alt="Profile Image"
            class="h-20 w-20 rounded object-cover"
        >
    </div>
@endif

            @if($isOwner)
            <x-input-label for="image" :value="__('Profile Image')" />
    <x-text-input
        id="image"
        name="image"
        type="file"
        class="mt-1 block w-full"
    />

    <x-input-error class="mt-2" :messages="$errors->get('image')" />
            @endif
        </div>

        <!-- Save Button (Only for the Owner) -->
        @if($isOwner)
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        @endif
    </form>
    
    <h2>Public Messages</h2>

@foreach ($user->profileMessages as $message)
    <div class="border p-4 mb-4">
        <p><strong>{{ $message->sender->name }}</strong>: {{ $message->content }}</p>
        <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
    </div>
@endforeach

@auth
    <form method="POST" action="{{ route('profile.message.store', $user->id) }}">
        @csrf
        <textarea name="content" rows="3" placeholder="Write a message..." class="w-full border rounded p-2"></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Post Message</button>
    </form>
@else
    <p>Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to post a message.</p>
@endauth


    </div>
    </div> 
    </div>
    </div>
</x-app-layout>