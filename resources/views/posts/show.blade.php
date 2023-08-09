<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>

@include('comments._form')

@foreach ($post->comments as $comment)
    <div>
        <p>{{ $comment->content }}</p>
    </div>
@endforeach
