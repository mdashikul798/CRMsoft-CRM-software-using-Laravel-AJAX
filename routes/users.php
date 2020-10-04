<?php
 
 /*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
| Here is where the User routes is registered for the application.
| These routes are loaded by the RouteServiceProvider within 
| a group which contains the "web" middleware group.
|
| All the route which is needed to run the "users" frontend
| is defined here, it's only the "users" route
|
*/

 Route::get('/', 'User\HomeController@userHome')->name('user.home');
//Category route
Route::prefix('category')->group(function(){
	Route::get('/all-category', 'User\CategoryController@allCategory')->name('all.category');
	Route::get('/add-category', 'User\CategoryController@addCategory')->name('add.category');
	Route::post('/save-category', 'User\CategoryController@saveCategory')->name('save.category');
	Route::get('/cateStatus/{id}/{status}', 'User\CategoryController@cateStatus')->name('cateStatus');

	Route::get('/edit-category/{id}', 'User\CategoryController@editCate')->name('edit.category');
	Route::get('/delete-category/{id}', 'User\CategoryController@dleteCate')->name('delete.category');
});
//End of category route

//Sales route
Route::prefix('sale')->group(function()
{
	//Product sale route
	Route::get('/product-sale', 'User\SaleController@saleProduct')->name('product.sale');
	Route::post('/add-sale', 'User\SaleController@addSale')->name('add.sale');
	Route::get('/add-sale-qty/{id}', 'User\SaleController@addSaleQty')->name('add.sale.qty');
	Route::get('/reduce-sale-qty/{id}', 'User\SaleController@reduceSaleQty')->name('reduce.sale.qty');
	Route::get('/delete-product/{id}', 'User\SaleController@deleteProduct')->name('delete.product');
	Route::get('/product-sale-save', 'User\SaleController@productSaleSave')->name('product.sale.save');
	Route::get('/product-print-view', 'User\SaleController@productSaleView')->name('product.print.view');
	Route::get('/product-print', 'User\SaleController@productSalePrint')->name('product.print');
	
	//Asset sale route
	Route::get('/asset-sale', 'User\SaleController@assetSale')->name('asset.sale');
	Route::post('add-asset-sale', 'User\SaleController@addAssetSale')->name('add.asset.sale');
	Route::get('delete-asset-sale/{id}', 'User\SaleController@deleteAssetSale')->name('delete.asset.sale');
	Route::get('asset-sale-save', 'User\SaleController@assetSaleSave')->name('asset.sale.save');
	Route::get('asset-sale-view', 'User\SaleController@assetSaleView')->name('asset.sale.view');
	Route::get('asset-sale-print', 'User\SaleController@assetSalePrint')->name('asset.sale.print');
	//Route for views
	Route::get('/view/product-sale', 'User\SaleController@viewProductSale')->name('view.product.sale');
	Route::get('/view/other-sale', 'User\SaleController@viewOtherSale')->name('view.other.sale');
	Route::get('/view/asset-sale', 'User\SaleController@viewAssetSale')->name('view.asset.sale');
});
//End sales route

 //Route for all purchase
 Route::prefix('purchase')->group(function()
 {
 	//Product purchase
	Route::get('/product-purchase', 'User\PurchaseController@productPurchase')->name('product.purchase');
	Route::post('/add-purchase', 'User\PurchaseController@addPurchase')->name('add.purchase');
	Route::get('/add-purchase-qty/{id}', 'User\PurchaseController@addPurchaseQty')->name('add.purchase.qty');
	Route::get('/reduce-purchase-qty/{id}', 'User\PurchaseController@reducePurchaseQty')->name('reduce.purchase.qty');
	Route::get('/delete-product/{id}', 'User\PurchaseController@deletePurchase')->name('delete.purchase');
	Route::get('/product-purchase-save', 'User\PurchaseController@productPurchaseSave')->name('product.purchase.save');
	Route::get('/product-print-view', 'User\PurchaseController@purchasePrintView')->name('purchase.print.view');
	Route::get('/product-print', 'User\PurchaseController@purchasePrint')->name('purchase.print');
	
	//Stationery purchase
	Route::get('/stationery-purchase', 'User\PurchaseController@stationeryPurchase')->name('stationery.purchase');
	Route::post('/add-stationery', 'User\PurchaseController@addStationery')->name('add.stationery');
	Route::get('/add-stationery-qty/{id}', 'User\PurchaseController@addStationeryQty')->name('add.stationery.qty');
	Route::get('/reduce-stationery-qty/{id}', 'User\PurchaseController@reduceStationeryQty')->name('reduce.stationery.qty');
	Route::get('/delete-stationery/{id}', 'User\PurchaseController@deleteStationery')->name('delete.stationery');
	Route::get('/stationery-purchase-save', 'User\PurchaseController@stationeryPurchaseSave')->name('stationery.purchase.save');
	Route::get('/stationery-print-view', 'User\PurchaseController@stationeryPrintView')->name('stationery.print.view');
	Route::get('/stationery-print', 'User\PurchaseController@stationeryPrint')->name('stationery.print');
	
	//Asset purchase
	Route::get('/asset-purchase', 'User\PurchaseController@assetPurchase')->name('asset.purchase');
	Route::post('/add-asset', 'User\PurchaseController@addAsset')->name('add.asset');
	Route::get('/add-asset-qty/{id}', 'User\PurchaseController@addAssetQty')->name('add.asset.qty');
	Route::get('/reduce-asset-qty/{id}', 'User\PurchaseController@reduceAssetQty')->name('reduce.asset.qty');
	Route::get('/delete-asset/{id}', 'User\PurchaseController@deleteAsset')->name('delete.asset');
	Route::get('/asset-purchase-save', 'User\PurchaseController@assetPurchaseSave')->name('asset.purchase.save');
	Route::get('/asset-print-view', 'User\PurchaseController@assetPrintView')->name('asset.print.view');
	Route::get('/asset-print', 'User\PurchaseController@assetPrint')->name('asset.print');

	//view all purchase
	Route::get('/view/product-purchase', 'User\PurchaseController@viewProductPurchase')->name('view.product.purchase');
	Route::get('/view/stationery-purchase', 'User\PurchaseController@viewStationeryPurchase')->name('view.stationery.purchase');
	Route::get('/view/asset-purchase', 'User\PurchaseController@viewAssetPurchase')->name('view.asset.purchase');
 });
 //End of purchase route

 //Route for bank activities
 Route::prefix('bank')->group(function()
 {
 	//Bank deposit
	Route::get('/bank-deposit', 'User\BankController@bankDeposit')->name('bank.deposit');
	Route::post('/add-deposit', 'User\BankController@addDeposit')->name('add.deposit');
	Route::get('/delete-deposit/{id}', 'User\BankController@deleteDeposit')->name('delete.deposit');
	Route::get('/save-deposit', 'User\BankController@saveDeposit')->name('save.deposit');

	//Bank withdrawal
	Route::get('/bank-withdrawal', 'User\BankController@Withdrawal')->name('bank.withdrawal');
	Route::post('/add-withdrawal', 'User\BankController@addWithdrawal')->name('add.withdrawal');
	Route::get('/delete-withdrawal/{id}', 'User\BankController@deleteWithdrawal')->name('delete.withdrawal');
	Route::get('/save-withdrawal', 'User\BankController@saveWithdrawal')->name('save.withdrawal');

	//Statement view
	 Route::get('/bank-statement', 'User\BankController@statement')->name('bank.statement');

 });
 //End of bank route

 //Route for supplier
 Route::prefix('supplier')->group(function()
 {
	Route::get('/add-supplier', 'User\SupplierController@addSupplier')->name('add.supplier');
	Route::post('/save-supplier', 'User\SupplierController@saveSupplier')->name('save.supplier');
	Route::get('/view-supplier', 'User\SupplierController@viewSupplier')->name('view.supplier');
	Route::get('/supplierStatus/{id}/{status}', 'User\SupplierController@supplierStatus')->name('supplierStatus');
	Route::get('/editSupplier/{id}', 'User\SupplierController@editSupplier')->name('editSupplier');
	Route::get('/deleteSupplier/{id}', 'User\SupplierController@deleteSupplier')->name('deleteSupplier');
 });
 //End of route for supplier

 //Income route
 Route::prefix('income')->group(function()
 {
	Route::get('/add-other-income', 'User\OtherIncomeController@addOtherIncome')->name('other.income');
	Route::post('/save-other-income', 'User\OtherIncomeController@saveOtherIncome')->name('save.other.income');
	Route::get('/delete-other-income/{id}', 'User\OtherIncomeController@deleteOtherIncome')->name('delete.other.income');
	Route::get('/other-income-save-direct', 'User\OtherIncomeController@otherIncomeSaveDirect')->name('other.income.save.direct');
	Route::get('/other-income-print-view', 'User\OtherIncomeController@otherIncomePrintView')->name('other.income.print.view');
	Route::get('/other-income-print', 'User\OtherIncomeController@otherIncomePrint')->name('other.income.print');

	Route::get('/view-other-income', 'User\OtherIncomeController@viewOtherIncome')->name('other.view');

 });
 //End of income route
 
 //Expense route
 Route::prefix('expense')->group(function()
 {
	Route::get('/operating-exp', 'User\OperatingController@operatingExp')->name('add.operating');
	//All operating expense is listed below
	Route::post('/add-salary', 'User\OperatingController@addSalary')->name('operating.add.salary');
	Route::post('/add-office-rent', 'User\OperatingController@addOfficeRent')->name('operating.add.office.rent');
	
	Route::post('/add-electricity-bill', 'User\OperatingController@addElectricityBill')->name('operating.add.electricity.bill');
	Route::post('/add-night-guard-bill', 'User\OperatingController@addNightGuardBill')->name('operating.add.night.guard.bill');
	Route::post('/add-internet-bill', 'User\OperatingController@addInternetBill')->name('operating.add.internet.bill');
	Route::post('/add-other-expense', 'User\OperatingController@addOtherExpense')->name('operating.add.other.expense');
	Route::get('/save-operating-exp', 'User\OperatingController@saveOperatingExp')->name('save.operating.exp');
	Route::get('/delete-operating-exp/{id}', 'User\OperatingController@deleteOperatingExp')->name('delete.operating.exp');
	Route::get('/operating-view', 'User\OperatingController@viewOperating')->name('view.operating');


	Route::get('/admin-exp', 'User\AdminController@adminExpHome')->name('admin.exp.home');
	Route::post('/add-admin-exp', 'User\AdminController@addAdminExpHome')->name('add.admin.exp');
	Route::get('/save-admin-exp', 'User\AdminController@saveAdminExpHome')->name('save.admin.exp');
	Route::get('/delete-admin-exp/{id}', 'User\AdminController@deleteAdminExpHome')->name('delete.admin.exp');


	Route::get('/admin-view', 'User\AdminController@viewAdmin')->name('view.admin');
 });
 //End of expense route
 
 //Return route
