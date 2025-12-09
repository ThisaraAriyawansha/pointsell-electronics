<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $settings[6]->value}} | Billing</title>
    <link rel="icon" href="../{{ $settings[13]->value}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../styles/common.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .clicked {
            background-color: green !important;
            color: white !important;
        }
         /* Loading overlay styles */
         .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        #custom-alert {
        display: none; /* Hidden by default */
        }
        #custom-alert.show {
            display: flex; /* Show the modal when the `show` class is added */
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #ccc;
            border-top-color: #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Styling for the fetched data */
        #data-container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        /* Tooltip container */
.add-to-storage {
    position: relative;
}

/* Tooltip text */
.tooltip {
    visibility: hidden;
    width: 120px;
    color: white;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 60%; /* Position the tooltip above the button */
    left: 50%;
    margin-left: -60px; /* Center the tooltip */
    opacity: 0;
    transition: opacity 0.3s;
    background-color: {{ $settings[7]->value}};
    border: 1px solid {{ $settings[7]->value}};
}

/* Tooltip arrow */
.tooltip::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: {{ $settings[7]->value}} transparent transparent transparent;
}

/* Show the tooltip on hover */
.add-to-storage:hover .tooltip {
    visibility: visible !important;
    opacity: 1 !important;
}
    </style>
</head>
<script>
    // Initialize an array to hold all rows' data
    let allData = [];
</script>
<body class="h-dvh max-lg:h-fit" onload="allPriceCalc();">
    <!--Nav-->
    <header class="sticky top-0 z-50 flex items-center justify-between w-full px-4 py-2 nav-gradient" style="background: {{ $settings[7]->value }};">
    <!-- Left Section - Controls -->
    <div class="flex items-center space-x-4">
        <!-- Fullscreen Toggle -->
        <button onclick="toggleFullScreen()" class="relative group">
            <div class="flex items-center justify-center w-10 h-10 transition-all bg-white rounded-full group-hover:rotate-1">
                <span id="fullscreen-icon" class="text-xl font-bold" style="color: {{ $settings[14]->value}};">
                    <i class="fas fa-expand"></i>
                </span>
            </div>
            <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-black rounded opacity-0 -bottom-7 left-1/2 bg-opacity-70 group-hover:opacity-100 whitespace-nowrap">
                Toggle Fullscreen
            </span>
        </button>

        <!-- Logo -->
        <div class="flex items-center space-x-3 cursor-pointer" onclick="window.location.href = '/dashboard';">
            <div class="relative">
                <img src="{{ asset($siteSetting->company_logo) }}" alt="Logo" 
                    class="object-contain w-10 h-10 rounded-lg md:w-12 md:h-12">
                <div class="absolute inset-0 bg-blue-500 rounded-lg mix-blend-overlay opacity-20"></div>
            </div>
            <h1 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 md:text-xl">
                {{ $settings[6]->value }}
            </h1>
        </div>
    </div>

    <!-- Center Section - Date/Time (Hidden on mobile) -->
    <div class="flex-col items-center justify-center hidden md:flex">
        <div class="text-sm font-medium text-white" id="current-date"></div>
        <div class="text-lg font-bold text-white" id="current-time"></div>
    </div>

    <!-- Right Section - User Controls -->
    <div class="flex items-center space-x-4 md:space-x-6">
        <!-- Date/Time for Mobile -->
        <div class="flex flex-col items-end md:hidden">
            <div class="text-xs text-white" id="mobile-date"></div>
            <div class="text-sm font-medium text-white" id="mobile-time"></div>
        </div>
        
        <!-- User Info -->
        <div class="hidden text-right sm:block">
            <p class="text-xs text-gray-300 md:text-sm">Welcome back,</p>
            <p class="text-sm font-medium text-white md:text-base">{{ $siteSetting->site_name }}</p>
        </div>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="relative group">
                <div class="flex items-center justify-center w-8 h-8 transition-all rounded-full md:w-10 md:h-10 bg-gradient-to-br from-blue-500 to-purple-600 group-hover:rotate-12">
                    <i class="text-sm text-white fas fa-sign-out-alt md:text-base"></i>
                </div>
                <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-black rounded opacity-0 -bottom-7 left-1/2 bg-opacity-70 group-hover:opacity-100 whitespace-nowrap">
                    Sign Out
                </span>
            </button>
        </form>
    </div>
</header>

