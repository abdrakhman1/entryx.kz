<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\RefBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\AdminSyncController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\AdminDealerController;
use App\Http\Controllers\Admin\AdminCityController;
use App\Http\Controllers\Admin\AdminTicketController;

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

// Route::prefix('admin')->middleware(['manager_check'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard'])->name('manager.dashboard');

//     Route::get('/refitems/{id}/add', [RefBookController::class, 'item_new']);
//     Route::post('/refitems/store', [RefBookController::class, 'item_store']);
//     Route::get('/refitems/{id}', [RefBookController::class, 'item_show']);
//     Route::get('/refitems/{id}/edit', [RefBookController::class, 'item_edit']);
//     Route::post('/refitems/update', [RefBookController::class, 'item_update']);

//     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
//     Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
//     Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
//     Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
//     Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
//     Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
//     Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//     Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
//     Route::get('/products/exist_properties', [AdminProductController::class, 'exist_properties'])->name('admin.products.exist_properties');
//     Route::get('/products/try_filter', [AdminProductController::class, 'try_filter'])->name('admin.products.try_filter');
//     Route::get('/products/try_filter_submit', [AdminProductController::class, 'try_filter_submit'])->name('admin.products.try_filter_submit');
//     Route::get('/products/try_filter2', [AdminProductController::class, 'try_filter2'])->name('admin.products.try_filter22');
//     Route::get('/products/filter', [AdminProductController::class, 'filter'])->name('admin.products.filter');
//     Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
//     Route::get('/products/create_by_category/{category}', [AdminProductController::class, 'create_by_category'])->name('admin.products.create_by_category');
//     Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
//     Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
//     Route::get('/products/{product}/variants/create', [AdminProductController::class, 'variants_create'])->name('admin.products.variants_create');
//     Route::post('/products/{product}/variants/create', [AdminProductController::class, 'variants_store'])->name('admin.products.variants_store');
//     Route::get('/products/{product}/variants/{product_variant}/edit', [AdminProductController::class, 'variants_edit'])->name('admin.products.variants_edit');
//     Route::post('/products/{product}/variants/{product_variant}/', [AdminProductController::class, 'variants_update'])->name('admin.products.variants_update');
//     Route::get('/products/{product}/variants/{product_variant}/variants_delete', [AdminProductController::class, 'variants_delete'])->name('admin.products.variants_delete');
//     Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
//     Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
//     Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');


//     Route::get('/properties', [AdminPropertyController::class, 'index'])->name('admin.properties.index');
//     Route::get('/properties/create', [AdminPropertyController::class, 'create'])->name('admin.properties.create');
//     Route::post('/properties', [AdminPropertyController::class, 'store'])->name('admin.properties.store');
//     Route::get('/properties/{property}', [AdminPropertyController::class, 'show'])->name('admin.properties.show');
//     Route::get('/properties/{property}/edit', [AdminPropertyController::class, 'edit'])->name('admin.properties.edit');
//     Route::put('/properties/{property}', [AdminPropertyController::class, 'update'])->name('admin.properties.update');
//     Route::delete('/properties/{property}', [AdminPropertyController::class, 'destroy'])->name('admin.properties.destroy');

//     Route::get('/products/{product}/document/create', [AdminDocumentController::class, 'create'])->name('admin.products.documents.create');
//     Route::get('/products/{product}/document/{document}/make_main', [AdminDocumentController::class, 'make_main'])->name('admin.products.documents.make_main');
//     Route::post('/products/{product}/document/', [AdminDocumentController::class, 'store'])->name('admin.products.documents.store');
//     Route::delete('/products/document/{document}', [AdminDocumentController::class, 'destroy'])->name('admin.products.documents.destroy');

