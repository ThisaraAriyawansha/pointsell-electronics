@include('layouts.header')
<div class="flex flex-col h-5/6">
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Items</p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Add Items</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="flex-grow p-6">

        <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
            <form id="addItemForm" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Success Message -->
                    <div id="successMessage" class="fixed hidden w-full max-w-xs p-4 font-bold text-center text-green-800 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 rounded-lg shadow-lg top-1/2 left-1/2">
                        Item successfully added!
                    </div>

                        <!-- Success Message -->
                    <div id="successMessage"
                        class="fixed hidden w-full max-w-xs p-4 font-bold text-center text-green-800 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 rounded-lg shadow-lg top-1/2 left-1/2">
                        Item successfully added!
                    </div>


                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="item_name" class="block mb-2 text-sm font-medium text-black ">Item name</label>
                        <input type="text" id="item_name" name="item_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Your Item name" />
                        <p id="item_name_error" class="mt-1 text-sm text-red-500"></p>
                    </div>
                    
                    <div >
                            <label for="expense-search" class="block mb-2 text-sm font-medium text-black ">Supplier</label>
                            <!--custom combobox-->
                            <div class="w-full custom-select">
                                <select id="supplier" name="suppliers_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden">
                                    <option value="">Your supplier name</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <p id="supplier_error" class="mt-1 text-sm text-red-500"></p>
                            </div>

                    </div>
                    
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-black ">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter Qty" />
                        <p id="quantity_error" class="mt-1 text-sm text-red-500"></p>
                    </div>
                    <div>
                        <label for="minimum_qty" class="block mb-2 text-sm font-medium text-black ">Minimum
                            Quantity</label>
                        <input type="number" id="minimum_qty" name="minimum_qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter Minimum Qty" />
                        <p id="minimum_qty_error" class="mt-1 text-sm text-red-500"></p>
                    </div>
                    <div>
                    <label for="purchase_price" class="block mb-2 text-sm font-medium text-black">Purchase Price</label>
                    <input type="text" id="purchase_price" name="purchase_price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter price" pattern="^\d+(\.\d{1,2})?$" title="Enter a valid price, e.g., 0.50 or 10.99" />
                    <p id="purchase_price_error" class="mt-1 text-sm text-red-500"></p>
                </div>
                <div>
                    <label for="retail_price" class="block mb-2 text-sm font-medium text-black">Retail Price</label>
                    <input type="text" id="retail_price" name="retail_price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter retail price" pattern="^\d+(\.\d{1,2})?$" title="Enter a valid price, e.g., 0.50 or 10.99" />
                    <p id="retail_price_error" class="mt-1 text-sm text-red-500"></p>
                </div>
                <div>
                    <label for="wholesale_price" class="block mb-2 text-sm font-medium text-black">Wholesale Price</label>
                    <input type="text" id="wholesale_price" name="wholesale_price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter wholesale price" pattern="^\d+(\.\d{1,2})?$" title="Enter a valid price, e.g., 0.50 or 10.99" />
                    <p id="wholesale_price_error" class="mt-1 text-sm text-red-500"></p>
                </div>

                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-black">Category</label>
                    <select id="category_id" name="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected value="-1">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->categories }}</option>
                        @endforeach
                    </select>
                    <p id="category_error" class="mt-1 text-sm text-red-500"></p>
                </div>

                </div>
                <div class="flex flex-col items-center justify-center w-full">
                    <!-- Label for the file input -->
                    <label for="wholesale_price" class="block mb-2 text-sm font-medium text-black ">Add image <span style="color: red;"></span></label>

                    <!-- File input -->
                    <input type="file" class="mb-2 form-control" name="image_path" id="imageInput">

                    <!-- Display image name -->
                    <div id="imageName" class="mb-2 text-sm text-gray-500"></div>

                    <!-- Image preview box -->
                    <div id="imagePreview" style="display:none; border: 1px solid #ccc; width: 200px; height: 200px; overflow: hidden; margin-top: 10px; margin-bottom: 10px;">
                        <img id="previewImage" src="" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Error message for image -->
                    <div style="color:red">{{ $errors->first('image_path') }}</div>
                    <p id="image_path_error" class="mt-1 text-sm text-red-500"></p>
                </div><br><br><br><br>
                <div class="flex items-center justify-center w-full gap-4 p-4">
                    <button type="submit" id="saveButton"
                        class="px-6 py-3 text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-blue-900 disabled:bg-gray-400">
                        Save
                    </button>
                    <button type="reset" class="px-6 py-3 text-white bg-black rounded-lg">Reset</button>
                </div>


            </form>
        </div>
    </div>
    @include('layouts.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

<script>
   document.getElementById('addItemForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);
    const saveButton = document.getElementById('saveButton');
    const successMessage = document.getElementById('successMessage');
    const textFields = document.querySelectorAll('input[type="text"], input[type="number"], textarea'); // Select all text and number fields

    // Disable Save button and indicate saving
    saveButton.disabled = true;
    saveButton.textContent = 'Saving...';

    fetch('{{ route('add_itam') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 422) {
                    return response.json().then(data => { throw data; });
                }
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data); // Handle successful response

            // Reset form fields after successful submission
            textFields.forEach(field => field.value = '');
            document.getElementById('imagePreview').style.display = 'none'; // Hide image preview
            document.getElementById('imageName').textContent = ''; // Clear image name

            // Show success message
            successMessage.textContent = 'Item successfully added!';
            successMessage.style.display = 'block';

            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);

            // Reset Save button
            saveButton.disabled = false;
            saveButton.textContent = 'Save';

            // Reload the page to reflect changes (optional)
            // location.reload();
        })
        .catch(error => {
            // Reset Save button
            saveButton.disabled = false;
            saveButton.textContent = 'Save';

            if (error.errors) {
                // Map each error to its corresponding field
                const errorFields = {
                    item_name: "item_name_error",
                    quantity: "quantity_error",
                    minimum_qty: "minimum_qty_error",
                    purchase_price: "purchase_price_error",
                    retail_price: "retail_price_error",
                    suppliers_id: "supplier_error",
                    wholesale_price: "wholesale_price_error",
                    image_path: "image_path_error"
                };

                // Display validation errors
                Object.keys(errorFields).forEach(field => {
                    const errorElement = document.getElementById(errorFields[field]);
                    errorElement.textContent = error.errors[field] ? error.errors[field][0] : '';
                });
            } else {
                console.error('Error:', error); // Handle non-validation errors
            }
        });
});

// Image file preview functionality
const fileInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const previewImage = document.getElementById('previewImage');
const imageName = document.getElementById('imageName');

fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        imageName.textContent = file.name; // Display image name

        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result; // Update preview image source
            imagePreview.style.display = 'block'; // Show image preview box
        };

        reader.readAsDataURL(file); // Read file as data URL
    } else {
        imagePreview.style.display = 'none'; // Hide preview box
        imageName.textContent = ''; // Clear image name
    }
});



</script>