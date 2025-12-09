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
                            <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2">Stock Counting</p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!--btn controls-->
        <div class="px-12 max-sm:px-6 py-5 flex w-full items-center max-md:flex-col justify-between gap-3">
            <!--search-->
            <div class="flex w-1/2 max-md:w-full items-center">
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-[#47891E] border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
                        <svg width="45" height="29" viewBox="0 0 45 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.958496 28.2087V0.791992H4.87516V28.2087H0.958496ZM6.8335 28.2087V0.791992H10.7502V28.2087H6.8335ZM12.7085 28.2087V0.791992H14.6668V28.2087H12.7085ZM18.5835 28.2087V0.791992H22.5002V28.2087H18.5835ZM24.4585 28.2087V0.791992H30.3335V28.2087H24.4585ZM32.2918 28.2087V0.791992H34.2502V28.2087H32.2918ZM38.1668 28.2087V0.791992H44.0418V28.2087H38.1668Z"
                                fill="white" />
                        </svg>
                    </span>
                    <input type="text" id="barcode"
                        class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 mr-6"
                        placeholder="Barcode">
                </div>
                <button class="py-3 px-6 bg-[#47891E] text-white rounded-lg">Submit</button>
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
                            <th scope="col" class="px-6 py-3 rounded-tr-lg">
                                Barcode
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
                                <button class="bg-gray-300 px-6 py-2 rounded-lg">Save Counted Items</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-2 text-black">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                1
                            </td>
                            <td class="px-6 py-4">
                                Item 1
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                        </tr>
                        <tr class="bg-white border-2 text-black">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                1
                            </td>
                            <td class="px-6 py-4">
                                Item 1
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                        </tr>
                        <tr class="bg-white border-2 text-black">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                1
                            </td>
                            <td class="px-6 py-4">
                                Item 1
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                        </tr>
                        <tr class="bg-white border-2 text-black">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                1
                            </td>
                            <td class="px-6 py-4">
                                Item 1
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                        </tr>
                        <tr class="h-6"></tr>
                        <tr class="bg-[#47891E] border-2 text-white">
                            <td class="px-6 py-4">
                                Total Added Stock
                            </td>
                            <td class="px-6 py-4">0</td>
                            <td class="px-6 py-4">
                                <button class="bg-gray-300 px-6 py-2 rounded-lg bg-white text-black">Save Counted Items</button>
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