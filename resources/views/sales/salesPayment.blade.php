@include('layouts.header')

<div class="flex flex-col flex-grow">
    <!-- Header -->
    <div class="px-12 py-5 max-sm:px-6">
        <h2 class="text-2xl font-semibold text-gray-700">Make a Payment</h2>
    </div>

    <!-- Main panel -->
    <div class="p-6">
        <div class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
            <form method="POST" action="{{ route('payment.update') }}" id="paymentForm" class="flex flex-col flex-grow h-full p-6 border-2 rounded-lg">
                @csrf
                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="relative px-4 py-3 mb-4 text-red-700 border border-red-400 rounded bg-red-50" role="alert">
                    <strong class="font-bold">Please correct the following errors:</strong>
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

                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="sale_id" class="block mb-2 text-sm font-medium text-black">Sales ID</label>
                        <input id="sale_id" name="sale_id" type="text" value="{{ $payment->sales_id }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            readonly>
                    </div>
                </div>
                
                {{-- Current Due Amount --}}
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="due_amount" class="block mb-2 text-sm font-medium text-black">Current Due Amount</label>
                        <input id="due_amount" name="due_amount" type="text" 
                            value="{{ $payment->grand_total - $payment->paid_amount }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            readonly>
                    </div>
                </div>

                {{-- Payment Type --}}
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="payment_type" class="block mb-2 text-sm font-medium text-black">Payment Type</label>
                        <select id="payment_type" name="payment_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="CASH">CASH</option>
                            <option value="CARD">CARD</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="CREDIT">CREDIT</option>
                        </select>
                    </div>
                </div>

                <!-- Additional Fields for CHEQUE -->
                <div id="cheque-fields" class="grid hidden gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="cheque_number" class="block mb-2 text-sm font-medium text-black">CHEQUE Number</label>
                        <input id="cheque_number" name="cheque_number" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter CHEQUE number">
                    </div>
                    <div>
                        <label for="cheque_date" class="block mb-2 text-sm font-medium text-black">CHEQUE Date (Optional)</label>
                        <input id="cheque_date" name="cheque_date" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                {{-- Amount Paid --}}
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="amount_paid" class="block mb-2 text-sm font-medium text-black">Amount Paid</label>
                        <input id="amount_paid" name="amount_paid" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter amount paid" require>
                    </div>
                </div>

                <input type="hidden" name="sale_id" value="{{ $payment->sales_id }}">
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                <input type="hidden" name="number" value="{{ $customer->contact_number }}">
                <input type="hidden" name="Cus_name" value="{{ $customer->customer_name }}">
                <input type="hidden" name="user_name" value="{{ $userName }}">
                <input type="hidden" name="Cus_id" value="{{ $customerId }}">




                {{-- Buttons --}}
                <div class="flex items-center justify-center w-full gap-4 max-sm:flex-col max-sm:p-0">
                    <button type="submit"
                        class="px-6 py-3 text-white bg-[{{ $settings[7]->value}}] rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full">Submit</button>
                    <button type="button" 
                        class="px-6 py-3 text-white bg-red-500 rounded-lg max-sm:py-1 max-sm:px-3 max-sm:w-full"
                        onclick="history.back()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')

