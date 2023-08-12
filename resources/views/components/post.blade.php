<div
    class="max-w-sm bg-gray-800 rounded-lg shadow flex flex-col justify-between">
    <a href="{{route('post.show', $post)}}" class="rounded-t-lg overflow-hidden">
        <img class="hover:transform hover:scale-105 hover:duration-300"
             src="https://flowbite.com/docs/images/blog/image-1.jpg" alt=""
             loading="lazy"/>
    </a>

    @if(auth()->id() === $post->user_id)
        <div>
            <ul class="flex px-1 py-2" aria-labelledby="dropdownButton">
                <li>
                    <a href="{{ route('post.edit', $post) }}"
                       class="text-center rounded-sm block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </li>
                <li>
                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="w-full block rounded-sm px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endif

    <div class="p-5">
        <a href="{{route('post.show', $post)}}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                {{$post->title}}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
            {{$post->excerpt}}</p>
        <div class="flex justify-between items-center">
            <a href="{{route('post.show', $post)}}"
               class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-700 hover:bg-gray-300 bg-gray-100 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                Read more
                <svg class="hover:transform hover:ml-3 hover:duration-150 w-3.5 h-3.5 ml-2" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <a href="{{ route('post.show', $post) }}">
                <div class="space-x-2 hover:transform hover:scale-105 hover:duration-150">
                    <i class="fa-solid fa-thumbs-up text-white"></i>
                    <sup style="color: #59CE8F;">
                        {{random_int(0, 10)}}
                    </sup>
                    <i class="fa-regular fa-comment text-white"></i>
                    <sup class="text-indigo-500" style="color: #F05454;">
                        {{$post->comments_count}}
                    </sup>
                </div>
            </a>
        </div>
    </div>
</div>
