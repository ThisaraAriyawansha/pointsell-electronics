<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .form-card {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .form-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .input-field {
            transition: all 0.2s ease;
        }
        .input-field:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }
        .submit-btn {
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
        }
        .product-card {
            background-color: #f3f4f6;
            border-radius: 12px;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-gradient-to-r from-blue-50 to-indigo-50">
    <div class="w-full max-w-4xl p-0 bg-white form-card">
        <div class="p-6 text-white bg-gradient-to-r from-indigo-600 to-blue-500">
            <h1 class="text-2xl font-bold text-center md:text-3xl">Customer Information</h1>
            <p class="mt-2 text-center text-indigo-100">Complete your purchase details below</p>
        </div>
        
        <div class="p-6 md:p-8">
            <div class="flex flex-col gap-8 md:flex-row">
                <!-- Form Section -->
                <form id="customerForm" action="{{ route('mobile.completePurchase', ['imei_id' => $imeiDetails->id]) }}" method="POST" class="w-full space-y-5 md:w-1/2">
    @csrf
    <h2 class="flex items-center mb-4 text-lg font-semibold text-gray-700">
        <i class="mr-2 text-indigo-500 fas fa-user-circle"></i>
        Personal Details
    </h2>
    <!-- Form Fields (Full Name, Email, Phone, Address) -->
    <div class="relative">
        <label for="fullName" class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="fullName" name="fullName" required class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm">
    </div>
    <!-- More fields like email, phone, address, etc. -->
    <div class="relative">
        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm">
    </div>

    <div class="relative">
        <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Phone Number</label>
        <input type="tel" id="phone" name="phone" required class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm">
    </div>

    <div class="relative">
        <label for="address" class="block mb-1 text-sm font-medium text-gray-700">Address</label>
        <input type="text" id="address" name="address" required class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm">
    </div>

    <!-- Hidden fields for card details -->
    <input type="hidden" id="cardNumber" name="cardNumber" value="">
    <input type="hidden" id="expiryDate" name="expiryDate" value="">
    <input type="hidden" id="cvv" name="cvv" value="">

    <!-- Submit Button -->
    <div class="mt-8 text-center">
        <button type="submit" class="flex items-center justify-center px-8 py-3 mx-auto text-white rounded-lg shadow-md bg-gradient-to-r from-indigo-600 to-blue-500">
            <i class="mr-2 fas fa-credit-card"></i>
            Complete Purchase
        </button>
    </div>
</form>


                <!-- Product Information Section -->
                <div class="flex flex-col w-full gap-5 mt-8 md:w-1/2 md:mt-0">
                    <div class="p-6 product-card">
                        <h2 class="flex items-center mb-4 text-lg font-semibold text-gray-700">
                            <i class="mr-2 text-indigo-500 fas fa-mobile-alt"></i>
                            Product Information
                        </h2>
                        
                        <div class="flex items-center justify-center hidden mb-6">
                            <div class="p-3 bg-white rounded-full shadow-md">
                                <i class="text-5xl text-indigo-500 fas fa-mobile-alt"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Device</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $imeiDetails->mobileItem->name }}</p>
                                </div>
                            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-500">IMEI No</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $imeiDetails->imei_number }}</p>
                                </div>
                            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Color</p>
                                
                                @php
                                $colorMap = [
                                    'Red' => '#ff0000',
                                    'Blue' => '#0000ff',
                                    'Green' => '#008000',
                                    'Black' => '#000000',
                                    'White' => '#ffffff',
                                    'Gray' => '#808080',
                                    'Yellow' => '#ffff00',
                                    'Silver' => '#c0c0c0',
                                    'Gold' => '#ffd700',
                                    'Rose Gold' => '#b76e79',
                                    'Midnight Green' => '#004953',
                                    'Space Gray' => '#535353',
                                    'Pacific Blue' => '#1b4f72',
                                    'Phantom Black' => '#1c1c1c',
                                    'Mystic Bronze' => '#cd7f32',
                                    'Titanium' => '#878681',
                                    'Graphite' => '#383838',
                                    'Ocean Blue' => '#0077be',
                                    'Lavender' => '#967bb6',
                                    'Mint Green' => '#98ff98',
                                    'Coral' => '#ff7f50',
                                    'Bronze' => '#b08d57'
                                ];

                                $colorName = ucwords(strtolower($imeiDetails->mobileItem->color->name ?? ''));
                                $colorCode = $colorMap[$colorName] ?? '#ccc';
                            @endphp

                            <div class="flex items-center">
                                <div class="w-3 h-3 mr-2 rounded-full" style="background-color: {{ $colorCode }}"></div>
                                <p class="text-sm font-semibold text-gray-700">{{ $colorName ?: 'N/A' }}</p>
                            </div>



                            </div>
                            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-500">Storage</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $imeiDetails->mobileItem->storage->name ?? 'N/A' }}</p>
                                </div>
                            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-500">RAM</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $imeiDetails->mobileItem->ram->name ?? 'N/A' }}</p>
                                </div>
                        </div>
                        
                        @php
                            $taxRate = $imeiDetails->mobileItem->tax / 100; // Tax percentage from the database
                            $priceWithTax = $imeiDetails->mobileItem->mrp_price * (1 + $taxRate);
                        @endphp

                        <div class="p-4 mt-6 rounded-lg bg-blue-50">
                            <div class="flex items-center justify-between">
                                <p class="text-base font-medium text-gray-700">Total Price (Incl. Tax):</p>
                                <p class="text-xl font-bold text-indigo-600">Rs. {{ number_format($priceWithTax, 2) }}/=</p>
                            </div>
                        </div>

                    </div>
                    <!--
                    <div class="mt-4 text-sm text-center text-gray-500">
                        <p>Secure payment processing. All information is encrypted.</p>
                        <div class="flex justify-center mt-2 space-x-2">
                            <i class="text-xl text-gray-600 fab fa-cc-visa"></i>
                            <i class="text-xl text-gray-600 fab fa-cc-mastercard"></i>
                            <i class="text-xl text-gray-600 fab fa-cc-amex"></i>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>
