<x-app-layout>
    <div class="space-y-5">
        <x-posts :posts="$posts"/>
        {{ $posts->links() }}
    </div>
</x-app-layout>
