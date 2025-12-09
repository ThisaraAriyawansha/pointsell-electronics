@include('layouts.header')
    <div class="flex flex-col h-5/6">
        <!--breadcrumbs-->
        <div class="px-12 py-5 max-sm:px-6">
            <nav class="flex items-center justify-between" aria-label="Breadcrumb">
                <!-- Breadcrumb Navigation -->
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <p class="inline-flex items-center text-sm font-medium text-gray-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Main Panel
                        </p>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Item</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Category List</p>
                        </div>
                    </li>
                </ol>

                <!-- Buttons -->
                <div class="flex items-center gap-2">
                    <button class="hidden px-4 py-2 text-sm text-white bg-black rounded-md max-sm:px-2 max-sm:py-1">Copy</button>
                    <button class="hidden px-4 py-2 text-sm text-white bg-black rounded-md max-sm:px-2 max-sm:py-1">CSV</button>
                    <button class="hidden px-4 py-2 text-sm text-white bg-black rounded-md max-sm:px-2 max-sm:py-1">Excel</button>
                    <button class="hidden px-4 py-2 text-sm text-white bg-black rounded-md max-sm:px-2 max-sm:py-1">PDF</button>
                    <button data-popover-target="popover-click" data-popover-trigger="click" data-popover-placement="bottom" 
                        type="button" class="px-4 py-2 text-sm text-white bg-black rounded-md max-sm:px-2 max-sm:py-1">
                        Column Visibility
                    </button>
                    <div data-popover id="popover-click" role="tooltip" 
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-fit">
                        <ul class="flex flex-col w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                            <li>
                                <input id="filter_hash" type="checkbox" checked class="hidden peer">
                                <label for="filter_hash" 
                                    class="flex w-full px-3 py-1.5 border-b border-gray-200 rounded-t-lg select-none peer-checked:bg-blue-300" 
                                    onclick="filterColumn('#');">
                                    #
                                </label>
                            </li>
                            <li>
                                <input id="filter_name" type="checkbox" checked class="hidden peer">
                                <label for="filter_name" 
                                    class="flex w-full px-3 py-1.5 border-b border-gray-200 select-none peer-checked:bg-blue-300" 
                                    onclick="filterColumn('Category');">
                                    Category
                                </label>
                            </li>
                            <li>
                                <input id="filter_manage" type="checkbox" checked class="hidden peer">
                                <label for="filter_manage" 
                                    class="flex w-full px-3 py-1.5 rounded-b-lg select-none peer-checked:bg-blue-300" 
                                    onclick="filterColumn('Manage');">
                                    Manage
                                </label>
                            </li>
                        </ul>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </nav>
        </div>

        <!--search-->
        
        <div class="flex items-center w-1/2 gap-3 px-12 py-5 max-sm:px-6 max-md:w-full">
            <label for="search_item">Search</label>
            <input type="text" id="searchCatName" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter Category name" required />
            <button onclick="searchItems();" class="py-2 px-4 bg-[{{ $settings[7]->value}}] text-white rounded-lg text-sm">Search</button>
            <span class="flex items-center gap-3 w-fit max-md:w-full">
                <input type="number" id="col_num"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="30" min="1" oninput="showEntries()" required />
                Entries
            </span>
        </div>


        <!--table--><div><center>@include('_message')</center></div>
        <div class="flex flex-col px-12 py-5 overflow-y-auto bg-white max-sm:px-6">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="catTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-4 py-2 rounded-tl-lg">
                                #
                            </th>
                            <th scope="col" class="px-4 py-2">
                                Category
                            </th>
                            <th scope="col" class="px-4 py-2">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-2 rounded-tr-lg">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item_categories as $value)
                        <tr class="text-black bg-white border-2">
                            <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap">
                                {{ $value->id }}
                            </td>
                            <td class="px-4 py-2 catName">
                                {{ $value->categories }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $value->description }}
                            </td>
                            <td class="px-4 py-2">
                                @if (has_permission(53))
                                <a href="{{ url('item/edit_category/'.$value->id) }}">
                                    <button class="px-2 py-1 border-2 rounded-lg">Edit</button>
                                </a>
                                @endif

                                @if (has_permission(54))
                                <a href="{{ url('item/delete/'.$value->id) }}">
                                    <button class="hidden px-2 py-1 text-white bg-red-600 border-2 rounded-lg">Delete</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</body>
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script>
    function searchItems() {
    const searchValue = document.getElementById('searchCatName').value.toLowerCase();
    const rows = document.querySelectorAll('#catTable tbody tr');

    rows.forEach(row => {
        const itemName = row.querySelector('.catName').textContent.toLowerCase();

        // Show row if the item name includes the search text; otherwise, hide it
        if (itemName.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
function showEntries() {
        const rows = document.querySelectorAll('#catTable tbody tr'); // Target the suppliersTable
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
    function filterColumn(selectedColName) {
        // Get the table and its header row
        var table = document.getElementById("catTable");
        var th = table.querySelectorAll("thead th");
        var rows = table.querySelectorAll("tbody tr");

        // Find the index of the selected column
        var colIndex = -1;
        th.forEach((header, index) => {
            if (header.textContent.trim() === selectedColName) {
                colIndex = index;
            }
        });

        if (colIndex === -1) {
            console.error("Column not found!");
            return;
        }

        // Toggle visibility of the column
        var isHidden = th[colIndex].style.display === "none";
        th[colIndex].style.display = isHidden ? "" : "none";

        rows.forEach((row) => {
            var cells = row.querySelectorAll("td");
            if (cells[colIndex]) {
                cells[colIndex].style.display = isHidden ? "" : "none";
            }
        });
    }
</script>

