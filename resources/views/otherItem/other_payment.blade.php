<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1px;
            color: #333;
            background-color: #f9fafb;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: {{ $settings[7]->value }};
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .company-info {
            text-align: left;
        }
        .company-logo img {
            height: 60px;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            text-align: left;
            padding: 8px;
            background-color: {{ $settings[7]->value }};
            color: white;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .total-row {
            font-weight: bold;
            font-size: 1.1em;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 0.9em;
            color: #555;
        }
        .contact-info {
            background-color: {{ $settings[7]->value }}; /* Same as header background */
            padding: 20px;
            margin-top: 20px;
            border-radius: 0px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
        }
        .contact-info li {
            font-size: 0.9em;
            display: flex;
            justify-content: right;
            gap: 10px;
            color: white;
        }
        .contact-info i {
            color: white;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .invoice-box {
                box-shadow: none;
                border: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .header {
                background-color: {{ $settings[7]->value }} !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            th {
                background-color: {{ $settings[7]->value }} !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        

    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="flex items-center justify-start gap-4 header">
            <div class="company-logo">
                <img src="../../../../images/logo.png" alt="Company Logo">
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold">Udarata Computers</h2>
                <p class="text-xs">Computer Arcade & Technologies (PVT) Ltd</p>
                <p class="text-xs">Phone: +94 7074 66666</p>
            </div>
            <div class="ml-auto text-right">
                <h1 class="text-xl font-bold text-white">INVOICE</h1>
                <p class="text-sm text-gray-200">Invoice #: {{ $payment->invoice_num }}</p>
                <p class="text-sm text-gray-200">Date: {{ $payment->created_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div style="margin-bottom: 30px; margin-top: 10px;">
            <h3>Bill To:</h3>
            <p>{{ $customer->customer_name }}</p>
            <p>{{ $customer->address_line_1 }}, {{ $customer->city_name }}</p>
            <p>Phone: {{ $customer->contact_number }}</p>
            <p>Email: {{ $customer->email }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Item Name</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->unit->serial_number }}</td>
                    <td>{{ $order->unit->item->name }}</td>
                    <td class="text-right">{{ number_format($order->unit->item->retail_price, 2) }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="2" class="text-right">Subtotal:</td>
                    <td class="text-right">{{ number_format($payment->total, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" class="text-right">Payment Type:</td>
                    <td class="text-right">{{ $payment->payment_type }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" class="text-right">Warranty:</td>
                    <td class="text-right">{{ $payment->warranty }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" class="text-right">TOTAL:</td>
                    <td class="text-right">{{ number_format($payment->total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Thank you for your business. Please make payment by the due date. For any queries regarding this invoice, please contact our support team at support@udaratacomputers.com or call +94 (77) 987-6543.</p>
            <button onclick="window.print()" class="px-4 py-2 mt-4 text-white rounded shadow bg-[{{ $settings[7]->value }}] no-print">Print Invoice</button>
        </div>

        <!-- Contact Info in Footer -->
        <div class="contact-info ">
            <ul>
                <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    +94 7074 66666
                </li>
                <li>
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    www.udaratacomputers.lk
                </li>
                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    udaratacomputers@gmail.com
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
