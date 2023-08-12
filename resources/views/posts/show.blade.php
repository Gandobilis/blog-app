<x-app-layout>
    <div
        class="rounded-lg flex flex-col justify-between gap-y-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight">Noteworthy
            {{$post->title}}</h5>
        <img class="rounded-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt=""
             loading="lazy"/>
        <p class="mb-3 font-normal text-2xl">Here are the biggest enterprise
            {{$post->excerpt}}</p>
        @if(auth()->id() === $post->user_id)
            <div x-data="{open: false}"
                 class="relative flex justify-end px-4 pt-4">
                <button @click="open = !open" id="dropdownButton" data-dropdown-toggle="dropdown"
                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor"
                         viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                </button>
            </div>
            <div
                class="absolute top-14 z-10 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="{{ route('post.edit', $post) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <form action="{{ route('post.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
    {{__('Comments:')}}
    @auth
        <form method="POST" action="{{route('comment.store')}}">
            @csrf
            <x-input-label for="content"/>
            <x-text-input id="content" class="block mt-1 w-full"
                          type="content"
                          name="content"
                          placeholder="Comment"
                          required autocomplete="current-content"/>
            <x-primary-button type="submit">
                <input type="hidden" value="{{$post->id}}" name="post_id">
                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                {{__('Add')}}
            </x-primary-button>
        </form>
    @endauth
    <div class="flex flex-col gap-y-5 mt-10">
        <x-comments :comments="$comments"/>
        {{ $comments->links() }}
    </div>
</x-app-layout>
