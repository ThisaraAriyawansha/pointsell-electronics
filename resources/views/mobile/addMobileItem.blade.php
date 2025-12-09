@include('layouts.header')
<style>
/* Toast container in the center */
#toast-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center it */
    z-index: 9999; /* Ensure it stays on top */
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    pointer-events: none; /* Don't affect other UI elements */
}

/* Style for the toast message */
.toast {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #323232;
    color: #fff;
    padding: 12px 16px;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-size: 14px;
    animation: fadeIn 0.3s ease-in-out;
    pointer-events: all; /* Allow interaction with the toast */
}

/* Success and Error Toast Styles */
.toast.success {
    background-color: #4caf50; /* Green */
}

.toast.error {
    background-color: #f44336; /* Red */
}

/* Toast Fade In Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Toast Fade Out Animation */
@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-10px); }
}

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
                            <label for="quantity" class="block mb-2 text-sm font-medium text-black ">Model</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="model" name="model"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Model name</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('model');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-black">IMEI</label>
                            <div class="flex items-center gap-3">
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] w-1/3 text-white rounded-lg"
                                    onclick="showImeiModal();">Add IMEI</button>
                                <p id="imei-qty">Qty: 0</p>
                            </div>
                        </div>



                        <div>
                            <label for="desc" class="block mb-2 text-sm font-medium text-black ">Description</label>
                            <textarea id="desc"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter description" required></textarea>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="color" class="block mb-2 text-sm font-medium text-black">Select
                                Color</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="color" name="color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('color');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="storage" class="block mb-2 text-sm font-medium text-black">Select
                                Storage</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="storage" name="storage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Storage</option>
                                    @foreach($storages as $storage)
                                        <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('storage');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="ram" class="block mb-2 text-sm font-medium text-black">Select
                                RAM</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="ram" name="ram"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Ram</option>
                                    @foreach($rams as $ram)
                                        <option value="{{ $ram->id }}">{{ $ram->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('ram');">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <!--supplier data-->
                <div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="distributor" class="block mb-2 text-sm font-medium text-black">Select
                                Distributor</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="distributor" name="distributor"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Select Distributor</option>
                                    @foreach($distributors as $distributor)
                                        <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('distributor');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="dealer-search" class="block mb-2 text-sm font-medium text-black">Select
                                Dealer</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="dealer" name="dealer"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Select Dealer</option>
                                    @foreach($dealers as $dealer)
                                        <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('dealer');">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="agent-search" class="block mb-2 text-sm font-medium text-black">Select
                                Agent</label>
                            <!--custom combobox-->
                            <div class="flex w-full gap-3 custom-select">
                                <select id="agent" name="agent"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Select Agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                <button class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg"
                                    data-modal-target="modal-for-add-items" data-modal-toggle="modal-for-add-items"
                                    onclick="showModal('agent');">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Distributor Price</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Dealer Price</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Agent Price</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <!--other prices-->
                <div>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Tax (%)</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">MRP Price</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-black ">Purchase Price</label>
                            <div class="flex gap-3">
                                <input type="number" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Enter Price" required min="1" />
                            </div>
                        </div>
                    </div>
                </div>
                
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
        <div id="imei-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center hidden w-full h-full max-h-full overflow-x-hidden overflow-y-auto bg-gray-800 bg-opacity-50">
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <input type="hidden" id="imei-modal-type" value="">
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                        <h3 class="text-xl font-semibold text-gray-900" id="imei-modal-header">Add IMEI</h3>
                        <!-- Close Button -->
                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" onclick="closeImeiModal()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close IMEI List</span>
                        </button>
                    </div>

                    <div class="p-4 space-y-4 md:p-5">
                        <input type="text" id="imei-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter IMEI" required />
                        <div class="mt-4 overflow-y-auto max-h-60">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">IMEI</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="imei-table-body">
                                    <!-- Dynamic content inserted here by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" id="add-imei-btn" onclick="addImei()">Add IMEI</button>
                        <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="closeImeiModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast-container"></div>

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
            case "agent":
                document.getElementById("modal-header").innerText = "Add Agent";
                document.getElementById("modal-input").placeholder = "Agent Name";
                break;
            case "dealer":
                document.getElementById("modal-header").innerText = "Add Dealer";
                document.getElementById("modal-input").placeholder = "Dealer Name";
                break;
            case "distributor":
                document.getElementById("modal-header").innerText = "Add Distributor";
                document.getElementById("modal-input").placeholder = "Distributor Name";
                break;
            case "imei":
                document.getElementById("modal-header").innerText = "Add IMEI";
                document.getElementById("modal-input").placeholder = "IMEI";
                break;
            case "model":
                document.getElementById("modal-header").innerText = "Add Model";
                document.getElementById("modal-input").placeholder = "Model Name";
                break;
            case "brand":
                document.getElementById("modal-header").innerText = "Add Brand";
                document.getElementById("modal-input").placeholder = "Brand Name";
                break;
            case "color":
                document.getElementById("modal-header").innerText = "Add Color";
                document.getElementById("modal-input").placeholder = "Color";
                break;
            case "storage":
                document.getElementById("modal-header").innerText = "Add Storage Option";
                document.getElementById("modal-input").placeholder = "Storage";
                break;
            case "ram":
                document.getElementById("modal-header").innerText = "Add RAM Option";
                document.getElementById("modal-input").placeholder = "RAM";
                break;

            default:
                break;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<!--<script src="../../../scripts/common.js"></script>-->



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
        
        if (modalInput.trim() === '') {
            alert('Please enter a value');
            return;
        }
        
        // Send AJAX request to save the data
        saveToDB(modalType, modalInput);
    });
});