<script>
    // Update date and time
    function updateDateTime() {
        const now = new Date();
        
        // Format options
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        
        // Desktop display
        document.getElementById('current-date').textContent = now.toLocaleDateString(undefined, dateOptions);
        document.getElementById('current-time').textContent = now.toLocaleTimeString(undefined, timeOptions);
        
        // Mobile display (shorter format)
        document.getElementById('mobile-date').textContent = now.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
        document.getElementById('mobile-time').textContent = now.toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', hour12: true });
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>

    <div class="h-[90%] flex flex-col">
        <!-- Loading Spinner
        <div class="loading-overlay" id="loading" style="display: none">
            <div>
                <div class="spinner"></div>
            </div>
        </div>-->
        <!--breadcrumbs-->
        <div class="hidden px-12 py-5 max-sm:px-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <p class="inline-flex items-center text-sm font-medium text-gray-700">
                            <svg class="w-3 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">
                                Sales
                            </p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">
                                Billing
                            </p>
                        </div>
                    </li>
                    <div><button class="hidden px-4 py-2 text-black border-2 rounded-lg bg-sky-400" id="fullscreenBtn">Fullscreen</button></div>
                </ol>

            </nav>
        </div>
        <!--main content-->
        <div class="flex h-full gap-2 px-3 py-3 pb-5 overflow-y-auto max-sm:px-6 max-xl:flex-col">
            <!--blue div + textfields + table-->
            <div class="flex flex-col w-2/3 border border-gray-100 shadow-sm bg-gray-50 rounded-2xl max-xl:w-full backdrop-blur-sm bg-opacity-70">
                <!-- Header Section -->
                <div class="flex flex-col items-start justify-between gap-3 p-5 border-b border-gray-100 bg-white/50 rounded-t-2xl sm:flex-row sm:items-center">
                    <!-- Title with futuristic accent -->
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl font-[Inter]">Sales Terminal</h1>
                        <div class="w-2 h-2 ml-2 bg-blue-500 rounded-full animate-pulse"></div>
                    </div>
                    
                    <!-- Right controls -->
                    <div class="flex flex-col items-start w-full gap-3 sm:flex-row sm:items-center sm:space-x-3 sm:gap-0 sm:w-auto">
                        <!-- Customer Select - Futuristic floating style -->
                        <div class="w-full sm:w-48">
                        <select id="customer" name="customer"
                                class="w-full p-2.5 text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="" disabled selected>Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- View Hold List Button - Glassmorphism style -->
                        <button id="view-hold-list"
                                data-modal-target="default-modal"
                                data-modal-toggle="default-modal"
                                class="relative w-full px-4 py-2.5 text-sm transition-all bg-white/80 border border-gray-200 rounded-xl hover:bg-white shadow-sm backdrop-blur-sm sm:w-auto">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                Hold List
                            </span>
                            <span id="hold-list-count"
                                class="absolute flex items-center justify-center w-5 h-5 text-xs text-white bg-red-500 rounded-full shadow-sm -top-2 -right-2">
                                0
                            </span>
                        </button>

                        <!-- Toggle Buttons - Neumorphic style -->
                        <div class="flex w-full p-1 bg-gray-100/50 rounded-xl sm:w-auto backdrop-blur-sm">
                            <button id="retailButton" class="w-1/2 px-4 py-2 font-medium text-gray-600 transition-all bg-white rounded-lg shadow-sm sm:w-auto hover:bg-gray-50">
                                Retail
                            </button>
                            <button id="wholesaleButton" class="w-1/2 px-4 py-2 text-gray-600 transition-all rounded-lg sm:w-auto hover:bg-gray-50">
                                Wholesale
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Items Table - Futuristic card style -->
                <div class="relative h-full max-h-[90vh] overflow-auto">
                    <table id="itemsTable" class="w-full text-sm text-left text-gray-700">
                        <thead class="sticky top-0 text-xs uppercase border-b border-gray-100 bg-white/80 backdrop-blur-sm">
                            <tr class="[&>th]:font-semibold [&>th]:text-gray-600 [&>th]:py-4 [&>th]:px-6">
                                <th scope="col" class="rounded-tl-2xl">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="rounded-tr-2xl">Action</th>
                            </tr>
                        </thead>
                        <tbody id="stored-items" class="divide-y divide-gray-100/50">
                            <!-- Items will be populated here -->
                            <tr class="bg-white/50 hover:bg-gray-50/50 transition-colors [&>td]:py-4 [&>td]:px-6">
                                <td colspan="6" class="py-6 text-center text-gray-500">Scan items to begin</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Summary and Controls Section - Floating panel -->
                <div class="p-5 border-t border-gray-100 bg-white/50 rounded-b-2xl backdrop-blur-sm">
                    <!-- Summary Info - Minimalist badges -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-100/50 max-sm:flex-col max-sm:gap-3 max-sm:items-start">
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-2 h-2 mr-2 bg-blue-400 rounded-full"></span>
                            <span>Quantity: <span id="addQuantity" class="font-bold text-gray-900">0</span></span>
                        </div>
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-2 h-2 mr-2 bg-purple-400 rounded-full"></span>
                            <span>Amount: <span id="total-amount" class="font-bold text-gray-900">Rs. 0.00</span></span>
                        </div>
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-2 h-2 mr-2 bg-green-400 rounded-full"></span>
                            <span>Total: <span id="grand-total" class="font-bold text-blue-600">Rs. 0.00</span></span>
                        </div>
                    </div>

                    <!-- Controls - Futuristic layout -->
                    <div class="flex items-start gap-5 mt-5 max-lg:flex-col">
                        <!-- Customer Due Info - Subtle notification -->
                        <div id="due-amount" class="p-3 text-xs font-medium text-gray-600 border border-gray-100 shadow-sm bg-white/80 rounded-xl max-sm:w-full backdrop-blur-sm">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Customer due information will appear here</span>
                            </div>
                        </div>

                        <!-- Discount Input - Floating label style -->
                        <div class="flex-1 max-sm:w-full">
                            <div class="relative">
                                <input type="text" id="itemDiscount"
                                    class="w-full p-3 pl-4 text-sm text-gray-700 transition-all border border-gray-200 bg-white/80 rounded-xl focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/30 peer"
                                    placeholder=" " disabled>
                                <label for="itemDiscount" 
                                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-3 left-4 origin-[0] peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">
                                    Discount
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons - Futuristic glass buttons -->
                        <div class="grid w-1/2 grid-cols-2 gap-3 max-lg:w-full max-sm:grid-cols-1">
                            <!-- Hold All Button - Glass with icon -->
                            <button id="hold-all-button"
                                class="flex items-center justify-center gap-2 px-6 py-3.5 text-sm font-medium text-gray-900 transition-all bg-white/80 border border-gray-200 rounded-xl hover:bg-white shadow-sm backdrop-blur-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M10 9v6m4-6v6m-7 8h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v18a2 2 0 002 2z"/>
                                </svg>
                                Hold All
                            </button>

                            <!-- Process Payment Button - Accent color with hover effect -->
                            <button type="button"
                                data-modal-target="payment-modal"
                                data-modal-toggle="payment-modal"
                                onclick="getDataForPaymentModal();"
                                class="flex items-center justify-center gap-2 px-6 py-3.5 text-sm font-medium text-white transition-all rounded-xl hover:shadow-lg"
                                style="background-color: {{ $settings[7]->value }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8c-1.657 0-3 1.567-3 3.5S10.343 15 12 15s3-1.567 3-3.5S13.657 8 12 8zm0 0V5m0 10v3" />
                                </svg>
                                Process Payment
                            </button>
                            
                            <!-- Cancel Button - Hidden by default -->
                            <button id="cancelButton"
                                    class="flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-red-500/90 rounded-xl transition-all hover:bg-red-600/90 col-span-2 max-sm:col-span-1  shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--sidebar-->
            <div class="flex flex-col w-1/3 border-2 rounded-lg max-md:w-full max-xl:w-full">
                <!--Search bar-->
                <span class="h-1/6 p-3 bg-[#0000000F] border-b-2 2xl:h-[5%] min-h-[65px]">
                    <input type="text" id="searchInput"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Search for items..." required />
                </span>

                <!--sidebar products cards-->
                <div id="searchResults"
                    class="grid grid-cols-3 max-xl:grid-cols-5 max-lg:grid-cols-4 max-[600px]:grid-cols-2 max-[400px]:grid-cols-2 gap-3 overflow-y-auto p-3">
                    @foreach ($items as $item)
                    <button class="add-to-storage"
                        data-id="{{ $item->id }}"
                        data-item_name="{{ $item->item_name }}"
                        data-item_code="{{ $item->item_code }}"
                        data-addQuantity="{{ $item->addQuantity }}"
                        data-purchase_price="{{ $item->purchase_price }}"
                        data-retail_price="{{ $item->retail_price }}"
                        data-wholesale_price="{{ $item->wholesale_price }}"
                        {{ $item->quantity == 0 ? 'disabled' : '' }}
                        style="background-color: {{ $item->quantity == 0 ? '#e0e0e0' : '#ffffff' }}; cursor: {{ $item->quantity == 0 ? 'not-allowed' : 'pointer' }};">
                        <div class="bg-white xl:h-[160px] max-xl:aspect-[4/5] flex flex-col justify-between rounded-md border border-gray-300">
                                <div class="bg-gradient-to-r from-[{{ $settings[7]->value }}] to-[{{ $settings[7]->value }}90] h-8 rounded-t-lg text-white flex items-center px-2 justify-between text-xs font-medium {{ $item->minimum_qty > $item->quantity ? 'from-red-500 to-red-400' : '' }}">                                
                                    <p class="truncate">{{ $item->item_code }}</p>
                                    <span class="bg-white/20 px-1.5 py-0.5 rounded-full">{{ $item->quantity }}</span>
                                </div>                            
                                <div class="flex flex-col justify-between p-1 h-5/6">
                                <center>
                                    @if (!empty($item->getImageUrlAttribute()))
                                        <img src="{{ $item->getImageUrlAttribute() }}" alt="Product image" style="width: 80px; height: 80px; border-radius:5px;">
                                    @else
                                        <img src="/images/placeholder.jpg" alt="Placeholder image" style="width: 80px; height: 80px; border-radius: 5px;">
                                    @endif
                                </center>
                                <span class="flex flex-col text-xs text-center h-fit" id="stored-items">
                                  <p class="text-lg font-medium text-gray-900 truncate">{{ $item->item_name }}</p>
                                    <p class="hidden truncate">{{ $item->item_name }}</p>

                                      <div class="flex items-center justify-between">
                                            <span class="text-sm text-[{{ $settings[7]->value }}] truncate price-text price">{{ $item->retail_price }}</span>
                                            <span class="text-xs text-gray-500 truncate">Qty: {{ $item->quantity }}</span>
                                        </div>
                                </span>
                            </div>
                        </div>
                        <!-- Custom Tooltip -->
                        <span class="tooltip">{{ $item->item_name }}</span>
                    </button>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- View Hold List Modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Hold List
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">
                    <div class="relative overflow-x-auto">
                        <table id="itemsTables" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ref Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="stored-item">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add customer Modal -->
    <div id="customer-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Corrected Form -->
        {{-- <form action="{{ route('customers.storeBill') }}" method="POST"> --}}
        <form id="addCustomerForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Customer
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="customer-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">
                    <div class="grid grid-cols-3 gap-6 max-md:grid-cols-1">
                        <div class="max-sm:w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-black ">Customer Name</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Customer name"  />
                                <span class="text-sm text-red-500" id="error-name"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="Mobile_Number" class="block mb-2 text-sm font-medium text-black ">Mobile Number</label>
                            <input type="text" id="Mobile_Number" name="Mobile_Number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Mobile Number"  />
                                <span class="text-sm text-red-500" id="error-Mobile_Number"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-black ">Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter email"  />
                        </div>
                        <div class="max-sm:w-full">
                            <label for="city" class="block mb-2 text-sm font-medium text-black ">City</label>
                            <input type="text" id="city" name="city"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter city"  />
                                <span class="text-sm text-red-500" id="error-city"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="addl1" class="block mb-2 text-sm font-medium text-black">Address Line</label>
                            <textarea id="addl1" rows="2" name="addl1"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter address" ></textarea>
                                <span class="text-sm text-red-500" id="error-addl1"></span>
                        </div>
                        <div class="hidden max-sm:w-full">
                            <label for="addl2" class="block mb-2 text-sm font-medium text-black">Address Line 2</label>
                            <textarea id="addl2" rows="2" name="addl2"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter address" ></textarea>
                                <span class="text-sm text-red-500" id="error-addl2"></span>
                        </div>
                        <div class="max-sm:w-full">
                            <label for="due" class="block mb-2 text-sm font-medium text-black ">Due Amount</label>
                            <input type="text" id="due" name="due"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter Customer name"  />
                                <span class="text-sm text-red-500" id="error-due"></span>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">
                    <button  type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                    <button data-modal-hide="customer-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Payment Modal -->
    <div id="payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        {{-- <form action="{{ route('payment.store') }}" method="POST"> --}}
        <form id="paymentForm" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Make Payment
                    </h3>



                    <div id="form-errors" class="hidden w-full mb-4 text-center">
                        <div class="max-w-xs p-4 mx-auto text-white bg-red-500 rounded-lg shadow-md">
                            <p id="error-message" class="text-sm font-medium sm:text-base"></p>
                        </div>
                    </div>



                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
                        data-modal-hide="payment-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">
                    <div class="grid gap-6 md:grid-cols-3">
                        <!--text fields-->
                        <div class="grid gap-6 md:grid-cols-1">
                        <div class="max-sm:w-full">
                            <label for="r_amount" class="block mb-2 text-sm font-medium text-black">Received Amount</label>
                            <input type="number" id="r_amount" name="r_amount"
                                step="0.01" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter received amount" />
                            <span class="text-sm text-red-500" id="error-r_amount"></span>
                        </div>


                        <div class="max-sm:w-full">
                            <label for="p_amount" class="block mb-2 text-sm font-medium text-black">Paying Amount</label>
                            <input type="number" id="g_totals" name="p_amount" value=""
                                step="0.01" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter paying amount" />
                            <span class="text-sm text-red-500" id="error-p_amount"></span>
                        </div>

                            <div class="max-sm:w-full">
                                <label for="c_return" class="block mb-2 text-sm font-medium text-black ">Change
                                    Return</label>
                                <input type="number" id="c_return" name="c_return" data-input-counter data-input-counter-min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="change return" disabled />
                            </div>
                            <div class=" max-sm:w-full">
                                <label for="p_type" class="block mb-2 text-sm font-medium text-black ">Payment
                                    Type</label>
                                <select id="p_type" name="p_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="CASH">Cash</option>
                                    <option value="CARD">Card</option>
                                    <option value="CHEQUE">Cheque</option>
                                    <option value="CREDIT">Credit</option>
                                </select>
                                <span class="text-sm text-red-500" id="error-p_type"></span>
                            </div>
                            <div class="hidden max-sm:w-full">
                                <label for="p_status" class="block mb-2 text-sm font-medium text-black ">Payment
                                    Status</label>
                                <select id="p_status" name="p_status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="PAID">Paid</option>
                                    <option value="DUE">Due</option>
                                    <option value="HOLD">Hold</option>
                                </select>
                                <span class="text-sm text-red-500" id="error-p_status"></span>
                            </div>

                            <div>
                                <label for="due_amount_pay" class="inline-block text-base font-semibold text-black">
                                    Due Amount:
                                </label>
                                <span id="due_amount_pay" class="inline-block ml-2 text-base font-semibold text-red-500"></span>
                            </div>






                            <script>
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    const grandTotalInput = document.getElementById('g_total');
                                    const payingAmountInput = document.getElementById('g_totals');
                                    const dueAmountPayLabel = document.getElementById('due_amount_pay');

                                    payingAmountInput.addEventListener('input', function() {
                                        const grandTotal = parseFloat(grandTotalInput.value) || 0;
                                        const payingAmount = parseFloat(payingAmountInput.value) || 0;
                                        const dueAmount = grandTotal - payingAmount;

                                        dueAmountPayLabel.textContent = dueAmount.toFixed(2);
                                    });
                                });
                            </script>


                        </div>
                        <!--table-->
                        <div class="grid gap-6 md:col-span-2">
                            <div class="relative overflow-x-auto md:border-l md:pl-6">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <tbody id="totals-body">
                                        <tr class="bg-white max-md:border-t">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Total Products
                                            </th>
                                            <td class="py-4 " colspan="2">
                                                <p id="t_products"></p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Total Amount
                                            </th>
                                            <td class="py-4 ">
                                            <input id="t_amount" name="t_amount" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Discount
                                            </th>
                                            <td class="py-4 ">
                                                <input id="dis" name="discount" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="hidden py-3 text-xs text-gray-700 uppercase ">
                                                Tax
                                            </th>
                                            <td class="hidden py-4 ">
                                                <p id="_tax"></p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="hidden py-3 text-xs text-gray-700 uppercase ">
                                                Tax Type
                                            </th>
                                            <td class="hidden py-4 ">
                                                <p id="t_type"></p>
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Grand Total
                                            </th>
                                            <td class="py-4 ">

                                                <input id="g_total" name="grand_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Commission
                                            </th>
                                            <td class="py-4 ">
                                                <input type="number" id="commission" name="commission" data-input-counter
                                                    data-input-counter-min="1"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Enter commission"/>
                                                    <span class="text-sm text-red-500" id="error-commission"></span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                            cheque Number
                                            </th>
                                            <td class="py-4 ">
                                            <input type="number" id="cheque_no" name="cheque_no" data-input-counter data-input-counter-min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter cheque amount"  />
                                    <span class="text-sm text-red-500" id="error-cheque_no"></span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase">
                                                Cheque Date
                                            </th>
                                            <td class="py-4">
                                                <input
                                                    type="date"
                                                    id="cheque_date"
                                                    name="cheque_date"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Enter cheque Date"
                                                />
                                                <span class="text-sm text-gray-500" id="info-cheque_date"></span>
                                            </td>
                                        </tr>
                                        <tr class="hidden bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Warrenty Period
                                            </th>
                                            <td class="py-4 ">
                                                <input type="text" id="warrenty_period" name="warrenty_period"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Enter warrenty period"  />
                                                    <span class="text-sm text-red-500" id="error-warrenty_period"></span>
                                            </td>
                                        </tr>
                                        <tr class="hidden bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Warrenty Card Number
                                            </th>
                                            <td class="py-4 ">
                                                <input type="number" id="warrenty_cnum" name="warrenty_cnum" data-input-counter
                                                    data-input-counter-min="1"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Enter warrenty card number"  />
                                                    <span class="text-sm text-red-500" id="error-warrenty_cnum"></span>
                                            </td>
                                        </tr>
                                        <tr class="hidden bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                With Guide
                                            </th>
                                            <td class="py-4 ">
                                                <input id="w_guide" type="checkbox" value=""
                                                    class="hidden w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            </td>
                                        </tr>
                                        <tr class="hidden bg-white">
                                            <th scope="row" class="py-3 text-xs text-gray-700 uppercase ">
                                                Send SMS
                                            </th>
                                            <td class="py-4 ">
                                                <input id="sms" type="checkbox" value=""
                                                    class="hidden w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="max-sm:w-full">
                                    <label for="notes" class="block mb-2 text-sm font-medium text-black">Notes</label>
                                    <textarea id="notes" name="notes" rows="2"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter notes"></textarea>
                                        <span class="text-sm text-red-500" id="error-notes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5">

                    <button type="submit" id="download-invoice"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Pay</button>
                    <button data-modal-hide="payment-modal" type="button" id="cancel"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Modal for Entering Bill Name -->
    <div id="bill-name-modal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
        <div class="p-6 bg-white rounded-lg shadow-lg w-96">
            <h2 class="mb-4 text-xl font-semibold">Enter Bill Name</h2>
            <input type="text" id="bill-name-input" class="w-full p-2 mb-4 border rounded"
                placeholder="Enter a name for this bill" />
                <p id="bill-name-error" class="hidden mt-1 text-xs text-red-500">Bill name is required!</p>
            <div class="flex justify-end space-x-2">
                <button id="cancel-bill-name" class="px-4 py-2 text-gray-700 bg-gray-300 rounded">
                    Cancel
                </button>
                <button id="save-bill-name" class="px-4 py-2 text-white bg-blue-500 rounded">
                    Save
                </button>
            </div>
        </div>
    </div>
    <!-- Success Alert Modal -->
    <div id="success-alert" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="p-4 text-center bg-white rounded-lg">
            <p id="success-message" class="text-lg text-green-500">Success!</p>
            <button id="ok-button" class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">OK</button>
        </div>
    </div>
    <div id="custom-alert" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-sm p-6 text-center bg-white rounded-lg shadow-lg">
            <p id="custom-alert-message" class="text-lg font-medium text-gray-800"></p>
            <button id="custom-alert-close" class="px-4 py-2 mt-4 text-white bg-blue-500 rounded hover:bg-blue-600" onclick="openPDF()">
                OK
            </button>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    const fullscreenBtn = document.getElementById('fullscreenBtn');

