@include('layouts.header')
<div class="h-[90vh] max-lg:h-[92vh] flex flex-col grow">
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Users</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Permission List</p>
                        </div>
                    </li>
                </ol>
                <!-- Button Controls -->
                
            </nav>
        </div>

        <!--search-->
        <div class="flex items-center w-1/2 gap-2 px-6 py-3 max-sm:px-3 max-md:w-full">
        <label for="search_item">Search</label>
            <input type="text" id="search_cat"
                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Permission name" required />
            <button onclick="searchItems('search_cat', 'PermissionTable', 2);" class="py-2 px-4 bg-[{{ $settings[7]->value}}] text-white text-sm rounded-md">Search</button>
            <span class="flex items-center gap-2 w-fit max-md:w-full">
                <input type="number" id="col_num"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                    placeholder="30" min="1" oninput="showEntries()" required />
                <label for="col_num" class="text-sm text-gray-700">Entries</label>
            </span>
        </div>



        <!--table-->
        <div class="flex flex-col flex-grow px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="PermissionTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-4 py-2 rounded-tl-lg">  <!-- Reduced padding -->
                                #
                            </th>
                            <th scope="col" class="px-4 py-2">  <!-- Reduced padding -->
                                Permission Name
                            </th>
                            <th scope="col" class="px-4 py-2 rounded-tr-lg">  <!-- Reduced padding -->
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permission as $key => $permission)
                            <tr class="text-black bg-white border-2">
                                <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap">  <!-- Reduced padding -->
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-4 py-2">  <!-- Reduced padding -->
                                    {{ $permission->permissions_name }}
                                </td>
                                <td class="px-4 py-2">  <!-- Reduced padding -->
                                    @if(has_permission(38))
                                        <button class="p-2 border-2 rounded-lg" onclick="editPermission({{ $permission->id }})">Edit</button>  <!-- Reduced padding -->
                                    @endif
                                    <button class="hidden p-2 text-white bg-red-600 border-2 rounded-lg" onclick="deletePermission({{ $permission->id }})">Delete</button>  <!-- Reduced padding -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">No Permission found.</td>  <!-- Reduced padding -->
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

function editPermission(permissionId) {
    window.location.href = `/users/updatePermission/${permissionId}`;
}

</script>


<script>
document.getElementById('search_cat').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#PermissionTable tbody tr');

    rows.forEach(row => {
        const permissions_name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();  // Fixed column index (td:nth-child(2))
        if (permissions_name.includes(filter)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});



// Function to show a specific number of rows in the suppliers table
function showEntries() {
    const rows = document.querySelectorAll('#PermissionTable tbody tr'); // Target the suppliersTable
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
    const table = document.getElementById('PermissionTable');
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
    const rows = document.querySelectorAll("#PermissionTable tr");
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
    const table = document.getElementById("PermissionTable");
    const clonedTable = table.cloneNode(true);

    // Remove "Manage" column from the cloned table
    const rows = clonedTable.rows;
    for (let i = 0; i < rows.length; i++) {
        rows[i].deleteCell(-1); // Delete the last cell in each row
    }

    const worksheet = XLSX.utils.table_to_sheet(clonedTable);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "PermissionTable");
    XLSX.writeFile(workbook, filename);
}



function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Get the table data
    const table = document.getElementById('PermissionTable');
    
    // Extract table data
    const rows = [];
    const tableRows = table.querySelectorAll('tr');
    
    // Find the index of the "Manage" column (example assumes it's the last column)
    let manageColumnIndex = -1;
    const headerCells = tableRows[0].querySelectorAll('th');
    headerCells.forEach((cell, index) => {
        if (cell.innerText.toLowerCase() === 'manage') {
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
    doc.save('PermissionTable.pdf');
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

    if (columnIndex === undefined) {
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