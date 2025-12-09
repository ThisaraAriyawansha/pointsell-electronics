@include('layouts.header')
<div class="flex flex-col flex-grow min-h-screen bg-gray-50">
    <!-- Breadcrumbs -->
    <div class="px-8 py-4 max-sm:px-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 text-sm text-gray-600">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center hover:text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 1-1h2a1 1 0 1 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/customers/customers" class="hover:text-gray-900">Customers</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="font-medium text-gray-700">Add New Customer</span>
                    </div>
                </li>
            </ol>
        </nav>
        <h1 class="mt-2 text-2xl font-bold text-gray-800">Add New Customer</h1>
    </div>

    <!-- Main Form -->
    <div class="px-8 py-4 max-sm:px-4">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <form action="{{ route('customers.store') }}" method="POST" id="addCustomerForm">
                @csrf
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <!-- Customer Information -->
                    <div class="space-y-6">
                        <h2 class="pb-2 text-lg font-semibold text-gray-800 border-b">Customer Information</h2>
                        
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Customer Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                </div>
                                <input id="name" name="name" type="text" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Enter customer name">
                            </div>
                        </div>

                        <div>
                            <label for="Mobile_Number" class="block mb-2 text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                        <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                    </svg>
                                </div>
                                <input id="Mobile_Number" name="Mobile_Number" type="text" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Enter mobile number">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Enter customer email">
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="space-y-6">
                        <h2 class="pb-2 text-lg font-semibold text-gray-800 border-b">Address Information</h2>
                        
                        <div>
                            <label for="addl1" class="block mb-2 text-sm font-medium text-gray-700">Address Line 1 <span class="text-red-500">*</span></label>
                            <input id="addl1" name="addl1" type="text" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter address line 1">
                        </div>

                        <div>
                            <label for="city_name" class="block mb-2 text-sm font-medium text-gray-700">City Name</label>
                            <input id="city_name" name="city_name" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter city name">
                        </div>

                        <div class="hidden">
                            <label for="due" class="block mb-2 text-sm font-medium text-gray-700">Due Amount</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                                    </svg>
                                </div>
                                <input id="due" name="due" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Enter due amount">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                    <button type="button" onclick="window.location.href='/customers/customers'" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancel
                    </button>
                    <button type="button" onclick="resetForm()" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        Reset
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Add Customer
                    </button>
                </div>

                <!-- Success and Error Messages -->
                <div id="errorMessage" class="items-center justify-between hidden p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span id="errorText">An error occurred</span>
                    </div>
                    <button class="ml-2 text-red-500 hover:text-red-700" onclick="closeMessage('errorMessage')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <div id="successMessage" class="items-center justify-between hidden p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span id="successText">Operation Successful</span>
                    </div>
                    <button class="ml-2 text-green-500 hover:text-green-700" onclick="closeMessage('successMessage')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Submit the form using AJAX
    $('#addCustomerForm').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        // Hide any previous messages
        $('#errorMessage').addClass('hidden');
        $('#successMessage').addClass('hidden');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#successText').text(response.message);
                    $('#successMessage').removeClass('hidden');
                    
                    // Reset form after successful submission
                    form[0].reset();
                    
                    // Optionally redirect after delay
                    setTimeout(() => {
                        window.location.href = '/customers/customers';
                    }, 2000);
                }
            },
            error: function (xhr) {
                let errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred';
                $('#errorText').text(errorMsg);
                $('#errorMessage').removeClass('hidden');
            }
        });
    });

    // Reset form function
    function resetForm() {
        document.getElementById('addCustomerForm').reset();
    }

    // Close message function
    function closeMessage(id) {
        $('#' + id).addClass('hidden');
    }
</script>