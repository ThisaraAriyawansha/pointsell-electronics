<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings[6]->value}} | Control Panel</title>
    <link rel="icon" href="./{{ $settings[13]->value}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles/common.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: {{ $settings[7]->value }};
            --text-color: {{ $settings[15]->value }};
            --accent-color: {{ $settings[14]->value }};
        }
        
        body {

            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        .glass-card {
            background: rgba(30, 30, 40, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.36);
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .nav-gradient {
            background: linear-gradient(90deg, var(--primary-color) 0%, #1a1a2e 100%);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        
        .icon-hover {
            transition: all 0.3s ease;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3));
        }
        
        .icon-hover:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 6px 8px rgba(0, 0, 0, 0.4));
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(var(--primary-color), 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(var(--primary-color), 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(var(--primary-color), 0);
            }
        }
        
        .notification-slide {
            animation: slideIn 0.5s forwards, fadeOut 0.5s 3.5s forwards;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden">
    <!-- Floating Particles Background -->
    <div class="particles">
        <div class="absolute w-2 h-2 bg-blue-500 rounded-full opacity-20" style="top: 20%; left: 10%;"></div>
        <div class="absolute w-3 h-3 bg-purple-500 rounded-full opacity-15" style="top: 60%; left: 80%;"></div>
        <div class="absolute w-1 h-1 rounded-full opacity-25 bg-cyan-400" style="top: 30%; left: 50%;"></div>
    </div>

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-50 flex items-center justify-between w-full px-6 py-4 nav-gradient">
        <!-- Logo with Holographic Effect -->
        <div class="flex items-center space-x-3">
            <div class="relative">
                <img src="{{ asset('' . $siteSetting->company_logo) }}" alt="Logo" 
                     class="object-contain w-12 h-12 rounded-lg pulse-animation">
                <div class="absolute inset-0 bg-blue-500 rounded-lg mix-blend-overlay opacity-20"></div>
            </div>
            <h1 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                {{ $settings[6]->value }}
            </h1>
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

    <!-- Main Content -->
    <main class="container relative z-10 px-4 py-8 mx-auto" >
        <!-- Notifications -->
        <div class="fixed z-50 space-y-3 top-20 right-4 w-80">
            {{-- Validation Errors Summary --}}
            @if ($errors->any())
                <div class="px-4 py-3 text-red-300 border-l-4 border-red-500 rounded-lg shadow-lg notification-slide glass-card">
                    <strong class="font-bold">Validation Error</strong>
                    <ul class="mt-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start">
                                <i class="mt-1 mr-2 fas fa-exclamation-circle"></i>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
                <div class="px-4 py-3 text-green-300 border-l-4 border-green-500 rounded-lg shadow-lg notification-slide glass-card">
                    <div class="flex items-center">
                        <i class="mr-2 fas fa-check-circle"></i>
                        <strong>Success</strong>
                    </div>
                    <p class="mt-1 text-sm">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="px-4 py-3 text-red-300 border-l-4 border-red-500 rounded-lg shadow-lg notification-slide glass-card">
                    <div class="flex items-center">
                        <i class="mr-2 fas fa-exclamation-triangle"></i>
                        <strong>Error</strong>
                    </div>
                    <p class="mt-1 text-sm">{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 " >
            @if (has_permission(17))
                <a href="{{ asset('dash/dash') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/dash.svg" class="w-12 h-12" alt="Dashboard">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-blue-300">Dashboard</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">System Overview</p>
                    </div>
                </a>
            @endif

            @if (has_permission(18))
                <a href="{{ asset('sales/billing') }}" target="_blank" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-green-500 to-green-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/billing.svg" class="w-12 h-12" alt="Billing">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-green-300">Billing</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Create Invoices</p>
                    </div>
                </a>
            @endif

            @if (has_permission(19))
                <a href="{{ asset('item/item') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/items.svg" class="w-12 h-12" alt="Items">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-purple-300">Items</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Product Management</p>
                    </div>
                </a>
            @endif

            @if (has_permission(25))
                <a href="{{ asset('expenses/expenses') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-red-500 to-red-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/expenses.svg" class="w-12 h-12" alt="Items">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-red-300">Expences</h3>
                        <p class="mt-1 text-xs text-center text-gray-400">Expences Management</p>
                    </div>
                </a>
            @endif

            @if (has_permission(20))
                <a href="{{ asset('stock/stock') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/stock.svg" class="w-12 h-12" alt="Stock">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-yellow-300">Stock</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Inventory Control</p>
                    </div>
                </a>
            @endif

            @if (has_permission(21))
                <a href="{{ asset('sales/sales') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-red-500 to-red-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/sales.svg" class="w-12 h-12" alt="Sales">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-red-300">Sales</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Transaction History</p>
                    </div>
                </a>
            @endif

            @if (has_permission(22))
                <a href="{{ asset('users/users') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-cyan-500 to-cyan-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/users.svg" class="w-12 h-12" alt="Users">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-cyan-300">Users</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Access Management</p>
                    </div>
                </a>
            @endif

            @if (has_permission(23))
                <a href="{{ asset('customers/customers') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-pink-500 to-pink-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/customer.svg" class="w-12 h-12" alt="Customers">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-pink-300">Customers</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Client Database</p>
                    </div>
                </a>
            @endif

            @if (has_permission(24))
                <a href="{{ asset('suppliers/suppliers') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-orange-500 to-orange-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/suppliers.svg" class="w-12 h-12" alt="Suppliers">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-orange-300">Suppliers</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Vendor Network</p>
                    </div>
                </a>
            @endif

            @if (has_permission(26))
                <a href="{{ asset('reports/reports') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/reports.svg" class="w-12 h-12" alt="Reports">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-indigo-300">Reports</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Business Analytics</p>
                    </div>
                </a>
            @endif

            @if (has_permission(27))
                <a href="{{ asset('settings/settings') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-gray-500 to-gray-700 icon-hover">
                            <img src="../images/main-panel/btn-icons/settings.svg" class="w-12 h-12" alt="Settings">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-gray-300">Settings</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">System Configuration</p>
                    </div>
                </a>
            @endif
            
            @if (has_permission(83))
                <a href="{{ asset('reports/stockReports') }}" class="group">
                    <div class="flex flex-col items-center h-full p-6 glass-card rounded-xl" style="background: {{ $settings[7]->value }}; color: #e0e0e0;">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-teal-500 to-teal-700 icon-hover">
                            <img src="../images/reports/ItemStockReport.png" class="w-12 h-12" alt="Stock Report">
                        </div>
                        <h3 class="text-lg font-semibold text-center transition-colors group-hover:text-teal-300">Stock Report</h3>
                        <p class="mt-1 text-xs text-center text-gray-300">Inventory Analysis</p>
                    </div>
                </a>
            @endif
        </div>
    </main>


    <script>
        // Auto-hide notifications
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const notifications = document.querySelectorAll('.notification-slide');
                notifications.forEach(notification => {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 500);
                });
            }, 4000);
        });
    </script>
</body>
</html>