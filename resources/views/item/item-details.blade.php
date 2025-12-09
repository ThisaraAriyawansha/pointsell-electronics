<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->item_name }} - Item Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script> <!-- Lucide Icons -->
    <style>
        body {
            background: #ffffff;
            color: #333333;
            font-family: 'Inter', sans-serif;
        }
        .card {
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        .header-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            color: #222222;
        }
        .price-box {
            background: #eeeeee;
            padding: 16px;
            border-radius: 8px;
        }
    </style>
</head>
<body class="font-sans antialiased">



<main class="flex items-center justify-center min-h-screen px-6 py-10">
    <div class="w-full max-w-5xl p-8 overflow-hidden card">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <div class="flex items-center justify-center">
                <img src="{{ $item->getImageUrlAttribute() }}" alt="{{ $item->item_name }}"
                    class="w-full h-auto max-w-sm rounded-lg shadow-md">
            </div>
            <div class="space-y-6">
                <h2 class="flex items-center text-3xl font-bold text-gray-800">
                    <i data-lucide="package" class="w-6 h-6 mr-2 text-gray-600"></i>
                    {{ $item->item_name }}
                </h2>
                <p class="flex items-center text-gray-600">
                    <i data-lucide="barcode" class="w-5 h-5 mr-2 text-gray-600"></i>
                    <strong class="text-gray-700">Item Code:</strong> {{ $item->item_code }}
                </p>
                <p class="flex items-center text-gray-600">
                    <i data-lucide="layers" class="w-5 h-5 mr-2 text-gray-600"></i>
                    <strong class="text-gray-700">Category:</strong> {{ $item->category->categories ?? 'N/A' }}
                </p>
                <p class="flex items-center text-gray-600">
                    <i data-lucide="tag" class="w-5 h-5 mr-2 text-gray-600"></i>
                    <strong class="text-gray-700">Subcategory:</strong> {{ $item->subcategory->name ?? 'N/A' }}
                </p>
                <p class="flex items-center text-gray-600">
                    <i data-lucide="box" class="w-5 h-5 mr-2 text-gray-600"></i>
                    <strong class="text-gray-700">Quantity:</strong> {{ $item->quantity }}
                </p>
                
                <div class="price-box">
                    <p class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                        <i data-lucide="dollar-sign" class="w-5 h-5 mr-2 text-gray-800"></i>
                        Pricing
                    </p>
                    <p class="flex items-center text-gray-600">
                        <i data-lucide="shopping-cart" class="w-5 h-5 mr-2 text-gray-600"></i>
                        <strong class="text-gray-700">Retail Price:</strong> 
                        <span class="font-bold">Rs.{{ number_format($item->retail_price, 2) }}</span>
                    </p>
                    <p class="flex items-center text-gray-600">
                        <i data-lucide="store" class="w-5 h-5 mr-2 text-gray-600"></i>
                        <strong class="text-gray-700">Wholesale Price:</strong> 
                        <span class="font-bold">Rs.{{ number_format($item->wholesale_price, 2) }}</span>
                    </p>
                </div>
            </div>
        </div>
        <footer class="py-6 text-center">
        <p>{{ now()->year }} © All Rights Reserved | {{ $settings[6]->value }} | Designed by Silicon Radon Networks (Pvt) Ltd</p>
    </footer>
    </div>
</main>




    <script>
        lucide.createIcons();
    </script>

</body>
</html>
