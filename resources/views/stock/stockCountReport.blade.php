@include('layouts.header')
    <div class="h-5/6 max-lg:h-[83vh] flex flex-col">
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
                            <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Stock Count Report</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        
        <!--btn controls-->
        <div class="px-12 max-sm:px-6 py-5 flex w-full items-center max-md:flex-col justify-between gap-3">
            <!--search-->
        <div class="flex w-1/2 max-md:w-full items-center gap-3">
            <label for="search_item">Search</label>
            <input type="text" id="search_item"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter item name" required />
            <button onclick="searchItems('search_item', 'itemsTable', 1);" class="py-3 px-6 bg-[#47891E] text-white rounded-lg">Search</button>
        </div>
            <span class="w-fit max-md:w-full items-center flex gap-3">
                Show
                <input type="text" id="col_num"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="30" required />
                Entries
            </span>
        </div>
        <!--table-->
        <div class="px-12 max-sm:px-6 max-lg:min-h-full py-5 overflow-y-auto bg-white flex flex-col flex-grow">
            <span></span>
            <!--table from flowbite-->
            <div class="relative overflow-x-auto">
                <table id="itemsTable" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-white uppercase bg-[#47891E]">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-tl-lg">
                                #
                                </td>
                            <th scope="col" class="px-6 py-3">
                                Item Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                System Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Physical Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity Difference
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock Counted Date
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-tr-lg">
                                Counted By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-2 text-black">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                1
                            </td>
                            <td class="px-6 py-4">
                                Item 1
                            </td>
                            <td class="px-6 py-4">
                                4000
                            </td>
                            <td class="px-6 py-4">
                                4000
                            </td>
                            <td class="px-6 py-4">
                                0
                            </td>
                            <td class="px-6 py-4">
                                2024/10/10
                            </td>
                            <td class="px-6 py-4">
                                John Doe
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <footer
            class="h-[80px] bg-[#029ED9] max-lg:py-6 max-md:text-sm max-sm:text-xs max-md:flex-col text-center w-full flex items-center text-white justify-center gap-3">
            <p>Copyright</p>
            <p>Powered By <strong>Silicon Radon Networks (PVT) Ltd.</strong> All rights reserved.</p>
        </footer>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>

</html>