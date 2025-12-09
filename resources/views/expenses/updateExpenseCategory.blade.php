@include('layouts.header')
    <div class="flex flex-col flex-grow">
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Expenses</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Update Expense Category</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--main panel-->
        <div class="p-6">
        <form method="POST" action="" enctype="multipart/form-data">
        @csrf
            <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-black ">Expense
                            Category</label>
                        <input id="category" type="text" name = "name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter expense category" value="{{ $categorie->name }}" required>
                    </div>
                </div>
                <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                    <button
                        class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Update</button>
                    <button
                        class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Reset</button>
                        <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="window.location.href='/expenses/expenseCategoryList'">Cancel</button>
                </div>
            </div>
            </form>
        </div>
        <div class="flex-grow"></div>
        @include('layouts.footer')
        >
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</html>