</div>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
function generatePaymentReceipt(paymentData) {
    const { jsPDF } = window.jspdf;

    // Define PAGE_CONFIG if not already defined
    const PAGE_CONFIG = {
        margins: {
            left: 2, // Define left margin
        },
        spacing: {
            lineHeight: 5, // Adjust this value for line spacing
        }
    };

    // Calculate dynamic height
    const baseHeight = 90;
    const footerPadding = 28; // Adjusted to accommodate new footer
    const totalHeight = baseHeight + footerPadding;

    // Create PDF instance
    const doc = new jsPDF({
        unit: 'mm',
        format: [80, totalHeight], // Thermal printer width
    });

    let currentY = 10; // Starting Y position for the header

    // Function to center text
    const centerText = (text, yPosition) => {
        doc.text(text, 40, yPosition, { align: 'center' });
    };

    // Header
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(10);
    centerText('{{ $settings[6]->value }}', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;

    // Add detailed description
    doc.setFontSize(8);
    centerText('Wholesale & Retail Dealers in Electronic Spare', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('Parts of Washing Machines, Rice Cookers, T.V,', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('Blenders, Fan Motors & Other', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;
    centerText('Electronic Items.', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;

    // Add address, contact, and email
    doc.setFontSize(7); // Set the default font size
    centerText('{{ $settings[9]->value }}', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;

    // Bold and increase font size for this line
    doc.setFont('helvetica', 'bold'); // Switch to bold font
    doc.setFontSize(10); // Increase font size
    centerText('{{ $settings[10]->value }} / {{ $settings[11]->value }}', currentY);

    // Revert back to normal font and size
    doc.setFont('helvetica', 'normal'); // Switch back to normal font
    doc.setFontSize(7); // Reset to default font size
    currentY += PAGE_CONFIG.spacing.lineHeight;

    centerText('{{ $settings[12]->value }}', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight;

    // Receipt Title
    doc.setFontSize(8);
    centerText('============== PAYMENT RECEIPT ==============', currentY);

    // Receipt Details
    const now = new Date();
    const reducedGap = PAGE_CONFIG.spacing.lineHeight;
    currentY += reducedGap;
    doc.text('DATE:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(now.toISOString().split('T')[0], PAGE_CONFIG.margins.left + 10, currentY);
    doc.text('TIME:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text(now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }), PAGE_CONFIG.margins.left + 56, currentY);

    currentY += reducedGap;
    doc.text('CUS:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(paymentData.Cus_name.toUpperCase(), PAGE_CONFIG.margins.left + 8, currentY);
    doc.text('PTYPE:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text(paymentData.payment_type.toUpperCase(), PAGE_CONFIG.margins.left + 56, currentY);

    currentY += reducedGap;
    doc.text('CUSID:', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(paymentData.Cus_id.toUpperCase(), PAGE_CONFIG.margins.left + 11, currentY);
    doc.text('USER:', PAGE_CONFIG.margins.left + 46, currentY);
    doc.text(paymentData.user_name.toUpperCase(), PAGE_CONFIG.margins.left + 56, currentY);
    currentY += reducedGap;

    centerText('============================================', currentY);
    currentY += PAGE_CONFIG.spacing.lineHeight; // Use a smaller spacing value

    // Payment Summary
    doc.setFontSize(9); // Set font size for the content
    doc.setFont('helvetica', 'bold'); // Reset to normal font for the label
    doc.text('DUE AMOUNT', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(':', PAGE_CONFIG.margins.left + 36, currentY);
    doc.text(parseFloat(paymentData.due_amount).toFixed(2), 75, currentY, { align: 'right' });
    currentY += 5;

    doc.text('AMOUNT PAID', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(':', PAGE_CONFIG.margins.left + 36, currentY);
    doc.text(parseFloat(paymentData.amount_paid).toFixed(2), 75, currentY, { align: 'right' });
    currentY += 5;

    const remainingBalance = parseFloat(paymentData.due_amount) - parseFloat(paymentData.amount_paid);
    doc.text('REMAINING BALANCE', PAGE_CONFIG.margins.left + 1, currentY);
    doc.text(':', PAGE_CONFIG.margins.left + 36, currentY);
    doc.text(remainingBalance.toFixed(2), 75, currentY, { align: 'right' });

    // Footer
    currentY += 5;
    doc.setFontSize(7);
    centerText('======== THANK YOU! VISIT AGAIN ========', currentY);
    currentY += 4;  // Reduced line gap to make it more compact
    centerText('# Exchange within 07 days if item is in good condition.', currentY);

    currentY += 3;  // Reduced the line gap
    centerText('# Bill must be produced for claims.', currentY);
    currentY += 3;  // Reduced the line gap
    centerText('# Transportation Damages, Chip burns, Physical damages', currentY);
    currentY += 3;  // Reduced the line gap
    centerText('and electronical fixing faults are not covered.', currentY);

    currentY += 4;  // Reduced line gap to make it more compact
    centerText('-------------------------------------------------------------------------------------', currentY);
    const currentYear = new Date().getFullYear();
    currentY += 4;  // Reduced the line gap
    centerText(`Powered by PlexCode.`, currentY);

    // Generate and open PDF
    const pdfBlob = doc.output('blob');
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl, '_blank');
}



// Form handling and UI interactions
document.addEventListener('DOMContentLoaded', function () {
    const paymentType = document.getElementById('payment_type');
    const chequeFields = document.getElementById('cheque-fields');
    const form = document.getElementById('paymentForm');
    const dueAmountInput = document.getElementById('due_amount');
    const amountPaidInput = document.getElementById('amount_paid');

    // Show/hide CHEQUE fields based on selection
    paymentType.addEventListener('change', function () {
        if (paymentType.value === 'CHEQUE') {
            chequeFields.classList.remove('hidden');
        } else {
            chequeFields.classList.add('hidden');
        }
    });

    // Auto-hide alert messages after 4 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.relative[role="alert"]');
        alerts.forEach(alert => alert.style.display = 'none');
    }, 4000);

    // Handle form submission
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Get Current Due Amount and Amount Paid
        const dueAmount = parseFloat(dueAmountInput.value || 0);
        const amountPaid = parseFloat(amountPaidInput.value || 0);

        // Validation: Check if Amount Paid > Current Due Amount
        if (amountPaid > dueAmount) {
            // Show error message
            const errorMessage = document.createElement('div');
            errorMessage.className = 'relative px-4 py-3 mb-4 text-red-700 border border-red-400 rounded bg-red-50';
            errorMessage.setAttribute('role', 'alert');
            errorMessage.textContent = 'Error: Amount Paid cannot exceed the Current Due Amount.';
            
            // Insert error message at the top of the form
            form.insertBefore(errorMessage, form.firstChild);

            // Auto-hide error message after 4 seconds
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 4000);

            return; // Prevent form submission
        }

        // Collect form data
        const formData = new FormData(form);
        const paymentData = Object.fromEntries(formData.entries());

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            if (response.ok) {
                // Generate receipt
                generatePaymentReceipt(paymentData);

                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded';
                successMessage.setAttribute('role', 'alert');
                successMessage.textContent = 'Payment processed successfully!';
                form.insertBefore(successMessage, form.firstChild);

                // Clear form or redirect as needed
                setTimeout(() => {
                    // Optionally redirect or reset form
                }, 2000);
            } else {
                throw new Error('Payment processing failed');
            }
        } catch (error) {
            console.error('Error processing payment:', error);
            const errorMessage = document.createElement('div');
            errorMessage.className = 'relative px-4 py-3 mb-4 text-red-700 border border-red-400 rounded bg-red-50';
            errorMessage.setAttribute('role', 'alert');
            errorMessage.textContent = 'Error processing payment. Please try again.';
            form.insertBefore(errorMessage, form.firstChild);
        }
    });
});

</script>