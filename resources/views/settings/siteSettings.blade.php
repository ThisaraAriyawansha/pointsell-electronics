@include('layouts.header')

<div class="flex flex-col flex-grow bg-gray-50">
    <!-- Breadcrumbs -->
    <div class="px-8 py-4 bg-white border-b shadow-sm">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                        <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ asset('/settings/settings')}}" class="text-sm font-medium text-gray-500 hover:text-blue-600 ms-1 md:ms-2">Settings</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-sm font-medium text-blue-600 ms-1 md:ms-2">Site Settings</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <div class="mt-2">
            <h1 class="text-2xl font-bold text-gray-800">Site Configuration</h1>
            <p class="text-sm text-gray-500">Manage your website's basic settings and appearance</p>
        </div>
    </div>

    <!-- Main Content -->
    <form method="POST" action="{{ isset($sitevalue) ? route('settings.update', $sitevalue->id) : route('settings.store') }}" enctype="multipart/form-data" class="flex-1 p-6">
        @csrf
        @if(isset($sitevalue))
            @method('PUT')
        @endif

        <!-- Alerts Section -->
        <div class="mb-6 space-y-3">
            @if ($errors->any())
            <div class="p-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-medium">There were issues with your submission</h3>
                </div>
                <ul class="mt-2 ml-5 list-disc">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="p-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="p-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
            @endif
        </div>

        <!-- Settings Form -->
        <div class="bg-white border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-sm">
            <!-- Site Information Section -->
            <div class="p-6">
                <h2 class="mb-4 text-lg font-medium text-gray-900">Site Information</h2>
                
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="site_name" class="block mb-2 text-sm font-medium text-gray-700">Site Name</label>
                        <input type="text" id="site_name" name="site_name" value="{{ $sitevalue->site_name ?? '' }}" 
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Your website name" required>
                    </div>
                    
                    <div>
                        <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" value="{{ $sitevalue->contact_number ?? '' }}"
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="+1 (123) 456-7890" required>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Labels Section -->
            <div class="p-6">
                <h2 class="mb-4 text-lg font-medium text-gray-900">Navigation Labels</h2>
                
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="sidebar_one_name" class="block mb-2 text-sm font-medium text-gray-700">First Sidebar Label</label>
                        <input type="text" id="sidebar_one_name" name="sidebar_one_name" value="{{ $sitevalue->sidebar_one_name ?? '' }}"
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Primary navigation" required>
                    </div>
                    
                    <div>
                        <label for="sidebar_two_name" class="block mb-2 text-sm font-medium text-gray-700">Second Sidebar Label</label>
                        <input type="text" id="sidebar_two_name" name="sidebar_two_name" value="{{ $sitevalue->sidebar_two_name ?? '' }}"
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Secondary navigation" required>
                    </div>
                </div>
            </div>
            
            <!-- Logo Upload Section -->
            <div class="p-6">
                <h2 class="mb-4 text-lg font-medium text-gray-900">Branding</h2>
                
                <div>
                    <label for="company_logo" class="block mb-2 text-sm font-medium text-gray-700">Company Logo</label>
                    
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            @if(isset($sitevalue) && $sitevalue->company_logo)
                                <img id="logo_preview" src="{{ asset($sitevalue->company_logo) }}" 
                                    class="object-contain w-20 h-20 border border-gray-200 rounded-lg" alt="Current Logo">
                            @else
                                <div class="flex items-center justify-center w-20 h-20 bg-gray-100 border border-gray-200 rounded-lg">
                                    <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <label class="block">
                            <span class="sr-only">Choose logo</span>
                            <input type="file" name="company_logo" id="company_logo" accept="image/*" onchange="previewLogo(event)"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </label>
                    </div>
                    
                    <p class="mt-2 text-xs text-gray-500">
                        Upload your company logo in PNG, JPG or GIF format (Max 2MB)
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 mt-6 max-sm:flex-col max-sm:items-stretch">
            <button type="button" id="reset-system-btn" 
                class="flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                </svg>
                Reset System
            </button>
            
            <button type="button" onclick="window.location.href='/settings/settings'"
                class="flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Cancel
            </button>
            
            <button type="submit"
                class="flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save Changes
            </button>
        </div>
    </form>

    @include('layouts.footer')
</div>

<script>
function previewLogo(event) {
    const logoPreview = document.getElementById('logo_preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Create new image element if preview doesn't exist
            if (!logoPreview) {
                const previewContainer = event.target.parentElement.parentElement.querySelector('.shrink-0');
                const newImg = document.createElement('img');
                newImg.id = 'logo_preview';
                newImg.className = 'w-20 h-20 object-contain rounded-lg border border-gray-200';
                previewContainer.innerHTML = '';
                previewContainer.appendChild(newImg);
                logoPreview = newImg;
            }
            
            logoPreview.src = e.target.result;
            logoPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

// Auto-hide alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);
});

// Reset System button with confirmation
document.getElementById('reset-system-btn').addEventListener('click', function () {
    if (confirm('Are you sure you want to reset the system? This will clear all caches.')) {
        const button = this;
        button.disabled = true;
        button.innerHTML = `
            <svg class="w-5 h-5 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Resetting...
        `;
        
        fetch('{{ route('reset.system') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            button.disabled = false;
            button.innerHTML = `
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                </svg>
                Reset System
            `;
            alert('An error occurred while resetting the system.');
        });
    }
});
</script>