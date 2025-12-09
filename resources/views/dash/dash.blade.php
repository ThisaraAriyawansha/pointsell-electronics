@include('layouts.header')

<!-- Main Content Area -->
<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Header -->
    <div class="px-8 py-6 bg-white shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-light text-gray-800">Dashboard</h1>
                <p class="text-gray-500">Welcome back! Here's what's happening today.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Current Date</p>
                    <p class="font-medium">{{ now()->format('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Grid -->
    <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        <!-- Total Sales -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Sales</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 bg-blue-500 rounded-full" style="width: 85%"></div>
                </div>
            </div>
        </div>

        <!-- Sales Due -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Sales Due</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($totalDue, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-amber-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 rounded-full bg-amber-500" style="width: 65%"></div>
                </div>
            </div>
        </div>

        <!-- Today's Sales -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Today's Sales</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($todaySales, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-green-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 bg-green-500 rounded-full" style="width: 75%"></div>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Expenses</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($totalExpenses, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 bg-red-500 rounded-full" style="width: 45%"></div>
                </div>
            </div>
        </div>

        <!-- Today's Expenses -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Today's Expenses</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($todayExpenses, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 bg-purple-500 rounded-full" style="width: 30%"></div>
                </div>
            </div>
        </div>

        <!-- Payment Received -->
        <div class="p-6 transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Payment Received</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-800">Rs. {{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-indigo-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 bg-gray-200 rounded-full">
                    <div class="h-1 bg-indigo-500 rounded-full" style="width: 90%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Metrics and Charts -->
    <div class="grid grid-cols-1 gap-6 p-8 lg:grid-cols-3">
        <!-- Entity Counts -->
        <div class="p-6 bg-white shadow-sm rounded-xl">
            <h3 class="text-lg font-medium text-gray-800">System Overview</h3>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="p-4 text-center border border-gray-100 rounded-lg">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="mt-2 text-xl font-semibold text-gray-700">{{ $customerCount }}</h4>
                    <p class="text-sm text-gray-500">Customers</p>
                </div>
                <div class="p-4 text-center border border-gray-100 rounded-lg">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h4 class="mt-2 text-xl font-semibold text-gray-700">{{ $supplierCount }}</h4>
                    <p class="text-sm text-gray-500">Suppliers</p>
                </div>
                <div class="p-4 text-center border border-gray-100 rounded-lg">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h4 class="mt-2 text-xl font-semibold text-gray-700">{{ $itemCount }}</h4>
                    <p class="text-sm text-gray-500">Items</p>
                </div>
                <div class="p-4 text-center border border-gray-100 rounded-lg">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                    </div>
                    <h4 class="mt-2 text-xl font-semibold text-gray-700">{{ $invoiceCount }}</h4>
                    <p class="text-sm text-gray-500">Invoices</p>
                </div>
            </div>
        </div>

        <!-- Sales Chart -->
        <div class="p-6 bg-white shadow-sm rounded-xl lg:col-span-2">
            <div class="flex items-center justify-between">
                <div class="flex space-x-2">
                    <button id="chartBtn" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Chart
                    </button>
                    <button id="tableBtn" class="px-4 py-2 text-sm font-medium text-gray-800 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Stock Alerts
                    </button>
                </div>
            </div>
            <div id="chart" class="mt-6">
            <h3 class="text-lg font-medium text-gray-800">Sales Chart</h3>
                <div id="labels-chart"></div>
            </div>
            <div id="table" class="hidden mt-6 overflow-hidden rounded-lg">
         <h3 class="text-lg font-medium text-gray-800">Item Stock</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                    Item Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                    Current Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                    Minimum Quantity
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($items as $item)
                            <tr class="{{ $item->quantity < $item->minimum_qty ? 'bg-red-50' : 'hover:bg-gray-50' }}">
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->item_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $item->minimum_qty }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    
</div>

@include('layouts.footer')

<script>
    // Toggle between chart and table
    const chartBtn = document.getElementById("chartBtn");
    const tableBtn = document.getElementById("tableBtn");
    const chart = document.getElementById("chart");
    const table = document.getElementById("table");

    chartBtn.addEventListener("click", () => {
        chartBtn.classList.add("bg-gray-800", "text-white");
        chartBtn.classList.remove("bg-gray-100", "text-gray-800");
        tableBtn.classList.add("bg-gray-100", "text-gray-800");
        tableBtn.classList.remove("bg-gray-800", "text-white");
        chart.classList.remove("hidden");
        table.classList.add("hidden");
    });

    tableBtn.addEventListener("click", () => {
        tableBtn.classList.add("bg-gray-800", "text-white");
        tableBtn.classList.remove("bg-gray-100", "text-gray-800");
        chartBtn.classList.add("bg-gray-100", "text-gray-800");
        chartBtn.classList.remove("bg-gray-800", "text-white");
        table.classList.remove("hidden");
        chart.classList.add("hidden");
    });

    // ApexCharts configuration
    const monthlySalesData = @json($monthlySales);
    
    const options = {
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            fontFamily: 'Inter, sans-serif',
            foreColor: '#6B7280'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return 'Rs.' + value.toLocaleString();
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return 'Rs.' + value.toLocaleString();
                }
            }
        },
        colors: ['#3B82F6'],
        series: [{
            name: 'Sales',
            data: monthlySalesData
        }],
        grid: {
            borderColor: '#F3F4F6',
            strokeDashArray: 4,
            padding: {
                top: 0,
                right: 16,
                bottom: 0,
                left: 16
            }
        }
    };

    if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("labels-chart"), options);
        chart.render();
    }
</script>