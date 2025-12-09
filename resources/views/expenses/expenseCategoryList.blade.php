@include('layouts.header')
<div class="h-[90vh] max-lg:h-[92vh] flex flex-col grow">
        <!--breadcrumbs + Add new category btn-->
        <div class="flex items-center justify-between px-12 py-5 max-md:flex-col max-md:gap-6 max-sm:px-6">
            <!--breadcrumbs-->
            <div>
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
                                <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Expenses Category List</p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <!--add new cat btn-->
            <button class="p-1 px-3 bg-[#029ED9] text-white rounded-lg hidden" data-modal-target="default-modal" data-modal-toggle="default-modal">Add New Category</button>
        </div>
        <!--btn controls-->
        <div class="flex items-center justify-between w-full gap-2 px-6 py-3 max-sm:px-4 max-md:flex-col">
                <!-- search -->
                <div class="flex items-center w-1/2 gap-2 px-4 py-2 max-sm:px-3 max-md:w-full">
                    <label for="searchexpensesCat" class="text-xs">Search</label> 
                    <input type="text" id="searchexpensesCat" 
                        class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Enter Expense Category" required />
                    <button onclick="searchItems();" class="py-3 px-4 bg-[{{ $settings[7]->value}}] text-white rounded-lg text-xs">Search</button> 
                </div>

                <span class="flex items-center gap-2 w-fit max-md:w-full">
                    Show
                    <input type="number" id="col_num"
                        class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="30" min="1" oninput="showEntries()" required />
                    Entries
                </span>
            </div>

        <!--table--><div><center>@include('_message')</center></div>
        <div class="flex flex-col flex-grow px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="expensesCatTable" class="w-full text-xs text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-4 py-2 rounded-tl-lg">
                                #
                            </th>
                            <th scope="col" class="px-4 py-2">
                                Expense Category
                            </th>
                            <th scope="col" class="px-4 py-2 rounded-tr-lg">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expense_categories as $value)
                        <tr class="text-black bg-white border-2">
                            <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap">
                                {{ $value->id }}
                            </td>
                            <td class="px-4 py-2 name">
                                {{ $value->name }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{url('expenses/updateExpenseCategory/'.$value->id)}}">
                                    <button class="px-3 py-1 text-xs border-2 rounded-lg">Edit</button>
                                </a>
                                <a href="{{url('expenses/delete/'.$value->id)}}">
                                    <button class="px-3 py-1 text-xs text-white bg-red-600 border-2 rounded-lg">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        @include('layouts.footer')

    </div>
    <!-- add cat modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Expenses Category
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-black ">Expense
                        Category</label>
                    <input id="category" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Enter expense category" required>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-center gap-6 p-4 border-t border-gray-200 rounded-b md:p-5">
                    <button
                        class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Save</button>
                    <button
                        class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Reset</button>
                    <button
                        class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script>
function searchItems() {
    const searchValue = document.getElementById('searchexpensesCat').value.toLowerCase();
    const rows = document.querySelectorAll('#expensesCatTable tbody tr');

    rows.forEach(row => {
        const itemName = row.querySelector('.name').textContent.toLowerCase();

        // Show row if the item name includes the search text; otherwise, hide it
        if (itemName.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
function showEntries() {
        const rows = document.querySelectorAll('#expensesCatTable tbody tr'); // Target the suppliersTable
        let entries = document.getElementById('col_num').value;

        // Set default value of 30 if input is empty or invalid
        if (!entries || entries <= 0) {
            entries = 30;
        }

        rows.forEach((row, index) => {
            if (index < entries) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    }
</script>
</html>