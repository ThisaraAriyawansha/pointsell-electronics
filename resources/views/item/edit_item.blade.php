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
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Update Items</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <form method="POST" action="" enctype="multipart/form-data">
    <div><center>@include('_message')</center></div>
        @csrf
        <div class="flex-grow p-6">
            <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="item_name" class="block mb-2 text-sm font-medium text-black ">Item name</label>
                        <input type="text" id="item_name" name="item_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Your Item name" value="{{ $item->item_name }}" required />
                    </div>

                    
                    <div>
                        <label for="supplier" class="block mb-2 text-sm font-medium text-black ">Supplier</label>
                        <select id="supplier" name="suppliers_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Your supplier name" value="" required>
                            <option >Your supplier name</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ $supplier->id == $item->suppliers_id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-black ">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter Qty" value="{{ $item->quantity }}" required />
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-black">Purchase Price</label>
                        <input type="number" id="price" name="purchase_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter price" value="{{ $item->purchase_price }}" step="0.01" required />
                    </div>
                    <div>
                        <label for="retail_price" class="block mb-2 text-sm font-medium text-black">Retail Price</label>
                        <input type="number" id="retail_price" name="retail_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter retail price" value="{{ $item->retail_price }}" step="0.01" required />
                    </div>
                    <div>
                        <label for="minimum_qty" class="block mb-2 text-sm font-medium text-black ">Minimum
                            Quantity</label>
                        <input type="number" id="minimum_qty" name="minimum_qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter Minimum Qty" value="{{ $item->minimum_qty }}" step="0.01" required/>
                    </div>
                    <div>
                        <label for="wholesale_price" class="block mb-2 text-sm font-medium text-black">Wholesale Price</label>
                        <input type="number" id="wholesale_price" name="wholesale_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter wholesale price" value="{{ $item->wholesale_price }}" step="0.01" required />
                    </div>

                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-black ">Category</label>
                        <select id="category_id" name="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Your category name" value="" >
                            <option value="">Your category name</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $item->item_category_id ? 'selected' : '' }}>
                                    {{ $category->categories }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div>
                        <label for="product_image" class="block mb-2 text-sm font-medium text-black">Item</label>
                        @if(!empty($item->getImageUrlAttribute()))
                            <img src="{{ $item->getImageUrlAttribute() }}" style="width: 100px; height: 70px; object-fit: cover;">
                        @else
                            <span>No image available</span>
                        @endif
                    </div>


                </div>
                <div class="flex flex-col items-center justify-center w-full">
                    <!-- Label for the file input -->
                    <label for="wholesale_price" class="block mb-2 text-sm font-medium text-black ">Add image <span
                            style="color: red;"></span></label>

                    <!-- File input -->
                    <input type="file" class="mb-2 form-control" name="image_path" id="imageInput">

                    <!-- Display image name -->
                    <div id="imageName" class="mb-2 text-sm text-gray-500"></div>

                    <!-- Image preview box -->
                    <div id="imagePreview"
                        style="display:none; border: 1px solid #ccc; width: 200px; height: 200px; overflow: hidden; margin-top: 10px; margin-bottom: 10px;">
                        <img id="previewImage" src="" alt="Image Preview"
                            style="width: 100%; height: 100%; object-fit: cover;">
                        @if(!empty($item->getImageUrlAttribute()))
                            <img id="previewImage" src="" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{$item->getImageUrlAttribute()}}" style ="width: 100px; height:100px">
                        @endif
                    </div>

                    <!-- Error message for image -->
                    <div style="color:red">{{ $errors->first('image_path') }}</div>
                    <p id="image_path_error" class="mt-1 text-sm text-red-500"></p>
                </div><br><br><br><br>
                <div class="flex items-center justify-center w-full gap-4 p-4">
                    <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Update</button>
                    <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                    onclick="window.location.href='/item/item_list'">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    @include('layouts.footer')

</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script>
    const fileInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const imageName = document.getElementById('imageName');

    // Event listener for file input change
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            // Display image name
            imageName.textContent = file.name;

            // Create a FileReader to read the image file
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the src of the preview image
                previewImage.src = e.target.result;

                // Show the image preview box
                imagePreview.style.display = 'block';
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        } else {
            // Hide the preview box if no file is selected
            imagePreview.style.display = 'none';
            imageName.textContent = ''; // Clear the image name
        }
    });
</script>