<x-app-layout>
    @if(session('flash'))
    <div class="snackbar {{ session('flash.snackbar.type') }}">
        {{ session('flash.snackbar.message') }}
    </div>
    @endif

    <div class="container mx-auto px-4">
        <div class="flex flex-col">
            <div class="w-full flex flex-wrap gap-4 justify-between items-center mt-2 py-4 md:py-6 sticky top-0 z-10 bg-white">
                <h3 class="text-xl leading-6 font-medium text-gray-900 max-w-2xl">
                    All Posts
                </h3>
                
                @if($type === 'index')
                    <div class="flex gap-3">
                        <button class="add-post border rounded-md h-10">
                            <a href="{{ route('create') }}" class="flex items-center rounded-md bg-carmine text-white py-1 px-2 text-sm md:text-base gap-1 md:gap-2">
                                Add New Post 
                                <i class="fa fa-plus"></i>
                            </a>
                        </button>
            
                        <button type="button" class="flex items-center text-black border border-gray-400 rounded-md h-10 py-2 px-2 text-sm md:text-base gap-1 md:gap-2">
                            <a href="{{ route('posts.trashed') }}" class="flex items-center rounded-md py-1 px-2 text-sm md:text-base gap-1 md:gap-2">
                                Show Trash
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </button>
                    </div>
                @else
                <div class="flex gap-3">
                    <button class="add-post border rounded-md h-10">
                        <a href="{{ route('posts.index') }}" class="flex items-center rounded-md bg-carmine text-white py-1 px-2 text-sm md:text-base gap-1 md:gap-2">
                            All Posts
                        </a>
                    </button>
                </div>
                @endif
            </div>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-0">
                <table class="w-full border-collapse bg-white shadow-md rounded-md">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">
                                <form action="{{ route('posts.index') }}" method="get">
                                    <button type="submit" name="orderBy" value="id" class="flex items-center">
                                        ID
                                        @if($orderBy == 'id')
                                            <i class="ml-2 text-gray-600">
                                                @if(request('order') == 'asc')
                                                     <i class="fas fa-sort-up"></i> 
                                                @else
                                                <i class="fas fa-sort-down"></i>
                                                @endif
                                            </i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="order" value="{{ $order }}">
                                </form>
                            </th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">
                                <form action="{{ route('posts.index') }}" method="get">
                                    <button type="submit" name="orderBy" value="title" class="flex items-center">
                                        Title
                                        @if($orderBy == 'title')
                                            <i class="ml-2 text-gray-600">
                                                @if(request('order') == 'asc')
                                                <i class="fas fa-sort-up"></i> 
                                                @else
                                                <i class="fas fa-sort-down"></i> 
                                                @endif
                                            </i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="order" value="{{ $order }}">
                                </form>
                            </th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">Content</th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">
                                <form action="{{ route('posts.index') }}" method="get">
                                    <button type="submit" name="orderBy" value="created_at" class="flex items-center">
                                        Date Created
                                        @if($orderBy == 'created_at')
                                            <i class="ml-2 text-gray-600">
                                                @if($order == 'asc')
                                                <i class="fas fa-sort-up"></i> 
                                                @else
                                                <i class="fas fa-sort-down"></i> 
                                                @endif
                                            </i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="order" value="{{ $order }}">
                                </form>
                            </th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">
                                <form action="{{ route('posts.index') }}" method="get">
                                    <button type="submit" name="orderBy" value="updated_at" class="flex items-center">
                                        Date Modified
                                        @if($orderBy == 'updated_at')
                                            <i class="ml-2 text-gray-600">
                                                @if($order == 'asc')
                                                <i class="fas fa-sort-up"></i> 
                                                @else
                                                <i class="fas fa-sort-down"></i> 
                                                @endif
                                            </i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="order" value="{{ $order }}">
                                </form>
                            </th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">View</th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">{{ $edit_text }}</th>
                            <th class="py-4 px-6 text-left text-sm font-medium text-gray-700 tracking-wide">{{ $trash_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                <td class="py-4 px-6 text-sm text-gray-800">{{ $post->id ?? 0 }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $post->title ?? '' }}</td>
                                <td class="content-scroll overflow-x-auto whitespace-nowrap max-w-[500px] py-4 px-6 text-sm text-gray-700">{{ $post->content ?? '' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $post->created_at ?? '' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $post->updated_at ?? '' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700 font-semibold">
                                    <a href="/posts/{{ $post->slug }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700">
                                    @if($type === 'index')
                                        <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-600 hover:underline">{{ $edit_text }}</a>
                                    @else
                                        <form action="{{ route('posts.restore', $post->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="text-blue-600 hover:underline">{{ $edit_text }}</button>
                                        </form>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700">
                                    @if($type === 'index')
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:underline">{{ $trash_text }}</button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.forceDelete', $post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:underline">{{ $trash_text }}</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-6 px-6 text-center text-sm text-gray-500">
                                    No posts found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const snackbar = document.querySelector('.snackbar');
    
        // Show the snackbar if session message exists
        if (snackbar) {
            snackbar.classList.add('show');
    
            setTimeout(() => {
                snackbar.classList.remove('show');
            }, 3000);
        }
    });  
</script>

</x-app-layout>
