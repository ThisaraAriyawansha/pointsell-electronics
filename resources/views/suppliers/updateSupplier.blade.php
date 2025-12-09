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
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Update Supplier</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!--main panel-->
    <div class="p-6">
        <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
            @csrf
            @method('POST')
           
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
    @csrf
    @method('PUT')

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
            <label for="name" class="block mb-2 text-sm font-medium text-black">Supplier Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $supplier->supplier_name) }}"
                class="bg-gray-50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter supplier name" >
            @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="m_no" class="block mb-2 text-sm font-medium text-black">Mobile Number</label>
            <input id="m_no" name="mobile_number" type="text" value="{{ old('mobile_number', $supplier->contact_number) }}"
                class="bg-gray-50 border {{ $errors->has('mobile_number') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter mobile number" >
            @error('mobile_number')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 mb-6">
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-black">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $supplier->email) }}"
                class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter email address" >
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="addl1" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
            <input id="addl1" name="address" type="text" value="{{ old('address', $supplier->address) }}"
                class="bg-gray-50 border {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter address" >
            @error('address')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
                     <div>
                        <label for="addl2" class="block mb-2 text-sm font-medium text-black">City Name</label>
                        <input id="city_name" name="city_name" type="text" value="{{ old('city_name', $supplier->city_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter City Name">
                    </div>
        
        <div class="hidden">
            <label for="city" class="block mb-2 text-sm font-medium text-black">City</label>
            <div class="w-full custom-select">
                <select id="city" name="city" class="bg-gray-50 border {{ $errors->has('city') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="1">Select city</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" 
                            {{ (old('city', $supplier->city_id) == $city->id) ? 'selected' : '' }}>
                            {{ $city->name_en }}
                        </option>
                    @endforeach
                </select>
                @error('city')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
        <button type="submit" class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">
            Update
        </button>
        <button type="button" class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
        onclick="resetForm()">Reset</button>
        <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
        onclick="window.location.href='/suppliers/supplierList'">Cancel</button>
    </div>
</form>
            
        </div>
    </div>

    <div class="flex-grow"></div>
    @include('layouts.footer')

</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

<script>
    // Auto-hide alert messages after 4 seconds
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.relative[role="alert"]');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 4000); // 4000 milliseconds = 4 seconds
    });



    function resetForm() {
        // Reset all input fields
        document.getElementById('name').value = '';
        document.getElementById('m_no').value = '';
        document.getElementById('email').value = '';
        document.getElementById('addl1').value = '';
        document.getElementById('city').selectedIndex = 0; // Reset city dropdown
        // Reset Select2 (if applied)
        $('#city').trigger('change');
    }
</script>


</html>