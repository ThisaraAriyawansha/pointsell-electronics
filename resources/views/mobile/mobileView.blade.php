@include('layouts.header')
<div class="h-5/6 max-lg:h-[83vh] flex flex-col">
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">View Items</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--search-->
        <div class="flex items-center w-1/2 gap-3 px-12 py-5 max-sm:px-6 max-md:w-full">
            <label for="search_cat">Search</label>
            <input type="text" id="search_cat"
                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter item name" required />
            <button onclick="searchItems('search_cat', 'itemsTable', 2);" 
                class="py-2 px-4 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Search</button>
        </div>

        <!--btn controls-->
        <div class="flex items-center justify-between w-full gap-3 px-12 py-5 max-sm:px-6 max-md:flex-col">
            <!-- Column Visibility Buttons -->
            <button data-popover-target="popover-click" data-popover-trigger="click" data-popover-placement="bottom"
                type="button" class="px-6 py-3 text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1">
                Column Visibility
            </button>
            <div data-popover id="popover-click" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-fit">
                <ul class="flex flex-col w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                    <!-- Toggle columns -->
                    <li>
                        <input id="filter_name" type="checkbox" checked class="hidden peer">
                        <label for="filter_name" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Item Name', 'itemsTable');">
                            Item Name
                        </label>
                    </li>
                    <li>
                        <input id="filter_brand" type="checkbox" checked class="hidden peer">
                        <label for="filter_brand" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Brand', 'itemsTable');">
                            Brand
                        </label>
                    </li>
                    <li>
                        <input id="filter_model" type="checkbox" checked class="hidden peer">
                        <label for="filter_model" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Model', 'itemsTable');">
                            Model
                        </label>
                    </li>
                    <li>
                        <input id="filter_qty" type="checkbox" checked class="hidden peer">
                        <label for="filter_qty" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('QTY', 'itemsTable');">
                            QTY
                        </label>
                    </li>
                    <li>
                        <input id="filter_color" type="checkbox" checked class="hidden peer">
                        <label for="filter_color" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Color', 'itemsTable');">
                            Color
                        </label>
                    </li>
                    <li>
                        <input id="filter_ram" type="checkbox" checked class="hidden peer">
                        <label for="filter_ram" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('RAM', 'itemsTable');">
                            RAM
                        </label>
                    </li>
                    <li>
                        <input id="filter_storage" type="checkbox" checked class="hidden peer">
                        <label for="filter_storage" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Storage', 'itemsTable');">
                            Storage
                        </label>
                    </li>
                    <li>
                        <input id="filter_date" type="checkbox" checked class="hidden peer">
                        <label for="filter_date" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Added Date', 'itemsTable');">
                            Added Date
                        </label>
                    </li>
                    <li>
                        <input id="filter_status" type="checkbox" checked class="hidden peer">
                        <label for="filter_status" class="flex w-full px-4 py-2 border-b border-gray-200 select-none peer-checked:bg-blue-300"
                            onclick="filterColumn('Status', 'itemsTable');">
                            Status
                        </label>
                    </li>

                </ul>
            </div>

            <span class="flex items-center gap-3 w-fit max-md:w-full">
                Show
                <input type="number" id="col_num"
                    class="block w-full p-2 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="30" min="1" oninput="showEntries()" required />
                Entries
            </span>
        </div>
        <!--table-->
        <!-- In your Blade view (mobileItems/index.blade.php) -->
        <div class="px-12 max-sm:px-6 max-lg:min-h-[200px] py-5 overflow-y-auto bg-white flex flex-col">
            <div class="relative overflow-x-auto">
                <table id="itemsTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-tl-lg">#</th>
                            <th scope="col" class="px-6 py-3">Item Name</th>
                            <th scope="col" class="px-6 py-3">Brand</th>
                            <th scope="col" class="px-6 py-3">Model</th>
                            <th scope="col" class="px-6 py-3">QTY</th>
                            <th scope="col" class="px-6 py-3">Color</th>
                            <th scope="col" class="px-6 py-3">RAM</th>
                            <th scope="col" class="px-6 py-3">Storage</th>
                            <th scope="col" class="px-6 py-3">Added Date</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 rounded-tr-lg">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mobileItems as $mobileItem)
                            <tr class="text-black bg-white border-2">
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $mobileItem->name }}</td>
                                <td class="px-6 py-4">{{ $mobileItem->brand->name }}</td> <!-- Assuming brand is loaded -->
                                <td class="px-6 py-4">{{ $mobileItem->model->name }}</td> <!-- Assuming model is loaded -->
                                <td class="px-6 py-4">{{ $mobileItem->imeis->count() }}</td> <!-- Quantity from IMEI count -->
                                <td class="px-6 py-4">{{ $mobileItem->color->name }}</td> <!-- Assuming color is loaded -->
                                <td class="px-6 py-4">{{ $mobileItem->ram->name }}</td> <!-- Assuming RAM size is loaded -->
                                <td class="px-6 py-4">{{ $mobileItem->storage->name }}</td> <!-- Assuming storage capacity is loaded -->
                                <td class="px-6 py-4">{{ $mobileItem->created_at->format('d.m.Y') }}</td>
                                <!-- Status column (to be updated dynamically) -->
                                <td class="px-6 py-4 status-column-{{ $mobileItem->id }}">
                                    {{ $mobileItem->status->status_name }}
                                </td>                                
                                <td class="flex gap-3 px-6 py-4">
                                @if (has_permission(88))
                                <button class="p-3 border-2 rounded-lg" onclick="showImeiModal({{ $mobileItem->id }});">
                                    Add IMEI
                                </button>
                                @endif

                                @if (has_permission(89))
                                <button class="p-3 border-2 rounded-lg status-toggle" 
                                        data-id="{{ $mobileItem->id }}" 
                                         data-status="{{ $mobileItem->status_id }}">
                                             Status
                                        </button> 
                                        @endif
                                        
                                        @if (has_permission(87))      
                                        <button class="p-3 border-2 rounded-lg"
                                            onclick="window.location.href='{{ route('mobile.edit', $mobileItem->id) }}'">
                                            Edit
                                        </button>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="flex-grow">

        </div>
    </div>
