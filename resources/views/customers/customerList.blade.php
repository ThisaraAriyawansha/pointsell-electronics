@include('layouts.header')
<div class="flex flex-col min-h-[90vh] max-lg:min-h-[92vh] bg-gray-50">
    <!-- Header Section -->
    <div class="px-8 py-4 max-sm:px-4">
        <div class="flex flex-col justify-between space-y-4 md:flex-row md:items-center md:space-y-0">
            <!-- Breadcrumbs -->
            <div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm text-gray-600">
                        <li class="inline-flex items-center">
                            <a href="{{ asset('/dashboard')}}" class="inline-flex items-center hover:text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 1-1h2a1 1 0 1 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                </svg>
                                Main Panel
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <a href="{{ asset('/customers/customers')}}" class="hover:text-gray-900">Customers</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="font-medium text-gray-700">Customers List</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="mt-2 text-2xl font-bold text-gray-800">Customer Management</h1>
            </div>

            <!-- Add Customer Button -->
            @if(has_permission(41))
            <button onclick="window.location.href='/customers/addCustomer'" class="px-4 py-2 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                Add New Customer
            </button>
            @endif
        </div>
    </div>

    <!-- Search and Filter Controls -->
    <div class="px-8 py-3 max-sm:px-4">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <!-- Search Input -->
            <div class="relative w-full md:w-1/2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="search_cat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search customers..." onkeyup="searchItems('search_cat', 'customersTable', 2)">
            </div>
            
            <!-- Entries Selector -->
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <span>Show</span>
                <input type="number" id="col_num" class="w-20 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" value="30" min="1" oninput="showEntries()">
                <span>entries</span>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="flex flex-col flex-grow px-8 py-3 max-sm:px-4">
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table id="customersTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tl-lg">#</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Customer Code</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Customer Name</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Mobile</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Address</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Email</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tr-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($customers as $customer)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $customer->customer_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                                        <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                                    </svg>
                                    {{ $customer->customer_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                        <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                                    </svg>
                                    {{ $customer->contact_number }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->address_line_1 }} {{ $customer->address_line_2 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $customer->email }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    @if(has_permission(42))
                                <button 
                                    onclick="editCustomer({{ $customer->id }})" 
                                    class="px-3 py-1 text-sm text-white rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                    style="background-color: {{ $settings[7]->value }};"
                                >
                                    Edit
                                </button>

                                    @endif
                                    @if(has_permission(43))
                                    <button onclick="deleteCustomer({{ $customer->id }})" class="px-3 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Delete
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<!-- JavaScript -->
<script>
// Function to filter table rows based on the search term
function searchItems(searchInputId, tableId, columnIndex) {
    const searchInput = document.getElementById(searchInputId);
    const filter = searchInput.value.toLowerCase();
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const cell = cells[columnIndex]; // Column to search (0-indexed)

        if (cell) {
            const cellText = cell.textContent || cell.innerText;
            row.style.display = cellText.toLowerCase().includes(filter) ? "" : "none";
        }
    });
}

// Function to show a specific number of rows in the table
function showEntries() {
    const rows = document.querySelectorAll('#customersTable tbody tr');
    let entries = document.getElementById('col_num').value || 30;
    
    rows.forEach((row, index) => {
        row.style.display = index < entries ? '' : 'none';
    });
}

function editCustomer(customerId) {
    window.location.href = `/customers/updateCustomer/${customerId}`;
}

function deleteCustomer(customerId) {
    if (confirm("Are you sure you want to delete this customer?")) {
        fetch(`/customers/deleteCustomer/${customerId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the customer.');
        });
    }
}

// Initialize with default entries
document.addEventListener('DOMContentLoaded', showEntries);
</script>