// Function to toggle fullscreen
function toggleFullScreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen()
            .then(() => console.log('Entered fullscreen mode'))
            .catch(err => console.error(`Error attempting fullscreen: ${err.message}`));
    } else {
        document.exitFullscreen()
            .then(() => console.log('Exited fullscreen mode'))
            .catch(err => console.error(`Error exiting fullscreen: ${err.message}`));
    }
}

// Event listener for button click
fullscreenBtn.addEventListener('click', toggleFullScreen);


   document.addEventListener("DOMContentLoaded", function () {
    const paymentTypeSelect = document.getElementById("p_type");
    const chequeFields = document.querySelectorAll("#cheque_no, #cheque_date");

    // Function to toggle the visibility of cheque fields
    function toggleChequeFields() {
        if (paymentTypeSelect.value === "CHEQUE") {
            chequeFields.forEach(field => field.closest("tr").classList.remove("hidden"));
        } else {
            chequeFields.forEach(field => field.closest("tr").classList.add("hidden"));
        }
    }

    // Run the toggle function when the page loads to account for the initial state
    toggleChequeFields();

    // Add event listener for changes in payment type selection
    paymentTypeSelect.addEventListener("change", toggleChequeFields);
});



   document.addEventListener("DOMContentLoaded", function () {
    updateHoldListCount();  // Update the count when the page loads
    displayHoldList();      // Display the list when the page loads
});

// Function to update the hold list count
function updateHoldListCount() {
    const bills = JSON.parse(localStorage.getItem("bills")) || {};  // Get all saved bills
    const count = Object.keys(bills).length;  // Count the number of bills
    const countElement = document.getElementById("hold-list-count");

    // Update the count in the span
    countElement.textContent = count;

    // Hide the count element if there are no bills
    if (count === 0) {
        countElement.classList.add("hidden");
    } else {
        countElement.classList.remove("hidden");
    }
}

// Event listener for "Hold All" button
document.getElementById("hold-all-button").addEventListener("click", function () {
    const modal = document.getElementById("bill-name-modal");
    const billNameInput = document.getElementById("bill-name-input");
    const billNameError = document.getElementById("bill-name-error");
    const cancelBtn = document.getElementById("cancel-bill-name");
    const saveBtn = document.getElementById("save-bill-name");

    // Show the modal
    modal.classList.remove("hidden");
    billNameInput.value = "";  // Clear input field
    billNameInput.focus();

    // Hide error message and reset the border color initially
    billNameError.classList.add("hidden");
    billNameInput.classList.remove("border-red-500");

    // Cancel button functionality
    cancelBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Save button functionality
    saveBtn.addEventListener("click", () => {
        const billName = billNameInput.value.trim();

        if (!billName) {
            // Show error message if bill name is empty
            billNameError.classList.remove("hidden");
            billNameInput.classList.add("border-red-500");
            return;
        }

        const existingItems = JSON.parse(localStorage.getItem("items")) || [];
        if (existingItems.length === 0) {
            // Instead of alert, you can simply stop and return
            billNameError.textContent = "No items to save!";
            billNameError.classList.remove("hidden");
            billNameInput.classList.add("border-red-500");
            return;
        }

        const existingBills = JSON.parse(localStorage.getItem("bills")) || {};

        if (existingBills[billName]) {
            if (!confirm(`A bill with the name "${billName}" already exists. Overwrite?`)) {
                return;
            }
        }

        // Save bill and clear items
        existingBills[billName] = existingItems;
        localStorage.setItem("bills", JSON.stringify(existingBills));
        localStorage.removeItem("items");

        updateHoldListCount();  // Update the count after saving the bill
        displayHoldList();      // Refresh the list of bills displayed

        // Refresh the page to reflect the changes
        location.reload();  // This will force a page reload
    });
});

// Function to display hold list
function displayHoldList() {
    const holdListBody = document.getElementById("stored-item");
    holdListBody.innerHTML = "";

    const bills = JSON.parse(localStorage.getItem("bills")) || {};
    const billNames = Object.keys(bills);

    if (billNames.length === 0) {
        holdListBody.innerHTML = '<tr><td colspan="4" class="py-4 text-center">No hold orders found.</td></tr>';
        return;
    }

    billNames.forEach((billName, index) => {
        const row = document.createElement("tr");
        row.classList.add("bg-white", "border-b", "hover:bg-gray-50");

        const currentDate = new Date().toLocaleDateString();

        row.innerHTML = `
            <td class="px-6 py-4 text-center">${index + 1}</td>
            <td class="px-6 py-4">${currentDate}</td>
            <td class="px-6 py-4">${billName}</td>
            <td class="px-6 py-4 ">
                <button class="py-2 text-black border-2 rounded-lg px-7 bg-sky-400" onclick="loadSavedHoldOrder('${billName}')">Add Bill</button>
                <button class="py-2 text-black bg-red-400 border-2 rounded-lg px-7" onclick="deleteHoldOrder('${billName}')">Delete</button>
            </td>
        `;
        holdListBody.appendChild(row);
    });
}

