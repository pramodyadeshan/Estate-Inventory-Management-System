<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConferenceController;

//Login
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// User Management

Route::get('/view-user-role', function () {
    return view('pages.user_manage.add_user_role');
});
Route::post('/add-user-role', [AuthController::class, 'add_user_role'])->name('add-user-role');
Route::get('/list-user-role', [AuthController::class, 'list_user_role'])->name('list-user-role');
Route::get('/edit-user-role/{id}', [AuthController::class, 'edit_user_role'])->name('view-edit-user-role');
Route::post('/edit-auth-user-role/{id}', [AuthController::class, 'edit_auth_user_role'])->name('edit-auth-user-role');
Route::get('/delete-user-role/{id}', [AuthController::class, 'delete_user_role'])->name('delete-user-role');

Route::get('/add-user', [RegisterController::class, 'load_user_data'])->name('load-user-data');
Route::post('/add-auth-user', [RegisterController::class, 'register_users'])->name('register-users');
Route::get('/list-users', [AuthController::class, 'list_users'])->name('list-users');
Route::get('/edit-user/{id}', [RegisterController::class, 'edit_user'])->name('edit-user');
Route::post('/edit-auth-user/{id}', [RegisterController::class, 'edit_auth_user'])->name('edit-auth-user');
Route::get('/delete-user/{id}', [RegisterController::class, 'delete_user'])->name('delete-user');

Route::post('/switch-state', [AuthController::class, 'switch_state'])->name('switch-state');

// Category Management
Route::get('/cate-manage', [ProdController::class, 'list_categories'])->name('list-user-role');
Route::post('/add-categories', [ProdController::class, 'add_categories'])->name('add-categories');
Route::get('/edit-category/{id}', [ProdController::class, 'edit_category'])->name('edit-category');
Route::post('/edit-auth-category/{id}', [ProdController::class, 'edit_auth_category'])->name('edit-auth-category');
Route::get('/delete-category/{id}', [ProdController::class, 'delete_category'])->name('delete-category');

// State Management
Route::get('/state-manage', [StateController::class, 'list_states'])->name('list-states');
Route::post('/add-states', [StateController::class, 'add_states'])->name('add-states');
Route::get('/edit-state/{id}', [StateController::class, 'edit_state'])->name('edit-state');
Route::post('/edit-auth-state/{id}', [StateController::class, 'edit_auth_state'])->name('edit-auth-state');
Route::get('/delete-state/{id}', [StateController::class, 'delete_state'])->name('delete-state');

// Division Management
Route::get('/divi-manage', [DivisionController::class, 'list_divisions'])->name('list-divisions');
Route::post('/add-divisions', [DivisionController::class, 'add_divisions'])->name('add-divisions');
Route::get('/edit-division/{id}', [DivisionController::class, 'edit_division'])->name('edit-division');
Route::post('/edit-auth-division/{id}', [DivisionController::class, 'edit_auth_division'])->name('edit-auth-division');
Route::get('/delete-division/{id}', [DivisionController::class, 'delete_division'])->name('delete-division');

//Media File
Route::get('/media-file', [MediaController::class, 'list_media_file'])->name('media-file');
Route::post('/upload-file', [MediaController::class, 'upload_file'])->name('upload-file');
Route::get('/delete-media-file/{id}', [MediaController::class, 'delete_media_file'])->name('delete-media-file');

//Profile Setting
Route::view('/settings', 'pages.edit_user_profile');
Route::post('/account-setting/{page}', [RegisterController::class, 'upload_profile_picture'])->name('upload-profile-picture');

//Product Management
Route::get('/list-product',[ProdController::class,'list_product'])->name('list-product');
Route::get('/add-product',[ProdController::class,'add_product'])->name('add-product');
Route::post('/add-auth-product',[ProdController::class,'add_auth_product'])->name('add-auth-product');
Route::get('/edit-product/{id}',[ProdController::class,'edit_product'])->name('edit-product');
Route::post('/edit-auth-product/{id}',[ProdController::class,'edit_auth_product'])->name('edit-auth-product');
Route::get('/delete-product/{id}',[ProdController::class,'delete_product'])->name('delete-product');
Route::get('/lowest-product',[ProdController::class,'lowest_product'])->name('lowest-product');
Route::get('/search-product',[ProdController::class,'search_product'])->name('search-product');

//System Setting
Route::get('/system-settings', [SystemController::class, 'show_sys_setting'])->name('system-settings');
Route::post('/save-system-setting', [SystemController::class, 'save_system_setting'])->name('save-system-setting');

//Account Management
//Income
Route::get('/list-income', [AccountController::class, 'list_income'])->name('list-income');
Route::post('/add-auth-income', [AccountController::class, 'add_income'])->name('add-auth-income');
Route::get('/edit-income-form/{id}',[AccountController::class, 'edit_income_form'])->name('edit-income-form');
Route::post('/edit-income/{id}', [AccountController::class, 'edit_income'])->name('edit-income');
Route::get('/delete-income/{id}', [AccountController::class, 'delete_income'])->name('delete-income');

//Expenditure
Route::get('/list-expend', [AccountController::class, 'list_expend'])->name('list-expend');
Route::post('/add-auth-expend', [AccountController::class, 'add_expend'])->name('add-auth-expend');
Route::get('/edit-expend-form/{id}',[AccountController::class, 'edit_expend_form'])->name('edit-expend-form');
Route::post('/edit-expend/{id}', [AccountController::class, 'edit_expend'])->name('edit-expend');
Route::get('/delete-expend/{id}', [AccountController::class, 'delete_expend'])->name('delete-expend');

