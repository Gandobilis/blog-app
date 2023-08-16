<div x-data="{edit: false}">
    <p x-show="!edit">{{$comment->content}}</p>
    <form x-show="edit" method="POST" class="space-y-1" action="{{ route('comment.update', $comment) }}">
        @csrf

        @method('PUT')
        <x-input-label>
            <x-text-input type="text" value="{{$comment->content}}" name="content" required/>
        </x-input-label>
        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        <div>
            <x-secondary-button @click="edit = false">
                <i class="fa-solid fa-xmark"></i>
            </x-secondary-button>
            <button type="submit" @click="edit = true">
                <x-primary-button>
                    <i class="fa-solid fa-check"></i>
                </x-primary-button>
            </button>
        </div>
    </form>
    @if(auth()->id() === $comment->user_id)
        <div x-show="!edit" class="flex items-center space-x-5">
            <div>
                <x-secondary-button @click="edit = true">
                    <i class="fa-solid fa-pen"></i>
                </x-secondary-button>
                <form method="POST" class="inline" action="{{ route('comment.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')

                    <x-primary-button type="submit">
                        <i class="fa-solid fa-trash-can"></i>
                    </x-primary-button>
                </form>
            </div>
        </div>
    @endif
    <div class="flex items-center gap-x-2">
        @if(auth()->id() !== $comment->user_id)
        <form class="inline" action="{{ route('comments.toggleLike', $comment) }}" method="POST">
            @csrf
            <button type="submit">
                <i class="fa-solid fa-thumbs-up text-blue-700"></i>
            </button>
        </form>
        @endif
        <p>{{$comment->likes->count()}} Likes</p>
    </div>
</div>
