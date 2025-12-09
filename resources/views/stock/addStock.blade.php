@include('layouts.header')
    <div class="flex-grow flex flex-col">
        <!--breadcrumbs-->
        <div class="px-12 max-sm:px-6 py-5">
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
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Stock</p>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Add Stock</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!--main panel-->
        <div class="p-6">
            <div class="flex flex-grow flex-col border-2 h-full rounded-lg p-6">
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="item_name" class="block mb-2 text-sm font-medium text-black ">Item Name</label>
                        <input type="text" id="item_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter item name" required />
                    </div>
                </div>
                <div class="grid mb-6 md:grid-cols-2 gap-6">
                    <div>
                        <label for="branch" class="block mb-2 text-sm font-medium text-gray-900">Branch</label>
                        <!--custom combobox-->
                        <div class="custom-select w-full">
                            <select id="branch" name="branch"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden">
                                <option value="">Select branch</option>
                                <option value="Branch 1">Branch 1</option>
                                <option value="Branch 2">Branch 2</option>
                                <option value="Branch 3">Branch 3</option>
                                <option value="Branch 4">Branch 4</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="qty" class="block mb-2 text-sm font-medium text-black ">Quantity</label>
                        <input type="number" id="qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Enter quantity" required />
                    </div>
                </div>
                <div class="flex justify-center items-center w-full gap-4 max-sm:flex-col">
                    <button
                        class="py-3 px-6 bg-[#029ED9] text-white rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Add</button>
                </div>
            </div>
        </div>
        <div class="flex-grow"></div>
        <footer
            class="h-[80px] bg-[#029ED9] max-md:text-sm max-sm:text-xs max-md:flex-col text-center w-full flex items-center text-white justify-center gap-3">
            <p>Copyright</p>
            <p>Powered By <strong>Silicon Radon Networks (PVT) Ltd.</strong> All rights reserved.</p>
        </footer>

    </div>
</body>
<script src="../../../scripts/common.js"></script>

</html>