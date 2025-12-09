@include('layouts.header')
<div class="flex flex-col flex-grow">
    <!-- Breadcrumbs -->
    <div class="px-12 py-5 max-sm:px-6">
    <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ asset('/dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 1 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Main Panel
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ asset('/settings/settings')}}" class="text-sm font-medium text-gray-500 hover:text-blue-600 ms-1 md:ms-2">Settings</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="text-sm font-medium text-blue-600 ms-1 md:ms-2">Site Settings</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

    <div class="p-6">
        <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                        <div class="mb-8">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Select Setting to Update</h2>
                <p class="text-sm text-gray-500">Choose from the dropdown below to modify different site settings</p>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div class="md:col-span-2">
                    <label for="key" class="block mb-2 text-sm font-medium text-black">KEY</label>
                    <select id="key" name="key"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0">Select Setting</option>
                        @foreach ($sitevalue as $value)
                            <option value="{{ $value->id }}" data-value="{{ $value->value }}" data-key="{{ $value->id }}">{{ $value->key }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
            <!-- Value Input Field -->
            <div id="value-input">
                <label for="value" class="block mb-2 text-sm font-medium text-black">Value</label>
                <input id="value" name="value" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Value" required>
            </div>

            <!-- Image Upload Field -->
            <div id="image-upload" style="display:none;">
                <label for="image" class="block mb-2 text-sm font-medium text-black">Upload Image</label>
                <input type="file" id="image_login" name="image_login" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <img id="image-preview" src="" alt="Image Preview" style="display:none; width: 100px; height: 100px; object-fit: cover;">
            </div>

            <!-- Color Picker -->
            <div id="color-picker" style="display:none;">
                <label for="color" class="block mb-2 text-sm font-medium text-black">Select Color</label>
                <input type="color" id="color" name="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>


        <div class="flex items-center justify-end w-full gap-4 pt-6 mt-6 border-t border-gray-200 max-sm:flex-col max-sm:items-stretch">
                    <button type="button" id="reset-system-btn" 
                        class="px-6 py-2.5 text-white bg-gray-800 rounded-lg hover:bg-gray-900 transition-colors max-sm:w-full flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        <span>Reset System</span>
                    </button>
                    
                    <button type="button" class="px-6 py-2.5 text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors max-sm:w-full flex items-center justify-center space-x-2" 
                        onclick="window.location.href='/settings/settings'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Cancel</span>
                    </button>
                    
                    <button type="button" id="update-btn" class="px-6 py-2.5 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors max-sm:w-full flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                        <span>Update Setting</span>
                    </button>
                </div>
            </div>
        </div>

        </div>
    </div>

    @include('layouts.footer')

</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const keySelect = document.getElementById('key');
    const valueInput = document.getElementById('value-input');
    const imageUpload = document.getElementById('image-upload');
    const colorPicker = document.getElementById('color-picker');
    const valueField = document.getElementById('value');
    const imagePreview = document.getElementById('image-preview');
    const imageInput = document.getElementById('image_login'); // Corrected ID for the image input
    const colorInput = document.getElementById('color');

    // Function to reset visibility of input sections
    function resetFields() {
        valueInput.style.display = 'none';
        imageUpload.style.display = 'none';
        colorPicker.style.display = 'none';
        imagePreview.style.display = 'none';
        valueField.value = ''; // Reset value field
    }

    // Listen for changes in the select dropdown
    keySelect.addEventListener('change', function () {
        const selectedKey = this.options[this.selectedIndex].getAttribute('data-key');
        const selectedValue = this.options[this.selectedIndex].getAttribute('data-value');

        console.log('Selected Key:', selectedKey);
        console.log('Selected Value:', selectedValue);

        // Reset all fields initially
        resetFields();

        if (selectedKey === '1') {
            // Show image upload field for specific keys
            imageUpload.style.display = 'block';
            if (selectedValue) {
                imagePreview.src = `/${selectedValue}`;
                imagePreview.style.display = 'block';
            }
        } else if (selectedKey === '13') {
            // Show image upload for icons
            imageUpload.style.display = 'block';
            if (selectedValue) {
                imagePreview.src = `/${selectedValue}`;
                imagePreview.style.display = 'block';
            }
        } else if (['2', '3', '4', '5', '7', '8', '14' , '15', '16'].includes(selectedKey)) {
            // Show color picker for specific keys
            colorPicker.style.display = 'block';
            if (selectedValue) {
                colorInput.value = selectedValue;
            }
        } else {
            // Default case: Show value input
            valueInput.style.display = 'block';
            valueField.value = selectedValue || '';
        }
    });

    // Update value field when a color is picked
    colorInput.addEventListener('input', function () {
        valueField.value = this.value;
    });

    // Update value field when an image is selected
    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                valueField.value = imageInput.files[0].name; // Use file name for the value field
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});

// Update button event listener
document.addEventListener('DOMContentLoaded', function () {
    const updateButton = document.getElementById('update-btn');
    const keySelect = document.getElementById('key');
    const valueField = document.getElementById('value');
    const imageInput = document.getElementById('image_login'); // Corrected ID for the image input

    updateButton.addEventListener('click', function () {
        const selectedKey = keySelect.value;
        const value = valueField.value;

        if (!selectedKey || selectedKey === '0') {
            alert('Please select a valid key.');
            return;
        }

        const formData = new FormData();
        formData.append('id', selectedKey);
        formData.append('value', value);

        // Check if an image file is selected and append it
        if (imageInput.files.length > 0) {
            formData.append('image_login', imageInput.files[0]);
        }

        // Send the form data via AJAX
        fetch(`/settings/update`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Value updated successfully!');
                location.reload();
            } else {
                alert('Failed to update value.');
            }
        })
        .catch(error => {
            console.error('Error updating value:', error);
        });
    });
});


</script>


<script>
    document.getElementById('reset-system-btn').addEventListener('click', function () {
        fetch('{{ route('reset.system') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show success message
            location.reload(); // Refresh the page
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while clearing the cache.');
        });
    });
</script>