// Function to load a saved bill
function loadSavedHoldOrder(billName) {
    const existingBills = JSON.parse(localStorage.getItem("bills")) || {};

    if (!existingBills[billName]) {
        alert(`No bill found with the name "${billName}".`);
        return;
    }

    const billItems = existingBills[billName];
    localStorage.setItem("items", JSON.stringify(billItems));

    // Optionally delete the bill if you don't need it anymore
    delete existingBills[billName];
    localStorage.setItem("bills", JSON.stringify(existingBills));



    displayStoredItems();
    updateHoldListCount();  // Update the hold list count
    displayHoldList();      // Refresh the display of the hold list

    // Refresh the page to reflect the changes
     // This will force a page reload
}

// Function to delete a saved bill
function deleteHoldOrder(billName) {
    if (!confirm(`Are you sure you want to delete the bill "${billName}"?`)) {
        return;
    }

    const existingBills = JSON.parse(localStorage.getItem("bills")) || {};

    if (existingBills[billName]) {
        delete existingBills[billName];
        localStorage.setItem("bills", JSON.stringify(existingBills));
        alert(`Bill "${billName}" has been deleted successfully.`);
        updateHoldListCount();  // Update the count after deletion
        displayHoldList();      // Refresh the list

        // Refresh the page to reflect the changes
        location.reload();  // This will force a page reload
    } else {
        alert(`No bill found with the name "${billName}".`);
    }
}









document.getElementById('addCustomerForm').addEventListener('submit', function (event) {
    event.preventDefault();  // Prevent the default form submission behavior

    const formData = new FormData(this);

    // Get existing customers from local storage (or initialize if none exists)
    const customers = JSON.parse(localStorage.getItem('customers')) || [];
    formData.append('customers', JSON.stringify(customers)); // Serialize customers array to JSON string

    fetch('{{ route('customers.storeBill') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reset the form and close the modal if successful
            document.getElementById('customer-modal').classList.add('hidden');
            document.querySelector('form').reset();
            location.reload();  // Optionally, reload the page to reflect changes
        } else {
            // Display validation errors
            console.error('Error:', data.message);
            if (data.errors) {
                displayValidationErrors(data.errors);
            } else {

                location.reload();
            }

        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
    });
});
// Function to display validation errors
function displayValidationErrors(errors) {
    // 1. Reset previous error states
    document.querySelectorAll('.is-invalid').forEach(field => field.classList.remove('is-invalid'));
    document.querySelectorAll('.error-message').forEach(error => {
        error.textContent = '';
        error.classList.add('hidden'); // Hide error messages
    });

    // 2. Display new validation errors
    for (const field in errors) {
        if (errors.hasOwnProperty(field)) {
            const errorMessage = errors[field][0]; // Get the first error message
            const errorSpan = document.getElementById(`error-${field}`); // Error span by field ID
            const inputField = document.getElementById(field); // Input field by ID

            if (errorSpan) {
                errorSpan.textContent = errorMessage; // Set error message
                errorSpan.classList.remove('hidden'); // Show error message
            }

            if (inputField) {
                inputField.classList.add('is-invalid'); // Highlight invalid field
            }
        }
    }

    // 3. Hide errors on user input
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('input', () => {
            const errorSpan = document.getElementById(`error-${input.id}`);
            if (errorSpan) {
                errorSpan.textContent = ''; // Clear error message
                errorSpan.classList.add('hidden'); // Hide error message
            }
            input.classList.remove('is-invalid'); // Remove invalid class
        });
    });
}
document.addEventListener('DOMContentLoaded', () => {
    const rAmountInput = document.getElementById('r_amount'); // Received Amount
    const payAmountInput = document.getElementById('g_totals'); // Paying Amount
    const cReturnInput = document.getElementById('c_return'); // Change Return

    function calculateChangeReturn() {
        const receivedAmount = parseFloat(rAmountInput.value) || 0;
        const payAmount = parseFloat(payAmountInput.value) || 0;

        // Calculate the change return
        const changeReturn = receivedAmount - payAmount;

        // Display the result in the Change Return field
        cReturnInput.value = changeReturn.toFixed(2);
    }

    // Add event listeners for changes in Received Amount and Paying Amount
    rAmountInput.addEventListener('input', calculateChangeReturn);
    payAmountInput.addEventListener('input', calculateChangeReturn);
});

    document.getElementById('cancelButton').addEventListener('click', () => {
        // Clear local storage

const keyToRemove = "items";

// Remove the specific key
localStorage.removeItem(keyToRemove);

// Verify the key is removed
console.log(`${keyToRemove} removed!`);
console.log(localStorage);
        // Optionally refresh the page after clearing
        location.reload(); // Uncomment this line if you want to refresh the page
    });
    window.addEventListener('beforeunload', () => {

const keyToRemove = "items";

// Remove the specific key
localStorage.removeItem(keyToRemove);

// Verify the key is removed
console.log(`${keyToRemove} removed!`);
console.log(localStorage);
    });
    document.addEventListener('DOMContentLoaded', () => {
        // Select all elements with the "price" class
        const priceElements = document.querySelectorAll('.price');

        // Loop through each price element and add "Rs."
        priceElements.forEach((priceElement) => {
            const price = priceElement.textContent.trim();
            priceElement.textContent = `Rs. ${price}`;
        });
    });

    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase(); // Get the search term
        const items = document.querySelectorAll('.add-to-storage'); // Get all product cards

        items.forEach(item => {
            const itemName = item.querySelector('.truncate:nth-child(2)').textContent
        .toLowerCase(); // Get the item name
            const itemCode = item.querySelector('.truncate:nth-child(1)').textContent
        .toLowerCase(); // Get the item code

            // Check if the search term matches the item name or item code
            if (itemName.includes(searchTerm) || itemCode.includes(searchTerm)) {
                item.style.display = ''; // Show the item
            } else {
                item.style.display = 'none'; // Hide the item
            }
        });
    });


    // Fetch the hold orders and update the hold count
    // function fetchHoldCount() {
    //     fetch('/hold-orders')
    //         .then(response => response.json())
    //         .then(data => {
    //             const holdCount = data.length; // Get the count of hold orders
    //             document.getElementById('hold-list-count').textContent = holdCount;
    //         })
    //         .catch(error => {
    //             console.error('Error fetching hold orders:', error);
    //             alert('Failed to fetch hold orders');
    //         });
    // }

    // //Display the hold orders in the modal
    // function displayHoldList() {
    // fetch('/hold-orders')
    //     .then(response => response.json())
    //     .then(data => {
    //         const holdListBody = document.getElementById('itemsTables').getElementsByTagName('tbody')[0];
    //         holdListBody.innerHTML = ''; // Clear any existing rows

    //         data.forEach((holdOrder, index) => {
    //             const row = document.createElement('tr');
    //             row.classList.add('bg-white', 'border-b');

    //             row.innerHTML = `
    //                 <td class="px-6 py-4 text-center">${index + 1}</td> <!-- Numbering starts from 1 -->
    //                 <td class="px-6 py-4">${holdOrder.hold_reference}</td>
    //                 <td class="px-6 py-4">${holdOrder.hold_status}</td>
    //                 <td class="px-6 py-4">
    //                     <button class="ml-2 text-blue-500 hover:text-blue-700 loadSavedHoldOrder" data-hold-order-id="${holdOrder.id}">Add Bill</button>
    //                     <button class="ml-2 text-red-500 hover:text-red-700" onclick="deleteHoldOrder('${holdOrder.id}')">Delete</button>
    //                 </td>
    //             `;
    //             holdListBody.appendChild(row);
    //         });

//             // Attach event listener to all the 'Add Bill' buttons
//             document.querySelectorAll('.loadSavedHoldOrder').forEach(button => {
//                 button.addEventListener('click', function() {
//                     const holdOrderId = this.getAttribute('data-hold-order-id');

//                     // Fetch the hold order's items from the server (replace with your actual API endpoint)
//                     fetch(`/api/hold-order/${holdOrderId}`)
//                         .then(response => response.json())
//                         .then(data => {
//                             if (data && data.items) {
//                                 const items = data.items;

//                                 // Retrieve current items in localStorage
//                                 const storedItems = JSON.parse(localStorage.getItem('items')) || [];

//                                 // Add the items from the hold order to localStorage
//                                 items.forEach(item => {
//                                     // Check if the item already exists in localStorage
//                                     const existingItemIndex = storedItems.findIndex(storedItem => storedItem.item_code === item.item_code);
//                                     if (existingItemIndex === -1) {
//                                         // If the item doesn't already exist, add it
//                                         storedItems.push(item);
//                                     } else {
//                                         // If it exists, update the quantity
//                                         storedItems[existingItemIndex].addQuantity += item.addQuantity;
//                                     }
//                                 });

//                                 // Save the updated items back to localStorage
//                                 localStorage.setItem('items', JSON.stringify(storedItems));

//                                 // Optionally, call your function to update the UI or refresh the bill view
//                                 displayStoredItems();
//                             }
//                         })
//                         .catch(error => {
//                             console.error('Error loading hold order:', error);
//                             alert('Failed to load the hold order');
//                         });
//                 });
//             });
//         })
//         .catch(error => {
//             console.error('Error displaying hold orders:', error);
//             alert('Failed to load hold orders');
//         });
// }

