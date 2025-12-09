<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $settings[6]->value}} | Welcome</title>
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
    </style>
</head>
<script>
    // Initialize an array to hold all rows' data
    let allData = [];
</script>
<body class="h-dvh max-lg:h-fit" onload="allPriceCalc();">
    <!--Nav-->
    <header class="sticky top-0 z-50 flex items-center justify-between w-full px-6 py-4 nav-gradient" style="background: {{ $settings[7]->value }};">
    <!-- Back Button -->
    <div class="flex items-center">
        <button onclick="window.history.back();" class="relative mr-4 group">
            <div class="flex items-center justify-center w-10 h-10 transition-all rounded-full bg-gradient-to-br from-blue-500 to-purple-600 group-hover:rotate-1">
                <i class="text-white fas fa-arrow-left"></i>
            </div>
            <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-black rounded opacity-0 -bottom-7 left-1/2 bg-opacity-70 group-hover:opacity-100 whitespace-nowrap">
                Go Back
            </span>
        </button>

        <!-- Logo with Holographic Effect and Navigation -->
        <div class="flex items-center space-x-3 cursor-pointer" onclick="window.location.href = '/dashboard';">
            <div class="relative">
                <img src="{{ asset($siteSetting->company_logo) }}" alt="Logo" 
                     class="object-contain w-12 h-12 rounded-lg pulse-animation">
                <div class="absolute inset-0 bg-blue-500 rounded-lg mix-blend-overlay opacity-20"></div>
            </div>
            <h1 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                {{ $settings[6]->value }}
            </h1>
        </div>
    </div>

    <!-- User Controls -->
    <div class="flex items-center space-x-6">
        <div class="text-right">
            <p class="text-sm text-gray-300">Welcome back,</p>
            <p class="font-medium text-white">{{ $siteSetting->site_name }}</p>
        </div>
        
        <!-- Logout Button with Hover Effect -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="relative group">
                <div class="flex items-center justify-center w-10 h-10 transition-all rounded-full bg-gradient-to-br from-blue-500 to-purple-600 group-hover:rotate-12">
                    <i class="text-white fas fa-sign-out-alt"></i>
                </div>
                <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-black rounded opacity-0 -bottom-7 left-1/2 bg-opacity-70 group-hover:opacity-100 whitespace-nowrap">
                    Sign Out
                </span>
            </button>
        </form>
    </div>
</header>
