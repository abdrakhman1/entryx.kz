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
use App\Http\Controllers\Portal\PortalController;
use App\Http\Controllers\Admin\AdminDealerController;
use App\Http\Controllers\Admin\AdminCityController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Api\ApiAmoController;
use App\Http\Controllers\Portal\PortalCartController;
use App\Http\Controllers\Portal\PortalNotifyController;
use App\Http\Controllers\Portal\PortalTicketController;
use App\Http\Controllers\Portal\PortalUserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProjectController;

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

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/posts/{slug}', [SiteController::class, 'show_post'])->name('site.post');
Route::get('/about', [SiteController::class, 'about'])->name('site.about');
Route::get('/catalog', [SiteController::class, 'catalog'])->name('site.catalog');
Route::get('/catalog/{category}', [SiteController::class, 'catalog_category'])->name('site.catalog.category');
Route::get('/catalog/brand/{brand_title}', [SiteController::class, 'catalog_brand'])->name('site.catalog.brand');
Route::post('/catalog/filtred', [SiteController::class, 'catalog_filtred'])->name('catalog.filter');
Route::get('/product/{product}', [SiteController::class, 'product_show'])->name('site.product_show');
Route::get('/product/search/{text}', [SiteController::class, 'product_search'])->name('site.product_search');
Route::get('/contacts', [SiteController::class, 'contacts'])->name('site.contacts');
Route::get('/dealers', [SiteController::class, 'dealers'])->name('site.dealers');
Route::get('/branch_offices', [SiteController::class, 'branch_offices'])->name('site.branch_offices');
Route::get('/branch_offices/search/{query_str}', [SiteController::class, 'branch_offices_search'])->name('site.branch_offices_search');
Route::get('/about/payment', [SiteController::class, 'about_payment'])->name('site.about.payment');
Route::get('/about/requisites', [SiteController::class, 'about_requisites'])->name('site.about.requisites');
Route::get('/about/privacy', [SiteController::class, 'about_privacy'])->name('site.about.privacy');
Route::get('/about/public_contract', [SiteController::class, 'about_public_contract'])->name('site.about.public_contract');

Route::get('/images/{document}/{size_name}', [SiteController::class, 'images_size_name'])->name('site.images_size_name');
Route::get('/images/flushcashed', [SiteController::class, 'flushcashed'])->name('site.flushcashed');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('site.projects.show');

Route::get('/cloudpayments_callback', [SiteController::class, 'cloudpayments_callback']);
Route::get('/hmack_test', [SiteController::class, 'hmack_test']);

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
Route::post('/feedback_simple_submit', [FeedbackController::class, 'feedback_simple_submit']);
Route::get('/feedback_submited', [FeedbackController::class, 'feedback_submited']);

