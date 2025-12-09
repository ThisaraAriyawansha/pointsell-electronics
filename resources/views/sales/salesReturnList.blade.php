@include('layouts.header')
    <div class="flex flex-col flex-grow">
        <!--breadcrumbs-->
        <div class="px-12 py-5 max-sm:px-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <p class="inline-flex items-center text-sm font-medium text-gray-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Sales</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Sales Return List</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--submission controls-->
        <!--search-->
        <div class="flex items-center w-1/2 gap-3 px-12 py-5 max-sm:px-6 max-md:w-full">
            <input type="text" id="search_sale_ret"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter sale code" required />
            <button onclick="filterSales();" class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg">Search</button>
        </div>


        <!--table-->
        <div class="flex flex-col px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative h-[500px] overflow-x-auto">
            <table id="salesRetTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
        <tr>
            <th scope="col" class="px-6 py-3 rounded-tl-lg">
                Item Name
            </th>
            <th scope="col" class="px-6 py-3">
                Price (Rs.)
            </th>
            <th scope="col" class="px-6 py-3">
                Discount (Rs.)
            </th>
            <th scope="col" class="px-6 py-3">
                Subtotal (Rs.)
            </th>
            <th scope="col" class="px-6 py-3">
                Quantity
            </th>
            <th scope="col" class="px-6 py-3">
                Return Quantity
            </th>
            <th scope="col" class="px-6 py-3">
                For Permanently Remove
            </th>
            <th scope="col" class="px-6 py-3 rounded-tr-lg">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
    {{--
    @foreach($sales as $sale)
    @foreach($sale->salesItems as $salesItem)
        <tr class="text-black bg-white border-2"
            data-sale-id="{{ $sale->id }}" 
            data-item-id="{{ $salesItem->items_id }}">
            <td class="px-6 py-4">
                {{ $salesItem->item->item_name ?? 'Item not found' }}
            </td>
            <td class="px-6 py-4">
                {{ $salesItem->item ? $salesItem->item->retail_price : '0.00' }}
            </td>
            <td class="px-6 py-4">
                {{ $salesItem->discount ?? '0.00' }}
            </td>
            <td class="px-6 py-4">
                {{ $salesItem->item ? number_format(($salesItem->item->retail_price - ($salesItem->discount ?? 0)) * $salesItem->quantity, 2) : '0.00' }}
            </td>
            <td class="px-6 py-4">
                {{ $salesItem->quantity }}
            </td>
            <td class="px-6 py-4">
                <input type="number" 
                    class="w-16 px-2 py-1 border rounded-lg return-quantity" 
                    min="0" 
                    max="{{ $salesItem->quantity }}" />
            </td>
            <td class="px-6 py-4">
                <input type="checkbox" class="w-5 h-5 permanent-check" />
            </td>
            <td class="px-6 py-4">
            @if(has_permission(64))
                <button class="p-3 border-2 rounded-lg bg-[#029ED9] text-white process-return-btn">
                    Process Return
                </button>
                @endif
            </td>
        </tr>
    @endforeach
@endforeach
--}}

</tbody>

</table>

            </div>
        </div>
    </div>
    @include('layouts.footer')

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

</html>


<script>
   function filterSales() {
    const searchValue = document.getElementById('search_sale_ret').value;

    fetch(`/sales/filter?sales_code=${searchValue}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#salesRetTable tbody');
            tableBody.innerHTML = '';

            data.forEach(sale => {
                sale.sales_items.forEach(item => {
                    const row = `
                        <tr class="text-black bg-white border-2"
                            data-sale-id="${sale.id}" 
                            data-item-id="${item.items_id}">
                            <td class="px-6 py-4">${item.item ? item.item.item_name : 'Item not found'}</td>
                            <td class="px-6 py-4">${item.item ? item.item.retail_price : '0.00'}</td>
                            <td class="px-6 py-4">${item.discount || '0.00'}</td>
                            <td class="px-6 py-4">${item.item ? ((item.item.retail_price - (item.discount || 0)) * item.quantity).toFixed(2) : '0.00'}</td>
                            <td class="px-6 py-4">${item.quantity}</td>
                            <td class="px-6 py-4">
                                <input type="number" class="w-16 px-2 py-1 border rounded-lg return-quantity" 
                                    min="0" max="${item.quantity}" />
                            </td>
                            <td class="px-6 py-4">
                                <input type="checkbox" class="w-5 h-5 permanent-check" />
                            </td>
                            <td class="px-6 py-4">
                                @if(has_permission(64))
                                <button class="p-3 border-2 rounded-lg bg-[{{ $settings[7]->value}}] text-white process-return-btn">
                                    Process Return
                                </button>
                                @endif
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
            });

            // Reattach event listeners after updating table
            document.querySelectorAll('.process-return-btn').forEach(button => {
                button.addEventListener('click', handleSalesReturn);
            });
        })
        .catch(error => console.error('Error:', error));
}




   // Add event listeners to all "Process Return" buttons
document.querySelectorAll('#salesRetTable button').forEach(button => {
    button.addEventListener('click', handleSalesReturn);
});

function handleSalesReturn(event) {
    event.preventDefault();
    
    // Get the row and its data
    const row = event.target.closest('tr');
    const returnQuantityInput = row.querySelector('.return-quantity');
    const isPermanent = row.querySelector('.permanent-check').checked;
    const returnQuantity = parseInt(returnQuantityInput.value);
    const maxQuantity = parseInt(returnQuantityInput.getAttribute('max'));
    
    // Get sale and item IDs from data attributes
    const salesId = row.getAttribute('data-sale-id');
    const itemsId = row.getAttribute('data-item-id');
    
    console.log('Data:', {
        salesId,
        itemsId,
        returnQuantity,
        isPermanent,
        maxQuantity
    });

    // Validation
    if (!returnQuantity || returnQuantity <= 0) {
        alert('Please enter a valid return quantity');
        return;
    }
    
    if (returnQuantity > maxQuantity) {
        alert(`Return quantity cannot exceed original quantity (${maxQuantity})`);
        return;
    }

    // CSRF token
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) {
        alert('CSRF token not found. Please refresh the page.');
        return;
    }

    // Prepare data
    const data = {
        sales_id: salesId,
        items_id: itemsId,
        return_quantity: returnQuantity,
        is_permanent: isPermanent
    };

    // Send request
    fetch('/sales/process-return', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Return processed successfully');
            window.location.reload(); // Reload page to show updated data
        } else {
            alert(data.message || 'Error processing return');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error processing return. Check console for details.');
    });
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.process-return-btn').forEach(button => {
        button.addEventListener('click', handleSalesReturn);
    });
});
    


document.addEventListener('DOMContentLoaded', function() {
    // Reset all number inputs and checkboxes on page load
    document.querySelectorAll('.return-quantity').forEach(input => {
        input.value = ''; // Reset the number input
    });
    document.querySelectorAll('.permanent-check').forEach(checkbox => {
        checkbox.checked = false; // Uncheck the checkbox
    });

    // Reattach event listeners
    document.querySelectorAll('.process-return-btn').forEach(button => {
        button.addEventListener('click', handleSalesReturn);
    });
});




</script>