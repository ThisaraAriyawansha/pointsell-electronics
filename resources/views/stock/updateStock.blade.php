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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Stock</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Update Stock</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--main panel-->
        <div class="p-6">
            <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
            <form method="POST" action="{{ url('stock/updateStock') }}">
            @csrf
                
            <input type="hidden" name="item_id" value="{{ $item->id }}">


            {{-- Validation Errors Summary --}}
                @if ($errors->any())
                <div class="relative px-4 py-3 mb-4 text-red-700 border border-red-400 rounded bg-red-50" role="alert">
                <strong class="font-bold">Oops! There were some errors with your submission:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

                @endif

                {{-- Success Message --}}
                @if (session('success'))
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>

                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>

                @endif
                
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="exp_date" class="block mb-2 text-sm font-medium text-black ">Item Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $item->item_name) }}"
                            class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2."  readonly 
                            >
                    </div>
                    <div>
                        <label for="exp_date" class="block mb-2 text-sm font-medium text-black ">Item Code</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $item->item_code) }}"
                            class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2."  readonly 
                            >
                    </div>
                    
                    
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="exp_date" class="block mb-2 text-sm font-medium text-black ">Minimum Quantity</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $item->minimum_qty) }}"
                            class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2."  readonly 
                            >
                    </div>
                    <div>
                        <label for="exp_date" class="block mb-2 text-sm font-medium text-black ">Current Quantity</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $item->quantity) }}"
                            class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2."  readonly 
                            >
                    </div>

                    
                    
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-black">Stock quantity</label>
                        <input id="quantity" name="quantity" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter quantity" required>
                    </div>
                    <div>
                        <label for="note" class="block mb-2 text-sm font-medium text-black">Note</label>
                        <input id="note" name="note" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter note" required>
                    </div>
                </div>
                <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                    <button type="submit"
                        class="py-3 px-6 bg-[{{ $settings[7]->value}}] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Add</button>
                        <button type="reset" class="px-6 py-3 text-white bg-black rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Reset</button>
                        <button type="button" class="px-6 py-3 text-white bg-red-600 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="window.location.href='/stock/stock'">Cancel</button>
                </div>
            </Form>
                </div>

            </div>
        </div>
        <div class="flex-grow"></div>


        <div class="flex flex-col flex-grow px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
            <table id="suppliersTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
    <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}]">
        <tr>
            <th scope="col" class="px-6 py-3 rounded-tl-lg">#</th>
            <th scope="col" class="px-6 py-3 " >Item Code</th>
            <th scope="col" class="px-6 py-3" >Item Name</th>
            <th scope="col" class="px-6 py-3" >Quantity</th>
            <th scope="col" class="px-6 py-3" >Note</th>
            <th scope="col" class="px-6 py-3" >Create At</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($stockUpdates as $key => $stockUpdates)
            <tr class="text-black bg-white border-2">
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $key + 1 }}</td>
                <td class="px-6 py-4">{{ $item->item_code }}</td>
                <td class="px-6 py-4">{{ $item->item_name }}</td>
                <td class="px-6 py-4">{{ $stockUpdates->stock }}</td>
                <td class="px-6 py-4">{{ $stockUpdates->note }}</td>
                <td class="px-6 py-4">{{ $stockUpdates->created_at }}</td>

            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center">No items found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

            </div>
        </div>
        
        @include('layouts.footer')

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

</html>

<script>
    // Auto-hide alert messages after 4 seconds
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.relative[role="alert"]');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 4000); // 4000 milliseconds = 4 seconds
    });

</script>