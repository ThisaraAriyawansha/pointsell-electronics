@include('layouts.header')
<div class="h-[90vh] max-lg:h-[92vh] flex flex-col grow">
        <!--breadcrumbs-->
        <div class="px-12 py-5 max-sm:px-6">
                <nav class="flex" aria-label="Breadcrumb">
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
                                <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Users</p>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Users List</p>
                            </div>
                        </li>
                    </ol>

                    <!--btn controls-->
                    <div class="flex items-center justify-end w-full gap-2 px-6 py-3 max-sm:px-6 max-md:flex-col">
                        <span class="w-fit max-md:w-full max-md:justify-center flex gap-2 max-sm:gap-1 max-[350px]:scale-75">
                            <button id="copyButton" class="px-3 py-3 text-xs text-white bg-black rounded-sm max-sm:px-2 max-sm:py-1">Copy</button>
                            <button class="px-3 py-3 text-xs text-white bg-black rounded-sm max-sm:px-2 max-sm:py-1" onclick="exportTableToCSV('userTable.csv')">CSV</button>
                            <button class="px-3 py-3 text-xs text-white bg-black rounded-sm max-sm:px-2 max-sm:py-1" onclick="exportTableToExcel('userTable.xlsx')">Excel</button>
                            <button class="px-3 py-3 text-xs text-white bg-black rounded-sm max-sm:px-2 max-sm:py-1" onclick="exportTableToPDF()">PDF</button>
                            <button data-popover-target="popover-click" data-popover-trigger="click" type="button" class="px-3 py-1.5 text-white bg-black rounded-sm text-xs">Column Visibility</button>
                            <div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-fit">
                                <ul class="flex flex-col w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <li>
                                        <input id="filter_name" type="checkbox" checked class="hidden peer">
                                        <label for="filter_name" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Name', 'userTable');"> Name </label>
                                    </li>
                                    <li>
                                        <input id="filter_email" type="checkbox" checked class="hidden peer">
                                        <label for="filter_email" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Email', 'userTable');"> Email </label>
                                    </li>
                                    <li>
                                        <input id="filter_role" type="checkbox" checked class="hidden peer">
                                        <label for="filter_role" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Role', 'userTable');"> Role </label>
                                    </li>
                                    <li>
                                        <input id="filter_number" type="checkbox" checked class="hidden peer">
                                        <label for="filter_number" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Number', 'userTable');"> Mobile Number </label>
                                    </li>
                                    <li>
                                        <input id="filter_gender" type="checkbox" checked class="hidden peer">
                                        <label for="filter_gender" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Gender', 'userTable');"> Gender </label>
                                    </li>
                                    <li>
                                        <input id="filter_status" type="checkbox" checked class="hidden peer">
                                        <label for="filter_status" class="flex w-full px-2 py-1 border-b border-gray-200 select-none peer-checked:bg-blue-300" onclick="filterColumn('Status', 'userTable');"> Status </label>
                                    </li>
                                    <li>
                                        <input id="filter_manage" type="checkbox" checked class="hidden peer">
                                        <label for="filter_manage" class="flex w-full px-2 py-1 rounded-b-lg select-none peer-checked:bg-blue-300" onclick="filterColumn('Manage', 'userTable');"> Manage </label>
                                    </li>
                                </ul>
                            </div>
                        </span>
                    </div>
                </nav>
            </div>

        <!--search-->
        <div class="flex items-center w-1/2 gap-2 px-6 py-3 max-sm:px-3 max-md:w-full">
            <label for="search_item" class="text-sm">Search</label>
            <input type="text" id="search_cat"
                class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter User name" required />
            <button onclick="searchItems('search_cat', 'userTable', 1);" class="py-3 px-4 bg-[{{ $settings[7]->value}}] text-white rounded-lg text-xs">Search</button>
            <span class="flex items-center gap-2 w-fit max-md:w-full">
                <input type="number" id="col_num"
                    class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="30" min="1" oninput="showEntries()" required />
                Entries
            </span>
        </div>

        

        <!--table-->
        <div class="flex flex-col flex-grow px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="userTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-4 py-2 rounded-tl-lg"> <!-- Reduced padding -->
                                #
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Name
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Email
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Role
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Number
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Gender
                            </th>
                            <th scope="col" class="px-4 py-2"> <!-- Reduced padding -->
                                Status
                            </th>
                            <th scope="col" class="px-4 py-2 rounded-tr-lg"> <!-- Reduced padding -->
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $key => $user)
                            <tr class="text-black bg-white border-2">
                                <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap"> <!-- Reduced padding -->
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->role->role_name ?? 'No Role Assigned' }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->number }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->gender }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    {{ $user->status->status_name }}
                                </td>
                                <td class="px-4 py-2"> <!-- Reduced padding -->
                                    @if(has_permission(36))
                                        <button class="p-2 border-2 rounded-lg" onclick="editUser({{ $user->id }})">Edit</button> 
                                    @endif

                                    @if(has_permission(35))
                                        <button 
                                            id="status-button-{{ $user->id }}"
                                            class="p-2 text-white {{ $user->status_id == 1 ? 'bg-green-600' : 'bg-red-600' }} border-2 rounded-lg" 
                                            onclick="toggleUserStatus({{ $user->id }})">
                                            {{ $user->status_id == 1 ? 'Deactivate' : 'Activate' }} 
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center">No suppliers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        @include('layouts.footer')

    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.4/purify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</html>