//Stock Management
Route::get('/list-stock', [StockController::class, 'list_stock'])->name('list-stock');
Route::post('/get-stock-division', [StockController::class, 'get_stock_division'])->name('get-stock-division');
Route::get('/get-product-price/{id}', [StockController::class, 'get_price'])->name('get-product-price');
Route::post('/add-stock', [StockController::class, 'add_stock'])->name('add-stock');
Route::get('/get-edit-stock-form/{id}', [StockController::class, 'edit_stock_form'])->name('get-edit-stock-form');
Route::get('/delete-stock/{id}', [StockController::class, 'delete_stock'])->name('delete-stock');
Route::post('/edit-auth-stock/{id}', [StockController::class, 'edit_stock'])->name('edit-auth-stock');
Route::get('/search-issued-stock',[StockController::class,'search_issue_stock'])->name('search-product');

//Reports
Route::view('/list-reports', 'pages.prod_manage.report.list_report');

//Date range Stock Report
Route::get('/load-date-stock', [ReportController::class, 'load_date_stock_report'])->name('load-date-stock');
Route::post('/filter-date-stock', [ReportController::class, 'filter_date_stock'])->name('filter-date-stock');
Route::post('/download-date-range-stock-PDF', [ReportController::class, 'downloadDateRangeStockPDF'])->name('download-date-range-stock-PDF');

//Daily Stock Report
Route::get('/load-daily-stock', [ReportController::class, 'load_daily_stock_report'])->name('load-date-stock');
Route::get('/download-daily-stock-PDF', [ReportController::class, 'downloadDailyStockPDF'])->name('download-daily-stock-PDF');

//State Wise Report
Route::get('/load-state-wise', [ReportController::class, 'load_state_wise_report'])->name('load-state-wise');
Route::get('/download-state-wise-PDF', [ReportController::class, 'downloadStateWisePDF'])->name('download-state-wise-PDF');

//Division Wise Report
Route::get('/load-division-wise', [ReportController::class, 'load_division_wise_report'])->name('load-division-wise');
Route::get('/download-division-wise-PDF', [ReportController::class, 'downloadDivisionWisePDF'])->name('download-division-wise-PDF');

//User Wise Report
Route::get('/load-user-wise', [ReportController::class, 'load_user_wise_report'])->name('load-user-wise');
Route::get('/download-user-wise-PDF', [ReportController::class, 'downloadUserWisePDF'])->name('download-user-wise-PDF');

//Category Wise Report
Route::get('/load-category-wise', [ReportController::class, 'load_category_wise_report'])->name('load-category-wise');
Route::get('/download-category-wise-PDF', [ReportController::class, 'downloadCategoryWisePDF'])->name('download-category-wise-PDF');

//Product Wise Report
Route::get('/load-product-wise', [ReportController::class, 'load_product_wise_report'])->name('load-product-wise');
Route::get('/download-product-wise-PDF', [ReportController::class, 'downloadProductWisePDF'])->name('download-product-wise-PDF');

//Date range Income Report
Route::get('/load-date-income', [ReportController::class, 'load_date_income_report'])->name('load-date-income');
Route::post('/filter-date-income', [ReportController::class, 'filter_date_income'])->name('filter-date-income');
Route::post('/download-date-range-income-PDF', [ReportController::class, 'downloadDateRangeIncomePDF'])->name('download-date-range-income-PDF');

//Date range Expenditure Report
Route::get('/load-date-expend', [ReportController::class, 'load_date_expend_report'])->name('load-date-expend');
Route::post('/filter-date-expend', [ReportController::class, 'filter_date_expend'])->name('filter-date-expend');
Route::post('/download-date-range-expend-PDF', [ReportController::class, 'downloadDateRangeExpendPDF'])->name('download-date-range-expend-PDF');

//Low Stock Product Report
Route::get('/low-stock-product', [ReportController::class, 'load_low_stock_report'])->name('load-low-stock-product');
Route::post('/filter-low-stock-product', [ReportController::class, 'filter_low_stock'])->name('filter-low-stock-product');
Route::post('/download-low-stock-product-PDF', [ReportController::class, 'downloadLowStockProductPDF'])->name('download-low-stock-product-PDF');

//Chat bot
Route::get('/chat', [ChatBotController::class, 'index'])->name('index');
Route::post('/chat', [ChatBotController::class, 'sendMessage'])->name('sendMessage');
Route::post('/add-chat-bots', [ChatBotController::class, 'add_chat_bots'])->name('add-chat-bots');
Route::get('/manage-chat-bot', [ChatBotController::class, 'list_chat_bots'])->name('list-chat-bots');
Route::get('/update-chat-bot/{id}', [ChatBotController::class, 'update_chat_bot'])->name('update-chat-bot');
Route::post('/edit-auth-chat-bot/{id}', [ChatBotController::class, 'edit_auth_chat_bot'])->name('edit-auth-chat-bot');
Route::get('/delete-chat-bot/{id}', [ChatBotController::class, 'delete_chat_bot'])->name('delete-chat-bot');

//Chat
Route::get('/user-chat/{id}', [ChatController::class, 'list_user_chat'])->name('user-chat');
Route::post('/send-message/{id}', [ChatController::class, 'send_message'])->name('send-message');
Route::get('/unread-message/{id}', [ChatController::class, 'unread_message'])->name('unread-message');

//Conference
Route::get('/list-conference/', [ConferenceController::class, 'list_conference'])->name('list-conference');
Route::get('/add-conference-form/', [ConferenceController::class, 'add_conference_form'])->name('add-conference-form');
Route::post('/add-auth-conference/', [ConferenceController::class, 'add_auth_conference'])->name('add-auth-conference');
