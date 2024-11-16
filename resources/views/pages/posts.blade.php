<x-app-layout>
    <div class="px-4 sm:px-6 md:px-10 lg:px-14">
    <div class="posts-container container mx-auto py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loop through all posts -->
            @foreach($posts as $post)
                <div class="post-card bg-white shadow-lg rounded-lg overflow-hidden p-6">
                    <div class="card-content">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <h2 class="text-2xl font-semibold text-gray-800 hover:underline"> 
                                {{ $post->title }}
                            </h2>
                            
                            <p class="text-gray-600 mt-4">{{ \Str::limit($post->content, 150) }}</p>
                            <span class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('d-m-Y') }}</span>
                            <div class="justify-between items-center mt-4">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">Read More</a>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</x-app-layout>
