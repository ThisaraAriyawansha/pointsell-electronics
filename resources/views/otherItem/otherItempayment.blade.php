@include('layouts.header')
<style>
/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    padding-top: 60px;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 30px;
    border: 1px solid #ddd;
    width: 80%;
    max-width: 500px;
    position: relative;
    text-align: center;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-100px);
    animation: modalAppear 0.3s ease-out forwards;
}

@keyframes modalAppear {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 0;
    right: 10px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #333;
    text-decoration: none;
}

.modal-btn {
    padding: 12px 25px;
    background-color: {{ $settings[7]->value }};
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    display: inline-block;
    margin-top: 20px;
    border-radius: 8px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.modal-btn:hover {
    transform: scale(1.05);
}

.modal-btn:focus {
    outline: none;
}

#modalMessage {
    font-size: 18px;
    color: #333;
    margin-bottom: 20px;
    font-weight: 600;
}
</style>

<br/>

<body class="p-6 font-sans bg-gray-50">
    <div class="max-w-4xl p-8 mx-auto transition-shadow duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
        <h1 class="mb-8 text-3xl font-bold text-gray-800">Order Details</h1>

        <!-- Customer Details -->
        <div class="mb-8">
            <h2 class="mb-6 text-xl font-semibold text-gray-700">Customer Information</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                    <p class="text-gray-800">{{ $customer->customer_name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="text-gray-800">{{ $customer->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <p class="text-gray-800">{{ $customer->city_name }}, {{ $customer->address_line_1 }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <p class="text-gray-800">{{ $customer->contact_number }}</p>
                </div>
            </div>

            <!-- Select Fields for Payment Type & Warranty Period -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:flex lg:space-x-6">
                <!-- Payment Type -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700">Payment Type</label>
                    <select class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500" name="payment_type" id="payment_type">
                        <option value="Cash">Cash</option>
                        <option value="Visa">Visa</option>
                        <option value="Master Card">Master Card</option>
                        <option value="Koko">Koko</option>

                    </select>
                </div>

                <!-- Warranty Period -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700">Warranty Period</label>
                    <select class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500" name="warranty" id="warranty">
                        <option value="No Warranty">No Warranty</option>
                        <option value="3 Months">3 Months</option>
                        <option value="6 Months">6 Months</option>
                        <option value="1 Year">1 Year</option>
                        <option value="2 Years">2 Years</option>
                    </select>
                </div>
            </div>
        </div>


        <!-- Ordered Items -->
        <div class="mt-8">
            <h2 class="mb-6 text-xl font-semibold text-gray-700">Ordered Items</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-4 font-medium text-gray-700">Serial Number</th>
                            <th class="p-4 font-medium text-gray-700">Item Name</th>
                            <th class="p-4 font-medium text-gray-700">Total Price</th>
                        </tr>
                    </thead>
                    <tbody id="orderItemsTable">
                        @foreach ($units as $unit)
                            <tr class="transition duration-200 border-b hover:bg-gray-50" data-unitid="{{ $unit->id }}">
                                <td class="p-4 text-gray-600">{{ $unit->serial_number }}</td>
                                <td class="p-4 text-gray-600">{{ $unit->item->name }}</td>
                                <td class="p-4 text-gray-600 rental-price" data-price="{{ $unit->item->retail_price }}">
                                    {{ number_format($unit->item->retail_price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full p-4 bg-gray-100 shadow-md">
                <p class="text-lg font-semibold text-right md:text-xl lg:text-2xl">
                    Total: <span id="total" class="block md:inline">{{ number_format($totalPrice, 2) }}</span>
                </p>
            </div>

        </div>

        <!-- Place Order Button -->
        <div class="mt-8 text-center">
            <button id="placeOrderButton" class="px-8 py-3 font-semibold text-white transition duration-200 bg-[{{ $settings[7]->value }}] rounded-lg hover:bg-[{{ $settings[7]->value }}] focus:ring-2 focus:ring-offset-2">
                Place Order
            </button>
        </div>
    </div>

    <!-- Modal structure -->
    <div id="customAlert" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2 id="modalMessage"></h2>
            <button id="modalButton" class="modal-btn">OK</button>
        </div>
    </div>

@include('layouts.footer')



<script>
document.addEventListener('DOMContentLoaded', function() {
    const placeOrderButton = document.getElementById('placeOrderButton');
    const modal = document.getElementById('customAlert');
    const modalMessage = document.getElementById('modalMessage');
    const modalButton = document.getElementById('modalButton');
    const closeModal = document.getElementById('closeModal');

    placeOrderButton.addEventListener('click', function() {
        // Get selected payment type and warranty

        const paymentType = document.getElementById("payment_type").value;
        const warranty = document.getElementById("warranty").value;

        
        // Get all unit IDs from the table
        const unitIds = Array.from(document.querySelectorAll('#orderItemsTable tr'))
            .map(row => row.getAttribute('data-unitid'));
            
        // Get total price
        const total = document.getElementById('total').textContent.replace(/,/g, '');

        // Prepare data for the request
        const orderData = {
            customer_id: {{ $customer->id }},
            total: total,
            payment_type: paymentType,
            warranty: warranty,
            unit_ids: unitIds
        };

        // Send AJAX request to the server
        fetch('/place-other-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
        // Open invoice in new tab for printing
        window.open(`/other-payment/${data.invoice_num}`, '_blank');
        // Optional: redirect current page
            } else {
                modalMessage.textContent = 'Error: ' + data.message;
                modal.style.display = 'block';
                modalButton.onclick = function() {
                    modal.style.display = 'none';
                };
            }
        })
        .catch(error => {
            modalMessage.textContent = 'An error occurred: ' + error.message;
            modal.style.display = 'block';
            modalButton.onclick = function() {
                modal.style.display = 'none';
            };
        });
    });

    // Close modal when clicking X or outside
    closeModal.onclick = function() {
        modal.style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});
</script>