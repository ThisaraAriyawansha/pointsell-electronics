<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HoldOrderController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MobileItemController;
use App\Http\Controllers\MobileImeiController;
use App\Http\Controllers\MobileOrderController;
use App\Http\Controllers\OtherItemController;
use App\Http\Controllers\OtherItemDataController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\OtherItemBillingController;
use App\Http\Controllers\GenarateQRController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** for side bar menu active */
/*function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}*/

/*Route::get('/', function () {
   return view('welcome');
});*/
Route::get('/dashboard', [SiteSettingsController::class, 'showDashboard'])->name('main_panel');

//clean  cache
Route::post('/reset-system', [SystemController::class, 'resetSystem'])->name('reset.system');

//login
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);

//----dashbord-----//
Route::get('dash/dash', [DashboardController::class, 'dashboard'])->middleware('permission:17');

//item
Route::get('item/item', [ItemController::class, 'item'])->middleware('permission:19');
Route::get('item/item_list', [ItemController::class, 'item_list'])->middleware('permission:51');
Route::get('item/add_item', [ItemController::class, 'item_add'])->name('add_items')->middleware('permission:49');
Route::post('item/add_item', [ItemController::class, 'item_insert'])->name('add_itam')->middleware('permission:49');
Route::get('item/edit_item/{id}', [ItemController::class, 'edit'])->middleware('permission:56');
Route::post('item/edit_item/{id}', [ItemController::class, 'update'])->name('edit_itam')->middleware('permission:56');
Route::get('item/delete/{id}', [ItemController::class, 'delete'])->middleware('permission:55');
Route::post('/payment-success', [ItemController::class, 'paymentSuccess'])->name('payment.store.success');
Route::get('item/importItem', [ItemController::class, 'importItem'])->middleware('permission:58');
Route::post('/import-items', [ItemController::class, 'importItems'])->middleware('permission:58');
Route::post('/value/toggle-status/{id}', [ItemController::class, 'toggleUserStatus']);
Route::post('/item/toggle-status/{id}', [ItemController::class, 'toggleItemStatus']);
Route::get('item/genarateCode', [GenarateQRController::class, 'genarate']);
Route::get('/ItemDetails/{itemCode}', [GenarateQRController::class, 'showItemDetails']);

//itemcategory
Route::get('item/category_list', [CategoryController::class, 'category_list'])->middleware('permission:52');
Route::get('item/add_category', [CategoryController::class, 'add_category'])->middleware('permission:50');
Route::post('item/add_category', [CategoryController::class, 'insert_category'])->name('add_category');
Route::get('item/edit_category/{id}', [CategoryController::class, 'edit_category'])->middleware('permission:53');
Route::post('item/edit_category/{id}', [CategoryController::class, 'update_category'])->name('edit_category')->middleware('permission:53');
Route::get('item/delete/{id}', [CategoryController::class, 'delete_category'])->middleware('permission:54');

//Color
Route::get('item/color_list', [CategoryController::class, 'color_list']);
Route::get('item/add_color', [CategoryController::class, 'add_color']);
Route::post('item/add_color', [CategoryController::class, 'insert_color'])->name('add_color');
Route::get('item/edit_color/{id}', [CategoryController::class, 'edit_color']);
Route::post('item/edit_color/{id}', [CategoryController::class, 'update_color'])->name('edit_color');
//Route::get('item/delete/{id}', [CategoryController::class, 'delete_color']);

//Sales
Route::get('sales/sales', [SalesController::class, 'sales'])->middleware('permission:21');
Route::get('sales/billing', [SalesController::class, 'billing'])->name('billing')->middleware('permission:60');
Route::get('sales/salesItems', [SalesController::class, 'salesItems'])->middleware('permission:62');
Route::get('sales/salesReturnList', [SalesController::class, 'salesReturnList'])->middleware('permission:63');
Route::get('/sales/filter', [SalesController::class, 'filter'])->name('sales.filter');
Route::post('/sales/process-return', [SalesController::class, 'processReturn'])->name('sales.processReturn')->middleware('permission:64');
Route::post('/sales/process-return', [SalesController::class, 'processReturn'])->name('sales.process-return')->middleware('permission:64');
Route::get('sales/ReturnListView', [SalesController::class, 'returnView'])->middleware('permission:65');
Route::get('sales/dueAmount', [SalesController::class, 'dueAmount'])->middleware('permission:78');
Route::get('/customer-due/{id}', [SalesController::class, 'getCustomerDue']);
Route::get('/sales/payment_due/{id}', [SalesController::class, 'getDueCustomerId']);