@include('layouts.footer')

<div id="imei-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center hidden w-full h-full max-h-full overflow-x-hidden overflow-y-auto bg-gray-800 bg-opacity-50">
    <div class="relative w-full max-w-2xl max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                <h3 class="text-xl font-semibold text-gray-900">Add IMEI</h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" onclick="closeImeiModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close IMEI List</span>
                </button>
            </div>

            <div class="p-4 space-y-4 md:p-5">
            <div class="flex items-center gap-3">
                    <!-- Input field for IMEI -->
                    <input type="text" id="imei-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter IMEI" required />
                    
                    <!-- Add IMEI button -->
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" id="add-imei-btn" onclick="addImei()">Add</button>
                    </div>
                <div class="mt-4 overflow-y-auto max-h-60">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">IMEI</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="hidden px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="imei-table-body">
                            <!-- IMEI data will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="closeImeiModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-for-view-items" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900" id="modal-header">
                        <!--dynamic header-->

                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="modal-for-view-items">
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
                    <div class="flex flex-col gap-3">
                        <label for="" class="block text-sm font-medium text-black">IMEI Number</label>
                        <input type="text" id="modal-input"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="" required />
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                    
                </div>
            </div>
        </div>
    </div>


</html>


<script>
    function showModal(whichModal) {
        switch (whichModal) {
            case "imei":
                document.getElementById("modal-header").innerText = "Add IMEI";
                document.getElementById("modal-input").placeholder = "IMEI";
                break;

            default:
                break;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>


<script>
document.getElementById('search_cat').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#itemsTable tbody tr');

    rows.forEach(row => {
        // Get the item name from the second column (index 1)
        const itemName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (itemName.includes(filter)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});



// Function to show a specific number of rows in the suppliers table
function showEntries() {
    const rows = document.querySelectorAll('#itemsTable tbody tr'); // Target the suppliersTable
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


function filterColumn(columnName, tableId) {
    const checkbox = document.getElementById(`filter_${columnName.toLowerCase().replace(/ /g, '_')}`);

    if (!checkbox) {
        console.error(`Checkbox with ID filter_${columnName.toLowerCase().replace(/ /g, '_')} not found.`);
        return; // Exit if checkbox is not found
    }

    const table = document.getElementById(tableId);
    const ths = table.querySelectorAll('th');
    const tds = table.querySelectorAll('tbody tr');

    let columnIndex;

    // Find the index of the column based on its name
    ths.forEach((th, index) => {
        if (th.textContent.trim() == columnName) {
            columnIndex = index;
        }
    });

    if (columnIndex === undefined) {
        console.error(`Column ${columnName} not found in the table header.`);
        return; // Exit if column is not found
    }

    // Toggle visibility based on checkbox state
    if (checkbox.checked) {
        ths[columnIndex].style.display = ''; // Show column header
        tds.forEach(td => {
            td.cells[columnIndex].style.display = ''; // Show column data
        });
    } else {
        ths[columnIndex].style.display = 'none'; // Hide column header
        tds.forEach(td => {
            td.cells[columnIndex].style.display = 'none'; // Hide column data
        });
    }
}

</script>


<script>
    document.querySelectorAll('.status-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const mobileItemId = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');
            
            // Send AJAX request to update the status
            fetch('{{ route('mobile.updateStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: mobileItemId })
            })
            .then(response => response.json())
            .then(data => {
                // Get the status column element for this row
                const statusColumn = document.querySelector(`.status-column-${mobileItemId}`);

                // Update the status text in the table based on the new status
                if (data.status == 1) {
                    statusColumn.textContent = 'Active'; // Assuming status 1 means "Active"
                } else {
                    statusColumn.textContent = 'Inactive'; // Assuming status 2 means "Inactive"
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>



<script>
let selectedMobileItemId = null;  // Store selected mobile item ID globally

// Show IMEI Modal and set the mobile item ID
function showImeiModal(mobileItemId) {
    selectedMobileItemId = mobileItemId;  // Store ID globally
    console.log("Selected Mobile Item ID:", selectedMobileItemId);

    const modal = document.getElementById("imei-modal");
    modal.classList.remove("hidden");
    
    loadImeiList();  // Load the IMEI list into the modal
}

// Close the IMEI Modal
function closeImeiModal() {
    const modal = document.getElementById("imei-modal");
    modal.classList.add("hidden");
}

// Add IMEI to Database and Update UI
function addImei() {
    const imeiInput = document.getElementById("imei-input");
    const imei = imeiInput.value;

    // Ensure IMEI and selected ID are not empty
    if (!imei || !selectedMobileItemId) {
        alert('IMEI cannot be empty');
        return;
    }

    // Send POST request to backend
    fetch('/store-imei', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            imei: imei,
            mobile_item_id: selectedMobileItemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadImeiList();  // Reload IMEI list after adding a new one
            updateImeiQty();  // Update IMEI Quantity display
            imeiInput.value = "";  // Clear input field
        } else {
            alert('Error adding IMEI');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding IMEI');
    });
}

// Delete IMEI from Database and Update UI
function deleteImei(imeiId) {
    if (!selectedMobileItemId) {
        alert("No mobile item selected!");
        return;
    }

    if (confirm('Are you sure you want to delete this IMEI?')) {
        fetch(`/delete-imei/${imeiId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                loadImeiList();  // Reload IMEI list after deletion
                updateImeiQty();  // Update IMEI Quantity display
            } else {
                alert('Error deleting IMEI');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting IMEI');
        });
    }
}

// Load IMEI list into the modal
function loadImeiList() {
    if (!selectedMobileItemId) {
        console.error("No mobile item ID selected!");
        return;
    }

    const imeiListElement = document.getElementById("imei-table-body");

    fetch(`/get-imei/${selectedMobileItemId}`)
        .then(response => response.json())
        .then(data => {
            imeiListElement.innerHTML = "";  // Clear the current table

            if (data.length > 0) {
                data.forEach((imeiObj) => {
                    const tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td class="px-6 py-3">${imeiObj.imei_number}</td>
                        <td class="px-6 py-3">
                            <button onclick="togglePurchaseStatus(${imeiObj.id}, ${imeiObj.purchase_status_id})"
                                class="px-3 py-1 rounded text-white ${imeiObj.purchase_status_id == 1 ? 'bg-green-500' : 'bg-red-500'}">
                                ${imeiObj.purchase_status_id == 1 ? 'Unsold' : 'Sold'}
                            </button>
                        </td>
                        <td class="hidden px-6 py-3">
                            <button class="text-red-500" onclick="deleteImei(${imeiObj.id})">Delete</button>
                        </td>
                    `;
                    imeiListElement.appendChild(tr);
                });
            } else {
                imeiListElement.innerHTML = "<tr><td colspan='3' class='text-center'>No IMEI records found.</td></tr>";
            }
        })
        .catch(error => {
            console.error('Error fetching IMEI data:', error);
            imeiListElement.innerHTML = "<tr><td colspan='3' class='text-center'>Error loading IMEI data.</td></tr>";
        });
}

// Toggle IMEI purchase status between Sold (2) and Unsold (1)
function togglePurchaseStatus(imeiId, currentStatus) {
    const newStatus = currentStatus == 1 ? 2 : 1; // Toggle between 1 (Unsold) and 2 (Sold)

    fetch(`/update-imei-status/${imeiId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ purchase_status_id: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadImeiList(); // Reload the list to reflect changes
        } else {
            console.error("Failed to update status:", data.message);
        }
    })
    .catch(error => {
        console.error("Error updating purchase status:", error);
    });
}


// Update the IMEI quantity display outside the modal
function updateImeiQty() {
    if (!selectedMobileItemId) {
        console.error("No mobile item ID selected for quantity update!");
        return;
    }

    fetch(`/get-imei/${selectedMobileItemId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("imei-qty").innerText = `Qty: ${data.length}`;
        })
        .catch(error => {
            console.error('Error updating IMEI quantity:', error);
            document.getElementById("imei-qty").innerText = "Qty: 0";
        });
}

// Initialize the IMEI list on page load
window.onload = function() {
    updateImeiQty();
};
</script>
