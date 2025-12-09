@include('layouts.header')
<div class="flex flex-col min-h-[90vh] bg-gray-50">
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
                                <a href="{{ asset('/item/item')}}" class="hover:text-gray-900">Items</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="font-medium text-gray-700">Items List</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="mt-2 text-2xl font-bold text-gray-800">Inventory Management</h1>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <button onclick="exportTableToCSV('items.csv')" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                    </svg>
                    Export CSV
                </button>
                
                @if(has_permission(54))
                <button onclick="window.location.href='/item/add_item'" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    Add Item
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Search and Filter Controls -->
    <div class="px-8 py-3 max-sm:px-4">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <!-- Search Input -->
            <div class="relative w-full md:w-1/2">
                <form method="GET" action="{{ url('item/item_list') }}" class="flex items-center gap-2">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            id="searchItemName" 
                            value="{{ request('search') }}" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                            placeholder="Search items..." 
                            onkeyup="searchItems()"
                        />
                    </div>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </form>
            </div>
            
            <!-- Entries Selector and Reset -->
            <div class="flex items-center gap-3">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <span>Show</span>
                    <input type="number" id="col_num" class="w-20 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" value="10" min="1" oninput="showEntries()">
                    <span>entries</span>
                </div>
                <button onclick="window.location.href='/item/item_list'" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="flex flex-col flex-grow px-8 py-3 max-sm:px-4">
        @include('_message')
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table id="itemsTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tl-lg">#</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Image</th>
                             <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Item Code</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Item Name</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Purchase Price</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Retail Price</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Wholesale Price</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Qty</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Status</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tr-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($items as $value)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if(!empty($value->getImageUrlAttribute()))
                                <img src="{{ $value->getImageUrlAttribute() }}" class="object-cover w-10 h-10 rounded-full">
                                @else
                                <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full">
                                    <svg class="w-5 h-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 12.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm0 0 2 2m4.5-9.25a7.964 7.964 0 0 0-1.25-5.125M1 13.25A7.963 7.963 0 0 1 5.75 8M13 2.25a7.963 7.963 0 0 1 4.75 5.875M1 7a7.97 7.97 0 0 1 3-5.375M19 7a7.97 7.97 0 0 0-3-5.375M1 7v9.25a1.75 1.75 0 0 0 1.75 1.75h14.5A1.75 1.75 0 0 0 19 16.25V7"/>
                                    </svg>
                                </div>
                                @endif
                            </td>
                         <td class="px-6 py-4 text-sm text-gray-900 item-name">{{ $value->item_code }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 item-name">{{ $value->item_name }}</td>
                             <td class="px-6 py-4 text-sm text-gray-900 item-name">{{ $value->purchase_price }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 item-name">{{ $value->retail_price }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 item-name">{{ $value->wholesale_price }}</td>

                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $value->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $value->status_id == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $value->status_id == 1 ? 'In Stock' : 'Out Of Stock' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    @if(has_permission(56))
                                    <a href="{{ url('item/edit_item/'.$value->id) }}" class="px-3 py-1 text-sm text-white bg-[{{ $settings[7]->value}}] rounded-md  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Edit
                                    </a>
                                    @endif
                                    <button 
                                        id="status-button-{{ $value->id }}" 
                                        class="px-3 py-1 text-sm text-white {{ $value->status_id == 1 ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $value->status_id == 1 ? 'focus:ring-red-500' : 'focus:ring-green-500' }}"
                                        onclick="toggleItemStatus({{ $value->id }})"
                                    >
                                        {{ $value->status_id == 1 ? 'Mark Out of Stock' : 'Mark In Stock' }}
                                    </button>
                                    @if(has_permission(55))
                                    <a href="{{ url('item/delete/'.$value->id) }}" class="hidden px-3 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Delete
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">No items found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center px-8 py-4">
        {{ $items->links('vendor.pagination.tailwind') }}
    </div>
</div>
@include('layouts.footer')

<script>
// Function to filter table rows based on the search term
function searchItems() {
    const searchValue = document.getElementById('searchItemName').value.toLowerCase();
    const rows = document.querySelectorAll('#itemsTable tbody tr');

    rows.forEach(row => {
        const itemName = row.querySelector('.item-name').textContent.toLowerCase();
        row.style.display = itemName.includes(searchValue) ? "" : "none";
    });
}

// Function to show a specific number of rows in the table
function showEntries() {
    const rows = document.querySelectorAll('#itemsTable tbody tr');
    let entries = document.getElementById('col_num').value || 10;
    
    rows.forEach((row, index) => {
        row.style.display = index < entries ? '' : 'none';
    });
}

function exportTableToCSV(filename) {
    const rows = document.querySelectorAll("#itemsTable tr");
    let csvContent = "";

    rows.forEach((row, rowIndex) => {
        const cols = Array.from(row.querySelectorAll("th, td"));
        const rowContent = cols
            .filter((col, colIndex) => ![1,9].includes(colIndex)) 
            .map(col => col.textContent.trim())
            .join(",");

        csvContent += rowContent + "\n";
    });

    const blob = new Blob([csvContent], { type: "text/csv" });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function toggleItemStatus(ItemId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/item/toggle-status/${ItemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw new Error(errorData.message || 'Server error');
            });
        }
        return response.json();
    })
    .then(data => {
        const button = document.getElementById(`status-button-${ItemId}`);
        if (data.status_id == 1) {
            button.textContent = 'Mark Out of Stock';
            button.classList.remove('bg-green-600', 'hover:bg-green-700', 'focus:ring-green-500');
            button.classList.add('bg-red-600', 'hover:bg-red-700', 'focus:ring-red-500');
        } else {
            button.textContent = 'Mark In Stock';
            button.classList.remove('bg-red-600', 'hover:bg-red-700', 'focus:ring-red-500');
            button.classList.add('bg-green-600', 'hover:bg-green-700', 'focus:ring-green-500');
        }
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to toggle item status: ' + error.message);
    });
}

// Initialize with default entries
document.addEventListener('DOMContentLoaded', showEntries);
</script>

<style>
@media (max-width: 768px) {
    #itemsTable thead {
        display: none;
    }
    
    #itemsTable tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }
    
    #itemsTable td {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    #itemsTable td:before {
        content: attr(data-label);
        font-weight: 600;
        margin-right: 1rem;
    }
    
    #itemsTable td:last-child {
        border-bottom: none;
    }
    
    #itemsTable td .flex {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    #itemsTable td .flex button {
        width: 100%;
    }
}
</style>