// Validate item code by checking if it exists in the database
Route::get('/items/validate/{code}', [ItemController::class, 'validateItemCode']);

//Customer
Route::get('customers/customers', [CustomerController::class, 'customers'])->middleware('permission:23');
Route::get('customers/importCustomer', [CustomerController::class, 'importCustomer'])->middleware('permission:41');
Route::get('customers/customerList', [CustomerController::class, 'customerList'])->middleware('permission:40');
Route::get('customers/addCustomer', [CustomerController::class, 'addCustomer'])->middleware('permission:39');
Route::post('customers/addCustomer', [CustomerController::class, 'insertCustomer'])->name('addCustomer')->middleware('permission:39');
Route::get('customers/updateCustomer/{id}', [CustomerController::class, 'editCustomer'])->middleware('permission:42');
Route::post('customers/updateCustomer/{id}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer')->middleware('permission:42');
Route::get('customers/deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer'])->middleware('permission:43');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store')->middleware('permission:39');
Route::post('customers/updateCustomer/{id}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer')->middleware('permission:42');
Route::delete('customers/deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer'])->middleware('permission:43');
Route::post('/api/import-customers', [CustomerController::class, 'importCustomers'])->middleware('permission:41');
Route::post('billing/addCustomer', [CustomerController::class, 'addCustomerFromBilling'])->name('billing.addCustomer');
Route::post('/customers/storeBill', [CustomerController::class, 'storeBill'])->name('customers.storeBill');

Route::get('/search-customer', [CustomerController::class, 'searchCustomer']);




//expenses
Route::get('expenses/expenses', [ExpensesController::class, 'expenses'])->middleware('permission:25');
Route::get('expenses/expensesList', [ExpensesController::class, 'expensesList'])->middleware('permission:72');
Route::get('expenses/addExpense', [ExpensesController::class, 'addExpense'])->middleware('permission:70');
Route::post('expenses/addExpense', [ExpensesController::class, 'insertExpense'])->name('addExpense')->middleware('permission:70');
Route::get('expenses/updateExpense/{id}', [ExpensesController::class, 'editExpense'])->middleware('permission:74');
Route::post('expenses/updateExpense/{id}', [ExpensesController::class, 'updateExpense'])->name('edit_expenses')->middleware('permission:74');
Route::get('expenses/delete/{id}', [ExpensesController::class, 'delete_expenses'])->middleware('permission:75');
Route::delete('expenses/delete_expenses/{id}', [ExpensesController::class, 'expenses_delete'])->middleware('permission:75');

//expensescategory
Route::get('expenses/expenseCategoryList', [ExpensesController::class, 'expenseCategoryList'])->middleware('permission:73');
Route::get('expenses/addExpenseCategory', [ExpensesController::class, 'addExpenseCategory'])->middleware('permission:71');
Route::post('expenses/addExpenseCategory', [ExpensesController::class, 'insertExpenseCategory'])->name('addExpenseCategory')->middleware('permission:71');
Route::get('expenses/updateExpenseCategory/{id}', [ExpensesController::class, 'editExpenseCategory'])->middleware('permission:76');
Route::post('expenses/updateExpenseCategory/{id}', [ExpensesController::class, 'updateExpenseCategory'])->name('edit_expenses_category')->middleware('permission:76');
Route::get('expenses/delete/{id}', [ExpensesController::class, 'delete_category'])->middleware('permission:77');
Route::delete('expenses/delete/{id}', [ExpensesController::class, 'delete_category'])->middleware('permission:77');

//users
Route::get('users/users', [UsersController::class, 'users'])->middleware('permission:22');
Route::get('users/permissionList', [UsersController::class, 'permissionList'])->middleware('permission:34');
Route::get('users/rolesList', [UsersController::class, 'rolesList'])->middleware('permission:33');
Route::get('users/usersList', [UsersController::class, 'usersList'])->middleware('permission:32');
Route::get('users/addPermission', [UsersController::class, 'addPermission'])->middleware('permission:31');
Route::get('users/addRole', [UsersController::class, 'addRole'])->middleware('permission:30');
Route::get('users/addUsers', [UsersController::class, 'addUsers'])->middleware('permission:29');
Route::get('users/updatePermission/{id}', [UsersController::class, 'editPermission'])->middleware('permission:38');
Route::get('users/updateRole/{id}', [UsersController::class, 'editRole'])->middleware('permission:37');
Route::get('users/updateUsers/{id}', [UsersController::class, 'editUsers'])->middleware('permission:36');
Route::post('/permissions', [UsersController::class, 'store'])->name('permissions.store')->middleware('permission:31');
Route::put('users/updatePermission/{id}', [UsersController::class, 'updatePermission'])->name('users.updatePermission')->middleware('permission:36');
Route::post('/role', [UsersController::class, 'storeRole'])->name('role.storeRole')->middleware('permission:30');
Route::post('/users/updateRole/{id}', [UsersController::class, 'updateRole'])->name('users.updateRole')->middleware('permission:37');
Route::post('/users', [UsersController::class, 'userstore'])->name('users.store')->middleware('permission:29');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update')->middleware('permission:36');
Route::post('/users/toggle-status/{id}', [UsersController::class, 'toggleUserStatus'])->middleware('permission:35');

