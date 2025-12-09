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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Sales List</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--submission controls-->
        <div class="px-12 max-sm:px-6">
            <form>
                <div class="grid gap-6 py-6 md:grid-cols-5">
                    <!--select customer-->
                    <!-- Search Input -->
                    <div>
                        <label for="customer-search" class="block mb-2 text-sm font-medium text-black">Customer</label>
                        <div class="w-full custom-select">
                            <input id="customer_name" type="text"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Enter customer name" />
                        </div>
                    </div>
                    <div>
                        <label for="customer-search" class="block mb-2 text-sm font-medium text-black">Customer ID</label>
                        <div class="w-full custom-select">
                            <input id="customer_id" type="text"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Enter customer Id" />
                        </div>
                    </div>
                    <!--select user-->
                    <div>
                        <label for="created_by" class="block mb-2 text-sm font-medium text-black ">Created
                            By</label>
                        <!--custom combobox-->
                        <div class="w-full custom-select">
                            <input id="created_by" type="text"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Enter user Name">
                        </div>
                    </div>
                    <!--select item code-->
                    <div class="hidden">
                        <label for="item_code" class="block mb-2 text-sm font-medium text-black ">Item code</label>
                        <!--code combobox-->
                        <div class="w-full custom-select">
                            <input id="item_code" type="number"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Enter item code">
                        </div>
                    </div>
                    <!--select from date-->
                    <div>
                        <label for="from-date" class="block mb-2 text-sm font-medium text-black ">From Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="from-date" type="date"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Select a date">
                        </div>
                    </div>
                    <!--select to date-->
                    <div>
                        <label for="to-date" class="block mb-2 text-sm font-medium text-black ">To Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="to-date" type="date"
                                class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Select a date">
                        </div>
                    </div>
                </div>
                <!--search btn-->
                <div class="grid md:grid-cols-1">
                    <button id="filter-btn" type="button"
                        class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg place-self-end">Submit</button>
                </div>
            </form><br>
        </div>
        <!--Summary pane + submission controls-->
        <div>
            <!--rounded panel-->
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Invoice Card -->
                    <div class="p-6 bg-white border-l-4 border-blue-500 shadow-md rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <img src="{{ asset('images/sales/invoice.png') }}" alt="Invoice" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Invoice</p>
                                <h3 class="text-2xl font-bold text-gray-800" id="total-invoice">200</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Total Invoice Amount Card -->
                    <div class="p-6 bg-white border-l-4 border-green-500 shadow-md rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <img src="{{ asset('images/sales/supplier.png') }}" alt="Amount" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Invoice Amount</p>
                                <h3 class="text-2xl font-bold text-gray-800" id="total-invoice-amount">Rs.1,47,210.00</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Total Received Amount Card -->
                    <div class="p-6 bg-white border-l-4 border-purple-500 shadow-md rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <img src="{{ asset('images/sales/purchases.png') }}" alt="Received" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Received Amount</p>
                                <h3 class="text-2xl font-bold text-gray-800" id="total-received-amount">Rs.1,47,210.00</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sales Due Card -->
                    <div class="p-6 bg-white border-l-4 shadow-md rounded-xl border-amber-500">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-lg bg-amber-100">
                                <img src="{{ asset('images/sales/invoice1.png') }}" alt="Due" class="w-8 h-8">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Sales Due</p>
                                <h3 class="text-2xl font-bold text-gray-800" id="total-sales-due">Rs.0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
        </div>
        <!--btn controls-->
        {{-- <div class="flex items-center justify-between w-full gap-3 px-12 py-5 max-sm:px-6 max-md:flex-col">
            <span class="w-fit max-md:w-full max-md:justify-center flex gap-3 max-sm:gap-1 max-[350px]:scale-75">
                <button class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">Copy</button>
                <button class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">CSV</button>
                <button class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">Excel</button>
                <button class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">PDF</button>
                <button data-popover-target="popover-click" data-popover-trigger="click"
                    data-popover-placement="bottom" type="button"
                    class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">
                    Column Visibility
                </button>
                <div data-popover id="popover-click" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-fit">
                    <ul
                        class="flex flex-col w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                        <!-- First Column -->
                        <li>
                            <input id="filter_id" type="checkbox" checked class="hidden peer">
                            <label for="filter_id"
                                class="flex w-full px-4 py-2 border-b border-gray-200 rounded-t-lg select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('ID', 'salesListTable');">
                                ID
                            </label>
                        </li>
                        <!-- Second Column -->
                        <li>
                            <input id="filter_code" type="checkbox" checked class="hidden peer">
                            <label for="filter_code"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Code', 'salesListTable');">
                                Code
                            </label>
                        </li>
                        <!-- Third Column -->
                        <li>
                            <input id="filter_cname" type="checkbox" checked class="hidden peer">
                            <label for="filter_cname"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Customer Name', 'salesListTable');">
                                Customer Name
                            </label>
                        </li>
                        <!-- Fourth Column -->
                        <li>
                            <input id="filter_total" type="checkbox" checked class="hidden peer">
                            <label for="filter_total"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Total (RS)', 'salesListTable');">
                                Total (RS)
                            </label>
                        </li>
                        <!-- Fifth Column -->
                        <li>
                            <input id="filter_ramount" type="checkbox" checked class="hidden peer">
                            <label for="filter_ramount"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Recieved Amount (RS)', 'salesListTable');">
                                Recieved Amount (RS)
                            </label>
                        </li>
                        <!-- Sixth Column -->
                        <li>
                            <input id="filter_status" type="checkbox" checked class="hidden peer">
                            <label for="filter_status"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Status', 'salesListTable');">
                                Status
                            </label>
                        </li>
                        <!-- Seventh Column -->
                        <li>
                            <input id="filter_tpay" type="checkbox" checked class="hidden peer">
                            <label for="filter_tpay"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('To Pay (RS)', 'salesListTable');">
                                To Pay (RS)
                            </label>
                        </li>
                        <!-- Eighth Column -->
                        <li>
                            <input id="filter_dis" type="checkbox" checked class="hidden peer">
                            <label for="filter_dis"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Discount (RS)', 'salesListTable');">
                                Discount (RS)
                            </label>
                        </li>
                        <!-- Ninth Column -->
                        <li>
                            <input id="filter_tax" type="checkbox" checked class="hidden peer">
                            <label for="filter_tax"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Tax (RS)', 'salesListTable');">
                                Tax (RS)
                            </label>
                        </li>
                        <!-- Tenth Column -->
                        <li>
                            <input id="filter_created" type="checkbox" checked class="hidden peer">
                            <label for="filter_created"
                                class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Created At', 'salesListTable');">
                                Created At
                            </label>
                        </li>
                        <!-- Eleventh Column -->
                        <li>
                            <input id="filter_action" type="checkbox" checked class="hidden peer">
                            <label for="filter_action"
                                class="flex w-full px-4 py-2 border-b border-gray-200 rounded-b-lg select-none peer-checked:bg-blue-300"
                                onclick="filterColumn('Action', 'salesListTable');">
                                Action
                            </label>
                        </li>
                    </ul>
                    <div data-popper-arrow></div>
                </div>
            </span>
            <span class="flex items-center gap-3 w-fit max-md:w-full">
                Show
                <input type="text" id="col_num"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="30" required />
                Entries
            </span>
        </div> --}}
        <!--table-->
        <div class="flex flex-col px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative h-[500px] overflow-x-auto">
            <table id="salesListTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
<thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value }}]">
    <tr>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium rounded-tl-lg">ID</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Code</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Customer</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">User</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Total (Rs)</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Received (Rs)</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Status</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Due (Rs)</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Discount (Rs)</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium">Created</th>
        <th scope="col" class="px-4 py-2.5 text-[0.75rem] font-medium rounded-tr-lg">Action</th>
    </tr>
</thead>
    <tbody id="salesListBody">
        @foreach ($salesData as $data)
        <tr class="text-black bg-white border-2">
            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $data->id }}</td>
            <td class="px-6 py-4">{{ $data->sale->sales_code }}</td>
            <td class="px-6 py-4 customer-name">{{ $data->sale->customer->customer_name }}</td>
            <td class="px-6 py-4 customer-name">{{ $data->user->name }}</td>
            <td class="px-6 py-4 grand-total" data-grand-total="{{ $data->grand_total }}">{{ $data->grand_total }}</td>
            <td class="px-6 py-4 paid-amount" data-paid-amount="{{ $data->paid_amount }}">{{ $data->paid_amount }}</td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">{{ $data->payment_status }}</span>
            </td>
            <td class="px-6 py-4 to-pay" data-to-pay="{{ $data->grand_total - $data->paid_amount  }}">{{ $data->grand_total - $data->paid_amount  }}</td>
            <td class="px-6 py-4 discount">{{ $data->discount }}</td>
            <td class="px-6 py-4">{{ $data->created_at }}</td>
            <td class="px-6 py-4">
                <div class="flex items-center space-x-3">
                    @if ($data->grand_total - $data->paid_amount > 0)
                    <button onclick="payPayment({{ $data->id }})" 
                            class="px-3.5 py-1.5 border border-green-600 text-green-600 hover:bg-green-50 text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-1 focus:ring-green-500">
                        Pay
                    </button>
                    @endif
                    <button onclick="paymentDetails({{ $data->id }})" 
                            class="px-3.5 py-1.5 border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-1 focus:ring-gray-500">
                        More
                    </button>
                </div>
            </td>
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
<script>
    function filterTableAndCalculate() {
        const input = document.getElementById('customer_name');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('salesListTable');
        const tr = table.getElementsByTagName('tr');

        // Initialize calculations
        let totalInvoice = 0;
        let totalInvoiceAmount = 0;
        let totalReceivedAmount = 0;
        let totalSalesDue = 0;

        // Loop through all table rows (except the header)
        for (let i = 1; i < tr.length; i++) {
            const tdCustomerName = tr[i].getElementsByTagName('td')[2]; // Customer Name column
            const tdGrandTotal = tr[i].getElementsByClassName('grand-total')[0];
            const tdPaidAmount = tr[i].getElementsByClassName('paid-amount')[0];
            const tdToPay = tr[i].getElementsByClassName('to-pay')[0];
            const tdDiscount = tr[i].getElementsByClassName('discount')[0];

            if (tdCustomerName) {
                const customerName = tdCustomerName.textContent || tdCustomerName.innerText;

                // Check if the row matches the search filter
                if (customerName.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ''; // Show row

                    // Add to calculations if it matches the filter
                    totalInvoice += 1; // Count of rows
                    totalInvoiceAmount += parseFloat(tdGrandTotal.textContent || 0);
                    totalReceivedAmount += parseFloat(tdPaidAmount.textContent || 0);
                    totalSalesDue += parseFloat(tdToPay.textContent || 0);
                } else {
                    tr[i].style.display = 'none'; // Hide row
                }
            }
        }

        // Update the calculation results in real-time
        document.getElementById('total-invoice').textContent = totalInvoice;
        document.getElementById('total-invoice-amount').textContent = totalInvoiceAmount.toFixed(2);
        document.getElementById('total-received-amount').textContent = totalReceivedAmount.toFixed(2);
        document.getElementById('total-sales-due').textContent = totalSalesDue.toFixed(2);
    }
