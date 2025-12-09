@include('layouts.header')



<style>
/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Darkened background */
    padding-top: 60px;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 30px;
    border: 1px solid #ddd; /* Light border for subtle separation */
    width: 80%;
    max-width: 500px;
    position: relative;
    text-align: center;
    border-radius: 15px; /* Rounded corners for modern look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transform: translateY(-100px);
    animation: modalAppear 0.3s ease-out forwards;
}

/* Fade-in animation */
@keyframes modalAppear {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 0;
    right: 10px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #333;
    text-decoration: none;
}

.modal-btn {
    padding: 12px 25px;
    background-color: rgb(49, 64, 106);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    display: inline-block;
    margin-top: 20px;
    border-radius: 8px; /* Rounded corners for button */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.modal-btn:hover {
    transform: scale(1.05); /* Slight scale effect on hover */
}

.modal-btn:focus {
    outline: none;
}

/* Styling for the message text */
#modalMessage {
    font-size: 18px;
    color: #333;
    margin-bottom: 20px;
    font-weight: 600;
}


</style>

<body class="h-dvh max-lg:h-fit" >
    <!--Nav-->

    <div class="h-[90%] flex flex-col">
        <!--breadcrumbs-->
        <div class="hidden px-12 py-5 max-sm:px-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <p class="inline-flex items-center text-sm font-medium text-gray-700">
                            <svg class="w-3 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">
                                Sales
                            </p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">
                                Billing
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        
        <!--main content-->
        <div class="flex h-full gap-2 px-3 py-3 overflow-y-auto max-sm:px-6 max-xl:flex-col">
            <!--blue div + textfields + table-->
            <div class="bg-white flex flex-col w-2/3 rounded-lg border-2 border-[#00000096] max-xl:w-full">
                <div class="flex flex-col">
                    <!--blue div-->
                    <span
                        class="bg-[{{ $settings[7]->value}}] h-20 max-sm:h-fit rounded-t-md flex max-lg:flex-col max-lg:py-1 justify-between px-4 items-center">
                        <span class="flex gap-3 text-white max-sm:text-sm max-sm:w-full">
                            <p>Sales Invoice</p>
                        </span>
                    </span>
                    <!--textfields-->
                    <div class="flex gap-3 p-2 h-fit max-sm:flex-col max-sm:items-center">

                        <!-- Custom Combobox -->
                        <div class="custom-select sm:w-1/2 " >
                            <select id="customer_id" name="customer_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--add customer btn (blue)-->
                        <button type="button" data-modal-target="customer-modal" data-modal-toggle="customer-modal"
                            class="text-white w-fit bg-[{{ $settings[7]->value}}] hover:bg-[{{ $settings[7]->value}}] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </button>
                        <!--barcode-->

                    </div>
                </div>
                <!--table from flowbite-->
                <div class="relative h-full max-h-screen overflow-x-auto overflow-y-auto">
                <table id="itemsTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-black uppercase bg-[#00000042]">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-tl-lg">Item Name</th>
                            <th scope="col" class="px-6 py-3">Serial Number</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3 rounded-tr-lg"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
                </div>
                <!--white control panel-->
                <div class="bg-[#0000000F] h-[200px] max-xl:h-fit flex flex-col rounded-b-lg">
                    <!--info-->
                    <span
                        class="flex gap-3 h-fit w-full justify-evenly py-3 border-[#00000096] border-t-2 border-b-2 max-md:text-sm max-sm:text-xs max-md:flex-col max-md:p-2">
                        <p class="text-lg font-semibold">Total Quantity: <span id="total-quantity">0</span></p>
                        
                        <p class="text-lg font-semibold">Total: <span id="total">0</span></p>

                        </span>
                    <!--txts + btns-->
                    <div class="flex items-center max-lg:flex-col">

                        <div class="grid w-1/2 grid-flow-col grid-cols-2 grid-rows-2 gap-4 p-2 max-lg:w-full">
                        <button type="button" name="orderAll" id="orderAll"
                            class="row-span-2 gap-2 flex justify-center items-center text-white bg-[{{ $settings[7]->value}}] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 max-sm:px-2 py-2 max-sm:py-1 text-center inline-flex items-center max-sm:text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cash" viewBox="0 0 16 16">
                                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                            </svg>
                            Order All
                        </button>

                        </div>
                    </div>
                </div>
            </div>
            <!--sidebar-->
            <div class="flex flex-col w-1/3 border-2 rounded-lg max-md:w-full max-xl:w-full">
                <!-- Search bar -->
                <span class="h-1/6 p-3 bg-[#0000000F] border-b-2 2xl:h-[5%] min-h-[65px]">
                    <input type="text" id="searchInput"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Search for items..." onkeyup="searchItems()" required />
                </span>

                <!-- Sidebar products cards -->
                <div class="grid grid-cols-3 max-xl:grid-cols-5 max-lg:grid-cols-4 max-[600px]:grid-cols-3 max-[400px]:grid-cols-2 gap-3 overflow-y-auto p-3" id="productGrid">
                    @foreach ($items as $item)
                        <div class="bg-[#029ED90F] xl:h-[160px] max-xl:aspect-[4/5] flex flex-col justify-between rounded-md cursor-pointer open-modal item-card"
                            data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                            <span class="bg-[{{ $settings[7]->value}}] h-1/6 rounded-t-md text-white flex justify-center items-center text-sm">
                                <p class="truncate">{{ $item->id }}</p>
                            </span>
                            <div class="flex flex-col justify-between p-1 h-5/6">
                                <center>
                                    @if (!empty($item->image_path) && file_exists($item->image_path))
                                        <img src="{{ asset($item->image_path) }}" style="width: 80px; height: 60px; border-radius:5px;">
                                    @else
                                        <img src="{{ asset('upload/item/default.png') }}" style="width: 80px; height: 60px; border-radius:5px;">
                                    @endif
                                </center>
                                <span class="flex flex-col text-xs text-center h-fit">
                                    <p class="truncate">{{ $item->created_at->format('F j, Y') }}</p>
                                    <p class="truncate" title="{{ $item->name }}">{{ $item->name }}</p>
                                    <p class="truncate">Price: {{ number_format($item->retail_price, 2) }}</p>
                                    <p class="truncate">Qty: {{ $item->serialNumbers->count() }}</p>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>

    <!-- View Sidebar Item Modal -->
    <div id="sidebar-item-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-4xl max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900">
                    Loading...
                </h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" data-modal-hide="sidebar-item-modal">
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
                <div class="relative mb-4">
                    <input type="text" id="serial-number-search" placeholder="Search by Serial Number" class="w-full p-2 border border-gray-300 rounded-md" />
                </div>
                <div class="flex justify-center hidden">
                    <img id="modal-image" src="/upload/item/default.png" alt="prod-img" class="w-20">
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Serial Number</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody id="unit-numbers-body">
                            <tr><td colspan="3" class="py-4 text-center">Loading...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add customer Modal -->
