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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Customers</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Import Customer</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--btn controls-->
               <!--btn controls-->
               <div class="flex items-end justify-between w-full gap-3 px-12 py-5 max-sm:px-6 max-md:flex-col">
            <span class="flex gap-3 w-fit max-md:w-full max-md:justify-center max-sm:gap-3 max-sm:flex-col">
                <!--file input-->
                <div class="flex items-center justify-center sm:w-[100px] h-[100px]">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                        </div>
                        <input id="dropzone-file" type="file" accept=".csv" class="hidden" />
                    </label>
                </div>
                <!--btn controls-->
                <div class="flex flex-col justify-between max-md:w-full max-sm:gap-3">
                    <p>File must be in CSV format</p>
                    <span class="flex justify-between w-full">
                        <button id="importBtn" class="py-2 px-5 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Import</button>
                        <button class="px-5 py-2 text-white bg-red-600 rounded-lg">Cancel</button>
                    </span>
                </div>
            </span>
        </div>

        {{-- Validation Errors Summary --}}
                @if ($errors->any())
                <div class="relative px-4 py-3 mb-4 text-red-700 border border-red-400 rounded bg-red-50" role="alert">
                <strong class="font-bold">Oops! There were some errors with your submission:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

                @endif

                {{-- Success Message --}}
                @if (session('success'))
                <div class="relative px-4 py-3 mb-4 text-[green-700] bg-green-100 border border-green-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>

                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>

                @endif

        
        <!--table-->
        <div class="flex flex-col flex-grow gap-6 px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span class="flex items-center justify-between h-10 py-6 max-sm:flex-col max-sm:h-fit max-sm:gap-3">
                <button class="flex items-center gap-3 px-5 py-2 border-2 rounded-lg max-sm:w-full max-sm:justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-download" viewBox="0 0 16 16">
                        <path
                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                        <path
                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                    </svg>
                    List
                </button>
                <button id="addDataBtn" class="p-3 border-2 rounded-lg flex gap-3 text-white bg-[{{ $settings[7]->value}}] max-sm:text-sm max-sm:w-full max-sm:justify-center">
                    Add Data On Database
                </button>
            </span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="impTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-tl-lg">#</th>
                            <th scope="col" class="px-6 py-3">Customer Code</th>
                            <th scope="col" class="px-6 py-3">Customer Name</th>
                            <th scope="col" class="px-6 py-3">Mobile Number</th>
                            <th scope="col" class="px-6 py-3">Address Line 1</th>
                            <th scope="col" class="px-6 py-3">City Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3 rounded-tr-lg">Due Amount</th>
                            <th scope="col" class="px-6 py-3">User ID</th>
                            <th scope="col" class="px-6 py-3">City ID</th>
                            <th scope="col" class="px-6 py-3">Status ID</th>

                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>
        @include('layouts.footer')


    </div>

</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>


<script>
        document.getElementById('importBtn').addEventListener('click', () => {
    const fileInput = document.getElementById('dropzone-file');
    const tableBody = document.getElementById('tableBody');

    if (fileInput.files.length === 0) {
        alert('Please upload a CSV file.');
        return;
    }

    const file = fileInput.files[0];
    if (!file.name.endsWith('.csv')) {
        alert('Invalid file format. Please upload a CSV file.');
        return;
    }

    Papa.parse(file, {
        header: true,
        skipEmptyLines: true,
        complete: function (results) {
            const rows = results.data;
            tableBody.innerHTML = ''; // Clear previous rows

            rows.forEach((row, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="px-6 py-4">${index + 1}</td>
                    <td class="px-6 py-4">${row['Customer Code'] || ''}</td>
                    <td class="px-6 py-4">${row['Customer Name'] || ''}</td>
                    <td class="px-6 py-4">${row['Mobile Number'] || ''}</td>
                    <td class="px-6 py-4">${row['Address Line 1'] || ''}</td>
                    <td class="px-6 py-4">${row['City Name'] || ''}</td>
                    <td class="px-6 py-4">${row['Email'] || ''}</td>
                    <td class="px-6 py-4">${row['Due Amount'] || ''}</td>
                    <td class="px-6 py-4">${row['User ID'] || ''}</td>
                    <td class="px-6 py-4">${row['City ID'] || ''}</td>
                    <td class="px-6 py-4">${row['Status ID'] || ''}</td>
                `;
                tableBody.appendChild(tr);
            });
        }
    });
});



document.getElementById('addDataBtn').addEventListener('click', () => {
    const rows = document.querySelectorAll('#impTable tbody tr');
    const customerData = [];

    rows.forEach(row => {
        const columns = row.querySelectorAll('td');
        const customer = {
            customer_name: columns[2].textContent.trim(),
            contact_number: columns[3].textContent.trim(),
            address_line_1: columns[4].textContent.trim(),
            city_name: columns[5].textContent.trim(),
            customer_id: columns[1].textContent.trim(),
            due_amount: columns[7].textContent.trim(),
            user_id: columns[8].textContent.trim(),
            cities_id: columns[9].textContent.trim(),
            status_id: columns[10].textContent.trim(),
            email: columns[6].textContent.trim(),

        };
        
        // Validate data before pushing
        if (!customer.customer_name || !customer.customer_id) {
            console.error('Invalid customer data:', customer);
            return;
        }
        
        customerData.push(customer);
    });

    if (customerData.length === 0) {
        alert('No valid data to insert.');
        return;
    }

    console.log('Sending customer data:', customerData);

    // Send data to the backend with error handling
    fetch('/api/import-customers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ customers: customerData })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Data successfully added to the database.');
        } else {
            alert(data.message || 'Error adding data to the database.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(`Error adding data to the database: ${error.message}`);
    });
});



document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.relative[role="alert"]');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 4000); // 4000 milliseconds = 4 seconds
    });



    </script>