//     // Delete a hold order
//     function deleteHoldOrder(id) {
//         if (confirm('Are you sure you want to delete this hold order?')) {
//             fetch(`/hold-orders/${id}`, {
//                     method: 'DELETE',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                     },
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     alert(data.success || data.error);
//                     displayHoldList(); // Refresh the hold list after deletion
//                     fetchHoldCount(); // Update the hold count
//                 })
//                 .catch(error => {
//                     console.error('Error deleting hold order:', error);
//                     alert('Failed to delete hold order');
//                 });
//         }
//     }

    // Call the fetchHoldCount and displayHoldList on page load
    window.addEventListener('DOMContentLoaded', () => {
        fetchHoldCount(); // Update hold count
        displayHoldList(); // Populate hold list in the modal
    });



    // Function to hold all items as one bill
    // Get references to modal elements
    const modal = document.getElementById('bill-name-modal');
    const billNameInput = document.getElementById('bill-name-input');
    const saveButton = document.getElementById('save-bill-name');
    const cancelButton = document.getElementById('cancel-bill-name');

    // Function to open the modal
    function openModal() {
        modal.classList.remove('hidden'); // Show the modal
        billNameInput.value = ''; // Clear the input field
        billNameInput.focus(); // Focus on the input field
    }

    // Function to close the modal
    function closeModal() {
        modal.classList.add('hidden'); // Hide the modal
    }

    // Event listener for "Hold All" button
    // document.getElementById('hold-all-button').addEventListener('click', function() {
    //     openModal(); // Open the modal for entering the bill name
    // });

    document.addEventListener('DOMContentLoaded', function() {
        const saveButton = document.getElementById('save-bill-name'); // Save button
        const billNameInput = document.getElementById('bill-name-input'); // Input field for bill name
        const modal = document.getElementById('bill-name-modal'); // Modal element

        // Function to close the modal
        function closeModal() {
            modal.classList.add('hidden');
        }

        // Event listener for Save button
        saveButton.addEventListener('click', function() {
            const billName = billNameInput.value.trim();

            if (!billName) {
                //alert('Bill name is required!'); // Check for valid bill name
                return;
            }

            // Retrieve items from localStorage
            // const items_data = localStorage.getItem('items') || [];
            const items_data = JSON.parse(localStorage.getItem('items')) || [];

            //if (items.length === 0) {
            //   alert('No items to save!');
            //    return;
            //}

            // Construct the bill object
            const bill = {
                name: billName,
                refId: `REF-${new Date().getTime()}`,
                items: items_data,
            };
            const loader = document.getElementById('loading');
            loader.style.display = 'flex';
            // Send the bill data to the server
            fetch('{{ route('save-hold-order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify(bill),
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log('Response from server:', data);
                    if (data.success) {
                        alert('Bill saved successfully!');
                        location.reload(); // Refresh the page on success
                    } else {
                        alert(data.message || 'Failed to save bill.');
                    }
                })
                .catch((error) => {
                    console.error('Error while saving bill:', error);
                    alert('An error occurred while saving the bill.');
                });

            // Close the modal
            closeModal();
        });
    });



    // Event listener for "Cancel" button
    cancelButton.addEventListener('click', closeModal);

    // Function to display success alert
    function showSuccessAlert(message) {
        document.getElementById('success-message').textContent = message;
        document.getElementById('success-alert').classList.remove('hidden');
    }

    // Function to close success alert and refresh page
    function closeSuccessAlert() {
        document.getElementById('success-alert').classList.add('hidden');
        window.location.reload(); // Refresh the page
    }

    // Attach event listener to "OK" button
    document.getElementById('ok-button').addEventListener('click', closeSuccessAlert);


    // Function to add the whole bill back to the item list
    function addBackToItemList(billId) {
        // Retrieve the hold list and item list from localStorage
        let holdList = JSON.parse(localStorage.getItem('holdList')) || [];
        let items = JSON.parse(localStorage.getItem('items')) || [];

        // Find the bill in the hold list by ID
        const billIndex = holdList.findIndex(bill => bill.id === billId);
        if (billIndex !== -1) {
            // Add the items from the bill back to the items list
            items = items.concat(holdList[billIndex].items);

            // Remove the bill from the hold list
            holdList.splice(billIndex, 1);

            // Update localStorage
            localStorage.setItem('items', JSON.stringify(items));
            localStorage.setItem('holdList', JSON.stringify(holdList));

            // Refresh the hold list in the modal
            displayHoldList();
        }
    }

    // // Function to delete a bill from the hold list
    // function deleteBillFromHoldList(billId) {
    //     // Retrieve the hold list from localStorage
    //     let holdList = JSON.parse(localStorage.getItem('holdList')) || [];

    //     // Find the bill in the hold list by ID
    //     const billIndex = holdList.findIndex(bill => bill.id === billId);
    //     if (billIndex !== -1) {
    //         // Remove the bill from the hold list
    //         holdList.splice(billIndex, 1);

    //         // Update the hold list in localStorage
    //         localStorage.setItem('holdList', JSON.stringify(holdList));

    //         // Refresh the hold list in the modal
    //         displayHoldList();
    //     }
    // }


    document.addEventListener('DOMContentLoaded', function() {
    // Clear any previous error message on page load
    const errorDiv = document.getElementById('form-errors');
    errorDiv.classList.add('hidden');  // Hide error message section initially
});

document.getElementById('paymentForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Check if customer ID exists in localStorage, if not, set it to 1
    let selectedCustomerId = localStorage.getItem('selectedCustomerId');
    if (!selectedCustomerId) {
        selectedCustomerId = 1;  // Set default customer ID to 1 if not available
        localStorage.setItem('selectedCustomerId', selectedCustomerId);  // Optionally store this default ID
    }

    // Prepare the form data
    const formData = new FormData(this);

    // Append customer ID to the form data
    formData.append('selectedCustomerId', selectedCustomerId);

    // Retrieve the items from localStorage and add them to the form data
    const items = JSON.parse(localStorage.getItem('items')) || [];
    formData.append('items', JSON.stringify(items)); // Serialize items to JSON string

    // Send the form data via a POST request
    fetch('{{ route('payment.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        const errorDiv = document.getElementById('form-errors');
        const errorMessage = document.getElementById('error-message');

        if (data.success) {
            // Display success message

            // Optionally, close the modal or reset the form
            document.getElementById('payment-modal').classList.add('hidden');
            document.querySelector('form').reset();

            // Log the sale code to the console
            console.log('Sale Code:', data.sales_code);
            console.log('Due Amount:', data.due_amount);
            console.log('Paid Amount:', data.paid_amount);
            console.log('Payment Type:', data.payment_type);
            console.log('Customer Name:', data.customer_name);
            console.log('User Name:', data.user_name);
            console.log('Discount:', data.discount);
            console.log('Total:', data.sub_total);
            console.log('Received Amount:', data.received_amount);


            // Store the sale code, due amount, and customer/user data in localStorage
            localStorage.setItem('sale_code', data.sales_code);
            localStorage.setItem('due_amount', data.due_amount);
            localStorage.setItem('paid_amount', data.paid_amount);
            localStorage.setItem('payment_type', data.payment_type);
            localStorage.setItem('customer_name', data.customer_name);
            localStorage.setItem('user_name', data.user_name);
            localStorage.setItem('discount', data.discount);
            localStorage.setItem('sub_total', data.sub_total);
            localStorage.setItem('received_amount', data.received_amount);


            openPDF();
            location.reload();
            // Hide error message if successful
            errorDiv.classList.add('hidden');
        } else {
            // Display the error message at the top
            errorMessage.innerText = data.message || 'An error occurred.';
            errorDiv.classList.remove('hidden');

            // Automatically hide the error message after 4 seconds
            setTimeout(function() {
                errorDiv.classList.add('hidden');
            }, 4000); // 4000ms = 4 seconds
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error with the payment submission.');
    });
});






    // Custom alert logic
    function showAlert(message, paymentId = null) {
        const alertModal = document.getElementById('custom-alert');
        const alertMessage = document.getElementById('custom-alert-message');
        const alertClose = document.getElementById('custom-alert-close');

        alertMessage.textContent = message;
        alertModal.classList.add('show');

        alertClose.addEventListener('click', () => {
            alertModal.classList.remove('show');
            if (message === 'Payment processed successfully!' && paymentId) {

                downloadPDF(paymentId); // Trigger the PDF download with the paymentId
            }location.reload();
        });
    }




// Set price type in localStorage when Wholesale or Retail button is clicked
document.getElementById('wholesaleButton').addEventListener('click', () => {
    localStorage.setItem('key-selectedPriceType', 'wholesale');
    console.log('Selected Pricing Type (Wholesale):', localStorage.getItem('key-selectedPriceType'));  // Debugging line
});

document.getElementById('retailButton').addEventListener('click', () => {
    localStorage.setItem('key-selectedPriceType', 'retail');
    console.log('Selected Pricing Type (Retail):', localStorage.getItem('key-selectedPriceType'));  // Debugging line
});





