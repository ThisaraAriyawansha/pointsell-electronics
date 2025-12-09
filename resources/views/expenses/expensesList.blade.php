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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Expenses List</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!--btn controls-->
        <div class="flex items-center justify-between w-full gap-2 px-6 py-3 max-sm:px-6 max-md:flex-col">
                <!-- search -->
                <div class="flex items-center w-1/2 gap-2 px-6 py-3 max-sm:px-6 max-md:w-full">
                    <label for="search_item" class="text-xs">Search</label>
                    <input type="text" id="searchExpensesName" 
                        class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter Expense Title" required />
                    <button onclick="searchItems();" class="py-3 px-3 bg-[{{ $settings[7]->value}}] text-white rounded-lg text-xs">Search</button>
                </div>

                <span class="flex items-center gap-2 text-xs w-fit max-md:w-full">
                    Show
                    <input type="number" id="col_num"
                        class="block w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="30" min="1" oninput="showEntries()" required />
                    Entries
                </span>

                <button class="px-3 py-3 text-xs text-white bg-black rounded-lg max-sm:px-3 max-sm:py-1" onclick="exportTableToPDF()">PDF</button>
            </div>

        
        <!--table--><div><center>@include('_message')</center></div>
        <div class="flex flex-col flex-grow px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="expensesTable" class="w-full text-xs text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                    <tr>
                        <th scope="col" class="px-4 py-2 rounded-tl-lg">ID</th>
                        <th scope="col" class="px-4 py-2">Expense Title</th>
                        <th scope="col" class="px-4 py-2">Expense Category</th>
                        <th scope="col" class="px-4 py-2">Amount</th>
                        <th scope="col" class="px-4 py-2">Created at</th>
                        <th scope="col" class="px-4 py-2 rounded-tr-lg">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $value)
                    <tr class="text-black bg-white border-2">
                        <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap">{{ $value->id }}</td>
                        <td class="px-4 py-2 Title">{{ $value->expense_title }}</td>
                        <td class="px-4 py-2">{{ $value->category ? $value->category->name : 'No Category' }}</td>
                        <td class="px-4 py-2">{{ $value->amount }}</td>
                        <td class="px-4 py-2">{{ $value->expense_date->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{url('expenses/updateExpense/'.$value->id)}}">
                                <button class="px-2 py-1 text-xs border-2 rounded-lg">Edit</button>
                            </a>
                            @if(has_permission(75))
                            <button class="px-2 py-1 text-xs text-white bg-red-600 border-2 rounded-lg" onclick="deleteExpense({{ $value->id }})">Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
function searchItems() {
    const searchValue = document.getElementById('searchExpensesName').value.toLowerCase();
    const rows = document.querySelectorAll('#expensesTable tbody tr');

    rows.forEach(row => {
        const itemName = row.querySelector('.Title').textContent.toLowerCase();

        // Show row if the item name includes the search text; otherwise, hide it
        if (itemName.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
function showEntries() {
        const rows = document.querySelectorAll('#expensesTable tbody tr'); // Target the suppliersTable
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
function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Get the table data
    const table = document.getElementById('expensesTable');

    // Extract table data
    const rows = [];
    const tableRows = table.querySelectorAll('tr');

    // Determine the number of columns to exclude (last 4 columns)
    let totalColumns = tableRows[0].querySelectorAll('th, td').length; // Total columns in the table
    let columnsToExclude = 1; // Number of columns to remove

    // Extract rows, excluding the last 4 columns
    tableRows.forEach((row, rowIndex) => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];

        cols.forEach((col, index) => {
            if (index < totalColumns - columnsToExclude) { // Include columns except the last 4
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
    doc.save('Expenses.pdf');
}


function deleteExpense(ExpensesId) {
    if (confirm("Are you sure you want to delete this Expenses?")) {
        fetch(`/expenses/delete_expenses/${ExpensesId}`, {
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
                location.reload(); // Reload page to see changes
            } else {
                alert(data.message);
            }
        });
    }
}
</script>