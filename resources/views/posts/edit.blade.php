<x-app-layout>
    <form method="POST" action="{{route('post.update', $post)}}">
        @csrf

        @method('PUT')
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required
                          autofocus autocomplete="title"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <!-- Excerpt Address -->
        <div class="mt-4">
            <x-input-label for="excerpt" :value="__('Excerpt')"/>
            <x-text-input id="excerpt" class="block outline-indigo-600 mt-1 px-2.5 py-2.5 w-full" type="excerpt"
                          name="excerpt" :value="$post->excerpt"
                          required autocomplete="username"/>
            <x-input-error :messages="$errors->get('excerpt')" class="mt-2"/>
        </div>

        <!-- Content -->
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')"/>

            <x-text-input id="content" class="block px-2.5 py-2.5 outline-indigo-600 mt-1 w-full"
                          type="content"
                          name="content"
                          :value="$post->excerpt"
                          required autocomplete="new-content"/>

            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{route('post.show', $post)}}">
                {{ __('Cancel') }}
            </a>


            <a href="{{ route('post.update', $post) }}">
                <x-primary-button class="ml-4">
                    {{ __('Edit') }}
                </x-primary-button>
            </a>
        </div>
    </form>
</x-app-layout>
