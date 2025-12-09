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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Add New Expense</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--main panel-->
        
        <div><center>@include('_message')</center></div>
        <form method="POST" action="{{ route('addExpense') }}" enctype="multipart/form-data">
        @csrf
            <div class="p-6">
                <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="exp_date" class="block mb-2 text-sm font-medium text-black ">Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker id="exp_date" type="text" name="expense_date"
                                    class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-black ">Expense Title</label>
                            <input id="title" type="text" name="expense_title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter expense title" required>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3 ">
                        
                        <div class="md:col-span-2">
                            <label for="expense-search" class="block mb-2 text-sm font-medium text-black ">Expence
                                Category</label>
                            <!--custom combobox-->
                            <div class="w-full custom-select">
                                <select id="exp_cat" name="exp_cat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden">
                                    <option value="">Select expense category</option>
                                    @foreach ($categorie as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-black ">Amount</label>
                            <input id="amount" type="text" name="amount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter amount" required>
                        </div>
                    </div>
                    <div class="grid mb-6 md:grid-cols-1">
                        <label for="details" class="block mb-2 text-sm font-medium text-gray-900">Details</label>
                        <textarea id="details" rows="4" name="details"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter Details"></textarea>
                    </div>
                    <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                        <button type="submit"
                            class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Add</button>
                        <button
                            class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Reset</button>
                            <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                                     onclick="window.location.href='/expenses/expenses'">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex-grow"></div>
        @include('layouts.footer')

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

</html>