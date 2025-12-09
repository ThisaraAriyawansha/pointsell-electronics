@include('layouts.header')
<body class="max-lg:h-fit">
<div class="flex flex-col h-[680px] max-lg:h-fit">
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Due Amount</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--submission controls-->
        <div class="px-12 max-sm:px-6">
    <form>
        <div class="grid gap-4 py-4 md:grid-cols-5">
            <!-- Select customer -->
            <div>
                <label for="customer-search" class="block mb-1 text-sm font-medium text-black">Customer</label>
                <div class="w-full custom-select">
                    <input id="customer_name" type="text"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Enter customer name" />
                </div>
            </div>
            <div>
                <label for="customer-search" class="block mb-1 text-sm font-medium text-black">Customer ID</label>
                <div class="w-full custom-select">
                    <input id="customer_id" type="text"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Enter customer ID" />
                </div>
            </div>
            <div>
                <label for="customer-search" class="block mb-1 text-sm font-medium text-black">Customer Number</label>
                <div class="w-full custom-select">
                    <input id="phone_number" type="text"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Enter customer number" />
                </div>
            </div>
            <!-- Hidden fields -->
            <div class="hidden">
                <label for="created_by" class="block mb-1 text-sm font-medium text-black">Created By</label>
                <div class="w-full custom-select">
                    <input id="created_by" type="text"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Enter user name">
                </div>
            </div>
            <div class="hidden">
                <label for="item_code" class="block mb-1 text-sm font-medium text-black">Item Code</label>
                <div class="w-full custom-select">
                    <input id="item_code" type="number"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Enter item code">
                </div>
            </div>
            <!-- From Date -->
            <div>
                <label for="from-date" class="block mb-1 text-sm font-medium text-black">From Date</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="from-date" type="date"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Select a date">
                </div>
            </div>
            <!-- Hidden To Date -->
            <div class="hidden">
                <label for="to-date" class="block mb-1 text-sm font-medium text-black">To Date</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="to-date" type="date"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-1.5"
                        placeholder="Select a date">
                </div>
            </div>
            <!-- Submit Button -->
            <div class="grid md:grid-cols-1">
                <button id="filter-btn" type="button"
                    class="py-2 px-4 bg-[{{ $settings[7]->value}}] text-white rounded-lg place-self-end">Submit</button>
            </div>
        </div>
    </form>
