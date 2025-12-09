<!-- File: resources/views/suppliers/addSupplier.blade.php -->
@include('layouts.header')
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
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Suppliers</p>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Add New Supplier</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="flex flex-col flex-grow">
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

        <!-- Form Section -->
        <div class="p-6">
            <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div class="md:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-black">Supplier Name</label>
                            <input id="name" name="supplier_name" type="text"
                                   class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('supplier_name') border-red-500 @enderror"
                                   placeholder="Enter supplier name" value="{{ old('supplier_name') }}" >
                            @error('supplier_name') 
                                <span class="text-xs text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div>
                            <label for="Contact_Number" class="block mb-2 text-sm font-medium text-black">Mobile Number</label>
                            <input id="Contact_Number" name="contact_number" type="text"
                                   class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('contact_number') border-red-500 @enderror"
                                   placeholder="Enter mobile number" value="{{ old('contact_number') }}" >
                            @error('contact_number') 
                                <span class="text-xs text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-black">Email Address</label>
                            <input id="email" name="email" type="email" 
                                   class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-500 @enderror"
                                   placeholder="Enter email address" value="{{ old('email') }}">
                            @error('email') 
                                <span class="text-xs text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                            <input id="address" name="address"  type="text"
                                   class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('address') border-red-500 @enderror"
                                   placeholder="Enter address" value="{{ old('address') }}" >
                            @error('address') 
                                <span class="text-xs text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="hidden">
                            <label for="city" class="block mb-2 text-sm font-medium text-black">City</label>
                            <select id="city_id" name="city_id"
                                class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('city_id') border-red-500 @enderror">
                                <option value="">Select city</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name_en }}</option>
                                @endforeach
                            </select>
                            @error('city_id') 
                                <span class="text-xs text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div>
                        <label for="addl2" class="block mb-2 text-sm font-medium text-black">City Name</label>
                        <input id="city_name" name="city_name" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter City Name">
                    </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                        <button type="submit" class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Add</button>
                        <button type="reset" class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Reset</button>
                        <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="window.location.href='/suppliers/suppliers'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Function to automatically hide messages
    function autoHideMessages() {
        // Select success and error message elements
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        // Hide success message after 4 seconds
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('transition', 'duration-500', 'ease-out', 'opacity-0');
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 500);
            }, 4000);
        }

        // Hide error message after 4 seconds
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('transition', 'duration-500', 'ease-out', 'opacity-0');
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 500);
            }, 4000);
        }
    }

    // Call the auto-hide function when the page loads
    autoHideMessages();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
</body>
</html>