</script>

<script>
  // Button Click Event
document.getElementById('filter-btn').addEventListener('click', (event) => {
    event.preventDefault(); // Prevent page refresh
    filterTable();
});

// Filter Table Based on Multiple Filters
function filterTable() {
    const fromDate = document.getElementById('from-date').value;
    const toDate = document.getElementById('to-date').value;
    const customerFilter = document.getElementById('customer_name').value.toUpperCase();
    const customerIDFilter = document.getElementById('customer_id').value.toUpperCase();
    const itemCodeFilter = document.getElementById('item_code').value.toUpperCase();
    const createdByFilter = document.getElementById('created_by').value.toUpperCase();
    const rows = document.querySelectorAll('#salesListTable tbody tr');

    let totalInvoice = 0;
    let totalInvoiceAmount = 0;
    let totalReceivedAmount = 0;
    let totalSalesDue = 0;

        // Clear Input Fields


    rows.forEach(row => {
        const createdAt = row.cells[9].textContent.trim(); // Created At column (10th column)
        const customerName = row.cells[2].textContent.trim().toUpperCase(); // Customer Name column (3rd column)
        const customerID = row.cells[0].textContent.trim().toUpperCase(); // Customer ID column (1st column)
        const itemCode = row.cells[1].textContent.trim().toUpperCase(); // Item Code column (2nd column)
        const createdBy = row.cells[3].textContent.trim().toUpperCase(); // Created By column (4th column)

        let showRow = true;

        // Date Filtering
        if (fromDate && new Date(createdAt) < new Date(fromDate)) {
            showRow = false;
        }
        if (toDate && new Date(createdAt) > new Date(toDate)) {
            showRow = false;
        }

        // Customer Name Filtering
        if (customerFilter && customerName.indexOf(customerFilter) === -1) {
            showRow = false;
        }

        // Customer ID Filtering
        if (customerIDFilter && customerID.indexOf(customerIDFilter) === -1) {
            showRow = false;
        }

        // Item Code Filtering
        if (itemCodeFilter && itemCode.indexOf(itemCodeFilter) === -1) {
            showRow = false;
        }

        // Created By (User ID) Filtering
        if (createdByFilter && createdBy.indexOf(createdByFilter) === -1) {
            showRow = false;
        }

        // Show or Hide Row
        row.style.display = showRow ? '' : 'none';

        // Update calculations for visible rows
        if (showRow) {
            totalInvoice += 1;
            totalInvoiceAmount += parseFloat(row.cells[4].textContent || 0); // Total Amount
            totalReceivedAmount += parseFloat(row.cells[5].textContent || 0); // Received Amount
            totalSalesDue += parseFloat(row.cells[7].textContent || 0); // To Pay
        }
    });

    // Update Totals in UI
    document.getElementById('total-invoice').textContent = totalInvoice;
    document.getElementById('total-invoice-amount').textContent = totalInvoiceAmount.toFixed(2);
    document.getElementById('total-received-amount').textContent = totalReceivedAmount.toFixed(2);
    document.getElementById('total-sales-due').textContent = totalSalesDue.toFixed(2);
}



function resetFilters() {
    // Clear Input Fields
    document.getElementById('from-date').value = '';
    document.getElementById('to-date').value = '';
    document.getElementById('customer_name').value = '';
    document.getElementById('customer_id').value = '';
    document.getElementById('item_code').value = '';
    document.getElementById('created_by').value = '';
}



function setCurrentMonthDates() {
    const now = new Date();
    const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1); // First day of the current month
    const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0); // Last day of the current month

    // Format dates as yyyy-mm-dd
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    // Set the values of the date inputs
    document.getElementById('from-date').value = formatDate(startOfMonth);
    document.getElementById('to-date').value = formatDate(endOfMonth);
}

// Initial Calculation on Page Load
window.onload = () => {
    setCurrentMonthDates(); // Set default dates for the current month
    filterTable(); // Show only current month's data
};


</script>

</html>

<script>
    function payPayment(paymentId) {
    window.location.href = `/sales/payment/${paymentId}`;
}

function paymentDetails(paymentId) {
    window.location.href = `/sales/paymentdetails/${paymentId}`;
}
</script>