Route::prefix('return')->group(function()
{
	//Return from customer
	Route::get('/customer-return', 'User\ReturnController@customerReturn')->name('customer.return');
	Route::get('/customerReturnSearchByInv/{invoiceNum}', 'User\ReturnController@customerReturnSearchByInv')->name('customer.return.search.inv');
	Route::get('/customerReturnSearchByItem/{itemName}', 'User\ReturnController@customerReturnSearchByItem')->name('customer.return.search.item');
	Route::post('/save-customer-return', 'User\ReturnController@saveCustomerReturn')->name('save.customer.return');
	Route::get('/delete-customer-return/{id}', 'User\ReturnController@deleteCustomerReturn')->name('delete.customer.return');
	//Return to supplier
	Route::get('/supplier-return', 'User\ReturnController@supplierReturn')->name('supplier.return');
	Route::get('/supplierReturnSearchByModel/{model}', 'User\ReturnController@supplierReturnSearchByModel')->name('supplier.return.search.model');
	Route::get('/supplierReturnSearchByName/{itemName}', 'User\ReturnController@supplierReturnSearchByName')->name('supplier.return.search.name');
	Route::post('/save-supplier-return', 'User\ReturnController@saveSupplierReturn')->name('save.supplier.return');
	Route::get('/delete-supplier-return/{id}', 'User\ReturnController@deleteSupplierReturn')->name('delete.supplier.return');
	//View all return
	Route::get('/view-return', 'User\ReturnController@viewReturn')->name('view.return');
});
//End of return route
 
