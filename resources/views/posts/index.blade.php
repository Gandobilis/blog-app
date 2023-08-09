@foreach ($posts as $post)
    <a href="{{ route('posts.show', $post->id) }}">
        <h2>{{ $post->title }}</h2>
    </a>
    <p>{{ $post->content }}</p>
@endforeach
