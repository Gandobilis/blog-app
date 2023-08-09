<form action="{{ route('comments.store') }}" method="post">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <label>
        <textarea name="content" rows="3"></textarea>
    </label>
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>