function openPDF(paymentId) {
    const { jsPDF } = window.jspdf;

const PAGE_CONFIG = {
    width: 80,
    margins: {
        left: 3,
        right: 3
    },
    spacing: {
        lineHeight: 4,
        sectionGap: 8
    },
    columns: {
        quantity: 30,
        amount: 46
    }
};

    // Retrieve data
    // Retrieve data from localStorage with default values
    const items = JSON.parse(localStorage.getItem('items')) || [];
    const pricingType = localStorage.getItem('key-selectedPriceType') || 'retail';
    const saleCode = localStorage.getItem('sale_code') || 'SALE-XXXX'; // Default if not found
    const dueAmount = parseFloat(localStorage.getItem('due_amount')) || 0.00;
    const paidAmount = parseFloat(localStorage.getItem('paid_amount')) || 0.00;
    const paymentType = localStorage.getItem('payment_type') || 'UNKNOWN';
    const customerName = localStorage.getItem('customer_name') || 'Customer';
    const userName = localStorage.getItem('user_name') || 'Cashier';
    const discount = parseFloat(localStorage.getItem('discount')) || 0.00;
    const total = parseFloat(localStorage.getItem('sub_total')) || 0.00;


    // Calculate dynamic height
    const calculateTotalHeight = () => {
    const headerHeight = 40; // Height of the header section
    const itemHeight = PAGE_CONFIG.spacing.lineHeight * 2; // Height for each item (2 lines per item)
    const itemGap = 1; // Additional gap between items (in mm)
    const itemsHeight = items.length * (itemHeight + itemGap); // Total height for all items including gaps
    const summaryHeight = 30; // Height of the summary section
    const footerHeight = 60; // Height of the footer section
    const padding = 1; // Additional padding for the document

    return headerHeight + itemsHeight + summaryHeight + footerHeight + padding;
};

    const doc = new jsPDF({
        unit: 'mm',
        format: [PAGE_CONFIG.width, calculateTotalHeight()]
    });

    // Utility functions
    const centerText = (text, y) => {
        doc.text(text, PAGE_CONFIG.width / 2, y, { align: 'center' });
    };

    const rightAlignText = (text, x, y) => {
        doc.text(text, x, y, { align: 'right' });
    };

        // Print header
        let currentY = 10;
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(13);
        centerText('{{ $settings[6]->value}}', currentY);

        // Add new header detail with reduced gap
        doc.setFontSize(10);
        currentY += 5; // Reduced gap before the new detail
        doc.setFont('helvetica', 'normal'); // Revert to normal font after highlighting
        // Add the detailed description line by line
        centerText('Wholesale & Retail Dealers in Aquarium Supplies', currentY);
        currentY += PAGE_CONFIG.spacing.lineHeight;
        centerText('Tropical Fish, Tanks, Filters & Air Pumps,', currentY);
        currentY += PAGE_CONFIG.spacing.lineHeight;
        centerText('Fish Food, Aquatic Plants & Accessories', currentY);
        currentY += PAGE_CONFIG.spacing.lineHeight;
        centerText('Everything Your Pet Needs!', currentY);


        doc.setFontSize(8);
        currentY += PAGE_CONFIG.spacing.lineHeight;
        centerText('{{ $settings[9]->value}}', currentY);

        // Highlight the contact numbers
        currentY += PAGE_CONFIG.spacing.lineHeight;
        doc.setFontSize(11); // Adjust the size as needed
        doc.setFont('helvetica', 'bold'); // Switch to bold for highlighting
        centerText('{{ $settings[10]->value}} / {{ $settings[11]->value}}', currentY);
        doc.setFont('helvetica', 'normal'); // Revert to normal font after highlighting
        doc.setFontSize(8);

        currentY += PAGE_CONFIG.spacing.lineHeight;
        centerText('{{ $settings[12]->value}}', currentY);
;


    // Invoice title


    // SALE CODE
    currentY += 5; // Reduced gap before the new detail
    doc.setFontSize(8);
    centerText(`SALE CODE: ${saleCode}`, currentY);
    currentY += 5; // Reduced gap before the new detail

    const now = new Date();
    const reducedGap = PAGE_CONFIG.spacing.lineHeight;
    centerText('============================================', currentY);
    currentY += reducedGap;
    doc.text('DATE:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(now.toISOString().split('T')[0], PAGE_CONFIG.margins.left + 10, currentY);
    doc.text('TIME:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text(now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }), PAGE_CONFIG.margins.left + 56, currentY);

    currentY += reducedGap;
    doc.text('CUS:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(customerName.toUpperCase(), PAGE_CONFIG.margins.left + 8, currentY);
    doc.text('PTYPE:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text(paymentType.toUpperCase(), PAGE_CONFIG.margins.left + 56, currentY);

    currentY += reducedGap;
    doc.text('USER:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(userName.toUpperCase(), PAGE_CONFIG.margins.left + 10, currentY);
    doc.text('STYPE:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text((pricingType === 'wholesale' ? 'Wholesale' : 'Retail').toUpperCase(), PAGE_CONFIG.margins.left + 56, currentY);
    currentY += reducedGap;

    centerText('============================================', currentY);

    // Items header
    currentY += PAGE_CONFIG.spacing.lineHeight; // Use a smaller spacing value
doc.setFont('helvetica', 'bold');
doc.text('#', PAGE_CONFIG.margins.left + 1, currentY);
// doc.text('ITEM', PAGE_CONFIG.margins.left + 6, currentY);
// doc.text('QTY', PAGE_CONFIG.margins.left + 18, currentY);
// doc.text('PRICE', PAGE_CONFIG.margins.left + 30, currentY);
// doc.text('AMOUNT', PAGE_CONFIG.margins.left + 58, currentY);

doc.text('ITEM', PAGE_CONFIG.margins.left + 10, currentY);
doc.text('QTY', PAGE_CONFIG.margins.left + 26, currentY);
doc.text('PRICE', PAGE_CONFIG.width - 26, currentY, { align: 'right' });
doc.text('AMOUNT', PAGE_CONFIG.width - 7, currentY, { align: 'right' });

// Items
let rawTotal = 0;
let totalDiscount = 0;
let grandTotal = 0;

// Reverse the order of items
currentY += PAGE_CONFIG.spacing.lineHeight;
doc.setFont('helvetica', 'normal');

[...items].reverse().forEach((item, index) => { // Reverse the items array
    const price = pricingType === 'wholesale' ? item.wholesale_price : item.retail_price;
    const itemSubtotal = price * item.addQuantity;
    const itemDiscount = item.discount * item.addQuantity;
    const itemTotal = itemSubtotal - itemDiscount;

    rawTotal += itemSubtotal;
    totalDiscount += itemDiscount;
    grandTotal += itemTotal;

    doc.setFontSize(9);

    // Print item details
    doc.text(`${index + 1})`, PAGE_CONFIG.margins.left + 1, currentY);
    doc.setFont('helvetica', 'bold'); // Make item name bold
    doc.text(item.item_name.substring(0, 25).toUpperCase(), PAGE_CONFIG.margins.left + 10, currentY);
    doc.setFont('helvetica', 'normal'); // Revert back to normal font
    currentY += PAGE_CONFIG.spacing.lineHeight;

    doc.text(item.item_code, PAGE_CONFIG.margins.left + 10, currentY);
    doc.text(item.addQuantity.toString(), PAGE_CONFIG.margins.left + 28, currentY);

    // Right-align the price and itemTotal
    doc.text(price.toString(), PAGE_CONFIG.width - 26, currentY, { align: 'right' }); // Align price to the right
    doc.text(itemTotal.toFixed(2), PAGE_CONFIG.width - 7, currentY, { align: 'right' }); // Align item total to the right

    currentY += PAGE_CONFIG.spacing.lineHeight;

    // Add a small gap between items
    currentY += 1;     
});

doc.setFontSize(9);

    // Summary
    centerText('=======================================', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight; // Use a smaller spacing value

    const summaryItems = [
        ['TOTAL', rawTotal.toFixed(2)],
        ['DISCOUNT', totalDiscount.toFixed(2)],
        ['NET TOTAL', grandTotal.toFixed(2)],
        ['PAID', parseFloat(document.getElementById('r_amount')?.value || 0).toFixed(2)],
        ['CHANGE', parseFloat(document.getElementById('c_return')?.value || 0).toFixed(2)],
        ['TOTAL DUE', dueAmount.toFixed(2)]
    ];

    summaryItems.forEach(([label, value]) => {
        // Check if the label is RAW TOTAL or GRAND TOTAL to set bold font
        if (label === 'NET TOTAL') {
            doc.setFont('helvetica', 'bold');
        } else {
            doc.setFont('helvetica', 'normal');
        }

        doc.text(label, PAGE_CONFIG.margins.left, currentY);
        doc.text(':', PAGE_CONFIG.margins.left + 23, currentY);
        doc.text(value, PAGE_CONFIG.width - 7, currentY, { align: 'right' }); // Align item total to the right

        currentY += PAGE_CONFIG.spacing.lineHeight;
    });

    // Reset font to normal after the loop
    doc.setFont('helvetica', 'normal');


    // Footer
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(7);
    centerText('======== THANK YOU! VISIT AGAIN ========', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('# Fish and Aquatic Products can be exchanged within 07 days', currentY);

    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('# Original receipt must be shown for any exchanges.', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('# Water quality issues, transportation stress, or physical damage', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('after purchase are not covered under warranty.', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('------------------------------------------------------------', currentY);
    const currentYear = new Date().getFullYear();
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText(`Powered by PlexCode.`, currentY);


    // Generate and open PDF
    const pdfBlob = doc.output('blob');
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl, '_blank');
}












    function updateTotals() {
        const storedItems = JSON.parse(localStorage.getItem('items')) || [];

        let totalQuantity = 0;
        let totalAmount = 0;
        let grandTotal = 0;
        let totalDiscount = 0; // Total discount calculation

        storedItems.forEach(item => {
            totalQuantity += item.addQuantity || 0;
            totalAmount += (item[selectedPriceType + '_price'] * (item.addQuantity || 0)) || 0;

            // Calculate the item's subtotal considering the discount
            let itemSubtotal = item[selectedPriceType + '_price'] * (item.addQuantity || 0);
            let itemDiscount = (item.discount || 0 )* (item.addQuantity || 0);
            let discountedAmount = itemSubtotal - itemDiscount; // Apply discount

            grandTotal += discountedAmount; // Add the discounted amount to the grand total
            totalDiscount += itemDiscount; // Add the item’s discount to the total discount
        });

        // Update the DOM elements with the calculated totals
        document.getElementById('addQuantity').textContent = ` ${totalQuantity}`;
        document.getElementById('total-amount').textContent = ` ${totalAmount.toFixed(2)}`;
        document.getElementById('grand-total').textContent = ` ${grandTotal.toFixed(2)}`;
        document.getElementById('dis').textContent =` ${totalDiscount.toFixed(2)}`; // Update discount display

        // Set the itemDiscount value and disable the input field
        const itemDiscountInput = document.getElementById('itemDiscount');
        itemDiscountInput.value = totalDiscount.toFixed(2); // Set the total discount value
        itemDiscountInput.disabled = true; // Disable the input field to make it uneditable
    }



    function getDataForPaymentModal() {
    const storedItems = JSON.parse(localStorage.getItem('items')) || [];

    const totalProducts = storedItems.reduce((sum, item) => {
        return sum + (item.addQuantity || 0);
    }, 0);

    const totalAmount = storedItems.reduce((sum, item) => {
        const price = item[selectedPriceType + '_price'];
        const quantity = item.addQuantity || 0;
        return sum + (price * quantity);
    }, 0);

    const totalDiscount = storedItems.reduce((sum, item) => {
        const itemDiscount = (item.discount || 0) * (item.addQuantity || 0);
        return sum + itemDiscount;
    }, 0);

    const grandTotal = totalAmount - totalDiscount;

    document.getElementById('t_products').textContent = totalProducts;
    document.getElementById('t_amount').value = totalAmount.toFixed(2);
    document.getElementById('dis').value = totalDiscount.toFixed(2);
    document.getElementById('g_totals').value = grandTotal.toFixed(2);
    document.getElementById('g_total').value = grandTotal.toFixed(2);
}




    document.getElementById('retailButton').addEventListener('click', function() {
        location.reload();
        // Key to remove
const keyToRemove = "items";

// Remove the specific key
localStorage.removeItem(keyToRemove);

// Verify the key is removed
console.log(`${keyToRemove} removed!`);
console.log(localStorage);
 // Reload the page when the retail button is clicked
    });

    document.getElementById('wholesaleButton').addEventListener('click', function() {
        location.reload();
const keyToRemove = "items";

// Remove the specific key
localStorage.removeItem(keyToRemove);

// Verify the key is removed
console.log(`${keyToRemove} removed!`);
console.log(localStorage);
        // Reload the page when the wholesale button is clicked
    });


    // Default price type is 'retail'
    let selectedPriceType = localStorage.getItem('selectedPriceType') || 'retail';

    // Get buttons
    const retailButton = document.getElementById('retailButton');
    const wholesaleButton = document.getElementById('wholesaleButton');

    // Function to apply styles
    function applyButtonStyles(button, isSelected) {
        if (isSelected) {
            button.classList.add('bg-[{{ $settings[7]->value}}]', 'text-white');
            button.classList.remove('bg-white', 'text-black');
        } else {
            button.classList.add('bg-white', 'text-black');
            button.classList.remove('bg-[{{ $settings[7]->value}}]', 'text-white');
        }
    }

    // Initialize button styles based on saved selection
    applyButtonStyles(retailButton, selectedPriceType === 'retail');
    applyButtonStyles(wholesaleButton, selectedPriceType === 'wholesale');

    // Event listeners for price type buttons
    retailButton.addEventListener('click', () => {
        selectedPriceType = 'retail';
        localStorage.setItem('selectedPriceType', 'retail');
        applyButtonStyles(retailButton, true);
        applyButtonStyles(wholesaleButton, false);
        displayStoredItems(); // Update table based on selected price type
    });

    wholesaleButton.addEventListener('click', () => {
        selectedPriceType = 'wholesale';
        localStorage.setItem('selectedPriceType', 'wholesale');
        applyButtonStyles(retailButton, false);
        applyButtonStyles(wholesaleButton, true);
        displayStoredItems(); // Update table based on selected price type
    });

    function updatePrices() {
        const priceElements = document.querySelectorAll('.add-to-storage');

        priceElements.forEach(button => {
            const retailPrice = parseFloat(button.getAttribute('data-retail_price'));
            const wholesalePrice = parseFloat(button.getAttribute('data-wholesale_price'));

            const priceTextElement = button.querySelector('.price-text');
            if (selectedPriceType === 'retail') {
                priceTextElement.innerText = retailPrice.toFixed(2); // Show retail price
            } else {
                priceTextElement.innerText = wholesalePrice.toFixed(2); // Show wholesale price
            }
        });
    }

    // Initialize price display on page load
    updatePrices();

    // Function to handle adding items to the list
    function addItemToList(item) {
        const storedItems = JSON.parse(localStorage.getItem('items')) || [];

        // Store item with selected price type
        const price = selectedPriceType === 'retail' ? item.retail_price : item.wholesale_price;
        storedItems.push({
            id: item.id,
            item_name: item.item_name,
            item_code: item.item_code,
            price: price,
        });

        // Save updated list to local storage
        localStorage.setItem('items', JSON.stringify(storedItems));
        updateItemList(); // Update item list display
    }





    // Function to calculate price, discount, and subtotal for each row
    function priceCalc(index) {
        const addQuantity = parseInt(document.getElementById(`addQuantity-${index}`).value) ||1; // Default to 1 if invalid
        const priceSingle = parseFloat(document.getElementById(`price-single-${index}`).value) || 0;
        const discount = parseFloat(document.getElementById(`discount-${index}`).value) || 0;

        if (addQuantity < 1) {
            alert("addQuantity must be at least 1.");
            return;
        }

        // Calculate the total price for this row based on addQuantity
        const price = priceSingle * addQuantity;

        // Set the subtotal (price - discount)
        const subtotal = Math.max(price - (discount* addQuantity), 0); // Ensure subtotal is not negative
        // const tdiscount = Math.max((discount* addQuantity), 0);

        // Update the price and subtotal in the table
        document.getElementById(`price-${index}`).innerText = priceSingle.toFixed(2); // Always show the retail price
        document.getElementById(`subtotal-${index}`).innerText = subtotal.toFixed(2); // Update subtotal
        // document.getElementById(`tdiscount-${index}`).innerText = tdiscount.toFixed(2); // Update subtotal

        // Update the localStorage
        const storedItems = JSON.parse(localStorage.getItem('items')) || [];
        if (storedItems[index]) {
            storedItems[index].addQuantity = addQuantity;
            storedItems[index].subtotal = subtotal;
            storedItems[index].discount = discount;
            // storedItems[index].tdiscount = tdiscount;
            localStorage.setItem('items', JSON.stringify(storedItems));
        }

        // Recalculate the total of the subtotals
        updateTotals();
    }

    // Function to update the hold list count
    // function updateHoldListCount() {
    //     // Retrieve the hold list from localStorage (or wherever you store it)
    //     let holdList = JSON.parse(localStorage.getItem('holdList')) || [];

    //     // Get the count of items in the hold list
    //     const holdListCount = holdList.length;

    //     // Update the span element with the count
    //     document.getElementById('hold-list-count').textContent = holdListCount;
    // }

    // // Call the function to update the count when the page loads or hold list changes
    // updateHoldListCount();



    // Event listener for changes in addQuantity or discount input for specific row
    document.addEventListener('input', (event) => {
        if (event.target.classList.contains('addQuantity-input') || event.target.classList.contains(
                'discount-input')) {
            const index = event.target.dataset.index; // Use dataset index to identify which row
            priceCalc(index); // Calculate the price and subtotal for the affected row
        }
    });

    function updatePriceType(type) {
        const storedItems = JSON.parse(localStorage.getItem('items')) || [];
        storedItems.forEach((item, index) => {
            item.current_price = type === 'retail' ? item.retail_price : item.wholesale_price;
            item.subtotal = (item.current_price * item.addQuantity) - (item.discount * item.addQuantity);
            // item.tdiscount =(item.discount * item.addQuantity);
        });
        localStorage.setItem('items', JSON.stringify(storedItems));
        displayStoredItems(); // Refresh the table display
    }

    // Function to display items from localStorage
    function displayStoredItems() {

        const storedItems = JSON.parse(localStorage.getItem('items')) || [];
    const list = document.getElementById('stored-items');
    list.innerHTML = storedItems.map((item, index) =>
            `<tr class="text-black bg-white border-2">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium whitespace-normal cursor-pointer max-2xl:max-w-full"
                                            title="${item.item_name}">
                                            <div>
                                                <!-- Ensure long names wrap and break properly -->
                                                <span class="block break-words break-all">${item.item_name}</span>
                                                <span class="block text-xs text-gray-500">${item.item_code}</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="relative flex items-center w-full">
                                                <!-- Decrement Button -->
                                                <button type="button"
                                                    class="px-2 py-1 text-black bg-gray-200 rounded decrement-btn hover:bg-gray-300"
                                                    data-index="${index}"
                                                    onmousedown="startUpdateQuantity(${index}, 'decrease')"
                                                    onmouseup="stopUpdateQuantity()"
                                                    onmouseleave="stopUpdateQuantity()">-</button>

                                                <!-- Quantity Input -->
                                                <input
                                                    type="number"
                                                    id="addQuantity-${index}"
                                                    data-index="${index}"
                                                    class="addQuantity-input flex-shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[4rem] text-center"
                                                    placeholder="QTY"
                                                    value="${item.addQuantity || 1}"
                                                    min="1"
                                                    onchange="manualQuantityUpdate(${index}, this.value)"
                                                />

                                                <!-- Increment Button -->
                                                <button type="button"
                                                    class="px-2 py-1 text-black bg-gray-200 rounded increment-btn hover:bg-gray-300"
                                                    data-index="${index}"
                                                    onmousedown="startUpdateQuantity(${index}, 'increase')"
                                                    onmouseup="stopUpdateQuantity()"
                                                    onmouseleave="stopUpdateQuantity()">+</button>
                                            </div>
                                        </td>

                                    <td class="px-6 py-4">
                                        <input type="hidden" id="price-single-${index}" value="${item[selectedPriceType + '_price']}">
                                        <p id="price-${index}">${item[selectedPriceType + '_price']}</p>
                                    </td>
                                        <td class="px-6 py-4">
                                            <input
                                                type="number"
                                                id="discount-${index}"
                                                data-index="${index}"
                                                class="discount-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[4rem] p-1"
                                                placeholder="Discount"
                                                min="0"
                                                value="${item.discount || 0}"
                                            />
                                        </td>
                                        <!--
                                    <td class="px-6 py-4 id="tdiscount-${index}"">
                                        <input type="hidden" id="tdiscount-${index}" data-index="${index}"
                                            class="tdiscount-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="tdiscount" min="0" value="${ item.tdiscount}" />
                                            <p id="tdiscount-${index}">${item.tdiscount}</p>
                                    </td>-->
                                    <td class="px-6 py-4" id="subtotal-${index}">
                                    ${(item.subtotal || item[selectedPriceType + '_price'] * 1).toFixed(2)}<!-- Subtotal initially based on price -->
                                    </td> <!-- Subtotal will be calculated here -->
                                    <td class="px-6 py-4">
                                        <button class="p-2.5 text-red-600 border-2 border-red-500 hover:bg-red-50 rounded-full transition-all duration-200 hover:shadow-sm" onclick="removeItem(${index})" aria-label="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>`
        ).join('');

        // Update totals whenever items are displayed
        updateTotals();

    }

    let interval = null;

function startUpdateQuantity(index, action) {
    // Immediately update the quantity on button press
    updateQuantity(index, action);

    // Start a recurring update for hold functionality
    interval = setInterval(() => {
        updateQuantity(index, action);
    }, 100); // Adjust interval time as needed (e.g., 100ms)
}

function stopUpdateQuantity() {
    // Clear the interval when the button is released or the pointer leaves
    clearInterval(interval);
}

function manualQuantityUpdate(index, newQuantity) {
    const storedItems = JSON.parse(localStorage.getItem('items')) || [];
    const item = storedItems[index];

    // Ensure quantity is at least 1
    const parsedQuantity = Math.max(parseInt(newQuantity, 10) || 1, 1);

    item.addQuantity = parsedQuantity;

    // Update localStorage
    storedItems[index] = item;
    localStorage.setItem('items', JSON.stringify(storedItems));

    // Update input value to ensure it's valid
    document.getElementById(`addQuantity-${index}`).value = parsedQuantity;

    // Recalculate price
    priceCalc(index);
}

function updateQuantity(index, action) {
    // Retrieve stored items from local storage
    const storedItems = JSON.parse(localStorage.getItem('items')) || [];

    // Get the specific item by its index
    const item = storedItems[index];
    if (!item) return; // Exit if item does not exist

    // Adjust the quantity based on the action
    if (action === 'increase') {
        item.addQuantity = (item.addQuantity || 1) + 1; // Increment quantity
    } else if (action === 'decrease') {
        item.addQuantity = Math.max((item.addQuantity || 1) - 1, 1); // Decrement but not below 1
    }

    // Update the item's quantity in local storage
    storedItems[index] = item;
    localStorage.setItem('items', JSON.stringify(storedItems));

    // Update the input value in the DOM
    const quantityInput = document.getElementById(`addQuantity-${index}`);
    if (quantityInput) {
        quantityInput.value = item.addQuantity;
    }

    // Recalculate totals and update the display
    priceCalc(index);
}






    // Function to remove items from localStorage
    function removeItem(index) {
        const storedItems = JSON.parse(localStorage.getItem('items')) || [];
        storedItems.splice(index, 1); // Remove item from the array
        localStorage.setItem('items', JSON.stringify(storedItems)); // Update localStorage
        displayStoredItems(); // Refresh the list
    }
    // Function to add items to localStorage
    function addToLocalStorage(itemId, itemName, itemCode, addQuantity, purchasePrice, retailPrice, wholesalePrice) {
    const storedItems = JSON.parse(localStorage.getItem('items')) || [];
    const existingItemIndex = storedItems.findIndex(item => item.item_code === itemCode);

    if (existingItemIndex !== -1) {
        // If the item already exists, increment the quantity
        storedItems[existingItemIndex].addQuantity += parseInt(addQuantity, 10);
    } else {
        // If the item does not exist, add it as a new entry at the beginning of the array
        storedItems.unshift({
            id: itemId,
            item_name: itemName,
            item_code: itemCode,
            addQuantity: parseInt(addQuantity, 10),
            purchase_price: purchasePrice,
            retail_price: retailPrice,
            wholesale_price: wholesalePrice,
            discount: 0
        });
    }

    // Update localStorage and refresh the display
    localStorage.setItem('items', JSON.stringify(storedItems));
    displayStoredItems();
}


    // Event listeners for Add buttons
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.add-to-storage');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const itemId = button.getAttribute('data-id');
                const itemName = button.getAttribute('data-item_name');
                const itemCode = button.getAttribute('data-item_code');
                const addQuantity = button.getAttribute('data-addQuantity') ||1; // Default quantity is 1
                const purchasePrice = button.getAttribute('data-purchase_price');
                const retailPrice = button.getAttribute('data-retail_price');
                const wholesalePrice = button.getAttribute('data-wholesale_price');
                addToLocalStorage(itemId, itemName, itemCode, addQuantity, purchasePrice,
                    retailPrice, wholesalePrice);
            });
        });

        // Display stored items on page load
        displayStoredItems();
    });


    function addItemByCode() {
        const itemCode = document.getElementById('itemCodeInput').value.trim();
        const errorMessage = document.getElementById('itemError');
        errorMessage.textContent = ''; // Clear any previous errors

        if (!itemCode) {
            errorMessage.textContent = 'Item code is required!';
            return;
        }

        // Send a GET request to validate the item code
        fetch(`/items/validate/${itemCode}`)
            .then(response => response.json())
            .then(data => {
                if (data.valid) {
                    const newItem = {
                        item_code: data.item_code,
                        item_name: data.item_name,
                        addQuantity: 1, // Default quantity
                        purchase_price: data.purchase_price,
                        retail_price: data.retail_price,
                        wholesale_price: data.wholesale_price,
                        discount: 0
                    };

                    const storedItems = JSON.parse(localStorage.getItem('items')) || [];
                    const existingItemIndex = storedItems.findIndex(item => item.item_code === newItem.item_code);

                    if (existingItemIndex !== -1) {
                        // If the item exists, increase the quantity
                        storedItems[existingItemIndex].addQuantity += newItem.addQuantity;
                        storedItems[existingItemIndex].subtotal = (storedItems[existingItemIndex].current_price *
                                storedItems[existingItemIndex].addQuantity) - storedItems[existingItemIndex]
                            .discount;
                    } else {
                        // If item is new, add it to the storage
                        storedItems.push(newItem);
                    }

                    localStorage.setItem('items', JSON.stringify(storedItems));
                    displayStoredItems();
                    errorMessage.textContent = 'Item added successfully!';
                    document.getElementById('itemCodeInput').value = ''; // Clear input field
                } else {
                    errorMessage.textContent = 'Invalid item code!';
                }
            });
    }
    // Listen for Enter key press to trigger adding item
    document.getElementById('itemCodeInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission or page refresh
            addItemByCode(); // Call the function to add item
        }
    });

    // For opening the modal
    document.querySelector('[data-modal-target="payment-modal"]').addEventListener('click', function() {
        // Populate the modal data before showing it
        getDataForPaymentModal();
        document.getElementById('payment-modal').classList.remove('hidden');
    });

    // For closing the modal
    document.querySelector('[data-modal-hide="payment-modal"]').addEventListener('click', function() {
        document.getElementById('payment-modal').classList.add('hidden');
    });
</script>
<script>
    // Get dropdown and due amount display elements
    const customerDropdown = document.getElementById('customer');
    const dueAmountDisplay = document.getElementById('due-amount');

    // Event listener for customer selection
    customerDropdown.addEventListener('change', async function () {
        const selectedCustomerId = this.value;

        // Check if a valid customer is selected
        if (selectedCustomerId !== "-1") {
            try {
                // Fetch due amount for the selected customer
                const response = await fetch(`/customer-due/${selectedCustomerId}`);

                if (response.ok) {
                    const customerDue = await response.json();

                    // Update the display with both customer ID and due amount, and add "Pay" button
                    dueAmountDisplay.innerHTML = `
                        <p><span class="hidden text-blue-500" name="selectedCustomerId" id="selectedCustomerId">${selectedCustomerId}</span></p>
                        <p>Total Due Amount: <span class="text-red-500">${customerDue.total_due_amount}</span></p>
                        <button id="payButton" class="p-2 mt-2 text-white bg-[{{ $settings[7]->value}}] rounded-lg">Pay</button>
                    `;

                    // Store the selected customer ID and due amount in localStorage
                    localStorage.setItem('selectedCustomerId', selectedCustomerId);
                    localStorage.setItem('customerDueAmount', customerDue.total_due_amount);

                    // Add event listener for the "Pay" button
                    const payButton = document.getElementById('payButton');
                    payButton.addEventListener('click', function() {
                        // Open the payment route in a new tab
                        window.open(`/sales/payment_due/${selectedCustomerId}`, '_blank');
                    });
                } else {
                    throw new Error('Unable to fetch due amount');
                }
            } catch (error) {
                // Handle errors gracefully
                dueAmountDisplay.textContent = "Error fetching due amount.";
                console.error(error);
            }
        } else {
            // Reset display if no customer is selected
            dueAmountDisplay.innerHTML = "";

            // Remove the customer ID and due amount from localStorage if no customer is selected
            localStorage.removeItem('selectedCustomerId');
            localStorage.removeItem('customerDueAmount');
        }
    });

    // Optionally, you can initialize the dropdown and due amount from localStorage if needed
    const storedCustomerId = localStorage.getItem('selectedCustomerId');
    const storedDueAmount = localStorage.getItem('customerDueAmount');

    if (storedCustomerId && storedDueAmount) {
        customerDropdown.value = storedCustomerId; // Set the dropdown to the stored value
        dueAmountDisplay.innerHTML = `
            <p><span class="hidden text-blue-500" name="selectedCustomerId" id="selectedCustomerId">${storedCustomerId}</span></p>
            <p>Total Due Amount: <span class="text-red-500">${storedDueAmount}</span></p>
            <button id="payButton" class="p-2 mt-2 text-white bg-blue-500">Pay</button>
        `;

        // Add event listener for the "Pay" button
        const payButton = document.getElementById('payButton');
        payButton.addEventListener('click', function() {
            // Open the payment route in a new tab
            window.open(`/sales/payment_due/${storedCustomerId}`, '_blank');
        });
    }
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Reference the dropdown
        const customerDropdown = document.getElementById('customer');

        // Always set the customer ID to 1
        const defaultCustomerId = "1";

        // Set the dropdown value to 1
        customerDropdown.value = defaultCustomerId;

        // Optionally, you can trigger the change event to update other dependent UI
        const event = new Event('change', { bubbles: true });
        customerDropdown.dispatchEvent(event);

        document.getElementById('commission').value = '';
        document.getElementById('cheque_no').value = '';
        document.getElementById('cheque_date').value = '';
        document.getElementById('notes').value = '';
        document.getElementById('r_amount').value = '';
        document.getElementById('c_return').value = '';

    });
</script>




</html>


<script>
    // Function to toggle fullscreen mode
    function toggleFullScreen() {
        // Check if the browser is already in fullscreen
        if (!document.fullscreenElement) {
            // If not in fullscreen, request fullscreen
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                document.documentElement.msRequestFullscreen();
            }

            // Change the icon to the exit fullscreen icon
            document.getElementById("fullscreen-icon").innerHTML = '<i class="fas fa-compress"></i>'; // Modern Exit fullscreen icon
        } else {
            // If already in fullscreen, exit fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // IE/Edge
                document.msExitFullscreen();
            }

            // Change the icon back to fullscreen icon
            document.getElementById("fullscreen-icon").innerHTML = '<i class="fas fa-expand"></i>'; // Fullscreen icon
        }
    }
</script>


