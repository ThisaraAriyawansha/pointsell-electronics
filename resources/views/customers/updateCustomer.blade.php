@include('layouts.header')
<div class="flex flex-col flex-grow">
    <!-- breadcrumbs -->
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Update Customer</p>
                        </div>
                    </li>
                </ol>
            </nav>
    </div>
    
    <!-- Main panel -->
    <div class="p-6">
        <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
            <form action="{{ route('updateCustomer', $customer->id) }}" method="POST">
                @csrf
                @method('POST')
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
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>

                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>

                @endif

                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div class="md:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-black">Customer Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $customer->customer_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            placeholder="Enter customer name" required>
                    </div>
                    <div class="hidden">
                        <label for="id" class="block mb-2 text-sm font-medium text-black">Customer ID</label>
                        <input id="id" name="id" type="text" value="{{ $customer->customer_id }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            placeholder="Enter id number" required readonly>
                    </div>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="Mobile_Number" class="block mb-2 text-sm font-medium text-black">Mobile Number</label>
                        <input id="Mobile_Number" name="Mobile_Number" type="text" value="{{ old('Mobile_Number', $customer->contact_number) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter mobile number" required>
                    </div>
                    <div class="hidden md:col-span-2">
                        <label for="city" class="block mb-2 text-sm font-medium text-black">City</label>
                        <select id="city" name="city"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select city</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $customer->cities_id ? 'selected' : '' }}>{{ $city->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-black">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $customer->email) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter customer email" >
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="addl1" class="block mb-2 text-sm font-medium text-black">Address Line 1</label>
                        <input id="addl1" name="addl1" type="text" value="{{ old('addl1', $customer->address_line_1) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter address line 1" required>
                    </div>
                    <div>
                        <label for="addl2" class="block mb-2 text-sm font-medium text-black">City Name</label>
                        <input id="city_name" name="city_name" type="text" value="{{ old('city_name', $customer->city_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter City Name">
                    </div>
                </div>

                <div class="grid hidden gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="due" class="block mb-2 text-sm font-medium text-black">Due Amount</label>
                        <input id="due" name="due" type="text" value="{{ old('due', $customer->due_amount) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter due amount">
                    </div>
                </div>

                <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                    <button type="submit"
                        class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Update</button>
                    <button type="button" class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="resetForm()">Reset</button>
                    <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="window.location.href='/customers/customerList'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.footer')

</div>

<script>
    function resetForm() {
        // Reset all input fields
        document.getElementById('name').value = '';
        document.getElementById('Mobile_Number').value = '';
        document.getElementById('email').value = '';
        document.getElementById('addl1').value = '';
        document.getElementById('addl2').value = '';
        document.getElementById('due').value = '';
        document.getElementById('city').selectedIndex = 0; // Reset city dropdown
        $('#city').trigger('change'); // Reset Select2 (if used)
    }

   // Function to close message manually
   function closeMessage(messageId) {
    document.getElementById(messageId).style.display = 'none';
}

// Auto hide success or error message after 4 seconds
window.onload = function() {
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        var errorMessage = document.getElementById('errorMessage');
        
        if(successMessage) {
            successMessage.style.display = 'none';
        }
        if(errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 4000);  // Messages will hide after 4 seconds
};


window.onload = function() {
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        var errorMessage = document.getElementById('errorMessage');
        
        if(successMessage) {
            console.log('Success Message found');  // Debug log
            successMessage.style.display = 'none';
        }
        if(errorMessage) {
            console.log('Error Message found');  // Debug log
            errorMessage.style.display = 'none';
        }
    }, 4000);  // Messages will hide after 4 seconds
};




</script>


<script>
    // Auto-hide alert messages after 4 seconds
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.relative[role="alert"]');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 4000); // 4000 milliseconds = 4 seconds
    });

</script>
</body>
</html>