//settings
Route::get('settings/settings', [SettingsController::class, 'settings'])->name('settings_page');
Route::get('settings/addBranch', [SettingsController::class, 'addBranch']);
Route::get('settings/addUnit', [SettingsController::class, 'addUnit']);
Route::get('settings/changePassword', [SettingsController::class, 'changePassword'])->middleware('permission:69');
Route::post('settings/changePassword', [SettingsController::class, 'updateChangePassword'])->middleware('permission:69');
//Route::get('settings/siteSettings', [SettingsController::class, 'siteSettings']);
//Site Setting
Route::get('settings/siteSettings', [SiteSettingsController::class, 'index'])->name('settings.index')->middleware('permission:68');
Route::post('/settings', [SiteSettingsController::class, 'store'])->name('settings.store')->middleware('permission:68');
Route::put('/settings/{id}', [SiteSettingsController::class, 'update'])->name('settings.update')->middleware('permission:68');
Route::get('settings/changeSite', [SettingsController::class, 'changeSite'])->middleware('permission:82');
Route::post('/settings/update', [SettingsController::class, 'update'])->middleware('permission:82');



//suppliers
Route::get('suppliers/suppliers', [SuppliersController::class, 'suppliers'])->middleware('permission:24');
Route::get('suppliers/importSupplier', [SuppliersController::class, 'importSupplier'])->middleware('permission:46');
Route::get('suppliers/supplierList', [SuppliersController::class, 'supplierList'])->middleware('permission:45');
Route::get('suppliers/addSupplier', [SuppliersController::class, 'addSupplier'])->middleware('permission:44');
Route::post('suppliers/addSupplier', [SuppliersController::class, 'insertSupplier'])->name('addSupplier')->middleware('permission:44');
Route::get('suppliers/updateSupplier/{id}', [SuppliersController::class, 'editSupplier'])->middleware('permission:47');
Route::post('suppliers/updateSupplier/{id}', [SuppliersController::class, 'updateSupplier'])->name('updateSupplier')->middleware('permission:47');
Route::get('suppliers/deleteSupplier/{id}', [SuppliersController::class, 'deleteSupplier'])->middleware('permission:48');
Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware('permission:44');
Route::delete('suppliers/deleteSuppliers/{id}', [SuppliersController::class, 'deleteSuppliers'])->middleware('permission:48');
Route::put('/suppliers/update/{id}', [SuppliersController::class, 'update'])->name('suppliers.update')->middleware('permission:47');
Route::post('/import-suppliers', [SuppliersController::class, 'import'])->name('import.suppliers')->middleware('permission:46');
Route::post('/supplier/toggle-status/{id}', [SuppliersController::class, 'toggleUserStatus'])->middleware('permission:59');

//payment
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/sales/payment/{id}', [PaymentController::class, 'duePay'])->middleware('permission:66'); // Due payment
Route::post('/payment/update', [PaymentController::class, 'updatePayment'])->name('payment.update')->middleware('permission:66');
Route::get('/sales/paymentdetails/{id}', [PaymentController::class, 'viewDetails'])->middleware('permission:67');
//holdlist
Route::post('/save-hold-order', [HoldOrderController::class, 'store'])->name('save-hold-order');
Route::get('/hold-orders', [HoldOrderController::class, 'getHoldOrders']);
Route::delete('/hold-orders/{id}', [HoldOrderController::class, 'deleteHoldOrder']);
Route::get('/api/hold-order/{id}', [HoldOrderController::class, 'getHoldOrder']);

//reports
Route::get('reports/reports', [ReportsController::class, 'reports'])->middleware('permission:26');
Route::get('reports/stockReports', [ReportsController::class, 'getstockReport'])->middleware('permission:83');
Route::post('/stock-report/filter', [ReportsController::class, 'filter'])->name('stockReport.filter');



