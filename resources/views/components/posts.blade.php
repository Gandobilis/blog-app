<div class="grid grid-cols-4 gap-5">
    @foreach($posts as $post)
        <x-post :post="$post"/>
    @endforeach
</div>
