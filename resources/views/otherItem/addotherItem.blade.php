@include('layouts.header')
<style>
/* Add a simple spinner style */
.spinner-border {
    border: 2px solid #fff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    width: 1rem;
    height: 1rem;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-left: 10px;
}

/* Spinner animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Hide the spinner by default */
.hidden {
    display: none;
}


</style>
<div class="flex flex-col flex-grow">
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Add Items</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--main panel-->
        <div class="p-6">
            <div class="flex flex-col h-full p-6 border-2 rounded-lg">
                <!--item data-->
                <div>
                            <!-- Improved Error and Success Messages -->
                        @if($errors->any())
                            <div id="error-message" class="p-4 mx-6 mt-3 mb-4 text-red-800 bg-red-100 border border-red-300 rounded-lg shadow-md">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div id="success-message" class="flex items-center justify-between p-4 mx-6 mt-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg shadow-md">
                                <span>{{ session('success') }}</span>
                                <button onclick="this.parentElement.style.display='none'" class="text-green-800 hover:text-green-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div id="error-message" class="flex items-center justify-between p-4 mx-6 mt-3 mb-4 text-red-800 bg-red-100 border border-red-300 rounded-lg shadow-md">
                                <span>{{ session('error') }}</span>
                                <button onclick="this.parentElement.style.display='none'" class="text-red-800 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="item_name" class="block mb-2 text-sm font-medium text-black ">Item name</label>
                            <input type="text" id="item_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Your Item name" required />
                        </div>
                        <div>
                            <label for="brand-search" class="block mb-2 text-sm font-medium text-black">Brand</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="brand" name="brand"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Brand name</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('brand');">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="quantity" class="block mb-2 text-sm font-medium text-black ">Category</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="category" name="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Category name</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('category');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-black">Serial Number</label>
                            <div class="flex items-center gap-3">
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] w-1/3 text-white rounded-lg"
                                    onclick="showUnitCodeModal();">Add Serial Number</button>
                                <p id="unit-code-qty">Qty: 0</p>
                            </div>
                        </div>


                        <div>
                            <label for="color" class="block mb-2 text-sm font-medium text-black">Select Type</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="type" name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('type');">+</button>
                            </div>
                        </div>

                    </div>
                    
                </div>
                <hr>
                <br>
                <div>
                <br/>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Purchase Price</label>
                            <div class="flex gap-3">
                                <input type="number" id="purchase_price" name="purchase_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Retail Price</label>
                            <div class="flex gap-3">
                                <input type="number" id="retails_price" name="retails_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Wholesale Price</label>
                            <div class="flex gap-3">
                                <input type="number" id="wholesale_price" name="wholesale_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <br>

                
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center flex-grow w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div id="dropzone-content" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Add image </span>here</p>
                            <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" accept="image/*" name="imageFile" />
                    </label>
                </div>


                <div class="flex items-center justify-center w-full gap-4 p-4">
                        <button id="saveMobileItemBtn" class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg" type="submit">
                            <span id="save-btn-text">Save</span> <!-- Text inside the button -->
                            <span id="loading-spinner" class="hidden spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <!-- Loading spinner -->
                        </button>
                    </div>


            </div>
        </div>
        <div class="flex-grow"></div>
    </div>

    <div id="modal-for-add-items" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <!-- Add this inside your modal body -->
                <input type="hidden" id="modal-type" value="">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900" id="modal-header"> <!-- dynamic header --> </h3>
                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" data-modal-hide="modal-for-add-items">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body with table -->
                    <div class="p-4 space-y-4 md:p-5">
                    <div>
                    <!-- Input field and button in one line -->
                    <div class="flex items-center space-x-2">
                        <input type="text" id="modal-input" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            placeholder="Enter item" required />
                            <button data-modal-hide="modal-for-add-items" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" id="add-item-btn">Add</button>

                    </div>
                        </div>
                        <!-- Dynamic table for items -->
                        <div class="overflow-y-auto t-4 max-h-60">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Name</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-table-body">
                                    <!-- Dynamic content inserted here by JS -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Add new item input field -->

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                        <button data-modal-hide="modal-for-add-items" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for adding IMEI -->
        <!-- Modal for Adding IMEI -->
        <div id="unit-code-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center hidden w-full h-full max-h-full overflow-x-hidden overflow-y-auto bg-gray-800 bg-opacity-50">
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <input type="hidden" id="unit-code-modal-type" value="">
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900" id="unit-code-modal-header">Add Serial Number</h3>
                        <!-- Close Button -->
                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" onclick="closeUnitCodeModal()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close Unit Code List</span>
                        </button>
                    </div>

                    <div class="p-4 space-y-4 md:p-5">
                        <input type="text" id="unit-code-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter Serial Number" required />
                        <div class="mt-4 overflow-y-auto max-h-60">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Serial Number</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="unit-code-table-body">
                                    <!-- Dynamic content inserted here by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" id="add-unit-code-btn" onclick="addUnitCode()">Add Serial Number</button>
                        <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="closeUnitCodeModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



<!-- Notification Container (Centered on Screen) -->
<div id="notification" class="fixed hidden max-w-xs px-6 py-4 text-center text-white transform -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-lg top-1/3 left-1/2 md:max-w-sm"
    data-aos="fade-down">
    <span id="notification-message"></span>
</div>
@include('layouts.footer')


</html>


<script>
    function showModal(whichModal) {

        document.getElementById("modal-type").value = whichModal;
        
        // Fetch existing items for the selected modal type
        fetchItems(whichModal);

        // Set modal header and input placeholder
        const modalHeader = document.getElementById("modal-header");
        const modalInput = document.getElementById("modal-input");
        
        switch (whichModal) {
            case "category":
                document.getElementById("modal-header").innerText = "Add Category";
                document.getElementById("modal-input").placeholder = "Category Name";
                break;
            case "type":
                document.getElementById("modal-header").innerText = "Add Type";
                document.getElementById("modal-input").placeholder = "Type Name";
                break;
            case "brand":
                document.getElementById("modal-header").innerText = "Add Brand";
                document.getElementById("modal-input").placeholder = "Brand Name";
                break;

            default:
                break;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<!--<script src="../../../scripts/common.js"></script>-->
<!-- Include AOS Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


<script>

// Add this to your existing script.js file or create a new one
document.addEventListener('DOMContentLoaded', function() {
    // Get the Add button in the modal
    const addButton = document.querySelector('[data-modal-hide="modal-for-add-items"].bg-blue-700');
    
    // Add click event listener
    addButton.addEventListener('click', function() {
        // Get the modal input value
        const modalInput = document.getElementById('modal-input').value;
        // Get the current modal type from a hidden input (we'll add this)
        const modalType = document.getElementById('modal-type').value;
        
        if (modalInput.trim() == '') {
            alert('Please enter a value');
            return;
        }
        
        // Check if modalType is brand, category, or type
        if (['brand', 'category', 'type'].includes(modalType)) {
            // Send AJAX request to save the data
            saveToDB(modalType, modalInput);
        } else {
            alert('Invalid type selected');
        }
    });
});

// Function to save data to the database and local storage
function saveToDB(type, value) {
    // Ensure the value isn't empty
    if (value.trim() == '') {
        alert('Please enter a value');
        return;
    }

    // Create FormData object to send data with AJAX
    const formData = new FormData();
    formData.append('type', type);  // The type of item (brand, category, type)
    formData.append('value', value);  // The value to be saved
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);  // CSRF token for security

    // Send the data to the server using fetch API (POST request)
    fetch('/save-otheritem-data', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Read the response as text
    .then(text => {
        try {
            const data = JSON.parse(text);  // Attempt to parse the response as JSON

            // Check if the response contains a success flag
            if (data.success) {
                // Add the new item to the dropdown (select element)
                const select = document.getElementById(type);  // Get the select element by type (brand, category, etc.)
                const option = document.createElement('option');  // Create a new option element
                option.value = data.id;  // Set the option value to the id returned from the server
                option.text = value;  // Set the option text to the value provided by the user
                select.appendChild(option);  // Add the option to the select dropdown

                // Set the new option as the selected one
                select.value = data.id;

                // Clear the modal input field
                document.getElementById('modal-input').value = '';

                // Save the new item to localStorage (for use in future interactions)
                saveToLocalStorage(type, data.id, value);

                // Optionally, you can reload the page or refresh the UI as needed
                location.reload();  // This will refresh the page, but be mindful of user experience
            } else {
                alert('Error: ' + data.message);  // If the response contains an error message, display it
            }
        } catch (e) {
            console.error('Invalid JSON response:', text);  // If parsing the response fails, log the error
            alert('An error occurred while saving the data');
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Log any network errors
        alert('An error occurred while saving the data');
    });
}

// Function to save the data to localStorage for persistence
function saveToLocalStorage(type, id, value) {
    // Get the existing items from localStorage (or initialize an empty array if none exist)
    let storedData = JSON.parse(localStorage.getItem(type)) || [];

    // Add the new item to the array
    storedData.push({ id, value });

    // Save the updated array back to localStorage
    localStorage.setItem(type, JSON.stringify(storedData));
}


function fetchItems(type) {
    fetch(`/fetch-otheritem/${type}`)
        .then(response => response.json())
        .then(data => {
            // If data structure is as expected, proceed
            if (data.items && Array.isArray(data.items)) {
                // Retrieve items stored in localStorage for this type
                let storedData = JSON.parse(localStorage.getItem(type)) || [];

                // Update the table with the fetched items
                const tbody = document.getElementById("modal-table-body");
                tbody.innerHTML = ''; // Clear existing table content

                // Add fetched and localStorage items to the table
                data.items.forEach(item => {
                    const storedItem = storedData.find(localItem => localItem.id === item.id);

                    // Create table row for this item
                    const row = document.createElement('tr');
                    row.classList.add('bg-white', 'border-b');

                    row.innerHTML = `
                        <td class="px-6 py-4">${item.name}</td>
                        <td class="px-6 py-4">
                            <button onclick="removeItem('${type}', ${item.id})" class="font-medium text-red-600 hover:underline">Delete</button>
                        </td>
                    `;

                    // Append to table body if item is found in both local storage and database
                    if (storedItem) {
                        tbody.appendChild(row);
                    }
                });
            } else {
                console.error('Invalid data format:', data);
                alert('An error occurred while fetching items.');
            }
        })
        .catch(error => {
            console.error('Error fetching items:', error);
            alert('An error occurred while fetching items.');
        });
}


// Function to remove item
function removeItem(type, id) {
    // Get CSRF token from the meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/remove-otheritem/${type}/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token, // Send CSRF token
            'Content-Type': 'application/json' // Optional: Specify content type as JSON
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); 
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>




<script>
// Show Modal for Unit Codes
function showUnitCodeModal() {
    const modal = document.getElementById("unit-code-modal");
    modal.classList.remove("hidden");
    loadUnitCodeList();  // Load the unit code list into the modal
}

// Close the Unit Code Modal (updated function)
function closeUnitCodeModal() {
    const modal = document.getElementById("unit-code-modal");
    modal.classList.add("hidden");
}

// Add Unit Code to Local Storage and Update UI
function addUnitCode() {
    const unitCodeInput = document.getElementById("unit-code-input");
    const unitCode = unitCodeInput.value.trim();
    
    if (unitCode) {
        // Retrieve existing unit codes from localStorage
        let unitCodes = JSON.parse(localStorage.getItem("unitCodes")) || [];
        
        // Add new unit code to the list
        unitCodes.push({ unitCode: unitCode });
        
        // Save updated list back to localStorage
        localStorage.setItem("unitCodes", JSON.stringify(unitCodes));
        
        // Clear input and refresh the UI
        unitCodeInput.value = "";
        loadUnitCodeList();
        updateUnitCodeQty();
    }
}

// Delete Unit Code from Local Storage and Update UI
function deleteUnitCode(index) {
    let unitCodes = JSON.parse(localStorage.getItem("unitCodes")) || [];
    unitCodes.splice(index, 1);  // Remove unit code at index
    localStorage.setItem("unitCodes", JSON.stringify(unitCodes));  // Update localStorage
    loadUnitCodeList();
    updateUnitCodeQty();
}

// Load Unit Code list into the modal
function loadUnitCodeList() {
    const unitCodes = JSON.parse(localStorage.getItem("unitCodes")) || [];
    const unitCodeListElement = document.getElementById("unit-code-table-body");
    
    unitCodeListElement.innerHTML = "";  // Clear current list
    
    unitCodes.forEach((unitCodeObj, index) => {
        const tr = document.createElement("tr");
        
        tr.innerHTML = `
            <td class="px-6 py-3">${unitCodeObj.unitCode}</td>
            <td class="px-6 py-3">
                <button class="text-red-500" onclick="deleteUnitCode(${index})">Delete</button>
            </td>
        `;
        unitCodeListElement.appendChild(tr);
    });
}

// Update the quantity display outside the modal
function updateUnitCodeQty() {
    const unitCodes = JSON.parse(localStorage.getItem("unitCodes")) || [];
    document.getElementById("unit-code-qty").innerText = `Qty: ${unitCodes.length}`;
}

// Initialize the unit code list on page load
window.onload = function() {
    updateUnitCodeQty();
};

</script>



<script>
    document.getElementById('dropzone-file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const dropzoneContent = document.getElementById('dropzone-content');
                dropzoneContent.innerHTML = `<img src="${e.target.result}" alt="Preview" class="max-w-full rounded-lg max-h-48" />`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>







<script>
document.addEventListener("DOMContentLoaded", function() {
    AOS.init();
});

document.getElementById("saveMobileItemBtn").addEventListener("click", function(event) {
    event.preventDefault();
    
    let isSubmitting = false;
    if (isSubmitting) return;
    isSubmitting = true;

    // Get form data
    const itemName = document.getElementById("item_name").value.trim();
    const brand = document.getElementById("brand").value;
    const category = document.getElementById("category").value;
    const type = document.getElementById("type").value;
    const unitCodes = JSON.parse(localStorage.getItem("unitCodes")) || [];
    const purchase_price = document.querySelector('input[name="purchase_price"]').value.trim();
    const retails_price = document.querySelector('input[name="retails_price"]').value.trim();
    const wholesale_price = document.querySelector('input[name="wholesale_price"]').value.trim();
    const imageFile = document.getElementById("dropzone-file").files[0];

    // Validation checks
    if (!itemName || !brand || !category || !type || !purchase_price || !retails_price || !wholesale_price) {
        showNotification('Please fill all required fields.', 'red');
        isSubmitting = false;
        return;
    }

    if (!Array.isArray(unitCodes)) {
        console.error('unitCodes is not an array:', unitCodes);
        showNotification('Unit codes are invalid.', 'red');
        isSubmitting = false;
        return;
    }


    if (unitCodes.length === 0) {
        showNotification('Please add at least one unit code.', 'red');
        isSubmitting = false;
        return;
    }

    const formData = new FormData();
    formData.append("name", itemName);
    formData.append("brand_id", brand);
    formData.append("category_id", category);
    formData.append("type_id", type);
    formData.append("purchase_price", purchase_price);
    formData.append("retails_price", retails_price);
    formData.append("wholesale_price", wholesale_price);

    if (imageFile) {
        formData.append("image", imageFile);
    }

    formData.append("unit_codes", JSON.stringify(unitCodes));

    // UI Loading state
    const saveBtn = document.getElementById("saveMobileItemBtn");
    const saveBtnText = document.getElementById("save-btn-text");
    const loadingSpinner = document.getElementById("loading-spinner");
    
    saveBtn.disabled = true;
    saveBtnText.classList.add("hidden");
    loadingSpinner.classList.remove("hidden");

    fetch('/save-other-item-and-serial-numbers', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification(data.message || "Item saved successfully!", 'green');
            localStorage.clear();
            
            // Reset form
            document.getElementById("item_name").value = '';
            document.getElementById("brand").value = '';
            document.getElementById("category").value = '';
            document.getElementById("type").value = '';
            document.querySelector('input[name="purchase_price"]').value = '';
            document.querySelector('input[name="retails_price"]').value = '';
            document.querySelector('input[name="wholesale_price"]').value = '';
            document.getElementById("dropzone-file").value = '';

            // Reload after delay
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        } else {
            showNotification(data.message || 'Error saving item', 'red');
        }
    })
    .catch(error => {
        console.error("Error:", error);
        const message = error.message || 'An error occurred. Please try again.';
        showNotification(message, 'red');
    })
    .finally(() => {
        saveBtn.disabled = false;
        saveBtnText.classList.remove("hidden");
        loadingSpinner.classList.add("hidden");
        isSubmitting = false;
    });
});

function showNotification(message, color) {
    // Implement your notification system here
    console.log(`[${color}] ${message}`);
    // Example: Toast notification or alert
}

// Function to Show Custom Notification (Centered, AOS Fade Animation)
function showNotification(message, color) {
    const notification = document.getElementById("notification");
    const notificationMessage = document.getElementById("notification-message");

    notificationMessage.innerText = message;
    notification.classList.remove("hidden");
    notification.classList.remove("bg-green-500", "bg-red-500"); 
    notification.classList.add(`bg-${color}-500`);

    // Re-trigger AOS animation
    notification.setAttribute("data-aos", "fade-down");
    AOS.refresh();

    // Auto-hide after 3 seconds
    setTimeout(() => {
        notification.classList.add("hidden");
    }, 3000);
}
</script>