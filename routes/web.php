<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\AccountsReportController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ExpenditureController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\StocksReportController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\WalletReceivableController;
use App\Http\Controllers\CustomerLedgerController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\SupplierLedgerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    // return view('welcome');
    return redirect('/admin/login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {

        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('create', [UserController::class, 'create'])->name('create');
        Route::post('check', [UserController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:web', 'PreventBackHistory', 'is_first_login'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::view('/change-password', 'dashboard.user.changepass')->name('changepass');
        Route::post('/change-passowrd-action', [UserController::class, 'changePassword'])->name('changepassaction');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login1')->name('login');
        Route::post('check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/change-password', 'dashboard.admin.changepass')->name('changepass');
        Route::post('/change-passowrd-action', [AdminController::class, 'changePassword'])->name('changepassaction');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory', 'is_admin_first_login'])->group(function () {
        Route::get('home', [AdminController::class, 'index'])->name('home');
        Route::get('todaysale', [AdminController::class, 'todaysale'])->name('todaysale');
        Route::get('todaypurchase', [AdminController::class, 'todaypurchase'])->name('todaypurchase');
        Route::get('receivable', [AdminController::class, 'receivable'])->name('receivable');
        Route::get('dashpayable', [AdminController::class, 'dashpayable'])->name('dashpayable');

        //Category Management
        Route::get('category-list', [ProductManagementController::class, 'index'])->name('category-list');
        Route::post('add-category', [ProductManagementController::class, 'addCategory'])->name('addcategory');
        Route::get('getCategoriesList', [ProductManagementController::class, 'getCategoriesList'])->name('getCategoriesList');
        Route::post('getCategoryDetails', [ProductManagementController::class, 'getCategoryDetails'])->name('getCategoryDetails');
        Route::post('updateCategoryDetails', [ProductManagementController::class, 'updateCategoryDetails'])->name('updateCategoryDetails');
        Route::post('deleteCategory', [ProductManagementController::class, 'deleteCategory'])->name('deleteCategory');

        //Unit Management
        Route::get('unit-list', [ProductManagementController::class, 'unitlist'])->name('unit-list');
        Route::post('add-unit', [ProductManagementController::class, 'addUnit'])->name('addunit');
        Route::get('getUnitsList', [ProductManagementController::class, 'getUnitsList'])->name('getUnitsList');
        Route::post('getUnitDetails', [ProductManagementController::class, 'getUnitDetails'])->name('getUnitDetails');
        Route::post('updateUnitDetails', [ProductManagementController::class, 'updateUnitDetails'])->name('updateUnitDetails');
        Route::post('deleteUnit', [ProductManagementController::class, 'deleteUnit'])->name('deleteUnit');

        //manufacturer Management
        Route::get('manufacturer-list', [ProductManagementController::class, 'manufacturerlist'])->name('manufacturer-list');
        Route::post('add-manufacturer', [ProductManagementController::class, 'addManufacturer'])->name('addmanufacturer');
        Route::get('getManufacturersList', [ProductManagementController::class, 'getManufacturersList'])->name('getManufacturersList');
        Route::post('getManufacturerDetails', [ProductManagementController::class, 'getManufacturerDetails'])->name('getManufacturerDetails');
        Route::post('updateManufacturerDetails', [ProductManagementController::class, 'updateManufacturerDetails'])->name('updateManufacturerDetails');
        Route::post('deleteManufacturer', [ProductManagementController::class, 'deleteManufacturer'])->name('deleteManufacturer');

        //Location Management
        Route::get('shelf-list', [ProductManagementController::class, 'locationlist'])->name('shelf-list');
        Route::post('add-shelf', [ProductManagementController::class, 'addShelf'])->name('addshelf');
        Route::get('getShelfsList', [ProductManagementController::class, 'getShelfsList'])->name('getShelfsList');
        Route::post('getShelfDetails', [ProductManagementController::class, 'getShelfDetails'])->name('getShelfDetails');
        Route::post('updateShelfDetails', [ProductManagementController::class, 'updateShelfDetails'])->name('updateShelfDetails');
        Route::post('deleteShelf', [ProductManagementController::class, 'deleteShelf'])->name('deleteShelf');

        //Supplier Management
        Route::get('supplier-list', [SupplierController::class, 'supplierlist'])->name('supplier-list');
        Route::post('add-supplier', [SupplierController::class, 'addSupplier'])->name('addsupplier');
        Route::get('getSuppliersList', [SupplierController::class, 'getSuppliersList'])->name('getSuppliersList');
        Route::post('getSupplierDetails', [SupplierController::class, 'getSupplierDetails'])->name('getSupplierDetails');
        Route::post('updateSupplierDetails', [SupplierController::class, 'updateSupplierDetails'])->name('updateSupplierDetails');
        Route::post('deleteSupplier', [SupplierController::class, 'deleteSupplier'])->name('deleteSupplier');

        //Customer Management
        Route::get('customer-list', [CustomerController::class, 'customerlist'])->name('customer-list');
        Route::post('add-customer', [CustomerController::class, 'addCustomer'])->name('addcustomer');
        Route::get('getCustomersList', [CustomerController::class, 'getCustomersList'])->name('getCustomersList');
        Route::post('getCustomerDetails', [CustomerController::class, 'getCustomerDetails'])->name('getCustomerDetails');
        Route::post('updateCustomerDetails', [CustomerController::class, 'updateCustomerDetails'])->name('updateCustomerDetails');
        Route::post('deleteCustomer', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');

        //Brand Management
        Route::get('brand-list', [BrandController::class, 'brandlist'])->name('brand-list');
        Route::post('add-brand', [BrandController::class, 'addBrand'])->name('addbrand');
        Route::get('getBrandsList', [BrandController::class, 'getBrandsList'])->name('getBrandsList');
        Route::post('getBrandDetails', [BrandController::class, 'getBrandDetails'])->name('getBrandDetails');
        Route::post('updateBrandDetails', [BrandController::class, 'updateBrandDetails'])->name('updateBrandDetails');
        Route::post('deleteBrand', [BrandController::class, 'deleteBrand'])->name('deleteBrand');

        //Product Management
        Route::get('add-product', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('addmanufacturerinpdt', [ProductController::class, 'addmanufacturerinpdt'])->name('addmanufacturerinpdt');
        Route::post('addcategoryinpdt', [ProductController::class, 'addcategoryinpdt'])->name('addcategoryinpdt');
        Route::post('addbrandinpdt', [ProductController::class, 'addbrandinpdt'])->name('addbrandinpdt');
        Route::post('addunitinpdt', [ProductController::class, 'addunitinpdt'])->name('addunitinpdt');
        Route::post('addshelfinpdt', [ProductController::class, 'addshelfinpdt'])->name('addshelfinpdt');
        Route::post('addProducts', [ProductController::class, 'addProducts'])->name('addProducts');
        Route::post('addProductToStock', [ProductController::class, 'addProductToStock'])->name('addProductToStock');
        Route::post('deletePdtCart', [ProductController::class, 'deletePdtCart'])->name('deletePdtCart');

        Route::get('addtostock/{id?}', [ProductController::class, 'addtostock'])->name('addtostock');
        Route::get('add-product-to-stock', [ProductController::class, 'addProductToStocks'])->name('addProductToStocks');
        Route::post('searchResult', [ProductController::class, 'searchResult'])->name('searchResult');
        Route::get('product-purchase', [ProductController::class, 'purchaseProduct'])->name('purchaseProduct');
        Route::post('searchResultForPurchase', [ProductController::class, 'searchResultForPurchase'])->name('searchResultForPurchase');
        Route::post('purchaseProducts', [ProductController::class, 'purchaseProducts'])->name('purchaseProducts');
        Route::post('purchaseProducts1', [ProductController::class, 'purchaseProducts1'])->name('purchaseProducts1');

        Route::get('purchase-return', [PurchaseController::class, 'purchaseReturn'])->name('purchaseReturn');
        Route::post('searchProducts', [PurchaseController::class, 'searchProducts'])->name('searchProducts');
        Route::post('searchProductsDetails', [PurchaseController::class, 'searchProductsDetails'])->name('searchProductsDetails');
        Route::post('purchaseReturn1', [PurchaseController::class, 'purchaseReturn1'])->name('purchaseReturn1');
        Route::post('purchaseReturnProducts', [PurchaseController::class, 'purchaseReturnProducts'])->name('purchaseReturnProducts');
        Route::post('deletePrCart', [PurchaseController::class, 'deletePrCart'])->name('deletePrCart');
        Route::get('stock-damage', [ProductController::class, 'stockDamage'])->name('stockDamage');
        Route::post('addstockdamage', [ProductController::class, 'addstockdamage'])->name('addstockdamage');
        Route::post('deleteDmgCart', [ProductController::class, 'deleteDmgCart'])->name('deleteDmgCart');
        Route::post('stockDamageAction', [ProductController::class, 'stockDamageAction'])->name('stockDamageAction');


        //Accounts Management
        Route::get('account-type-list', [AccountsController::class, 'account_type_list'])->name('account_type_list');
        Route::post('add-accountType', [AccountsController::class, 'addAccountType'])->name('addAccountType');
        Route::get('getAccountTypesList', [AccountsController::class, 'getAccountTypesList'])->name('getAccountTypesList');
        Route::post('getAccountTypeDetails', [AccountsController::class, 'getAccountTypeDetails'])->name('getAccountTypeDetails');
        Route::post('updateAccountTypeDetails', [AccountsController::class, 'updateAccountTypeDetails'])->name('updateAccountTypeDetails');
        Route::post('deleteAccountType', [AccountsController::class, 'deleteAccountType'])->name('deleteAccountType');
        Route::get('opening-balance', [AccountsController::class, 'openingBalance'])->name('openingBalance');
        Route::post('searchAccounts', [AccountsController::class, 'searchAccounts'])->name('searchAccounts');
        Route::post('obaction', [AccountsController::class, 'obaction'])->name('obaction');

        //Expenditure Management
        Route::get('expenditure', [ExpenditureController::class, 'expenditure'])->name('expenditure');
        Route::post('expaction', [ExpenditureController::class, 'expaction'])->name('expaction');
        Route::get('journal', [ExpenditureController::class, 'journal'])->name('journal');
        Route::post('journalaction', [ExpenditureController::class, 'journalaction'])->name('journalaction');
        Route::get('contra-transaction', [ExpenditureController::class, 'contra'])->name('contra');
        Route::post('contraaction', [ExpenditureController::class, 'contraaction'])->name('contraaction');

        Route::get('payment-supplier', [AccountsController::class, 'paymentSupplier'])->name('paymentSupplier');
        Route::post('getSupPayment', [AccountsController::class, 'getSupPayment'])->name('getSupPayment');
        Route::post('getSpplierPaymentDetails', [AccountsController::class, 'getSpplierPaymentDetails'])->name('getSpplierPaymentDetails');
        Route::post('updateSupplierPayment', [AccountsController::class, 'updateSupplierPayment'])->name('updateSupplierPayment');

        Route::get('receive-customer', [AccountsController::class, 'receiveCustomer'])->name('receiveCustomer');
        Route::post('getCusPayment', [AccountsController::class, 'getCusPayment'])->name('getCusPayment');
        Route::post('getCustomerPaymentDetails', [AccountsController::class, 'getCustomerPaymentDetails'])->name('getCustomerPaymentDetails');
        Route::post('updateCustomerPayment', [AccountsController::class, 'updateCustomerPayment'])->name('updateCustomerPayment');

        Route::get('cheque-clearance', [AccountsController::class, 'chequeClearance'])->name('chequeClearance');
        Route::post('getCusPaymentChq', [AccountsController::class, 'getCusPaymentChq'])->name('getCusPaymentChq');
        Route::post('getCustomerPaymentDetailsChq', [AccountsController::class, 'getCustomerPaymentDetailsChq'])->name('getCustomerPaymentDetailsChq');
        Route::post('updateCustomerPaymentChq', [AccountsController::class, 'updateCustomerPaymentChq'])->name('updateCustomerPaymentChq');

        //Tax Management
        Route::get('tax-list', [AccountsController::class, 'taxlist'])->name('tax-list');
        Route::post('add-tax', [AccountsController::class, 'addTax'])->name('addtax');
        Route::get('getTaxsList', [AccountsController::class, 'getTaxsList'])->name('getTaxsList');
        Route::post('getTaxDetails', [AccountsController::class, 'getTaxDetails'])->name('getTaxDetails');
        Route::post('updateTaxDetails', [AccountsController::class, 'updateTaxDetails'])->name('updateTaxDetails');
        Route::post('deleteTax', [AccountsController::class, 'deleteTax'])->name('deleteTax');

        //Sale Management

        Route::get('sales', [SalesController::class, 'index'])->name('sales');
        Route::post('searchProductsforSale', [SalesController::class, 'searchProductsforSale'])->name('searchProductsforSale');
        Route::post('searchProductsDetails1', [SalesController::class, 'searchProductsDetails1'])->name('searchProductsDetails1');
        Route::post('searchProductsDetails2', [SalesController::class, 'searchProductsDetails2'])->name('searchProductsDetails2');
        Route::post('salesAction', [SalesController::class, 'salesAction'])->name('salesAction');
        Route::post('addCustomerinSales', [SalesController::class, 'addCustomerinSales'])->name('addCustomerinSales');
        Route::post('deleteSlCart', [SalesController::class, 'deleteSlCart'])->name('deleteSlCart');

        Route::post('finalSale', [SalesController::class, 'finalSale'])->name('finalSale');
        Route::get('sales-return', [SalesController::class, 'salesReturn'])->name('salesReturn');

        Route::post('searchSalesReturn1', [SalesController::class, 'searchSalesReturn1'])->name('searchSalesReturn1');
        Route::post('searchSalesReturn2', [SalesController::class, 'searchSalesReturn2'])->name('searchSalesReturn2');
        Route::post('searchProductsDetails3', [SalesController::class, 'searchProductsDetails3'])->name('searchProductsDetails3');
        Route::post('salesReturnAction', [SalesController::class, 'salesReturnAction'])->name('salesReturnAction');
        Route::post('deleteSlRetCart', [SalesController::class, 'deleteSlRetCart'])->name('deleteSlRetCart');
        Route::post('finalSaleReturn', [SalesController::class, 'finalSaleReturn'])->name('finalSaleReturn');

        //Report
        Route::get('homereports', [AccountsReportController::class, 'index'])->name('homereports');
        Route::get('suppliers-list', [AccountsReportController::class, 'suppliersList'])->name('suppliersList');
        Route::get('payable', [AccountsReportController::class, 'payable'])->name('payable');
        Route::get('test', [AccountsReportController::class, 'test'])->name('test');
        Route::post('date-wise-payable-accounts', [AccountsReportController::class, 'datewisepayable'])->name('datewisepayable');
        Route::post('date-wise-purchase', [AccountsReportController::class, 'datewispurchase'])->name('datewispurchase');
        Route::post('date-wise-invoice', [AccountsReportController::class, 'purchaseinvoice'])->name('purchaseinvoice');
        Route::post('purchase-return', [AccountsReportController::class, 'purchasereturn'])->name('purchasereturn');
        Route::post('stockList', [StocksReportController::class, 'stockList'])->name('stockList');
        Route::post('stockListWithVal', [StocksReportController::class, 'stockListWithVal'])->name('stockListWithVal');
        Route::post('currentStock', [StocksReportController::class, 'currentStock'])->name('currentStock');
        Route::post('currentStockwithVal', [StocksReportController::class, 'currentStockwithVal'])->name('currentStockwithVal');
        Route::post('stockOut', [StocksReportController::class, 'stockOut'])->name('stockOut');
        Route::post('expiredIn', [StocksReportController::class, 'expiredIn'])->name('expiredIn');
        Route::post('typeWise', [StocksReportController::class, 'typeWise'])->name('typeWise');
        Route::post('damagePdtRpt', [StocksReportController::class, 'damagePdtRpt'])->name('damagePdtRpt');
        Route::post('showCustomers', [SalesReportController::class, 'showCustomers'])->name('showCustomers');
        Route::post('showReceivable', [SalesReportController::class, 'showReceivable'])->name('showReceivable');
        Route::post('datewisreceivale', [SalesReportController::class, 'datewisreceivale'])->name('datewisreceivale');



        Route::get('purchase-reports', [AccountsReportController::class, 'purchaseReports'])->name('purchaseReports');
        Route::get('stock-reports', [StocksReportController::class, 'stockReports'])->name('stockReports');
        Route::get('sales-reports', [SalesReportController::class, 'index'])->name('salesReports');
        Route::post('date-wise-sale', [SalesReportController::class, 'datewisesale'])->name('datewisesale');
        Route::post('date-wise-sale-invoice', [SalesReportController::class, 'salesinvoice'])->name('salesinvoice');
        Route::post('date-wise-sale-invoice1', [SalesReportController::class, 'salesinvoice1'])->name('salesinvoice1');
        Route::post('getInv', [SalesReportController::class, 'getInv'])->name('getInv');
        Route::post('getChallan', [SalesReportController::class, 'getChallan'])->name('getChallan');
        Route::post('sales-return', [SalesReportController::class, 'salesreturn'])->name('salesreturn');
        Route::get('accounts-reports', [AccountsReportController::class, 'accountsReport'])->name('accountsReport');
        Route::post('getAccounts', [AccountsReportController::class, 'getAccounts'])->name('getAccounts');
        Route::post('expenditureReport', [AccountsReportController::class, 'expenditureReport'])->name('expenditureReport');
        Route::post('balancesheet', [AccountsReportController::class, 'balancesheet'])->name('balancesheet');
        Route::post('trialbalance', [AccountsReportController::class, 'trialbalance'])->name('trialbalance');
        Route::post('incomestatement', [AccountsReportController::class, 'incomestatement'])->name('incomestatement');
        Route::post('cashflow', [AccountsReportController::class, 'cashflow'])->name('cashflow');


        Route::get('sale', [ProductManagementController::class, 'sale'])->name('sale');
        Route::post('save', [ProductManagementController::class, 'save'])->name('save');
        Route::get('search', [ProductManagementController::class, 'search'])->name('search');
Route::post('/customers/check-phone', [ProductManagementController::class, 'checkPhone'])->name('customers.checkPhone');
Route::post('/customers', [ProductManagementController::class, 'store'])->name('customers.store');


        Route::get('printBarcode', [SalesController::class, 'printBarcode'])->name('printBarcode');
        Route::post('barAction', [SalesController::class, 'barAction'])->name('barAction');

        Route::get('addstore', [SuperAdminController::class, 'index'])->name('index');


        Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
        Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
        Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
        Route::get('/recipes/{product_id}', [RecipeController::class, 'showRecipeDetails'])->name('recipes.details');

        Route::resource('productions', \App\Http\Controllers\Admin\ProductionController::class);
        Route::post('productions/get-recipe', [\App\Http\Controllers\Admin\ProductionController::class, 'getRecipe'])->name('productions.get-recipe');


        Route::get('wallet-receivables', [WalletReceivableController::class, 'index'])->name('wallet-receivables.index');
        Route::get('wallet-transfers', [WalletReceivableController::class, 'transfers'])->name('wallet-receivables.transfers');
        Route::get('wallet-transfers/create', [WalletReceivableController::class, 'createTransfer'])
            ->name('wallet-receivables.transfers.create');
        Route::post('wallet-transfers', [WalletReceivableController::class, 'storeTransfer'])
            ->name('wallet-receivables.transfers.store');

        Route::get('ledger', [LedgerController::class, 'showForm'])->name('ledger.form');
        Route::post('ledger', [LedgerController::class, 'ledgerView'])->name('ledger.view');

        Route::get('/supplier-ledger', [SupplierLedgerController::class, 'index'])->name('ledger.supplier.index');
        Route::post('/supplier-ledger/view', [SupplierLedgerController::class, 'view'])->name('ledger.supplier.view');
        Route::get('customer-ledger', [CustomerLedgerController::class, 'showForm'])->name('customer.ledger.form');
        Route::post('customer-ledger/view', [CustomerLedgerController::class, 'view'])->name('customer.ledger.view');

        Route::get('/reports/profit-loss', [ProfitLossController::class, 'showForm'])->name('profitloss.form');
        Route::post('/reports/profit-loss', [ProfitLossController::class, 'generate'])->name('profitloss.generate');

        // Current Assets
        Route::get('current-assets', [ProfitLossController::class, 'currentAssetsForm'])->name('current-assets.form');
        Route::post('current-assets/generate', [ProfitLossController::class, 'currentAssetsReport'])->name('current-assets.generate');

        // Current Liabilities
        Route::get('current-liabilities', [ProfitLossController::class, 'currentLiabilitiesForm'])->name('current-liabilities.form');
        Route::post('current-liabilities/generate', [ProfitLossController::class, 'currentLiabilitiesReport'])->name('current-liabilities.generate');

        Route::get('/edit-product-sell-price', [ProductManagementController::class, 'editProductPriceForm'])->name('edit.product.price.form');
Route::post('/get-products-by-category', [ProductManagementController::class, 'getProductsByCategory'])->name('get.products.by.category');
Route::post('/get-product-batch-stock', [ProductManagementController::class, 'getProductBatchStock'])->name('get.product.batch.stock');
Route::post('/update-sell-prices', [ProductManagementController::class, 'updateSellPrices'])->name('update.sell.prices');

        


    });
});
