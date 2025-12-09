@include('layouts.header')
<div class="flex flex-col h-5/6">
    <!--breadcrumbs-->
    <div class="px-12 py-1 max-sm:px-6">
        <nav class="flex justify-between w-full" aria-label="Breadcrumb">
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
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Items</p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">QR/Barcode</p>
                    </div>
                </li>
            </ol>
            <!-- Right side buttons -->
            
        </nav>
    </div>

        <!--search-->
        <div class="flex items-center w-1/2 gap-3 px-6 py-1 max-sm:px-4 max-md:w-full">
            <label for="search_item" class="text-xs">Search</label>

            <div class="flex items-center justify-between px-4 py-2 ">
            <form method="GET" action="{{ url('item/item_list') }}" class="flex items-center gap-2">
                <input 
                    type="text" 
                    name="search" 
                    id="searchItemName" 
                    value="{{ request('search') }}" 
                    class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg md:p-3 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Enter item name" 
                    required 
                />
                <button 
                    type="submit" 
                    class="py-2 md:py-3 px-4 md:px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg text-sm md:text-base">
                    Search
                </button>
            </form>
        </div>
        <button type="button" class="py-2 md:py-3 px-4 md:px-6 bg-[#000000] text-white rounded-lg text-sm md:text-base"
        onclick="window.location.href='/item/genarateCode'">Reset</button>
            <span class="flex items-center gap-3 w-fit max-md:w-full">
                <input type="number" id="col_num"
                    class="block w-full p-2 text-xs text-gray-900 border border-gray-300 rounded-lg md:p-3 md:text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="10" min="1" oninput="showEntries()" required />
                Entries
            </span>
        </div>




        
        
        <!--btn controls-->
        

        <!--table-->
        <div><center>@include('_message')</center></div>
        <div class="flex flex-col px-12 py-1 overflow-y-auto bg-white max-sm:px-6">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
        <!-- Modal Structure for QR/Barcode -->
    <div id="codeModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-500 bg-opacity-50">
        <div class="p-5 bg-white rounded-lg">
            <h2 id="modalTitle" class="mb-4 text-xl">Generated Code</h2>
            <div id="codeContainer" class="flex items-center justify-center mb-4">
                <!-- QR code or barcode will appear here -->
            </div>
            <button id="downloadBtn" class="p-2 text-white bg-blue-600 rounded-lg">Download</button>
            <button id="closeModalBtn" class="p-2 mt-2 text-white bg-gray-600 rounded-lg">Close</button>
        </div>
    </div>

<table id="itemsTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
        <tr>
            <th scope="col" class="px-4 py-2 rounded-tl-lg">#</th>
            <th scope="col" class="px-4 py-2">Item image</th>
            <th scope="col" class="px-4 py-2">Item Name</th>
            <th scope="col" class="px-4 py-2">Item Code</th>
            <th scope="col" class="px-4 py-2">Qty</th>
            <th scope="col" class="px-4 py-2">Status</th>
            <th scope="col" class="px-4 py-2 rounded-tr-lg">Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $key => $value)
        <tr class="text-black bg-white border-2">
            <td scope="row" class="px-4 py-2 font-medium whitespace-nowrap">{{ $key + 1 }}</td>
            <td>
                @if(!empty($value->getImageUrlAttribute()))
                <img src="{{$value->getImageUrlAttribute()}}" style="width: 40px; height:40px; border-radius:50px;">
                @endif
            </td>
            <td class="px-4 py-2 item-name">{{ $value->item_name }}</td>
            <td class="px-4 py-2 ">{{ $value->item_code }}</td>
            <td class="px-4 py-2">{{ $value->quantity }}</td>
            <td class="hidden px-4 py-2">{{ $value->status_id }}</td>
            <td class="px-4 py-2">
                <span style="padding: 5px 10px; border: 1px solid {{ $value->status_id == 1 ? 'green' : 'red' }}; border-radius: 5px; background-color: transparent; color: {{ $value->status_id == 1 ? 'green' : 'red' }}; cursor: pointer;">
                    {{ $value->status_id == 1 ? 'In Stock' : 'Out Of Stock' }}
                </span>
            </td>
            <td class="px-4 py-2">
                <!-- QR Code Generation Button -->
                <button class="p-2 text-white bg-black border-2 rounded-lg qr-code-btn" data-item-code="{{ $value->item_code }}">QR Code</button>

                <!-- Barcode Generation Button -->
                <button class="p-2 text-white bg-black border-2 rounded-lg barcode-btn" data-item-code="{{ $value->item_code }}">Barcode</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div>
<!-- Pagination links -->
<div class="flex justify-center p-1 mt-1 mb-6">
    <div class="pagination">
        {{ $items->links('vendor.pagination.tailwind') }}
    </div>
</div>

</div>

@include('layouts.footer')


<!-- Include the necessary libraries for QR Code and Barcode generation -->



