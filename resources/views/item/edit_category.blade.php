@include('layouts.header')
    <div class="flex flex-col h-5/6">
        <!--breadcrumbs-->
        <div class="px-12 py-5 max-sm:px-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <p class="inline-flex items-center text-sm font-medium text-gray-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Main Panel
                        </p>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Items</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Edit Category</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="flex-grow p-6">
            <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="cat_name" class="block mb-2 text-sm font-medium text-black ">Category</label>
                        <input type="text" id="cat_name" name="categories"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Your Category name" value="{{ $categorie->categories }}" required />
                    </div>
                </div>
                <div class="grid mb-6 md:grid-cols-1">

                    <label for="desc" class="block mb-2 text-sm font-medium text-gray-900">Your
                        description</label>
                    <textarea id="desc" rows="4" name="description"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter description" value="" >{{ $categorie->description }}</textarea>

                </div>
                <div class="flex items-center justify-center w-full gap-4 p-4">
                    <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Save</button>
                    <button class="px-6 py-3 text-white bg-black rounded-lg">Reset</button>
                    <button class="px-6 py-3 text-white bg-red-600 rounded-lg">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>

</body>
@include('layouts.footer')

</html>
