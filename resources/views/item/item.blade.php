@include('layouts.header')

<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Header -->


    <div class="px-4 py-4 bg-white shadow-sm sm:px-6 sm:py-6">
        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
            <!-- Title and subtitle -->
            <div>
                <h1 class="text-2xl font-light text-gray-800 sm:text-3xl">Items Management</h1>
                <p class="text-sm text-gray-500 sm:text-base">Manage your inventory and product categories</p>
            </div>

            <!-- Date display -->
            <div class="text-left sm:text-right">
                <p class="text-xs text-gray-500 sm:text-sm">Current Date</p>
                <p class="text-sm font-medium sm:text-base">{{ now()->format('F j, Y') }}</p>
            </div>
        </div>
    </div>


    <!-- Breadcrumbs -->
    <div class="px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2">Items</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="mt-2"><center>@include('_message')</center></div>
    </div>

    <!-- Action Cards Grid -->
    <div class="grid grid-cols-1 gap-6 p-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @if (has_permission(49))
        <a href="{{ asset('item/add_item')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-blue-50 group-hover:bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Add New Item</h3>
                    <p class="mt-1 text-sm text-gray-300">Create a new product entry</p>
                </div>
            </div>
        </a>
        @endif

        @if (has_permission(50))
        <a href="{{ asset('item/add_category')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-green-50 group-hover:bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Add New Category</h3>
                    <p class="mt-1 text-sm text-gray-300">Create product categories</p>
                </div>
            </div>
        </a>
        @endif

        @if (has_permission(51))
        <a href="{{ asset('item/item_list')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-purple-50 group-hover:bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Items List</h3>
                    <p class="mt-1 text-sm text-gray-300">View and manage all products</p>
                </div>
            </div>
        </a>
        @endif

        @if (has_permission(52))
        <a href="{{ asset('item/category_list')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-amber-50 group-hover:bg-amber-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Category List</h3>
                    <p class="mt-1 text-sm text-gray-300">View and manage categories</p>
                </div>
            </div>
        </a>
        @endif



        <a href="{{ asset('item/genarateCode')}}" class="group">
            <div class=" h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-red-50 group-hover:bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Generate QR/Barcode</h3>
                    <p class="mt-1 text-sm text-gray-300">Create product identifiers</p>
                </div>
            </div>
        </a>
    </div>
</div>


@include('layouts.footer')

<script>
    function locatePanelItem(panelItem) {
        window.location.href = "../../main-panel/items/" + panelItem;
    }
</script>