<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen p-4 bg-gray-100">
    
    <div class="w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="text-white bg-gray-800 p-7">
    <div class="flex items-center justify-between gap-6 mb-2 max-md:flex-col max-md:text-center">
        <!-- Download button icon placed above the header, centered -->
        <div class="absolute top-0 mt-4 transform -translate-x-1/2 left-1/2">
            <button id="downloadButton" class="px-4 py-2 bg-transparent rounded hover:bg-blue-600">
                <i class="text-white fa fa-download" aria-hidden="true"></i>
            </button>
        </div>

        <div class="flex items-center max-md:flex-col">
            <img src="../../../../images/logo.png" alt="" class="w-20 h-20">
            <div>
                <h1 class="text-2xl font-bold uppercase">Udarata Computers</h1>
                <p class="uppercase">Computer Arcade & Technologies (PVT) Ltd</p>
            </div>
        </div>

        <div class="md:text-right">
            <p class="font-bold">INVOICE</p>
            <p class="text-gray-300">Invoice - {{ $order->invoice_number }}</p>
            <p id="date" class="text-gray-300">Date: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        </div>
    </div>
</div>


        <!-- Customer Information -->
        <div class="p-8 border-b">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h2 class="mb-2 font-semibold text-gray-600">Bill To:</h2>
                    <p id="customerName" class="font-medium">{{ $order->name }}</p>
                    <p id="customerEmail">{{ $order->email }}</p>
                    <p id="customerPhone">{{ $order->number }}</p>
                    <p id="customerAddress">{{ $order->address }}</p>
                    <p>Sri Lanka</p>
                </div>
                <div class="text-right">
                    <h2 class="mb-2 font-semibold text-gray-600">Invoice Details:</h2>
                    <p><span class="font-medium">Date Issued:</span> {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
                    <p><span class="font-medium">Due Date:</span> {{ \Carbon\Carbon::now()->addDays(15)->format('F d, Y') }}</p>
                    <p><span class="font-medium">Payment Terms:</span> Net 15</p>
                </div>

            </div>
        </div>

        <!-- Product Table -->
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">IMEI</th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ITEM NAME</th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">COLOR</th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">STORAGE</th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">RAM</th>
                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">PRICE</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $order->mobileImei->imei_number }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $order->mobileImei->mobileItem->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $order->mobileImei->mobileItem->color->name ?? 'N/A' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $order->mobileImei->mobileItem->storage->name ?? 'N/A' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $order->mobileImei->mobileItem->ram->name ?? 'N/A' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">Rs. {{ number_format($order->mobileImei->mobileItem->mrp_price, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="p-8 bg-gray-50">
            <div class="flex justify-end">
                <div class="w-full">
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium">Subtotal:</span>
                        <span>Rs. {{ number_format($order->mobileImei->mobileItem->mrp_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium">Tax ({{ $order->mobileImei->mobileItem->tax }}%):</span>
                        <span>Rs. {{ number_format($order->mobileImei->mobileItem->mrp_price * ($order->mobileImei->mobileItem->tax / 100), 2) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium">Shipping:</span>
                        <span>Rs. 500</span>
                    </div>
                    <div class="flex justify-between py-3 text-lg font-bold">
                        <span>Total:</span>
                        <span>Rs. {{ number_format($order->mobileImei->mobileItem->mrp_price * (1 + $order->mobileImei->mobileItem->tax / 100) + 500, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information and Notes -->
        <div class="p-12 border-t">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="mb-2 font-semibold">Payment Information:</h3>
                    <p>Bank: BOC</p>
                    <p>Account Name: Udarata Computers</p>
                    <p>Account Number: XXXX-XXXX-XXXX-1234</p>
                    <p>IFSC Code: GLOB0001234</p>
                </div>
                <div>
                    <h3 class="mb-2 font-semibold">Notes:</h3>
                    <p class="text-justify text-gray-600">Thank you for your business. Please make payment by the due date. For any queries regarding this invoice, please contact our support team at support@udaratacomputers.com or call +94 (77) 987-6543.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between gap-3 p-4 text-sm text-right text-white bg-gray-800 max-sm:flex-col max-sm:items-center">
            <ul class="flex items-end gap-6 w-fit">
                <li>
                    <a href="https://www.facebook.com/Udarata.Computers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                      </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/udarata_computers/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                      </svg>
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                      </svg>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@udaratacomputers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                      </svg>
                    </a>
                </li>
            </ul>
            <ul class="flex flex-col gap-2">
                <li class="flex items-center justify-end gap-2 max-sm:justify-center">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    +94 7074 66666
                </li>
                <li class="flex items-center justify-end gap-2 max-sm:justify-center">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    www.udaratacomputers.lk
                </li>
                <li class="flex items-center justify-end gap-2 max-sm:justify-center">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    udaratacomputers@gmail.com
                </li>
            </ul>
        </div>
    </div>
</body>
</html>


<script>
document.getElementById('downloadButton').addEventListener('click', function() {
    const element = document.querySelector('body > div'); // Select the invoice div

    // Hide the download button before generating the PDF
    document.getElementById('downloadButton').style.display = 'none';

    // Options for html2pdf
    const options = {
        margin:       0.2,
        filename:     'invoice.pdf',
        image:       { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // Generate PDF and download
    html2pdf().from(element).set(options).save().then(function() {
        // Show the download button again after the PDF has been generated
        document.getElementById('downloadButton').style.display = 'block';
    });
});

</script>