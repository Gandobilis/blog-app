<div x-data="{edit: false}">
    <p x-show="!edit">{{$comment->content}}</p>
    <form x-show="edit" method="POST" action="{{ route('comment.update', $comment) }}">
        @csrf

        @method('PUT')
        <label>
            <input type="text" value="{{$comment->content}}" name="content" required/>
        </label>
        <div>
            <x-secondary-button @click="edit = false">
                {{__('Cancel')}}
            </x-secondary-button>
            <button type="submit" @click="edit = true">
                <x-primary-button>
                    {{__('Save')}}
                </x-primary-button>
            </button>
        </div>
    </form>
    @if(auth()->id() === $comment->user_id)
        <div x-show="!edit">
            <x-secondary-button @click="edit = true">
                {{__('Edit')}}
            </x-secondary-button>
            <form method="POST" class="inline" action="{{ route('comment.destroy', $comment) }}">
                @csrf
                @method('DELETE')

                <x-primary-button type="submit">
                    {{__('Delete')}}
                </x-primary-button>
            </form>
        </div>
    @endif
</div>