<div id="customer-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Corrected Form -->
        <form id="addCustomerForm"  enctype="multipart/form-data">
        @csrf
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Customer
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="customer-modal">
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
                    <div class="grid grid-cols-3 gap-6 max-md:grid-cols-1">
                        <div class="max-sm:w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-black ">Customer Name</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Customer name"  />
                                <span class="text-sm text-red-500" id="error-name"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="Mobile_Number" class="block mb-2 text-sm font-medium text-black ">Mobile Number</label>
                            <input type="text" id="Mobile_Number" name="Mobile_Number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Mobile Number"  />
                                <span class="text-sm text-red-500" id="error-Mobile_Number"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-black ">Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter email"  />
                        </div>
                        <div class="max-sm:w-full">
                            <label for="city" class="block mb-2 text-sm font-medium text-black ">City</label>
                            <input type="text" id="city" name="city"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter city"  />
                                <span class="text-sm text-red-500" id="error-city"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="addl1" class="block mb-2 text-sm font-medium text-black">Address Line</label>
                            <textarea id="addl1" rows="2" name="addl1"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter address" ></textarea>
                                <span class="text-sm text-red-500" id="error-addl1"></span>
                        </div>
                        <div class="hidden max-sm:w-full">
                            <label for="addl2" class="block mb-2 text-sm font-medium text-black">Address Line 2</label>
                            <textarea id="addl2" rows="2" name="addl2"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter address" ></textarea>
                                <span class="text-sm text-red-500" id="error-addl2"></span>
                        </div>
                        <div class="hidden max-sm:w-full" >
                            <label for="due" class="block mb-2 text-sm font-medium text-black ">Due Amount</label>
                            <input type="text" id="due" name="due"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Customer name"  />
                                <span class="text-sm text-red-500" id="error-due"></span>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                    <button  type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    <button data-modal-hide="customer-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>