<script>
    function searchItems() {
    const searchValue = document.getElementById('searchItemName').value.toLowerCase();
    const rows = document.querySelectorAll('#itemsTable tbody tr');

    rows.forEach(row => {
        const itemName = row.querySelector('.item-name').textContent.toLowerCase();

        // Show row if the item name includes the search text; otherwise, hide it
        if (itemName.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
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

</script>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>


<script>
    const rowsPerPage = 10;
    const table = document.getElementById('itemsTable');
    const pagination = document.getElementById('pagination');
    const rows = table.querySelectorAll('tbody tr');
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    let currentPage = 1;

    function showPage(page) {
        currentPage = page;

        // Hide all rows
        rows.forEach((row, index) => {
            row.style.display = 'none';
        });

        // Show only the rows for the current page
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        for (let i = start; i < end && i < rows.length; i++) {
            rows[i].style.display = '';
        }

        renderPagination();
    }

    function renderPagination() {
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.innerText = i;
            button.className = `px-3 py-1 mx-1 rounded ${i === currentPage ? 'bg-[#47891E] text-white' : 'bg-gray-200'}`;
            button.onclick = () => showPage(i);
            pagination.appendChild(button);
        }
    }

    // Initialize the table with the first page
    showPage(1);
</script>

<style>
    @media (max-width: 768px) {
    /* Hide columns that you don't want to display on mobile */
    #itemsTable td.hidden,
    #itemsTable th.hidden {
        display: none;
    }

    /* Adjust the layout of the table for mobile screens */
    #itemsTable {
        border-collapse: collapse;
        width: 100%;
    }

    #itemsTable td, #itemsTable th {
        padding: 10px;
        text-align: left;
    }

    #itemsTable td {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }

    /* Create a card-like structure for each row on mobile */
    #itemsTable tr {
        display: block;
        margin-bottom: 15px;
    }

    #itemsTable tr td:first-child {
        font-weight: bold;
    }

    #itemsTable td span {
        display: block;
        margin-top: 5px;
    }

    /* Stack the "manage" buttons in a column on mobile */
    #itemsTable td button {
        display: block;
        width: 100%;
        margin-bottom: 5px;
    }
}

</style>


<script>
    window.appBaseURL = "{{ env('APP_URL_QR') }}";
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // QR Code generation event listener
    document.querySelectorAll('.qr-code-btn').forEach(button => {
        button.addEventListener('click', function () {
            const itemCode = this.getAttribute('data-item-code');
            generateQRCode(itemCode);
        });
    });

    function generateQRCode(itemCode) {
    const baseURL = window.appBaseURL + "/ItemDetails/";
    const fullURL = `${baseURL}${itemCode}`;

    const codeContainer = document.getElementById('codeContainer');
    codeContainer.innerHTML = ''; // Clear previous content

    // Create image tag for the QR Code
    const qrCodeImg = document.createElement('img');
    codeContainer.appendChild(qrCodeImg);

    // Generate QR code using the QRCode library
    QRCode.toDataURL(fullURL, { width: 200, height: 200 }, function (err, url) {
        if (err) {
            console.error('Error generating QR code:', err);
            return;
        }
        qrCodeImg.src = url;

        // Create canvas to draw QR code and item code
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Set the canvas dimensions
        canvas.width = 250; // QR code width + padding
        canvas.height = 250; // QR code height + padding

        // Set background color to white
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height); // Fill background with white

        const img = new Image();
        img.src = url;

        img.onload = function () {
            // Draw the QR code on the canvas
            ctx.drawImage(img, 25, 25, 200, 200); // Adjust position for padding

            // Set text alignment to center
            ctx.textAlign = 'center';
            ctx.font = '16px Arial';
            ctx.fillStyle = 'black'; // Black text color

            // Add item code text and center it
            ctx.fillText(`Item Code: ${itemCode}`, canvas.width / 2, 230); // Center the text horizontally

            // Update modal and show it
            document.getElementById('modalTitle').innerText = `QR Code for ${itemCode}`;
            document.getElementById('codeModal').classList.remove('hidden');

            // Handle download button
            document.getElementById('downloadBtn').onclick = function () {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = `${itemCode}_QR_Code.png`;
                link.click();
                document.getElementById('codeModal').classList.add('hidden');
            };
        };
    });
}






        // Barcode generation event listener
        document.querySelectorAll('.barcode-btn').forEach(button => {
            button.addEventListener('click', function() {
                const itemCode = this.getAttribute('data-item-code');
                generateBarcode(itemCode);
            });
        });

        function generateBarcode(itemCode) {
            const codeContainer = document.getElementById('codeContainer');
            codeContainer.innerHTML = '';  // Clear any previous content

            // Create image tag for the Barcode
            const barcodeImg = document.createElement('img');
            codeContainer.appendChild(barcodeImg);

            // Generate Barcode using JsBarcode library
            JsBarcode(barcodeImg, itemCode, { format: "CODE128", width: 2, height: 100 });

            // Create canvas to draw Barcode and item code
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            // Set the canvas dimensions
            canvas.width = 250; // Barcode width + padding
            canvas.height = 150; // Barcode height + padding

            // Set background color to white
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height); // Fill background with white

            const barcodeCanvas = barcodeImg; // Barcode image element

            barcodeCanvas.onload = function() {
                // Draw the barcode on the canvas
                ctx.drawImage(barcodeCanvas, 25, 25, 200, 100); // Adjust position for padding


                // Update modal and show it
                document.getElementById('modalTitle').innerText = `Barcode for ${itemCode}`;
                document.getElementById('codeModal').classList.remove('hidden');

                // Handle download button
                document.getElementById('downloadBtn').onclick = function() {
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = `${itemCode}_Barcode.png`;
                    link.click();
                    document.getElementById('codeModal').classList.add('hidden');

                };
            };
        }

        // Close the modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('codeModal').classList.add('hidden');
        });
    });
</script>


