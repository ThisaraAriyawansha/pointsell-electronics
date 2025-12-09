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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Sales</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Return List View</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--submission controls-->
        <!--search-->
        <div class="flex items-center w-1/2 gap-3 px-12 py-5 max-sm:px-6 max-md:w-full">
    <input type="text" id="search_sale_ret"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Enter sale code" required />
    <button onclick="filterSales();" class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Search</button>
</div>


        <!--table-->
        <div class="flex flex-col px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative h-[500px] overflow-x-auto">

            
          <!-- Table -->
<table id="salesRetTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
        <tr>
            <th scope="col" class="px-6 py-3 rounded-tl-lg">Sales Code</th>
            <th scope="col" class="px-6 py-3">Date</th>
            <th scope="col" class="px-6 py-3">Time</th>
            <th scope="col" class="px-6 py-3">Item Name</th>
            <th scope="col" class="px-6 py-3">Price(Once)</th>
            <th scope="col" class="px-6 py-3">Quantity</th>
            <th scope="col" class="px-6 py-3">Price(Total)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groupedSalesReturnItems as $salesCode => $items)
            <tr>
                <td colspan="7" class="px-6 py-4 text-sm font-semibold bg-gray-100">{{ $salesCode }}</td> <!-- Sales Code Heading -->
            </tr>

            @php
                $salesCodeTotal = 0; // Initialize a variable to store the total price for each sales code
            @endphp

            @foreach($items as $salesReturnItem)
                <!-- Check if the status is 'permanent' -->
                <tr class="{{ $salesReturnItem->status === 'permanent' ? 'text-red-500' : '' }}">
                    <td class="px-6 py-4">{{ $salesReturnItem->sale->sales_code ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $salesReturnItem->sale->created_at->format('Y-m-d') ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $salesReturnItem->sale->created_at->format('H:i:s') ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $salesReturnItem->item->item_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $salesReturnItem->item->retail_price ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $salesReturnItem->return_quantity ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        {{ $salesReturnItem->return_quantity * $salesReturnItem->item->retail_price ?? 'N/A' }}
                    </td>
                </tr>

                @php
                    // Calculate the total for the sales code
                    $salesCodeTotal += $salesReturnItem->return_quantity * $salesReturnItem->item->retail_price;
                @endphp
            @endforeach

            <!-- Display the total price for the current sales code -->
            <tr class="font-semibold">
                <td colspan="6" class="px-6 py-4 text-right">Total:</td>
                <td class="px-6 py-4">{{ $salesCodeTotal }}</td> <!-- Total Price -->
            </tr>
        @endforeach
    </tbody>
</table>



            </div>
        </div>
    </div>
    @include('layouts.footer')

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

</html>



<script>

function filterSales() {
    const searchTerm = document.getElementById("search_sale_ret").value.toLowerCase(); // Get the input value
    const rows = document.querySelectorAll("#salesRetTable tbody tr"); // Select all rows in the table body
    
    rows.forEach(row => {
        const salesCodeCell = row.querySelector("td"); // Get the first <td> element (Sales Code column)
        
        if (salesCodeCell) {
            const salesCode = salesCodeCell.textContent.toLowerCase(); // Get the sales code text and convert it to lowercase
            
            if (salesCode.includes(searchTerm)) { // Check if the sales code contains the search term
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    });
}

</script>