</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>


    <!-- THISARA -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
    let totalQuantity = 0; // Variable to track total quantity
    const addedProducts = new Set(); // Track added products by their unitId

    // Function to update the total quantity counter
    function updateTotalQuantity() {
        document.querySelector("#total-quantity").innerText = totalQuantity;
    }

    // Open modal when item card is clicked
    document.querySelectorAll(".open-modal").forEach(card => {
    card.addEventListener("click", function() {
        let itemId = this.getAttribute("data-id");

        // Fetch item details
        fetch(`/returnable-items/${itemId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("Item not found!");
                    return;
                }

                // Update modal content
                document.querySelector("#modal-title").innerText = `${data.item.id} | ${data.item.name}`;

                let tbody = document.querySelector("#unit-numbers-body");
                tbody.innerHTML = "";

                // Store the full list of unit numbers
                let unitNumbers = data.unitNumbers;

                // Function to render unit numbers
                function renderUnitNumbers(filteredUnitNumbers) {
                    tbody.innerHTML = ""; // Clear the current list
                    filteredUnitNumbers.forEach(unit => {
                        let statusText = unit.purchase_status_id == 1 ? 'Available' : 'Bought';
                        let statusColorClass = unit.purchase_status_id == 1 ? 'bg-blue-700 hover:bg-blue-800' : 'bg-gray-200 cursor-not-allowed';
                        let isAdded = addedProducts.has(unit.id); // Check if the product is already added

                        let row = `
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">${unit.serial_number}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold text-white rounded-md ${getStatusColor(unit.purchase_status_id)}">
                                        ${statusText}
                                    </span>
                                </td>
                                <td class="hidden px-6 py-4">
                                    <span>${data.item.retail_price}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button data-product-id="${unit.id}" class="add-to-bill-btn ${statusColorClass} text-white w-fit font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" ${isAdded || unit.purchase_status_id != 1 ? 'disabled' : ''}>
                                        ${isAdded ? 'Added' : 'Add to Bill'}
                                    </button>
                                    ${isAdded ? '<span class="ml-2 text-black">✔</span>' : ''}
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                }

                // Initially render all unit numbers
                renderUnitNumbers(unitNumbers);

                // Handle the search functionality
                document.querySelector("#serial-number-search").addEventListener("input", function() {
                    let searchTerm = this.value.toLowerCase();
                    let filteredUnitNumbers = unitNumbers.filter(unit => 
                        unit.serial_number.toLowerCase().includes(searchTerm)
                    );
                    renderUnitNumbers(filteredUnitNumbers);
                });

                // Show the modal
                document.querySelector("#sidebar-item-modal").classList.remove("hidden");
            })
            .catch(error => console.error("Error fetching item details:", error));
    });
});


    // Function to determine status badge color
    function getStatusColor(statusId) {
        switch (statusId) {
            case 1: return "bg-blue-800";
            case 2: return "bg-red-800";
            case 3: return "bg-yellow-800";
            default: return "bg-gray-500";
        }
    }

    // Close modal
    document.querySelector("[data-modal-hide='sidebar-item-modal']").addEventListener("click", function() {
        document.querySelector("#sidebar-item-modal").classList.add("hidden");
    });

    // Add to Bill button click event
    let totalPrice = 0; // Initialize total price variable

document.addEventListener("click", function(event) {
    if (event.target.classList.contains("add-to-bill-btn")) {
        let unitId = event.target.getAttribute("data-product-id");
        console.log("Adding product with unitId:", unitId); // Debugging

        // Check if the product is already added
        if (addedProducts.has(unitId)) {
            console.log("Product already added:", unitId); // Debugging
            alert("This product has already been added to the bill!"); // Show alert
            return; // Exit if the product is already added
        }

        let unitRow = event.target.closest("tr");
        let unitCode = unitRow.querySelector("td").innerText;
        let itemName = document.querySelector("#modal-title").innerText.split(" | ")[1];
        let itemPrice = parseFloat(unitRow.querySelector("td:nth-child(3)").innerText); // Get price and convert to float

        // Append the new row to the table
        let itemsTableBody = document.querySelector("#itemsTable tbody");
        let newRow = `
            <tr class="text-black bg-white border-2" data-unit-id="${unitId}">
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap max-2xl:max-w-[100px] truncate cursor-pointer" title="${itemName}">
                    ${itemName}
                </td>
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap max-2xl:max-w-[100px] truncate cursor-pointer" title="${unitCode}">
                    ${unitCode}
                </td>
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap max-2xl:max-w-[100px] truncate cursor-pointer" title="${itemPrice}">
                    ${itemPrice.toFixed(2)} <!-- Format the price to two decimal places -->
                </td>
                <td class="px-6 py-4">
                    <button class="p-3 text-white bg-red-600 border-2 rounded-lg remove-item-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                    </button>
                </td>
            </tr>
        `;
        itemsTableBody.innerHTML += newRow;

        // Mark the product as added
        addedProducts.add(unitId);
        console.log("Added products:", addedProducts); // Debugging

        // Increment the total quantity and update total price
        totalQuantity += 1;
        totalPrice += itemPrice; // Add the item price to the total price
        updateTotalQuantity();
        updateTotalPrice(); // Call the function to update the total price display

        // Disable the "Add to Bill" button and update its text
        event.target.disabled = true;
        event.target.innerText = "Added";
        event.target.insertAdjacentHTML("afterend", '<span class="ml-2 text-black">✔</span>');

        // Close the modal
        document.querySelector("#sidebar-item-modal").classList.add("hidden");
    }
});

