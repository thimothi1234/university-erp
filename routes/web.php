<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PayorderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TallyheadController;
use App\Http\Controllers\TallygroupController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PfmsController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CostcentreController;
use App\Http\Controllers\CostcentregroupController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DateRangeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\Reports1Controller;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\Select2SearchController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\BankbookController;
use App\Http\Controllers\TaController;

use App\Http\Controllers\ApprovalpiController;
use App\Http\Controllers\InwardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ledger;
use App\Http\Controllers\BulkController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ContraController;
use App\Http\Controllers\TaallowController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\ReimbController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\TempadvController;
use App\Http\Controllers\CeaController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\PayrollController;

use App\Http\Controllers\User1Controller;
use App\Http\Controllers\MailController;
use App\Http\Livewire\Dependentdropdown;
use App\Http\Controllers\HierarchyController;
use App\Http\Controllers\HRMController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});


Route::middleware(['auth'])->group(function () {
   



Route::resource('projects', ProjectController::class);
Route::resource('staff', StaffController::class);
Route::resource('Tally', TallyheadController::class);
Route::resource('Tallygroup', TallygroupController::class);
Route::resource('voucher', TransactionController::class);
Route::resource('bank', BankController::class);
Route::resource('pfms', PfmsController::class);
Route::resource('beneficiary', VendorController::class);
Route::resource('costcentre', CostcentreController::class);
Route::resource('costcentregroup', CostcentregroupController::class);
Route::resource('receipt', ReceiptController::class);
Route::resource('approval', ApprovalController::class);
Route::get('approval/approve/{id}/action', [ApprovalController::class, 'approve'])->name('approval.approve');
Route::get('approval/undo/{id}/action', [ApprovalController::class, 'undo'])->name('approval.undo');
Route::get('approval/reject/{id}/action', [ApprovalController::class, 'reject'])->name('approval.reject');
//Route::get('approval/store', [ApprovalController::class, 'reject'])->name('approval.store');
Route::get('contacts', function () {
    return view('default');
});

Route::get('wizard', function () {
    return view('welcome');
});


Route::resource('daterange', DateRangeController::class);
Route::resource('reports', ReportsController::class);
Route::resource('reports1', Reports1Controller::class);

Route::resource('employees', EmployeesController::class);
Route::resource('cheque', PayController::class);
Route::resource('journal', JournalController::class);
Route::resource('contra', ContraController::class);

Route::get('search', [Select2SearchController::class,'index']);
Route::get('ajax-autocomplete-search', [Select2SearchController::class,'selectSearch']);



Route::resource('advance', AdvanceController::class);



Route::get('/color/{id}/edit',[PayController::class,'update'])->name('color.update');
Route::post('/color/{id}',[PayController::class,'edit'])->name('color.edit');
Route::resource('commitment', CommitmentController::class);



Route::POST('editPost',[PayController::class,'editPost']);


Route::group(['middleware' => ['web']], function() {
    
Route::POST('editPost1',[PayController::class,'editPost1']);
Route::POST('deletePost',[PayController::class,'deletePost']);
  });
Route::resource('bankbook', BankbookController::class);
Route::resource('claim', TaController::class);

Route::resource('taclaim', TaallowController::class);
Route::resource('inward', InwardController::class);
Route::resource('medical', MedicalController::class);
Route::resource('approvalpi', ApprovalpiController::class);
Route::get('approvalpi/approve/{id}/action', [ApprovalpiController::class, 'approve'])->name('approvalpi.approve');
Route::get('approvalpi/reject/{id}/action', [ApprovalpiController::class, 'reject'])->name('approvalpi.reject');
//Route::get('approvalpi/store', [ApprovalpiController::class, 'reject'])->name('approvalpi.store');
Route::get('claim/inward',[TaController::class,'inward'])->name('claim.inward');
Route::resource('invoice', InvoiceController::class);
Route::view('paymentdesk','livewire.home');
Route::resource('ledger', ledger::class);
Route::resource('bulk', BulkController::class);
Route::resource('mobile', MobileController::class);
Route::resource('reimb', ReimbController::class);
Route::resource('tempadv', TempadvController::class);
Route::resource('cea', CeaController::class);
Route::resource('payroll', PayrollController::class);
Route::get('dropdown list',[BulkController::class,'create']);
Route::get('dropdownlist1/getstates/{id}',[BulkController::class,'getStates']);
Route::get('select-ajax', [BulkController::class,'selectAjax'])->name('select-ajax');
Route::get('select-ajax1', [PayrollController::class,'selectAjax1'])->name('select-ajax1');
Route::get('findCityWithStateID/{id}',[BulkController::class,'findCityWithStateID']);
Route::get('pendingta',[TaController::class,'pendingta']);
Route::get('tasettle/{id}',[TaController::class,'tasettle']);
Route::get('createi',[TransactionController::class,'createi']);
Route::resource('travel', TravelController::class);
Route::get('ceainward',[InwardController::class,'ceaindex']);
Route::POST('editPost2',[PayController::class,'editPost2']);
Route::get('ceaprocess',[ProcessController::class,'ceaindex']);
Route::get('ceaprocess/{id}',[ProcessController::class,'ceaprocess']);
Route::POST('editPost9',[PayController::class,'editPost9']);
Route::get('selectcheque',[PayController::class,'selectcheque']);
Route::get('chequeview',[PayController::class,'view']);
Route::get('mybills',[TransactionController::class,'mybills']);
Route::get('tdscreate',[BankbookController::class,'createc']);
Route::get('chequebookprint',[BankbookController::class,'chequebookprint']);
Route::get('gstcreate',[BankbookController::class,'creategst']);
Route::get('tds',[BankbookController::class,'TDS']);
Route::get('gst',[BankbookController::class,'gst']);
Route::get('budget',[ReportsController::class,'budget']);

Route::get('searchtsa',[BankbookController::class,'searchtsa'])->name('searchtsa');
Route::get('tsa',[BankbookController::class,'tsa'])->name('tsa');
Route::get('pmrf',[BankbookController::class,'pmrf']);
Route::get('approved',[ApprovalController::class,'index1']);
Route::get('settle/{id}',[AdvanceController::class,'settle']);
Route::get('comset/{id}',[CommitmentController::class,'settle']);
Route::POST('settlepost',[AdvanceController::class,'creatte']);
Route::POST('settlecom',[CommitmentController::class,'creatte']);
Route::get('allbills',[ReceiptController::class,'allbills']);
Route::post('bulkinward',[BulkController::class,'inward']);
Route::post('approvebulk',[ApprovalController::class,'approvebulk']);
Route::get('tallyc',[BankbookController::class,'tallyc']);
Route::get('createpo',[BankbookController::class,'createpo']);
Route::get('indexpo',[BankbookController::class,'indexpo']);
Route::get('exceltotally',[BankbookController::class,'exceltotally']);
Route::get('inwardmobile',[MobileController::class,'inwardmobile']);
Route::get('selfadvances',[AdvanceController::class,'index1']);
Route::get('indexlink',[ReportsController::class,'indexlink']);
Route::get('approveledger',[ApprovalController::class,'indeex']);
Route::get('form1s6',[ReportsController::class,'form16']);
Route::get('payslip',[ReportsController::class,'payslip']);
Route::get('approveledger/approve/{id}/action', [ApprovalController::class, 'approveledger'])->name('approvalledger.approve');
//Route::get('approval/undo/{id}/action', [ApprovalController::class, 'undo'])->name('approval.undo');
//Route::get('approval/reject/{id}/action', [ApprovalController::class, 'reject'])->name('approval.reject');
Route::get('show1/{id}',[CommitmentController::class,'show1']);
Route::get('show2/{id}',[CommitmentController::class,'show2']);
Route::get('showtds/{id}',[TransactionController::class,'showtds']);
Route::get('pos',[TransactionController::class,'pos']);
Route::get('/users/{id}/reload-captcha', [UserController::class, 'reloadCaptcha']);
Route::get('/reload-captcha', [UserController::class, 'reloadCaptcha'])->name('reload-captcha');
Route::get('/password/reset/reload-captchaa', [UserController::class, 'reloadCaptcha']);
Route::get('budgetin/{id}/{from}/{to}',[ReportsController::class,'budgetin']);
Route::get('trans/{id}/{from}/{to}',[ReportsController::class,'trans']);
Route::get('trans1/{id}/{from}/{to}',[ReportsController::class,'trans1']);
//ledger wise report
Route::get('ledger1',[ReportsController::class,'ledger']);
Route::get('ledgerwise/{id}/{from}/{to}/{bank}',[ReportsController::class,'ledgetrans']);
Route::get('ledgerper',[ReportsController::class,'ledgerper']);

//budget wise report
Route::get('budget1',[ReportsController::class,'budget1']);
Route::get('budget2/{id}/{from}/{to}/{bank}',[ReportsController::class,'budget2']);
Route::get('budgetwise/{id}/{sid}/{from}/{to}/{bank}',[ReportsController::class,'budgettrans']);
Route::get('budgetper',[ReportsController::class,'budgetper']);

Route::get('mail',[BankbookController::class,'mail']);
Route::get('nested',[ReportsController::class,'nested']);


Route::get('usersa', [MailController::class, 'index'])->name('users.index1');
Route::post('send-mail', [MailController::class, 'sendMail'])->name('send.mail');
Route::get('usersb', [MailController::class, 'index2'])->name('users.index2');
Route::post('send-mail1', [MailController::class, 'sendMail1'])->name('send.mail1');
Route::get('student_export',[TallyheadController::class, 'get_student_data'])->name('student.export');

Route::get('/allbills', [ReceiptController::class,'allbills'])->name('search.index');
Route::get('/advancedsearch', [ReceiptController::class,'advancedsearch'])->name('search.advanced');
Route::get('/showPage', [UserController::class, 'showPage'])->name('showPage');
Route::get('comsettle/{id}',[CommitmentController::class,'settle']);
Route::POST('settlecom',[CommitmentController::class,'creatte']);
Route::get('createsub', [ProjectController::class,'index1']);
Route::get('createsub1/',[ProjectController::class,'index2'])->name('budget.createsub1');
Route::POST('storesub',[ProjectController::class,'storesub'])->name('budgetsub.create');
//Temporary route
Route::get('createiss',[TransactionController::class,'createiss']);
Route::get('bulkindex',[PayController::class,'bulkindex'])->name('bulk.indexx');
Route::post('bulkpay', [PayController::class, 'bulkpay'])->name('bulk.pay');
Route::get('bulkapproveindex',[ApprovalController::class,'bulkindex'])->name('bulkapprove.index');
Route::get('bulkapprove',[ApprovalController::class,'bulkindex'])->name('bulkapprove.index');
Route::get('budgetper',[ReportsController::class,'budgetper']);
Route::get('/fetch-outpuut', [ReportsController::class, 'fetchOutput'])->name('fetchOutpuut');


// Route::get('/fetch-options', [BulkController::class, 'fetchOptions'])->name('fetch.options');


//payroll
// Route::get('/create1', [PayrollController::class, 'create1'])->name('create1');

Route::get('/fetchdata', [PayrollController::class, 'fetchData'])->name('your.route.name');
Route::get('/fetchdata2', [PayrollController::class, 'fetchData2'])->name('your.route.esti');
Route::get('/computationsheet', [PayrollController::class, 'computationsheet']);
Route::get('/salaryshow', [PayrollController::class, 'show'])->name('salaryshow');

Route::get('/getpayslip', [PayrollController::class, 'getpayslip']);

Route::get('/get-categories', [PayrollController::class, 'getpayslip'])->name('getcategories');
Route::get('/get-subcategories/{categoryId}', [PayrollController::class, 'getMonths']);
Route::post('/store-income-tax-data', [PayrollController::class, 'storeIncomeTaxData']);
// web.php

Route::get('/export-excel', [PayrollController::class, 'exportExcel']);


Route::get('addincome/import', [EmployeesController::class, 'showImportForm'])->name('addincome.import.form');
Route::post('addincome/import', [EmployeesController::class, 'import'])->name('addincome.import');

// web.php




Route::get('/select-ajax12', [PayrollController::class,'selectAjax12'])->name('select-ajax12');
// routes/web.php
Route::get('/get-months/{name}', [PayrollController::class, 'getMonths'])->name('get-months');

Route::get('/generate', [CommitmentController::class, 'generate'])->name('generate');

Route::get('/cea1', [CeaController::class, 'index1']);
// web.php
Route::get('/taxsheet', [PayrollController::class, 'taxsheet'])->name('taxsheet');
Route::get('/paysheetfull', [PayrollController::class, 'index1']);
Route::get('/payrollfull', [PayrollController::class, 'downloadPdf'])->name('payroll.pdf');

Route::post('/save-income-tax-data', [PayrollController::class, 'store']);
Route::get('/save-other-income-data', [PayrollController::class, 'otherincome']);
Route::get('/save-other-income-data-po', [PayrollController::class, 'otherincomepo']);
Route::post('/saveotherincome', [PayrollController::class, 'saveotherincome']);
Route::get('/indexdeduct', [PayrollController::class, 'indexdeduct']);
Route::post('/adddeduct', [PayrollController::class, 'adddeduct']);
Route::put('/updateotherincome/{id}', [PayrollController::class, 'updateOtherIncome']);
Route::delete('/deleteotherincome/{id}', [PayrollController::class, 'deleteOtherIncome']);
Route::post('/editdeduct', [PayrollController::class, 'editdeduct'])->name('deductions.edit');
Route::delete('/deletededuct/{id}', [PayrollController::class, 'deletededuct'])->name('deductions.delete');

Route::post('/update-regime', [PayrollController::class, 'updateTaxDeduction'])->name('update.taxdeduction');
Route::get('/multi-form', [PayrollController::class, 'createw']);
Route::post('/multi-form', [PayrollController::class, 'storew'])->name('multi.store');

Route::post('/mobile/update-status', [MobileController::class, 'updateStatus'])->name('mobile.updateStatus');





Route::get('/nested-table', [HierarchyController::class, 'index']);
Route::get('/children/{parent_id}', [HierarchyController::class, 'getChildren']);
Route::get('/grandchildren/{child_id}', [HierarchyController::class, 'getGrandchildren']);
Route::get('/grandchildren/{child_id}/{parent_id}', [HierarchyController::class, 'getGrandchildren']);
Route::get('/bankbook/data', [BankbookController::class, 'getDataTableData'])->name('bankbook.data');
//HR

Route::resource('HRM', HRMController::class);
// Report routes
Route::get('/HRM/report/{id}', [HRMController::class, 'showReport'])->name('HRM.report');
Route::get('/HRM/export/{id}', [HRMController::class, 'exportToExcel'])->name('HRM.export');
Route::get('/HRM/report1/{id}', [HRMController::class, 'report'])->name('HRM.report1');
Route::get('/HRM/teachings/{id}', [HRMController::class, 'teachings'])->name('HRM.teachings');
Route::get('/HRM/phdstudents/{id}', [HRMController::class, 'phdstudents'])->name('HRM.phdstudents');
Route::get('/HRM/patents/{id}', [HRMController::class, 'patents'])->name('HRM.patents');
Route::get('/HRM/projects/{id}', [HRMController::class, 'projects'])->name('HRM.projects');

Route::get('/faculty/download-all', [HRMController::class, 'downloadAllApplications'])
    ->name('HRM.downloadAllFacultyApplications');
});
    Route::middleware(['log.visitor'])->group(function () {
    Route::get('/HRMDEAN', [HRMController::class, 'indexdean']);
});


//chat
Route::middleware('auth')->group(function () {
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::get('/chat/fetch/{id}', [ChatController::class, 'fetch']);
});