//Stock
Route::get('stock/stock', [StockController::class, 'stock'])->middleware('permission:20');
Route::get('stock/addStock', [StockController::class, 'addStock'])->middleware('permission:20');
Route::get('stock/updateStock/{id}', [StockController::class, 'updateStock'])->middleware('permission:57');
Route::post('stock/updateStock', [StockController::class, 'storeStockUpdate'])->middleware('permission:57');


//Mobile
Route::get('mobile/mobile', [MobileController::class, 'mobile'])->middleware('permission:91');
Route::get('mobile/AddMobile', [MobileController::class, 'addmobile'])->middleware('permission:85');
Route::get('mobile/MobileBilling', [MobileController::class, 'mobilebilling'])->name('mobilebilling')->middleware('permission:90');
Route::get('/mobile/{id}/edit', [MobileController::class, 'editmobile'])->name('mobile.edit')->middleware('permission:87');
Route::get('mobile/viewMobile', [MobileController::class, 'viewmobile'])->middleware('permission:86');
Route::get('/mobile/mobileCustomer/{imei}', [MobileController::class, 'mobileCustomer']);

Route::get('/mobile/mobileInvoice/{invoice_number}', [MobileOrderController::class, 'showInvoice'])->name('mobile.mobileInvoice');

Route::post('/save-item-data', [BrandController::class, 'save'])->name('save.item.data');
Route::get('/fetch-items/{type}', [BrandController::class, 'fetchItems'])->name('fetch.items');
Route::delete('/remove-item/{type}/{id}', [BrandController::class, 'removeItem']);


Route::post('/save-mobile-item', [MobileItemController::class, 'store']);
Route::post('/mobile/update-status', [MobileController::class, 'updateStatus'])->name('mobile.updateStatus')->middleware('permission:89');


// Delete IMEI
Route::delete('/delete-imei/{imeiId}', [MobileImeiController::class, 'destroy']);
Route::get('/get-imei/{mobileItemId}', [MobileImeiController::class, 'getImei']);
Route::post('/store-imei', [MobileImeiController::class, 'store'])->middleware('permission:88');


Route::put('/mobile-items/{id}', [MobileItemController::class, 'update'])->name('mobile-items.update');

Route::post('/mobile/completePurchase/{imei_id}', [MobileOrderController::class, 'completePurchase'])->name('mobile.completePurchase');

Route::post('/update-imei-status/{imei}', [MobileImeiController::class, 'updateStatus']);



//Other Items
Route::get('otheritem/otheritem', [OtherItemController::class, 'otheritem']);
Route::get('otherItem/addotherItem', [OtherItemController::class, 'addotherItem']);
Route::get('otherItem/viewotherItem', [OtherItemController::class, 'viewotherItem'])->name('viewotherItem');


//Add Other Item
Route::post('/save-otheritem-data', [OtherItemDataController::class, 'save'])->name('save.otheritem.data');
Route::get('/fetch-otheritem/{type}', [OtherItemDataController::class, 'fetchItems'])->name('fetch.otheritem');
Route::delete('/remove-otheritem/{type}/{id}', [OtherItemDataController::class, 'removeotheritem']);
Route::post('/save-other-item-and-serial-numbers', [OtherItemDataController::class, 'saveOtherItemAndSerialNumbers']);

//Update Status
Route::post('/oitem/update-status', [OtherItemController::class, 'updateStatus'])->name('Oitem.updateStatus');

//Other OtherItem Update
Route::get('/oItem/{id}/edit', [OtherItemDataController::class, 'editOItem'])->name('Oitem.edit');
Route::put('/oItem_edit/{id}/edit', [OtherItemDataController::class, 'update'])->name('Other_items.update');

//Serial Numbers
Route::post('/serial-Number', [SerialNumberController::class, 'store']);
Route::get('/serial-Number', [SerialNumberController::class, 'index']);
Route::delete('/serial-Number/{id}', [SerialNumberController::class, 'destroy']);

//OtherItem Billing
Route::get('otherItem/otherItemBilling', [OtherItemBillingController::class, 'otherItemBilling']);
Route::get('/returnable-items/{id}', [OtherItemBillingController::class, 'getItemDetails']);
Route::post('/order_Process', [OtherItemBillingController::class, 'handleOrder'])->name('order_Process');
Route::get('/another-ui', [OtherItemBillingController::class, 'showAnotherUI'])->name('another-ui');
Route::post('/place-other-order', [OtherItemBillingController::class, 'store'])->name('other-orders.store');
Route::get('/other-payment/{invoiceNum}', [OtherItemBillingController::class, 'show'])->name('other-payment.show');