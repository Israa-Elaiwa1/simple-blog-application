<x-app-layout>

    <div class="container mx-auto px-4">
        <div class="flex flex-col">
            <form id="addPostForm" action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mb-20">
                @method($method)
                @csrf
                <div class="post-heading w-full flex flex-wrap gap-4 justify-between items-center mt-2 py-4 md:py-8 sticky top-0 z-10 bg-white border-b border-gray-300">
                    <div class="flex gap-2 flex-wrap items-end">
                        <h3 class="text-xl leading-6 font-medium text-gray-900 max-w-2xl">
                            {{ $title }}
                        </h3>
                        <a href="{{ route('posts.index') }}" class="flex items-center text-gray-400 text-xs md:text-sm underline">
                            Show all posts
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit" class="add-post border rounded-md bg-carmine">
                            <p class="flex items-center rounded-md bg-carmine text-white py-2 px-2 text-md md:text-base md:py-3 md:px-4 gap-1 md:gap-2">
                                {{ $button }}
                            </p>
                        </button>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="grid grid-cols-1 md:grid-cols-5 pb-7">
                    <div class="flex flex-col gap-5 col-span-1 md:col-span-4 md:pr-10 mx-auto w-full md:w-3/4">
                        <div class="grid grid-cols-1 md:grid-cols-5 pb-7 gap-6">
                            <div class="flex flex-col gap-4 col-span-1 md:col-span-4">
                                <x-main-input 
                                    id="title" 
                                    name="title" 
                                    label="Title" 
                                    placeholder="Enter the title here" 
                                    :value="old('title') ?? ($post->title ?? '')" 
                                    class="border p-3 rounded-md" />
                            </div>

                            <div class="flex flex-col gap-4 col-span-1 md:col-span-4">
                                <label for="content" class="font-medium text-gray-800">Content</label>
                                <textarea 
                                    id="main-content" 
                                    name="content" 
                                    class="custom-input cursor-text p-3 rounded-md border border-gray-300 focus:ring-carmine focus:ring-2 h-40" 
                                    placeholder="Write your content here">{{ old('content') ?? $post->content ?? '' }}
                                </textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}*</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // jQuery validation
            $('#addPostForm').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 2,
                        maxlength: 250
                    },
                    content: {
                        maxlength: 10000
                    }
                },
                messages: {
                    title: {
                        required: "Title is required*",
                        minlength: "Title must be at least 2 characters long",
                        maxlength: "Title can't be more than 250 characters long"
                    },
                    content: {
                        maxlength: "Content can't be more than 10000 characters long"
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('text-red-500 text-sm mt-1');
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    // Submit form if it's valid
                    form.submit();
                }
            });
        });
    </script>
    
</x-app-layout>
