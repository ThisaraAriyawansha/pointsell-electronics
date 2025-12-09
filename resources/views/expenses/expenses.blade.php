@include('layouts.header')

<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="px-4 py-4 bg-white shadow-sm sm:px-6 sm:py-6">
        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
            <!-- Title and subtitle -->
            <div>
                <h1 class="text-2xl font-light text-gray-800 sm:text-3xl">Expenses</h1>
                <p class="text-sm text-gray-500 sm:text-base">Manage your expense records</p>
            </div>

            <!-- Date display -->
            <div class="text-left sm:text-right">
                <p class="text-xs text-gray-500 sm:text-sm">Current Date</p>
                <p class="text-sm font-medium sm:text-base">{{ now()->format('F j, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumbs -->
    <div class="px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2">Expenses</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="mt-2"><center>@include('_message')</center></div>
    </div>

    <!-- Action Cards Grid -->
    <div class="grid grid-cols-1 gap-6 p-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @if(has_permission(70))
        <a href="{{ asset('expenses/addExpense')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-gradient-to-br from-blue-500 to-blue-700">
                        <img src="{{ asset('images/expenses/addNewExpense.png') }}" alt="Add New Expense" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-medium text-white">Add New Expense</h3>
                    <p class="mt-1 text-sm text-gray-300">Record a new expense</p>
                </div>
            </div>
        </a>
        @endif

        @if(has_permission(71))
        <a href="{{ asset('expenses/addExpenseCategory')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-gradient-to-br from-green-500 to-green-700">
                        <img src="{{ asset('images/expenses/addNewExoenseCategory.png') }}" alt="Add New Expense Category" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-medium text-white">Add Expense Category</h3>
                    <p class="mt-1 text-sm text-gray-300">Create a new expense category</p>
                </div>
            </div>
        </a>
        @endif

        @if(has_permission(72))
        <a href="{{ asset('expenses/expensesList')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-gradient-to-br from-purple-500 to-purple-700">
                        <img src="{{ asset('images/expenses/ExpenseList.png') }}" alt="Expenses List" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-medium text-white">Expenses List</h3>
                    <p class="mt-1 text-sm text-gray-300">View all expenses</p>
                </div>
            </div>
        </a>
        @endif

        @if(has_permission(73))
        <a href="{{ asset('expenses/expenseCategoryList')}}" class="group">
            <div class="h-full p-6 transition-all duration-300 transform bg-[{{ $settings[7]->value }}] shadow-sm rounded-xl hover:shadow-md hover:-translate-y-1">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 mb-4 transition-colors duration-300 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700">
                        <img src="{{ asset('images/expenses/Expenses CategoryList.png') }}" alt="Expense Category List" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-medium text-white">Expense Category List</h3>
                    <p class="mt-1 text-sm text-gray-300">View all expense categories</p>
                </div>
            </div>
        </a>
        @endif
    </div>
</div>

@include('layouts.footer')

<script>
    function locatePanelItem(panelItem) {
        window.location.href = "../../main-panel/expenses/" + panelItem;
    }
</script>