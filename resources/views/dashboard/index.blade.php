<x-app-layout>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <p class="text-gray-700 text-base">
                {{auth()->user()->name}}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total Posts {{auth()->user()->count()}}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total Likes {{auth()->user()->count()}}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total Comments {{auth()->user()->count()}}</span>
        </div>
    </div>
</x-app-layout>
