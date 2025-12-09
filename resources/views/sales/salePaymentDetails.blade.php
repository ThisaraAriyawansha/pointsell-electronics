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
                        <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Sales Details</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Payment Details -->
    <div class="px-12 py-6 max-sm:px-6">
        <div class="p-8 mx-auto bg-white shadow-xl rounded-2xl max-w-7xl">
            <h1 class="mb-6 text-3xl font-semibold text-gray-800">Payment Details</h1>
            
            <!-- Sale Information -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-700">Sale Information</h2>
                    <p><strong class="text-gray-600">Sale Code:</strong> {{ $payment->sale->sales_code }}</p>
                    <p><strong class="text-gray-600">Sale ID:</strong> {{ $payment->sale->id }}</p>
                    <p><strong class="text-gray-600">Customer Name:</strong> {{ $payment->sale->customer->customer_name }}</p>
                    <p><strong class="text-gray-600">Sales Person:</strong> {{ $payment->user->name }}</p>
                    <p><strong class="text-gray-600">Payment ID:</strong> {{ $payment->id }}</p>
                    <p><strong class="text-gray-600">Date:</strong> {{ $payment->created_at->format('d M Y') }}</p>
                </div>
                
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-700">Payment Summary</h2>
                    <p><strong class="text-gray-600">Original Amount:</strong> {{ number_format($stats['original_amount'], 2) }}</p>
                    <p><strong class="text-gray-600">Total Paid:</strong> {{ number_format($stats['total_paid'], 2) }}</p>
                    <p><strong class="text-gray-600">Remaining Due:</strong> {{ number_format($stats['remaining_due'], 2) }}</p>
                    <p><strong class="text-gray-600">Payment Status:</strong> 
                        <span class="@if($stats['remaining_due'] <= 0) text-green-600 @else text-red-600 @endif">
                            {{ $payment->payment_status }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Items List -->
            <div class="mt-6">
                <h2 class="mb-4 text-lg font-medium text-gray-700">Purchased Items</h2>
                <div class="overflow-x-auto shadow-sm rounded-xl">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Item</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Returns</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($payment->sale->salesItems as $item)
                            <tr class="transition-colors hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $item->item->item_name }}</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">{{ $item->return_quantity ?? 0 }}</td>
                                <td class="px-6 py-4">{{ $item->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Due Payments History -->
            <!-- Due Payments History -->
@if($duePayments->count() > 0)
<div class="mt-6">
    <h2 class="mb-4 text-lg font-medium text-gray-700">Due Payment History</h2>
    <div class="overflow-x-auto shadow-sm rounded-xl">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Payment Type</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($duePayments as $duePayment)
                <tr class="transition-colors hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $duePayment->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">{{ number_format($duePayment->amount_paid, 2) }}</td>
                    <td class="px-6 py-4">
                        @if($duePayment->payment_type === 'CHEQUE')
                            <div>
                            {{ $duePayment->payment_type }}
                                <p><strong>Cheque No:</strong> {{ $duePayment->cheque_number }}</p>
                                <p><strong>Cheque Date:</strong> {{ $duePayment->cheque_date }}</p>
                            </div>
                        @else
                            {{ $duePayment->payment_type }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

        </div>
    </div>
</div>

@include('layouts.footer')