//     Route::get('/sync', [AdminSyncController::class, 'index'])->name('admin.sync.index');
//     Route::post('/sync_get', [AdminSyncController::class, 'sync_get'])->name('admin.sync.get');
//     Route::get('/sync/test', [AdminSyncController::class, 'test'])->name('admin.sync.test');
//     Route::get('/sync/ip', [AdminSyncController::class, 'ip'])->name('admin.sync.ip');
//     Route::get('/sync/new_user', [AdminSyncController::class, 'new_user']);
//     Route::get('/sync/user_update', [AdminSyncController::class, 'user_update']);
//     Route::get('/sync/new_order', [AdminSyncController::class, 'new_order']);
//     Route::get('/sync/products', [AdminSyncController::class, 'products']);
//     Route::get('/sync/get_user/{bin}', [AdminSyncController::class, 'get_user']);
//     Route::get('/sync/get_order/{uuid}', [AdminSyncController::class, 'get_order']);
//     Route::get('/sync/update_order/{uuid}', [AdminSyncController::class, 'update_order']);
//     Route::get('/sync/get_orders_by_user_bin/{bin}', [AdminSyncController::class, 'get_order_by_user_bin']);

//     Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
//     Route::get('/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
//     Route::post('/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');
//     Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('admin.posts.show');
//     Route::get('/posts/{post}/delete_image', [AdminPostController::class, 'delete_image'])->name('admin.posts.delete_image');
//     Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
//     Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
//     Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

//     Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');

//     Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks.index');
//     Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('admin.feedbacks.show');
//     Route::get('/download_file/{feedback}/{filenumber}', [FeedbackController::class, 'download_file'])->name('admin.feedbacks.download_file');

//     Route::get('/dealers', [AdminDealerController::class, 'index'])->name('admin.dealers.index');
//     Route::get('/dealers/create', [AdminDealerController::class, 'create'])->name('admin.dealers.create');
//     Route::post('/dealers', [AdminDealerController::class, 'store'])->name('admin.dealers.store');
//     Route::get('/dealers/{dealer}', [AdminDealerController::class, 'show'])->name('admin.dealers.show');
//     Route::get('/dealers/{dealer}/edit', [AdminDealerController::class, 'edit'])->name('admin.dealers.edit');
//     Route::put('/dealers/{dealer}', [AdminDealerController::class, 'update'])->name('admin.dealers.update');
//     Route::delete('/dealers/{dealer}', [AdminDealerController::class, 'destroy'])->name('admin.dealers.destroy');

//     Route::get('/dealers/{dealer}/brancoffices/create', [AdminDealerController::class, 'branchOfficecreate'])->name('admin.branchoffices.create');
//     Route::post('/dealers/{dealer}/brancoffices', [AdminDealerController::class, 'branchofficestore'])->name('admin.branchoffices.store');
//     Route::get('/dealers/{dealer}/brancoffices', [AdminDealerController::class, 'branchofficeshow'])->name('admin.branchoffices.show');
//     Route::get('/dealers/{dealer}/brancoffices/{branchoffice}/edit', [AdminDealerController::class, 'branchofficeedit'])->name('admin.branchoffices.edit');
//     Route::put('/dealers/{dealer}/brancoffices/{branchoffice}/update', [AdminDealerController::class, 'branchofficeupdate'])->name('admin.branchoffices.update');
//     Route::delete('/dealers/{dealer}/brancoffices/{branchoffice}', [AdminDealerController::class, 'branchofficedestroy'])->name('admin.branchoffices.destroy');

//     Route::get('/cities', [AdminCityController::class, 'index'])->name('admin.cities.index');
//     Route::get('/cities/create', [AdminCityController::class, 'create'])->name('admin.cities.create');
//     Route::post('/cities', [AdminCityController::class, 'store'])->name('admin.cities.store');
//     Route::get('/cities/{city}', [AdminCityController::class, 'show'])->name('admin.cities.show');
//     Route::get('/cities/{city}/edit', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
//     Route::put('/cities/{city}', [AdminCityController::class, 'update'])->name('admin.cities.update');
//     Route::delete('/cities/{city}', [AdminCityController::class, 'destroy'])->name('admin.cities.destroy');

//     Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
//     Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
//     Route::get('/tickets/{ticket}/set_close', [AdminTicketController::class, 'set_close'])->name('admin.tickets.set_close');
//     Route::get('/tickets/{ticket}/set_open', [AdminTicketController::class, 'set_open'])->name('admin.tickets.set_open');
//     Route::post('/tickets/{ticket}/reply', [AdminTicketController::class, 'reply_store'])->name('admin.tickets.reply_store');

// });
