<div class="relative max-w-4xl p-4 bg-white rounded-lg border dark:bg-gray-800 sm:p-5">
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

    <form action="/dashboard" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title"
                class="@error('title') bg-red-50 border-e-red-500 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                value="{{ old('title') }}" placeholder="Type post title">
                @error('title')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                @enderror
        </div>
        <div class="mb-4">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select name="category_id" id="category"
                class="@error('category_id') bg-red-50 border-e-red-500 text-red-700 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected value="">Select post category</option>
                @foreach (App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea id="body" rows="4" name="body"
                class="@error('body') bg-red-50 border-e-red-500 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Write post body here">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                @enderror
        </div>
        <div class="flex gap-2">
            <button type="submit"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add new post
            </button>
            <a href="/dashboard"
                class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                Cancel
            </a>
        </div>
    </form>
</div>