<script>
    function editUser(UserId) {
    window.location.href = `/users/updateUsers/${UserId}`;
    }

    
    function toggleUserStatus(userId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/users/toggle-status/${userId}`, {
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
        const button = document.getElementById(`status-button-${userId}`);
        if (data.status_id == 1) {
            button.textContent = 'Deactivate';
            button.classList.remove('bg-red-600');
            button.classList.add('bg-green-600');
        } else {
            button.textContent = 'Activate';
            button.classList.remove('bg-green-600');
            button.classList.add('bg-red-600');
        }
        
        // Redirect to the previous page after updating status
        window.location.reload(); // Or specify a different URL if needed
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to toggle user status: ' + error.message);
    });
}



document.getElementById('search_cat').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');

    rows.forEach(row => {
        const UserName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (UserName.includes(filter)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});


// Function to show a specific number of rows in the suppliers table
function showEntries() {
    const rows = document.querySelectorAll('#userTable tbody tr'); // Target the suppliersTable
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




document.getElementById('copyButton').addEventListener('click', function () {
    // Select the table
    const table = document.getElementById('userTable');
    let data = '';

    // Loop through the rows of the table
    for (let i = 0; i < table.rows.length; i++) {
        let row = table.rows[i];
        let rowData = [];
        
        // Loop through each cell in the row
        for (let j = 0; j < row.cells.length; j++) {
            // Skip the "Manage" column (assumed to be the last column)
            if (j === row.cells.length - 1) continue;

            // Add cell text, ensuring it is well-trimmed and cleaned
            rowData.push(row.cells[j].innerText.trim());
        }
        
        // Add formatted row data to the data string
        data += rowData.join('\t') + '\n'; // Use tab as a separator
    }

    // Copy the data to the clipboard
    navigator.clipboard.writeText(data).then(() => {
        alert('Table data copied to clipboard in a structured format!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
        alert('Failed to copy table data.');
    });
});


function exportTableToCSV(filename) {
    const rows = document.querySelectorAll("#userTable tr");
    let csvContent = "";

    rows.forEach(row => {
        const cols = Array.from(row.querySelectorAll("th, td"));
        const rowContent = cols
            .slice(0, -1) // Exclude the last column
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



function exportTableToExcel(filename) {
    const table = document.getElementById("userTable");
    const clonedTable = table.cloneNode(true);

    // Remove "Manage" column from the cloned table
    const rows = clonedTable.rows;
    for (let i = 0; i < rows.length; i++) {
        rows[i].deleteCell(-1); // Delete the last cell in each row
    }

    const worksheet = XLSX.utils.table_to_sheet(clonedTable);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Suppliers");
    XLSX.writeFile(workbook, filename);
}



function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Get the table data
    const table = document.getElementById('userTable');
    
    // Extract table data
    const rows = [];
    const tableRows = table.querySelectorAll('tr');
    
    // Find the index of the "Manage" column (example assumes it's the last column)
    let manageColumnIndex = -1;
    const headerCells = tableRows[0].querySelectorAll('th');
    headerCells.forEach((cell, index) => {
        if (cell.innerText.toLowerCase() == 'manage') {
            manageColumnIndex = index;
        }
    });

    // Extract rows, skipping the "Manage" column
    tableRows.forEach((row, rowIndex) => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        
        cols.forEach((col, index) => {
            if (index !== manageColumnIndex) {  // Skip "Manage" column
                rowData.push(col.innerText);
            }
        });
        
        // Skip empty rows
        if (rowData.length > 0) {
            rows.push(rowData);
        }
    });
    
    // Add table to PDF
    doc.autoTable({
        head: [rows[0]], // First row as headers
        body: rows.slice(1), // Remaining rows as table body
    });

    // Save PDF
    doc.save('userTable.pdf');
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
        if (th.textContent.trim() === columnName) {
            columnIndex = index;
        }
    });

    if (columnIndex == undefined) {
        console.error(`Column ${columnName} not found in the table header.`);
        return; // Exit if column is not found
    }

    // Toggle visibility based on checkbox state
    if (checkbox.checked) {
        ths[columnIndex].style.display = '';
        tds.forEach(td => {
            td.cells[columnIndex].style.display = '';
        });
    } else {
        ths[columnIndex].style.display = 'none';
        tds.forEach(td => {
            td.cells[columnIndex].style.display = 'none';
        });
    }
}



        
</script>