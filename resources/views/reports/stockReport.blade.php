@include('layouts.header')
<div class="flex flex-col h-[680px] max-lg:h-fit">
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
                            <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">Item Stock Report</p>
                        </div>
                    </li>
                </ol>
                <button class="py-3 px-3 bg-[#000000] text-white rounded-lg text-xs ml-auto" onclick="exportTableToPDF()">Generate Report</button>
            </nav>
        </div>

        
        <!--submission controls-->
        <div class="px-12 max-sm:px-6">
            <form method="POST" action="{{ route('stockReport.filter') }}">
                @csrf
                <div class="grid gap-4 py-4 md:grid-cols-5">
                    <!-- Select item name -->
                    <div>
                        <label for="item_name" class="block mb-1 text-xs font-medium text-black">Item Name</label>
                        <input id="item_name" name="item_name"
                            class="w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter item name">
                    </div>
                    <!-- Select from date -->
                    <div>
                        <label for="from-date" class="block mb-1 text-xs font-medium text-black">From Date</label>
                        <input id="from-date" name="from_date" type="date"
                            class="w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Select a date">
                    </div>
                    <!-- Select to date -->
                    <div>
                        <label for="to-date" class="block mb-1 text-xs font-medium text-black">To Date</label>
                        <input id="to-date" name="to_date" type="date"
                            class="w-full p-3 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Select a date">
                    </div>
                    <!-- Submit button -->
                    <div class="flex justify-start gap-4 md:col-span-2">
                    <button type="submit" class="py-0.5 px-3 w-auto bg-[{{ $settings[7]->value}}] text-white rounded-lg text-xs">Submit</button>
                    <button type="button" class="py-0.5 px-3 w-auto bg-[#000000] text-white rounded-lg text-xs"
                        onclick="window.location.href='/reports/stockReports'">Reset</button>
                </div>

                </div>
            </form>
        </div>

        

        <div class="flex flex-col px-12 py-5 overflow-y-auto bg-white max-sm:px-6 max-lg:min-h-full">
            <span></span>
            <!--table from flowbite-->
            <div class="relative h-[500px] overflow-x-auto">
                    <table id="ItemStock" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-[{{ $settings[7]->value}}] sticky top-0 z-10">
                            <tr>
                                <th class="px-3 py-2 rounded-tl-lg">No</th>
                                <th class="px-3 py-2">Item Name</th>
                                <th class="px-3 py-2">Starting Stock</th>
                                <th class="px-3 py-2">Purchased Stock</th>
                                <th class="px-3 py-2">Sold Stock</th>
                                <th class="px-3 py-2">Ending Stock</th>
                                <th class="px-3 py-2 text-right">Purchase Price</th>
                                <th class="px-3 py-2 text-right">Retail Price</th>
                                <th class="px-3 py-2 text-right">Whole Sale Price</th>
                                <th class="px-3 py-2 text-right">Stock Value (Rs.)</th>
                                <th class="px-3 py-2 text-right">Price Per Item (Rs.)</th>
                                <th class="px-3 py-2 text-right">Sold Stock Value (Rs.)</th>
                                <th class="px-3 py-2 rounded-tr-lg">Date</th>
                            </tr>
                        </thead>
                        <tbody class="space-y-2">
                            @foreach ($reportData as $index => $data)
                                <tr>
                                    <td class="px-3 py-2">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2">{{ $data['item_name'] }}</td>
                                    <td class="px-3 py-2">{{ $data['starting_stock'] }}</td>
                                    <td class="px-3 py-2">{{ $data['purchased_stock'] }}</td>
                                    <td class="px-3 py-2">{{ $data['sold_stock'] }}</td>
                                    <td class="px-3 py-2">{{ $data['ending_stock'] }}</td>
                                    <td class="px-3 py-2 text-right">{{ $data['purchase_price'] }}</td>
                                    <td class="px-3 py-2 text-right">{{ $data['retail_price'] }}</td>
                                    <td class="px-3 py-2 text-right">{{ $data['wholesale_price'] }}</td>
                                    <td class="px-3 py-2 text-right">{{ number_format($data['stock_value'], 2) }}</td>
                                    <td class="px-3 py-2 text-right">{{ number_format($data['price_per_item'], 2) }}</td>
                                    <td class="px-3 py-2 text-right">{{ number_format($data['sold_stock_value'], 2) }}</td>
                                    <td class="px-3 py-2">{{ $data['date'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="space-y-2 bg-gray-200">
                            <tr>
                                <th colspan="9" class="px-3 py-2 font-bold text-left">Total Value (Rs.)</th>
                                <th class="px-3 py-2 text-right">{{ number_format($totalStockValue, 2) }}</th>
                                <th class="px-3 py-2 text-right">{{ number_format($totalPricePerItem, 2) }}</th>
                                <th class="px-3 py-2 text-right">{{ number_format($totalSoldStockValue, 2) }}</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </tfoot>
                    </table>



            </div>
        </div>
    </div>
    @include('layouts.footer')

</body>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="../../../scripts/common.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.19/jspdf.plugin.autotable.min.js"></script>


<script>

function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');

    // Get the table data
    const table = document.getElementById('ItemStock');
    const tableRows = table.querySelectorAll('tr');

    // Extract all dates and initialize totals
    const dates = [];
    let totalStockValue = 0;
    let totalPricePerItem = 0;
    let totalSoldStockValue = 0;

    // Extract table data and calculate totals
    const rows = [];
    tableRows.forEach((row, rowIndex) => {
        const cols = row.querySelectorAll('th, td');
        const rowData = [];

        cols.forEach((col, colIndex) => {
            const text = col.innerText;

            // Extract dates from the last column
            if (colIndex === cols.length - 1) {
                if (text && !isNaN(Date.parse(text))) {
                    dates.push(new Date(text));
                }
            }

            // Calculate totals
            if (colIndex === 9) totalStockValue += parseFloat(text.replace(/[^\d.-]/g, '')) || 0;
            if (colIndex === 10) totalPricePerItem += parseFloat(text.replace(/[^\d.-]/g, '')) || 0;
            if (colIndex === 11) totalSoldStockValue += parseFloat(text.replace(/[^\d.-]/g, '')) || 0;

            rowData.push(text);
        });

        if (rowData.length > 0) {
            rows.push(rowData);
        }
    });

    // Add total row to the data
    const totalRow = [
        { content: 'Total Value (Rs.)', colSpan: 9, styles: { halign: 'left', fontStyle: 'bold' } },
        { content: totalStockValue.toFixed(2), styles: { halign: 'right' } },
        { content: totalPricePerItem.toFixed(2), styles: { halign: 'right' } },
        { content: totalSoldStockValue.toFixed(2), styles: { halign: 'right' } },
        { content: '', styles: { halign: 'center' } }
    ];

    // Determine and format date range
    const fromDate = dates.length ? new Date(Math.min(...dates)) : "N/A";
    const toDate = dates.length ? new Date(Math.max(...dates)) : "N/A";
    const formattedFromDate = fromDate !== "N/A" ? fromDate.toISOString().split('T')[0] : "N/A";
    const formattedToDate = toDate !== "N/A" ? toDate.toISOString().split('T')[0] : "N/A";

    // Add company name
    const companyName = "{{ $settings[6]->value }}";
    doc.setFontSize(18);
    doc.setFont("helvetica", "bold");
    const pageWidth = doc.internal.pageSize.getWidth();
    const companyNameWidth = doc.getTextWidth(companyName);
    doc.text(companyName, (pageWidth - companyNameWidth) / 2, 15);

    // Add date and time
    const currentDate = new Date();
    const dateString = currentDate.toISOString().split('T')[0];
    let hours = currentDate.getHours();
    let minutes = currentDate.getMinutes();
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    const timeString = `${hours}:${minutes} ${ampm}`;

    // Add generated date and date range
    doc.setFontSize(12);
    doc.setFont("helvetica", "normal");
    doc.text(`Generated Date: ${dateString} ${timeString}`, 14, 25);
    doc.text(`From Date: ${formattedFromDate}`, 14, 35);
    doc.text(`To Date: ${formattedToDate}`, 14, 45);

    // Create table with data and total row
    doc.autoTable({
        head: [rows[0]],
        body: [...rows.slice(1, rows.length - 1), totalRow],
        styles: {
            lineColor: [0, 0, 0],
            lineWidth: 0.5,
            fillColor: [255, 255, 255],
            textColor: [0, 0, 0],
            fontStyle: 'normal',
        },
        headStyles: {
            fillColor: [255, 255, 255],
            textColor: [0, 0, 0],
            fontStyle: 'bold',
        },
        alternateRowStyles: {
            fillColor: [255, 255, 255],
        },
        tableLineColor: [0, 0, 0],
        tableLineWidth: 0.5,
        margin: { top: 50 },
        columnStyles: {
            9: { halign: 'right' },
            10: { halign: 'right' },
            11: { halign: 'right' },
        }
    });

    // Save PDF
    doc.save('ItemReport.pdf');
}


</script>