//Accounting route
Route::prefix('accounting')->group(function(){
	Route::get('/view-profit-loss', 'User\AccountingController@viewProfitLoss')->name('view.profit.loss');
	Route::get('/view-fixed-asset', 'User\AccountingController@viewFixedAsset')->name('view.fixed.asset');
	Route::get('/view-receivable', 'User\AccountingController@viewReceivable')->name('view.receivable');
	Route::get('/receivablePaid/{id}', 'User\AccountingController@receivablePaid')->name('receivablePaid');
	Route::get('/view-payable', 'User\AccountingController@viewPayable')->name('view.payable');
	Route::get('/payablePaid/{id}', 'User\AccountingController@payablePaid')->name('payablePaid');
});
//End of accounting route

//Report route
Route::prefix('report')->group(function(){
	Route::get('/view-stock-report', 'User\ReportController@viewStockReport')->name('view.stock.report');
	Route::get('/view-customer-report', 'User\ReportController@viewCustomerReport')->name('view.customer.report');
});
//End of report route
 
//Component route group
Route::prefix('component')->group(function()
{
	//Bank account route
	Route::get('/add-bank-account', 'User\ComponentsController@addBankAccount')->name('add.bank.account');
	Route::post('/save-bank-account', 'User\ComponentsController@saveBankAccount')->name('save.bank.account');
	Route::get('/bankStatus/{id}/{status}', 'User\ComponentsController@bankStatus')->name('bankStatus');
	Route::get('/deleteBankAccount/{id}', 'User\ComponentsController@deleteBankAccount')->name('deleteBankAccount');
	//End of Bank account

	//Office staff route
	Route::get('/add-office-staff', 'User\ComponentsController@addOfficeStaff')->name('add.office.staff');
	Route::post('/save-office-staff', 'User\ComponentsController@saveOfficeStaff')->name('save.office.staff');
	Route::get('/officeStaffStatus/{id}/{status}', 'User\ComponentsController@officeStaffStatus')->name('officeStaffStatus');
	Route::get('/deleteOfficeStaff/{id}', 'User\ComponentsController@deleteOfficeStaff')->name('deleteOfficeStaff');
	//End of office staff

	//Branch route
	Route::get('/add-office-branch', 'User\ComponentsController@addBranch')->name('add.office.branch');
	Route::post('/save-office-branch', 'User\ComponentsController@saveBranch')->name('save.office.branch');
	Route::get('/changeBranchStatus/{id}/{status}', 'User\ComponentsController@changeBranchStatus')->name('changeBranchStatus');
	Route::get('/deleteBranch/{id}', 'User\ComponentsController@deleteBranch')->name('deleteBranch');
	//End of branch

	//Meater route
	Route::get('/add-meter', 'User\ComponentsController@addMeter')->name('add.meter');
	Route::post('/save-meter', 'User\ComponentsController@saveMeter')->name('save.meter');
	Route::get('/changeMeterStatus/{id}/{status}', 'User\ComponentsController@changeMeterStatus')->name('changeBranchStatus');
	Route::get('/deleteMeter/{id}', 'User\ComponentsController@deleteMeter')->name('deleteMeter');
	//End of meter

	//Depreciation route
	Route::get('/add-depreciation', 'User\ComponentsController@addDepreciation')->name('add.depreciation');

	Route::get('/searchDepreciationByItem/{assetName}', 'User\ComponentsController@searchDepreciationByItem')->name('searchDepreciationByItem');

	Route::post('/save-depreciation', 'User\ComponentsController@saveDepreciation')->name('save.depreciation');
	//End of depreciation route

	
});
//End of component route group

/*Lottery route is also defined here*/
Route::get('/customer-lottery', 'User\ComponentsController@customerLottery')->name('customer.lottery');
/*Route::get('/daterangeFetch_data', 'User\ComponentsController@fetch_data')->name('daterangeFetch_data');*/
Route::post('/daterange/fetch_data', 'User\ComponentsController@fetch_data')->name('daterange.fetch_data');