Route::prefix('admin')->middleware(['admin_check'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

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
    Route::get('/users/{user}/change_pass', [AdminUserController::class, 'change_pass'])->name('admin.users.change_pass');
    Route::post('/users/{user}/change_pass', [AdminUserController::class, 'change_pass_submit'])->name('admin.users.change_pass_submit');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/exist_properties', [AdminProductController::class, 'exist_properties'])->name('admin.products.exist_properties');
    Route::get('/products/try_filter', [AdminProductController::class, 'try_filter'])->name('admin.products.try_filter');
    Route::get('/products/try_filter_submit', [AdminProductController::class, 'try_filter_submit'])->name('admin.products.try_filter_submit');
    Route::get('/products/try_filter2', [AdminProductController::class, 'try_filter2'])->name('admin.products.try_filter22');
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
    Route::get('/products/{product}/set_visible', [AdminProductController::class, 'set_visible'])->name('admin.products.set_visible');
    Route::get('/products/{product}/set_hidden', [AdminProductController::class, 'set_hidden'])->name('admin.products.set_hidden');


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
    Route::get('/sync/new_user', [AdminSyncController::class, 'new_user']);
    Route::get('/sync/user_update', [AdminSyncController::class, 'user_update']);
    Route::get('/sync/new_order', [AdminSyncController::class, 'new_order']);
    Route::get('/sync/products', [AdminSyncController::class, 'products']);
    Route::get('/sync/sync_products', [AdminSyncController::class, 'sync_products']);
    Route::get('/sync/get_user/{bin}', [AdminSyncController::class, 'get_user']);
    Route::get('/sync/get_order/{uuid}', [AdminSyncController::class, 'get_order']);
    Route::get('/sync/get_order/', [AdminSyncController::class, 'get_order']);
    Route::get('/sync/update_order/{uuid}', [AdminSyncController::class, 'update_order']);
    Route::get('/sync/get_orders_by_user_bin/{bin}', [AdminSyncController::class, 'get_order_by_user_bin']);
    Route::get('/sync/order_upload', [AdminSyncController::class, 'order_upload']);
    Route::get('/sync/order_cancel', [AdminSyncController::class, 'order_cancel']);
    Route::get('/sync/order_upload_online', [AdminSyncController::class, 'order_upload_online']);
    Route::get('/sync/user_test', [AdminSyncController::class, 'user_test']);
    Route::get('/sync/sync_users', [AdminSyncController::class, 'sync_users']);
    Route::get('/sync/remains_test', [AdminSyncController::class, 'remains_test']);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{order}/set_status/{status_id}', [AdminOrderController::class, 'set_status'])->name('admin.orders.set_status');

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
    Route::get('/download_file/{feedback}/{filenumber}', [FeedbackController::class, 'download_file'])->name('admin.feedbacks.download_file');

    Route::get('/dealers', [AdminDealerController::class, 'index'])->name('admin.dealers.index');
    Route::get('/dealers/create', [AdminDealerController::class, 'create'])->name('admin.dealers.create');
    Route::post('/dealers', [AdminDealerController::class, 'store'])->name('admin.dealers.store');
    Route::get('/dealers/{dealer}', [AdminDealerController::class, 'show'])->name('admin.dealers.show');
    Route::get('/dealers/{dealer}/edit', [AdminDealerController::class, 'edit'])->name('admin.dealers.edit');
    Route::put('/dealers/{dealer}', [AdminDealerController::class, 'update'])->name('admin.dealers.update');
    Route::delete('/dealers/{dealer}', [AdminDealerController::class, 'destroy'])->name('admin.dealers.destroy');

    Route::get('/dealers/{dealer}/brancoffices/create', [AdminDealerController::class, 'branchOfficecreate'])->name('admin.branchoffices.create');
    Route::post('/dealers/{dealer}/brancoffices', [AdminDealerController::class, 'branchofficestore'])->name('admin.branchoffices.store');
    Route::get('/dealers/{dealer}/brancoffices', [AdminDealerController::class, 'branchofficeshow'])->name('admin.dealers.show');
    Route::get('/dealers/{dealer}/brancoffices/{branchoffice}/edit', [AdminDealerController::class, 'branchofficeedit'])->name('admin.branchoffices.edit');
    Route::put('/dealers/{dealer}/brancoffices/{branchoffice}/update', [AdminDealerController::class, 'branchofficeupdate'])->name('admin.branchoffices.update');
    Route::delete('/dealers/{dealer}/brancoffices/{branchoffice}', [AdminDealerController::class, 'branchofficedestroy'])->name('admin.branchoffices.destroy');

    Route::get('/cities', [AdminCityController::class, 'index'])->name('admin.cities.index');
    Route::get('/cities/create', [AdminCityController::class, 'create'])->name('admin.cities.create');
    Route::post('/cities', [AdminCityController::class, 'store'])->name('admin.cities.store');
    Route::get('/cities/{city}', [AdminCityController::class, 'show'])->name('admin.cities.show');
    Route::get('/cities/{city}/edit', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
    Route::put('/cities/{city}', [AdminCityController::class, 'update'])->name('admin.cities.update');
    Route::delete('/cities/{city}', [AdminCityController::class, 'destroy'])->name('admin.cities.destroy');

    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::get('/tickets/{ticket}/set_close', [AdminTicketController::class, 'set_close'])->name('admin.tickets.set_close');
    Route::get('/tickets/{ticket}/set_open', [AdminTicketController::class, 'set_open'])->name('admin.tickets.set_open');
    Route::post('/tickets/{ticket}/reply', [AdminTicketController::class, 'reply_store'])->name('admin.tickets.reply_store');

    Route::get('/amo/auth', [ApiAmoController::class, 'auth'])->name('amo_auth');
});




Route::get('/portal/login', [PortalUserController::class, 'dealer_login_form'])->name('portal.login');
Route::post('/portal/login', [PortalUserController::class, 'dealer_login_form_submit'])->name('portal.login.submit');
Route::prefix('portal')->middleware(['dealer_check'])->group(function () {
    Route::get('/index', [PortalController::class, 'index'])->name('portal.index');
    Route::get('/catalog', [PortalController::class, 'catalog'])->name('portal.catalog.index');
    Route::get('/catalog/{category}', [PortalController::class, 'catalog_category'])->name('portal.catalog.category');
    Route::get('/catalog/product/{product}', [PortalController::class, 'product'])->name('portal.catalog.product');
    Route::get('/catalog/product/{product}/add_to_cart', [PortalController::class, 'add_to_cart'])->name('portal.catalog.product.add_to_cart');
    Route::get('/catalog/product/{variant_id}/add_to_cart_variant', [PortalController::class, 'add_to_cart_variant'])->name('portal.catalog.product.add_to_cart_variant');
    Route::post('/catalog/filtered', [PortalController::class, 'catalog_filtred'])->name('portal.catalog.filter');
    Route::get('/catalog/brand/{brand_title}', [PortalController::class, 'catalog_brand'])->name('portal.catalog.brand');

    Route::get('/posts', [PortalController::class, 'posts'])->name('portal.posts.index');
    Route::get('/posts/{post}', [PortalController::class, 'posts_show'])->name('portal.posts.show');
    Route::get('/contacts', [PortalController::class, 'contacts'])->name('portal.contacts');
    Route::get('/about', [PortalController::class, 'about'])->name('portal.about');
    Route::get('/profile', [PortalUserController::class, 'profile'])->name('portal.user.profile');
    Route::get('/profile/change_pass', [PortalUserController::class, 'change_pass'])->name('portal.user.profile.change_pass');
    Route::post('/profile/change_pass', [PortalUserController::class, 'change_pass_submit'])->name('portal.user.profile.change_pass_submit');

    Route::get('/addresses/create', [PortalUserController::class, 'addresses_create'])->name('portal.user.addresses.create');
    Route::post('/addresses/store', [PortalUserController::class, 'addresses_store'])->name('portal.user.addresses.store');
    Route::get('/addresses/{address}/edit', [PortalUserController::class, 'addresses_edit'])->name('portal.user.addresses.edit');
    Route::post('/addresses/{address}/update', [PortalUserController::class, 'addresses_update'])->name('portal.user.addresses.update');

    Route::get('/cart', [PortalCartController::class, 'cart'])->name('portal.user.cart');
    Route::get('/cart/increase/{product_id}', [PortalCartController::class, 'cart_increase_product'])->name('portal.user.cart.increase');
    Route::get('/cart/reduce/{product_id}', [PortalCartController::class, 'cart_reduce_product'])->name('portal.user.cart.reduce');
    Route::get('/cart/delete/{product_id}', [PortalCartController::class, 'cart_delete_product'])->name('portal.user.cart.delete');
    Route::get('/cart/to_order', [PortalCartController::class, 'to_order'])->name('portal.user.cart.to_order');
    Route::post('/cart/make_order', [PortalCartController::class, 'cart_make_order'])->name('portal.user.cart.cart_make_order');
    Route::get('/cart/reset', [PortalCartController::class, 'reset'])->name('portal.user.cart.reset');

    Route::get('/orders', [PortalController::class, 'orders'])->name('portal.user.orders');
    Route::get('/orders/{order}', [PortalController::class, 'order'])->name('portal.user.order.show');
    Route::get('/orders/{order}/qr', [PortalController::class, 'order_qr'])->name('portal.user.order.qr');
    Route::get('/orders/{order}/kaspi_qr', [PortalController::class, 'order_kaspi_qr'])->name('portal.user.order.kaspi_qr');
    Route::get('/orders/{order}/cancel', [PortalController::class, 'order_cancel'])->name('portal.user.order.cancel');
    Route::get('/orders/{order}/online_payment', [PortalController::class, 'online_payment'])->name('portal.user.order.online_payment');
    Route::get('/download_requisits', [PortalController::class, 'download_requisits'])->name('portal.user.download_requisits');
    Route::get('/policy', [PortalController::class, 'policy'])->name('portal.user.policy');

    Route::get('/tickets', [PortalTicketController::class, 'index'])->name('portal.tickets.index');
    Route::get('/tickets/create', [PortalTicketController::class, 'create'])->name('portal.tickets.create');
    Route::post('/tickets', [PortalTicketController::class, 'store'])->name('portal.tickets.store');
    Route::get('/tickets/{ticket}', [PortalTicketController::class, 'show'])->name('portal.tickets.show');
    Route::post('/tickets/{ticket}/reply', [PortalTicketController::class, 'reply_store'])->name('portal.tickets.reply_store');
    Route::get('/tickets/{ticket}/set_close', [PortalTicketController::class, 'set_close'])->name('portal.tickets.set_close');
    Route::get('/tickets/{ticket}/set_open', [PortalTicketController::class, 'set_open'])->name('portal.tickets.set_open');

    Route::get('/notifies', [PortalNotifyController::class, 'index'])->name('portal.notifies.index');
    Route::get('/notifies/{notify}/read', [PortalNotifyController::class, 'read'])->name('portal.notifies.read');
});

// storeman
Route::prefix('storeman')->middleware(['storeman_check'])->group(function () {
    Route::get('/index', [StoreController::class, 'index'])->name('storeman.index');
    Route::get('/order/{order}', [StoreController::class, 'order_show'])->name('storeman.order.show');
    Route::get('/order/{order}/set_status_done', [StoreController::class, 'set_status_done'])->name('storeman.order.set_status_done');
    Route::get('/order/uuid/{uuid}', [StoreController::class, 'get_order_by_uuid'])->name('storeman.order.uuid');
});


