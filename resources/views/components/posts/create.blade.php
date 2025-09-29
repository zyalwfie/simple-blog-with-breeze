@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-toolbar {
            border: 1px solid rgb(209 213 219);
            border-radius: 6px;
            background-color: #f9fafb;
        }

        .ql-toolbar.ql-snow+.ql-container.ql-snow {
            border-color: rgb(209 213 219);
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            background-color: #f9fafb;
        }
    </style>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write post body here'
        });

        const postForm = document.getElementById('postForm');
        const postBody = document.getElementById('body');

        quill.clipboard.dangerouslyPasteHTML(postBody.value);

        postForm.addEventListener('submit', function(e) {
            e.preventDefault();
            postBody.value = quill.root.innerHTML;

            this.submit();
        })
    </script>
@endpush

<div class="relative max-w-4xl rounded-lg border bg-white p-4 sm:p-5 dark:bg-gray-800">
    <!-- Modal header -->
    <div class="mb-4 border-b pb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Post</h3>
    </div>

    <!-- Modal body -->

    {{-- @if ($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Ensure that these requirements are met:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif --}}

    <form action="/dashboard" method="POST" id="postForm">
        @csrf
        <div class="mb-4">
            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title"
                class="@error('title') bg-red-50 border-e-red-500 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                value="{{ old('title') }}" placeholder="Type post title">
            @error('title')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                    {{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="category" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select name="category_id" id="category"
                class="@error('category_id') bg-red-50 border-e-red-500 text-red-700 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <option selected value="">Select post category</option>
                @foreach (App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                    {{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea id="body" rows="4" name="body"
                class="@error('body') bg-red-50 border-e-red-500 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block hidden w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Write post body here">
                {!! old('body') !!}
            </textarea>
            <div id="editor"></div>
            @error('body')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                    {{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2">
            <button type="submit"
                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex cursor-pointer items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                <svg class="-ml-1 mr-1 h-6 w-6" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add new post
            </button>
            <a href="/dashboard"
                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                Cancel
            </a>
        </div>
    </form>
</div>
