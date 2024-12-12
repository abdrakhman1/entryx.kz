<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\RefBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\AdminSyncController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\FeedbackController;

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

Route::get('/', [SiteController::class, 'home']);
Route::get('/posts/{slug}', [SiteController::class, 'show_post']);
Route::get('/about', [SiteController::class, 'about']);
Route::get('/catalog', [SiteController::class, 'catalog']);
Route::get('/product', [SiteController::class, 'product']);
Route::get('/contacts', [SiteController::class, 'contacts']);
Route::get('/dealers', [SiteController::class, 'dealers']);
Route::get('/points_sale', [SiteController::class, 'points_sale']);

Route::get('/admin_login', [UserController::class, 'admin_login_form']);
Route::post('/admin_login', [UserController::class, 'admin_login_form_submit']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/user/logout', [UserController::class, 'user_logout']);

Route::get('/user/registration', [UserController::class, 'registration_form']);
Route::post('/user/registration', [UserController::class, 'registration_submit']);
Route::get('/user/login', [UserController::class, 'user_login_form']);
Route::post('/user/login', [UserController::class, 'user_login_submit']);
Route::get('/user/profile', [UserController::class, 'user_profile']);

Route::post('/feedback_submit', [FeedbackController::class, 'feedback_submit']);
Route::get('/feedback_submited', [FeedbackController::class, 'feedback_submited']);

Route::prefix('admin')->middleware(['admin_check'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/refbooks', [RefBookController::class, 'index'])->name('refbooks_index');
    // Route::get('/refbooks', [RefBookController::class, 'index'])
    Route::get('/refbooks/new', [RefBookController::class, 'create']);
    Route::post('/refbooks/store', [RefBookController::class, 'store']);
    Route::get('/refbooks/{id}/edit', [RefBookController::class, 'edit']);
    Route::post('/refbooks/update', [RefBookController::class, 'update']);
    Route::get('/refbooks/clear_trash', [RefBookController::class, 'clear_trash']);
    Route::get('/refbooks/{id}', [RefBookController::class, 'show']);
    Route::get('/refbooks/{id}/delete', [RefBookController::class, 'destroy']);
    Route::get('/refbooks/{id}/restore', [RefBookController::class, 'restore']);


    Route::get('/refitems/{id}/add', [RefBookController::class, 'item_new']);
    Route::post('/refitems/store', [RefBookController::class, 'item_store']);
    Route::get('/refitems/{id}', [RefBookController::class, 'item_show']);
    Route::get('/refitems/{id}/edit', [RefBookController::class, 'item_edit']);
    Route::post('/refitems/update', [RefBookController::class, 'item_update']);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/filter', [AdminProductController::class, 'filter'])->name('admin.products.filter');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/create_by_category/{category}', [AdminProductController::class, 'create_by_category'])->name('admin.products.create_by_category');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{product}/variants/create', [AdminProductController::class, 'variants_create'])->name('admin.products.variants_create');
    Route::post('/products/{product}/variants/create', [AdminProductController::class, 'variants_store'])->name('admin.products.variants_store');
    Route::get('/products/{product}/variants/{product_variant}/edit', [AdminProductController::class, 'variants_edit'])->name('admin.products.variants_edit');
    Route::post('/products/{product}/variants/{product_variant}/', [AdminProductController::class, 'variants_update'])->name('admin.products.variants_update');
    Route::get('/products/{product}/variants/{product_variant}/variants_delete', [AdminProductController::class, 'variants_delete'])->name('admin.products.variants_delete');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    

    Route::get('/properties', [AdminPropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/properties/create', [AdminPropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('/properties', [AdminPropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/properties/{property}', [AdminPropertyController::class, 'show'])->name('admin.properties.show');
    Route::get('/properties/{property}/edit', [AdminPropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('/properties/{property}', [AdminPropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('/properties/{property}', [AdminPropertyController::class, 'destroy'])->name('admin.properties.destroy');

    Route::get('/products/{product}/document/create', [AdminDocumentController::class, 'create'])->name('admin.products.documents.create');
    Route::get('/products/{product}/document/{document}/make_main', [AdminDocumentController::class, 'make_main'])->name('admin.products.documents.make_main');
    Route::post('/products/{product}/document/', [AdminDocumentController::class, 'store'])->name('admin.products.documents.store');
    Route::delete('/products/document/{document}', [AdminDocumentController::class, 'destroy'])->name('admin.products.documents.destroy');

    Route::get('/sync', [AdminSyncController::class, 'index'])->name('admin.sync.index');
    Route::post('/sync_get', [AdminSyncController::class, 'sync_get'])->name('admin.sync.get');
    Route::get('/sync/test', [AdminSyncController::class, 'test'])->name('admin.sync.test');
    Route::get('/sync/ip', [AdminSyncController::class, 'ip'])->name('admin.sync.ip');

    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('admin.posts.show');
    Route::get('/posts/{post}/delete_image', [AdminPostController::class, 'delete_image'])->name('admin.posts.delete_image');
    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');

    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks.index');
    Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('admin.feedbacks.show');

});
