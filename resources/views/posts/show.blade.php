<x-app-layout>
    <div
        class="rounded-lg flex flex-col justify-between gap-y-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight">
            {{$post->title}}</h5>
        <img class="rounded-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt=""
             loading="lazy"/>
        <p class="mb-3 font-normal text-2xl">
            {{$post->content}}</p>
    </div>
    @if(auth()->id() === $post->user_id)
        <div>
            <ul class="flex gap-x-2 px-1 py-2" aria-labelledby="dropdownButton">
                <li>
                    <a href="{{ route('post.edit', $post) }}">
                        <x-secondary-button>
                            {{__('Edit')}}
                        </x-secondary-button>
                    </a>
                </li>
                <li>
                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button type="submit">
                            {{__('Delete')}}
                        </x-primary-button>
                    </form>
                </li>
            </ul>
        </div>
    @endif

    <hr/>
    <form method="POST" class="space-y-2" action="{{route('comment.store', $post)}}">
        @csrf
        <x-input-label for="content"/>
        <x-text-input id="content" class="block w-full"
                      type="content"
                      name="content"
                      placeholder="Comment"
                      class="block w-1/2 px-2 py-3"
                      required autocomplete="current-content"/>
        <x-primary-button type="submit">
            Add <i class="ml-1 fa-solid fa-comment"></i>
        </x-primary-button>
    </form>
    <div class="flex items-center gap-x-2 mt-1">
        @if(auth()->id() !== $post->user_id)
            <form class="inline" action="{{ route('posts.toggleLike', $post) }}" method="POST">
                @csrf
                <button type="submit">
                    @if($post->likes->contains(auth()->id()))
                        <i class="fa-solid fa-thumbs-up text-blue-700"></i>
                    @else
                        <i class="fa-regular fa-thumbs-up"></i>
                    @endif
                </button>
            </form>
        @endif
        <p>{{$post->likes()->count()}} Likes</p>
    </div>
    <div class="flex items-center gap-x-2">
        <div class="flex flex-col gap-y-5 mt-10">
            <x-comments :comments="$comments"/>
            {{ $comments->links() }}
        </div>
    </div>
</x-app-layout>