</div>

        <!--Summary pane + submission controls-->
        {{--
        <div>
            <!--rounded panel-->
            <div class="px-12 max-sm:px-6">
                <div
                    class="rounded-2xl border-black border-2 h-[300px] max-lg:h-fit flex items-center gap-3 max-lg:flex-col">
                    <div class="flex flex-col items-center justify-center w-1/4 h-full gap-4 max-lg:w-full">
                        <div class="flex w-full max-lg:w-fit max-lg:items-center">
                            <img src="{{ asset('images/sales/invoice.png') }}" alt="card-img"
                                class="object-contain w-1/2">
                            <span class="flex flex-col items-end w-1/2 h-full justify-evenly">
                                <p class="pr-2 text-end">Total Invoice</p>
                                <h3 class="pr-2 text-2xl font-bold text-center" id="total-invoice">200</h3>
                            </span>
                        </div>
                        <span class="w-full px-3 max-lg:w-5/6 max-lg:p-0">
                            <button class="w-full h-10 text-white bg-gray-800 rounded-md">More Info</button>
                        </span>
                    </div>
                    <div class="w-[1px] h-5/6 border-[1px] border-black max-lg:w-5/6"></div>
                    <div class="flex flex-col items-center justify-center w-1/4 h-full gap-4 max-lg:w-full">
                        <div class="flex w-full max-lg:w-fit max-lg:items-center">
                            <img src="{{ asset('images/sales/supplier.png') }}" alt="card-img"
                                class="object-contain w-1/2">
                            <span class="flex flex-col items-end w-1/2 h-full justify-evenly">
                                <p class="pr-2 text-end">Total Invoice Amount</p>
                                <h3 class="pr-2 text-2xl font-bold text-center" id="total-invoice-amount">
                                    Rs.1,47,210.00</h3>
                            </span>
                        </div>
                        <span class="w-full px-3 max-lg:w-5/6 max-lg:p-0">
                            <button class="w-full h-10 text-white bg-gray-800 rounded-md">More Info</button>
                        </span>
                    </div>
                    <div class="w-[1px] h-5/6 border-[1px] border-black max-lg:w-5/6"></div>
                    <div class="flex flex-col items-center justify-center w-1/4 h-full gap-4 max-lg:w-full">
                        <div class="flex w-full max-lg:w-fit max-lg:items-center">
                            <img src="{{ asset('images/sales/purchases.png') }}" alt="card-img"
                                class="object-contain w-1/2">
                            <span class="flex flex-col items-end w-1/2 h-full justify-evenly">
                                <p class="pr-2 text-end">Total Received Amount</p>
                                <h3 class="pr-2 text-2xl font-bold text-center" id="total-received-amount">
                                    Rs.1,47,210.00</h3>
                            </span>
                        </div> <span class="w-full px-3 max-lg:w-5/6 max-lg:p-0">
                            <button class="w-full h-10 text-white bg-gray-800 rounded-md">More Info</button>
                        </span>
                    </div>
                    <div class="w-[1px] h-5/6 border-[1px] border-black max-lg:w-5/6"></div>
                    <div class="flex flex-col items-center justify-center w-1/4 h-full gap-4 max-lg:w-full">
                        <div class="flex w-full max-lg:w-fit max-lg:items-center">
                            <img src="{{ asset('images/sales/invoice1.png') }}" alt="card-img"
                                class="object-contain w-1/2">
                            <span class="flex flex-col items-end w-1/2 h-full justify-evenly">
                                <p class="pr-2 text-end">Total Sales Due</p>
                                <h3 class="pr-2 text-2xl font-bold text-center" id="total-sales-due">Rs.0.00</h3>
                            </span>
                        </div>
                        <span class="w-full px-3 max-lg:w-5/6 max-lg:p-0">
                            <button class="w-full h-10 mb-3 text-white bg-gray-800 rounded-md">More Info</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        --}}
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
    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
        <tr>
            <th scope="col" class="px-6 py-3 rounded-tl-lg">ID</th>
            <th scope="col" class="px-6 py-3">Sales Code</th>
            <th scope="col" class="px-6 py-3">Customer Name</th>
            <th scope="col" class="hidden px-6 py-3">User Name</th>
            <th scope="col" class="hidden px-6 py-3">Total (RS)</th>
            <th scope="col" class="hidden px-6 py-3">Recieved Amount (RS)</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Due Amount (RS)</th>
            <th scope="col" class="px-6 py-3 ">Number</th>
            <th scope="col" class="px-6 py-3">Created At</th>
            <th scope="col" class="px-6 py-3 rounded-tr-lg">Action</th>
        </tr>
    </thead>
    <tbody id="salesListBody">
    @foreach ($salesData as $data)
    @if ($data->grand_total - $data->paid_amount >0 )
    <tr class="text-black bg-white border-2">
            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $data->id }}</td>
            <td class="px-6 py-4">{{ $data->sale->sales_code }}</td>
            <td class="px-6 py-4 customer-name">{{ $data->sale->customer->customer_name }}</td>
            <td class="hidden px-6 py-4 customer-name">{{ $data->user->name }}</td>
            <td class="hidden px-6 py-4 grand-total" data-grand-total="{{ $data->grand_total }}">{{ $data->grand_total }}</td>
            <td class="hidden px-6 py-4 paid-amount" data-paid-amount="{{ $data->paid_amount }}">{{ $data->paid_amount }}</td>
            <td class="px-6 py-4">
                <span class="p-3 border-2 rounded-lg bg-[#029ED936]">{{ $data->payment_status }}</span>
            </td>
            <td class="px-6 py-4 to-pay" 
                data-to-pay="{{ $data->due_amount - $data->pay_due_amount  }}" 
                style="{{ ($data->grand_total - $data->paid_amount > 0) ? 'color: red; font-weight: bold;' : '' }}">
                {{ $data->grand_total - $data->paid_amount }}
            </td>
            <td class="px-6 py-4 discount">{{ $data->sale->customer->contact_number }}</td>
            <td class="px-6 py-4">{{ $data->created_at }}</td>
            <td class="flex items-center px-6 py-4 space-x-2">
                @if(has_permission(66))
                    <button class="p-3 border-2 rounded-lg bg-[#47891E] text-white" onclick="payPayment({{ $data->id }})">Pay</button>
                @endif
                
                @if(has_permission(67))
                    <button class="p-3 border-2 rounded-lg bg-[{{ $settings[7]->value}}] text-white" onclick="paymentDetails({{ $data->id }})">MORE</button>
                @endif
            </td>
        </tr>
        @endif
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
    const phoneNumberFilter = document.getElementById('phone_number').value; // No .toUpperCase() for numbers
    const itemCodeFilter = document.getElementById('item_code').value.toUpperCase();
    const createdByFilter = document.getElementById('created_by').value.toUpperCase();
    const rows = document.querySelectorAll('#salesListTable tbody tr');

    let totalInvoice = 0;
    let totalInvoiceAmount = 0;
    let totalReceivedAmount = 0;
    let totalSalesDue = 0;

    rows.forEach(row => {
        const createdAt = row.cells[9].textContent.trim(); // Created At column (10th column)
        const customerName = row.cells[2].textContent.trim().toUpperCase(); // Customer Name column (3rd column)
        const customerID = row.cells[0].textContent.trim().toUpperCase(); // Customer ID column (1st column)
        const phoneNumber = row.cells[8].textContent.trim(); // Phone Number column (7th column)
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

        // Phone Number Filtering (Partial Match)
        if (phoneNumberFilter && phoneNumber.indexOf(phoneNumberFilter) === -1) {
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
    document.getElementById('phone_number').value = '';
    document.getElementById('item_code').value = '';
    document.getElementById('created_by').value = '';
}

// Initial Calculation on Page Load
window.onload = () => {
    resetFilters();
    filterTable();
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