// Function to save data to the database and local storage
function saveToDB(type, value) {
    // Create form data
    const formData = new FormData();
    formData.append('type', type);
    formData.append('value', value);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    
    // Send AJAX request
    fetch('/save-item-data', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Read as text first
    .then(text => {
        try {
            const data = JSON.parse(text); // Try to parse the JSON
            if (data.success) {
                // Add the new option to the select element
                const select = document.getElementById(type);
                const option = document.createElement('option');
                option.value = data.id;
                option.text = value;
                select.appendChild(option);

                // Select the new option
                select.value = data.id;
                document.getElementById('modal-input').value = '';

                // Save to local storage
                saveToLocalStorage(type, data.id, value);

                location.reload(); // Refresh the page
            } else {
                alert('Error: ' + data.message);
            }
        } catch (e) {
            console.error('Invalid JSON response:', text);
            alert('An error occurred while saving the data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the data');
    });
}

// Function to save data to local storage
function saveToLocalStorage(type, id, value) {
    let storedData = JSON.parse(localStorage.getItem(type)) || [];
    storedData.push({ id, value });
    localStorage.setItem(type, JSON.stringify(storedData));
}




// Function to fetch existing items for the selected type
function fetchItems(type) {
    fetch(`/fetch-items/${type}`)
        .then(response => response.json())
        .then(data => {
            // Retrieve locally stored items for this type
            let storedData = JSON.parse(localStorage.getItem(type)) || [];
            
            // Filter items to only include those present in both local storage and database
            let filteredItems = data.items.filter(dbItem =>
                storedData.some(localItem => localItem.id == dbItem.id && localItem.value === dbItem.name)
            );

            // Update the table with filtered items
            const tbody = document.getElementById("modal-table-body");
            tbody.innerHTML = filteredItems.map(item => `
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">${item.name}</td>
                    <td class="px-6 py-4">
                        <button onclick="removeItem('${type}', ${item.id})" class="font-medium text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(error => console.error('Error fetching items:', error));
}


    function removeItem(type, id) {
    // Get CSRF token from the meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/remove-item/${type}/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token, // Send CSRF token
            'Content-Type': 'application/json' // Optional: Specify content type as JSON
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchItems(type); // Refresh the list
            location.reload(); // This will refresh the page
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
// Show Modal
function showImeiModal() {
    const modal = document.getElementById("imei-modal");
    modal.classList.remove("hidden");
    loadImeiList();  // Load the IMEI list into the modal
}

// Close the IMEI Modal (updated function)
function closeImeiModal() {
    const modal = document.getElementById("imei-modal");
    modal.classList.add("hidden");
}

// Add IMEI to Local Storage and Update UI
function addImei() {
    const imeiInput = document.getElementById("imei-input");
    const imei = imeiInput.value.trim();
    
    if (imei) {
        // Retrieve existing IMEIs from localStorage
        let imeis = JSON.parse(localStorage.getItem("imeis")) || [];
        
        // Add new IMEI to the list
        imeis.push({ imei: imei });
        
        // Save updated list back to localStorage
        localStorage.setItem("imeis", JSON.stringify(imeis));
        
        // Clear input and refresh the UI
        imeiInput.value = "";
        loadImeiList();
        updateImeiQty();
    }
}

// Delete IMEI from Local Storage and Update UI
function deleteImei(index) {
    let imeis = JSON.parse(localStorage.getItem("imeis")) || [];
    imeis.splice(index, 1);  // Remove IMEI at index
    localStorage.setItem("imeis", JSON.stringify(imeis));  // Update localStorage
    loadImeiList();
    updateImeiQty();
}

// Load IMEI list into the modal
function loadImeiList() {
    const imeis = JSON.parse(localStorage.getItem("imeis")) || [];
    const imeiListElement = document.getElementById("imei-table-body");
    
    imeiListElement.innerHTML = "";  // Clear current list
    
    imeis.forEach((imeiObj, index) => {
        const tr = document.createElement("tr");
        
        tr.innerHTML = `
            <td class="px-6 py-3">${imeiObj.imei}</td>
            <td class="px-6 py-3">
                <button class="text-red-500" onclick="deleteImei(${index})">Delete</button>
            </td>
        `;
        imeiListElement.appendChild(tr);
    });
}

// Update the quantity display outside the modal
function updateImeiQty() {
    const imeis = JSON.parse(localStorage.getItem("imeis")) || [];
    document.getElementById("imei-qty").innerText = `Qty: ${imeis.length}`;
}

// Initialize the IMEI list on page load
window.onload = function() {
    updateImeiQty();
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
document.getElementById('saveMobileItemBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    handleMobileItemSubmit(); // Call the unique function
});

function handleMobileItemSubmit() {
    // Disable the button and show the loading spinner
    const saveButton = document.getElementById('saveMobileItemBtn');
    const saveButtonText = document.getElementById('save-btn-text');
    const loadingSpinner = document.getElementById('loading-spinner');

    saveButton.disabled = true; // Disable the button
    saveButtonText.style.display = 'none'; // Hide the "Save" text
    loadingSpinner.style.display = 'inline-block'; // Show the spinner

    const formData = new FormData();
    formData.append('item_name', document.getElementById('item_name').value);
    formData.append('brand_id', document.getElementById('brand').value);
    formData.append('model_id', document.getElementById('model').value);
    formData.append('description', document.getElementById('desc').value);
    formData.append('color_id', document.getElementById('color').value);
    formData.append('storage_id', document.getElementById('storage').value);
    formData.append('ram_id', document.getElementById('ram').value);
    formData.append('distributor_id', document.getElementById('distributor').value);
    formData.append('dealer_id', document.getElementById('dealer').value);
    formData.append('agent_id', document.getElementById('agent').value);
    formData.append('distributor_price', document.querySelector('input[placeholder="Enter Price"]').value);
    formData.append('dealer_price', document.querySelectorAll('input[placeholder="Enter Price"]')[1].value);
    formData.append('agent_price', document.querySelectorAll('input[placeholder="Enter Price"]')[2].value);
    formData.append('tax', document.querySelectorAll('input[placeholder="Enter Price"]')[3].value);
    formData.append('mrp_price', document.querySelectorAll('input[placeholder="Enter Price"]')[4].value);
    formData.append('purchase_price', document.querySelectorAll('input[placeholder="Enter Price"]')[5].value);

    const imeis = JSON.parse(localStorage.getItem('imeis')) || [];
    imeis.forEach((imei, index) => {
        formData.append(`imeis[${index}][imei]`, imei.imei);
    });

    const imageFile = document.getElementById('dropzone-file').files[0];
    if (imageFile) {
        formData.append('imageFile', imageFile);
    }

    fetch('/save-mobile-item', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(data => {
        showToast('Item saved successfully!', 'success');
        localStorage.clear();

        // Clear input fields
        document.getElementById('item_name').value = '';
        document.getElementById('brand').value = '';
        document.getElementById('model').value = '';
        document.getElementById('desc').value = '';
        document.getElementById('color').value = '';
        document.getElementById('storage').value = '';
        document.getElementById('ram').value = '';
        document.getElementById('distributor').value = '';
        document.getElementById('dealer').value = '';
        document.getElementById('agent').value = '';
        document.getElementById('dropzone-file').value = '';
        document.querySelectorAll('input[placeholder="Enter Price"]').forEach(input => input.value = '');

        setTimeout(() => {
            window.location.reload();
        }, 1500);
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error: ' + (error.message || 'Unknown error occurred'), 'error');
    })
    .finally(() => {
        // Re-enable the button and hide the spinner after the request completes
        saveButton.disabled = false; // Re-enable the button
        saveButtonText.style.display = 'inline'; // Show the "Save" text
        loadingSpinner.style.display = 'none'; // Hide the spinner
    });
}


function showToast(message, type) {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerText = message;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'fadeOut 0.5s ease-in-out';
        setTimeout(() => toast.remove(), 500); // Remove toast after fade out
    }, 3000); // Toast will disappear after 3 seconds
}


</script>