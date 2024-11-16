<x-app-layout>

    @if(session('flash'))
    <div class="snackbar {{ session('flash.snackbar.type') }}">
        {{ session('flash.snackbar.message') }}
    </div>
    @endif

    <div class="px-4 sm:px-6 md:px-10 lg:px-14" >
        <div class="single-post-container flex flex-col items-left justify-center min-h-screen px-4 py-9">
            <!-- Post Container -->
            <div class="post-container w-full rounded-lg">
                <div class="border-b border-gray-300">
                    <h1 class="post-title leading-tight mb-4 font-bold">{{ $post->title }}</h1>
                    <p class="font-light text-sm mb-6 leading-none mt-5 text-left">
                        <span
                        font-family: sans-serif;" class="date font-light leading-relaxed inline-block bg-white border border-black border-solid py-2 px-3 text-black">
                            {{ $post->created_at->translatedFormat('l') }}
                        </span>
                        <span
                        font-family: sans-serif;" class="date font-light leading-relaxed inline-block bg-white border border-black border-solid py-2 px-3 text-black">
                            Date: {{ $post->created_at->format('d-m-Y') }}
                        </span>
                    </p>
                </div>
                <div class="text-left text-xl mt-8">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Comment Section -->
            <div class="comment-section w-full rounded-lg mt-9">
                <div class="border-b border-gray-300">
                    <h2 class="text-xl font-semibold mb-6">Comments</h2>
                </div>

                <!-- Comments List -->
                @forelse ($post->comments as $comment)
                    <div class="comment-box mt-6 mb-2 p-4 bg-gray-100 rounded-lg" id="comment-{{ $comment->id }}">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-lg text-gray-800">{{ $comment->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="comment-icon comment-content flex items-center">
                            <p class="mt-1 text-gray-600">{{ $comment->content }}</p>

                            @if ($comment->user_id === auth()->id())

                            <!-- Trigger Dropdown Menu -->
                            <button 
                            class="text-gray-600 hover:text-blue-600 focus:outline-none gear-icon" 
                            data-comment-id="{{ $comment->id }}">
                            <i class="fa-solid fa-gear"></i>
                            </button>
                            @endif
                        </div>

                        <!-- Update Form -->
                        @auth
                        @if ($comment->user_id === auth()->id())
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST" id="edit-form-{{ $comment->id }}" style="display: none;">
                                @csrf
                                @method('PUT')
                                <textarea 
                                    name="content" 
                                    rows="4" 
                                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-300"
                                    placeholder="Edit your comment here..." 
                                    required>{{ $comment->content }}</textarea>
                                <button 
                                    type="submit" 
                                    class="mt-4 w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-gray-300 transition-all ease-in-out duration-300">
                                    Save Changes
                                </button>
                                <button type="button" class="cancel-edit mt-4 w-full bg-gray-300 text-black py-3 rounded-lg" data-comment-id="{{ $comment->id }}">
                                    Cancel
                                </button>
                            </form>
                        @endif
                        @endauth

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                            <a href="#" class="edit-comment block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100" data-comment-id="{{ $comment->id }}">Edit</a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="delete-comment block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="mt-6 text-gray-600">No comments yet. Be the first to comment!</p>
                @endforelse

                <!-- Add Comment Form -->
                @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6 bg-white rounded-lg">
                    @csrf
                    <textarea 
                        name="content" 
                        rows="4" 
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-300"
                        placeholder="Write your comment here..." 
                        required></textarea>
                    <button 
                        type="submit" 
                        class="mt-4 w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 transition-all ease-in-out duration-300">
                        Add Comment
                    </button>
                </form>
                @else
                <p class="text-gray-600 mt-4 text-center">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to leave a comment.</p>
                @endauth
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        // Toggle the dropdown menu when the gear icon is clicked
        $('.gear-icon').on('click', function() {
            var commentId = $(this).data('comment-id');
            var $dropdownMenu = $('#comment-' + commentId).find('.dropdown-menu');
            
            $dropdownMenu.toggleClass('hidden');
        });

        // Close the dropdown when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.gear-icon').length) {
                $('.dropdown-menu').addClass('hidden');
            }
        });

        // Edit Comment
        $('.edit-comment').on('click', function (e) {
            e.preventDefault();

            var commentId = $(this).data('comment-id');
            console.log('Edit clicked for comment ID:', commentId); // Debugging

            // Select elements based on comment ID
            var $commentContent = $('#comment-' + commentId).find('.comment-content');
            var $editForm = $('#edit-form-' + commentId);

            // Hide original content and show the edit form
            $commentContent.hide();
            $editForm.show();
        });

        // Cancel
        $('.cancel-edit').on('click', function(e) {
            var commentId = $(this).data('comment-id');
            $('#comment-' + commentId).find('.comment-content').show(); // Show the original content
            $('#edit-form-' + commentId).hide(); // Hide the edit form
        });

        // Delete Comment
        $('.delete-comment form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this comment?')) {
                $(this).off('submit').submit(); // Submit the form if confirmed
            }
        });

        // Handle Snackbar
        const snackbar = $('.snackbar');

        // Show the snackbar if session message exists
        if (snackbar.length) {
            snackbar.addClass('show');

            setTimeout(function() {
                snackbar.removeClass('show');
            }, 3000);
        }
    });
</script>
</x-app-layout>