// Function to update the displayed total price
function updateTotalPrice() {
    document.querySelector("#total").innerText = totalPrice.toFixed(2); // Display total price with two decimals
}


    // Remove item from the table
    document.addEventListener("click", function(event) {
        if (event.target.closest(".remove-item-btn")) {
            let row = event.target.closest("tr");
            let unitId = row.getAttribute("data-unit-id"); // Get unit ID from the row's data attribute
            console.log("Removing product with unitId:", unitId); // Debugging

            // Remove the product from the addedProducts set
            addedProducts.delete(unitId);
            console.log("Added products after removal:", addedProducts); // Debugging

            // Remove the row from the table
            row.remove();

            // Decrement the total quantity
            totalQuantity -= 1;
            updateTotalQuantity();
        }
    });
});
</script>



<script>
    // Search Item
    function searchItems() {
    var input, filter, grid, items, name, i;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    grid = document.getElementById("productGrid");
    items = grid.getElementsByClassName("item-card");

    // Loop through all items and hide those who do not match the search
    for (i = 0; i < items.length; i++) {
        name = items[i].getAttribute("data-name").toLowerCase();
        if (name.indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}

</script>



<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#orderAll").addEventListener("click", function() {
        let unitIds = [];
        let rows = document.querySelectorAll("#itemsTable tbody tr");

        rows.forEach(row => {
            let unitId = row.getAttribute("data-unit-id");
            unitIds.push(unitId);
        });

        if (unitIds.length === 0) {
            alert("No items in the bill!");
            return;
        }

        let customerId = document.querySelector("#customer_id").value;
        if (!customerId) {
            alert("Please select a customer!");
            return;
        }

        // Get total price
        let totalPrice = parseFloat(document.querySelector("#total").innerText);
        if (isNaN(totalPrice) || totalPrice <= 0) {
            alert("Invalid total price!");
            return;
        }

        let dataToSend = {
            unitIds: unitIds,
            customerId: customerId,
            total: totalPrice // Include total price
        };

        console.log("Data to send:", dataToSend);

        fetch("/order_Process", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(dataToSend)
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data);
            if (data.success) {
                window.location.href = `/another-ui?unitIds=${unitIds.join(",")}&customerId=${customerId}&total=${totalPrice}`;
            } else {
                alert("Failed to place order. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });
});

</script>
</html>







<script>
document.getElementById('addCustomerForm').addEventListener('submit', function (event) {
    event.preventDefault();  // Prevent the default form submission behavior

    const formData = new FormData(this);

    // Get existing customers from local storage (or initialize if none exists)
    const customers = JSON.parse(localStorage.getItem('customers')) || [];
    formData.append('customers', JSON.stringify(customers)); // Serialize customers array to JSON string

    fetch('{{ route('customers.storeBill') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reset the form and close the modal if successful
            document.getElementById('customer-modal').classList.add('hidden');
        } else {
            // Display validation errors
            console.error('Error:', data.message);
            if (data.errors) {
                displayValidationErrors(data.errors);
            } else {

                location.reload();
            }

        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
    });
});
// Function to display validation errors
function displayValidationErrors(errors) {
    // 1. Reset previous error states
    document.querySelectorAll('.is-invalid').forEach(field => field.classList.remove('is-invalid'));
    document.querySelectorAll('.error-message').forEach(error => {
        error.textContent = '';
        error.classList.add('hidden'); // Hide error messages
    });

    // 2. Display new validation errors
    for (const field in errors) {
        if (errors.hasOwnProperty(field)) {
            const errorMessage = errors[field][0]; // Get the first error message
            const errorSpan = document.getElementById(`error-${field}`); // Error span by field ID
            const inputField = document.getElementById(field); // Input field by ID

            if (errorSpan) {
                errorSpan.textContent = errorMessage; // Set error message
                errorSpan.classList.remove('hidden'); // Show error message
            }

            if (inputField) {
                inputField.classList.add('is-invalid'); // Highlight invalid field
            }
        }
    }

    // 3. Hide errors on user input
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('input', () => {
            const errorSpan = document.getElementById(`error-${input.id}`);
            if (errorSpan) {
                errorSpan.textContent = ''; // Clear error message
                errorSpan.classList.add('hidden'); // Hide error message
            }
            input.classList.remove('is-invalid'); // Remove invalid class
        });
    });
}</script>