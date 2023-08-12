<x-app-layout>
    <form :action="route('post.store')" method="POST">
        @csrf
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                          autofocus autocomplete="title"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <!-- Excerpt Address -->
        <div class="mt-4">
            <x-input-label for="excerpt" :value="__('Excerpt')"/>
            <x-text-input id="excerpt" class="block mt-1 w-full" type="excerpt" name="excerpt" :value="old('excerpt')"
                          required autocomplete="username"/>
            <x-input-error :messages="$errors->get('excerpt')" class="mt-2"/>
        </div>

        <!-- Content -->
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')"/>

            <x-text-input id="content" class="block mt-1 w-full"
                          type="content"
                          name="content"
                          required autocomplete="new-content"/>

            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="/">
                {{ __('Cancel') }}
            </a>

            <x-primary-button class="ml-4" type="submit">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
