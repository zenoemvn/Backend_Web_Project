<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Link to Edit Users Page -->
        <a href="{{ route('admin.editusers') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ __('Edit Users') }}
        </a>

        <!-- Link to Manage News Page -->
        <a href="{{ route('admin.news.index') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-4">
            {{ __('Manage News') }}
        </a>
    </div>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

        <!-- Button to go to FAQ Management -->
        <a href="{{ route('faq.manage') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">
            Manage FAQs
        </a>

        <!-- Other admin links can go here -->
    </div>
</x-app-layout>
