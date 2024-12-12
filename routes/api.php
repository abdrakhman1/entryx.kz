<?php

use App\Http\Controllers\Api\ApiAmoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCatalogController;
use App\Http\Controllers\Api\ApiFeedbackController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiBranchOfficeController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiTicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/category', [ApiCategoryController::class, 'index']);
Route::get('/catalog', [ApiCatalogController::class, 'catalog']);
Route::get('/catalog/filter_data', [ApiCatalogController::class, 'filter_data']);
Route::get('/catalog/product_properties', [ApiCatalogController::class, 'product_properties']);
Route::post('/catalog/filter_products', [ApiCatalogController::class, 'filter_products']);
Route::get('/catalog/{category}', [ApiCatalogController::class, 'catalog_category']);
Route::get('/catalog/brand/{brand_title}', [ApiCatalogController::class, 'catalog_brand']);
Route::get('/products/{product}', [ApiProductController::class, 'show']);
Route::post('/product/search/', [ApiProductController::class, 'search']);
Route::get('/branchoffices', [ApiBranchOfficeController::class, 'index']);
Route::post('/feedback_simple_submit', [ApiFeedbackController::class, 'feedback_simple_submit']);
Route::post('/feedback/dealer', [ApiFeedbackController::class, 'dealer']);

Route::post('/auth/login', [ApiUserController::class, 'loginUser']);

Route::prefix('portal')->middleware(['api_dealer_check', 'auth:sanctum'])->group(function () {
    Route::get('/user', [ApiUserController::class, 'user']);
    Route::post('/user', [ApiUserController::class, 'user_update']);
    Route::get('/user/change_pass', [ApiUserController::class, 'change_pass']);
    Route::get('/catalog', [ApiCatalogController::class, 'catalog_dealer']);
    Route::get('/catalog/{category}', [ApiCatalogController::class, 'catalog_category_dealer']);
    Route::get('/catalog/brand/{brand_title}', [ApiCatalogController::class, 'catalog_brand_portal']);
    Route::get('/products/{product}', [ApiProductController::class, 'show_dealer']);

    Route::get('/catalog/product/{product}/add_to_cart', [ApiCatalogController::class, 'add_to_cart']);
    Route::get('/catalog/product/{variant_id}/add_to_cart_variant', [ApiCatalogController::class, 'add_to_cart_variant']);
    Route::get('/cart', [ApiCatalogController::class, 'cart']);
    Route::get('/cart/increase/{cart_item_id}', [ApiCatalogController::class, 'cart_increase_product']);
    Route::get('/cart/reduce/{cart_item_id}', [ApiCatalogController::class, 'cart_reduce_product']);
    Route::get('/cart/delete/{cart_item_id}', [ApiCatalogController::class, 'cart_delete_product']);
    Route::get('/payments', [ApiCatalogController::class, 'payments']);
    Route::post('/make_cart_to_order', [ApiCatalogController::class, 'make_cart_to_order']);
    Route::get('/orders', [ApiCatalogController::class, 'orders']);
    Route::get('/orders/create', [ApiCatalogController::class, 'orders_create']);

    Route::get('/tickets', [ApiTicketController::class, 'tickets']);
    Route::post('/tickets', [ApiTicketController::class, 'create']);
    Route::get('/tickets/{ticket}', [ApiTicketController::class, 'show']);
    Route::post('/tickets/{ticket}/reply', [ApiTicketController::class, 'reply']);
    Route::get('/tickets/{ticket}/set_close', [ApiTicketController::class, 'set_close']);
    Route::get('/tickets/{ticket}/set_open', [ApiTicketController::class, 'set_open']);

    Route::get('/posts', [ApiPostController::class, 'posts']);
    Route::get('/posts/{post}', [ApiPostController::class, 'show']);

    Route::get('/notifies', [ApiUserController::class, 'notify_index']);
    Route::get('/notifies/{notify}/read', [ApiUserController::class, 'notify_read']);


    Route::get('/auth/logout', [ApiUserController::class, 'logout']);

});

Route::get('/send_push/{user_id}', [ApiUserController::class, 'send_push'])->name('send_push');
Route::get('/email_test', [ApiUserController::class, 'email_test'])->name('email_test');

Route::get('/amo/auth', [ApiAmoController::class, 'auth'])->name('amo_auth');
Route::get('/amo/request_dealer', [ApiAmoController::class, 'request_dealer'])->name('request_dealer');
Route::get('/amo/request_question', [ApiAmoController::class, 'request_question'])->name('request_question');
Route::get('/amo/order_request', [ApiAmoController::class, 'order_request'])->name('request_question');
Route::get('/amo/account', [ApiAmoController::class, 'account'])->name('request_question');
Route::get('/amo/amo_test', [ApiAmoController::class, 'amo_test'])->name('request_question');
