<x-app-layout>
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
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required {{ !$isOwner ? 'readonly' : '' }} />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required {{ !$isOwner ? 'readonly' : '' }} />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                :value="old('username', $user->username)" {{ !$isOwner ? 'readonly' : '' }} />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Birthday -->
        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                :value="old('birthday', $user->birthday)" {{ !$isOwner ? 'readonly' : '' }} />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <!-- About Me -->
        <div>
            <x-input-label for="aboutme" :value="__('About Me')" />
            <x-text-input id="aboutme" name="aboutme" type="text" class="mt-1 block w-full"
                :value="old('aboutme', $user->aboutme)" {{ !$isOwner ? 'readonly' : '' }} />
            <x-input-error class="mt-2" :messages="$errors->get('aboutme')" />
        </div>

        <!-- Profile Image -->
        <div>
            @if($user->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="h-20 w-20 rounded object-cover">
                </div>
            @endif

            @if($isOwner)
                <x-input-label for="image" :value="__('Profile Image')" />
                <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
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
</x-app-layout>
