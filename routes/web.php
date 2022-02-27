<?php

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Vendor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Front\CustomerController;

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
    return redirect()->to('home');

});
Route::get('/home', [\App\Http\Controllers\Front\PagesController::class, 'index'])->name('home');

Route::view('/admin/login', 'admin.login');

Route::get('login-popup', function () {
    return view('front.loginPopup');
});

Route::get('add-address', function () {
    return view('front.addAddress');
});
Route::view('contact-us', 'front.contact-us');

Route::view('/dashboard', 'admin.index')->middleware(['auth'])->name('dashboard');
\Illuminate\Support\Facades\Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---------------------------Routes for guest users of front site--------------------------------------//
Route::group(['namespace' => 'Front'], function () {
    Route::get('product-list/{category_name}', [\App\Http\Controllers\Front\ProductController::class, 'getProducts'])->name('getProducts');
    Route::get('product-detail/{id}', [\App\Http\Controllers\Front\ProductController::class, 'productDetail'])->name('productDetail');
    Route::get('product_category_filter', [\App\Http\Controllers\Front\ProductController::class, 'categoryFilter'])->name('categoryFilter');
    Route::get('product_name_filter', [\App\Http\Controllers\Front\ProductController::class, 'productNameFilter'])->name('productNameFilter');
    Route::get('product_price_filter', [\App\Http\Controllers\Front\ProductController::class, 'priceFilter'])->name('priceFilter');
    Route::get('get-color-sizes/{color_id}/{variant_id}', [\App\Http\Controllers\Front\ProductController::class, 'getColorSizes'])->name('getColorSizes');
    Route::get('product_size-filter/{type}/{min}/{max}/{size}', [\App\Http\Controllers\Front\ProductController::class, 'sizeFilter'])->name('sizeFilter');
    Route::get('product_color-filter/{type}/{min}/{max}/{size}', [\App\Http\Controllers\Front\ProductController::class, 'colorFilter'])->name('colorFilter');
    Route::get('product_size_color-filter/{type}/{min}/{max}/{size}/{color}', [\App\Http\Controllers\Front\ProductController::class, 'sizeColorFilter'])->name('sizeColorFilter');
    Route::get('product_wishlist_update/{product_id}/{variant_id}', [\App\Http\Controllers\Front\ProductController::class, 'productWishlistUpdate'])->name('productWishlistUpdate');
    Route::get('trackOrder', [\App\Http\Controllers\Front\ProductController::class, 'trackOrder'])->name('trackOrder');

   Route::get('product_search_filter/{search}/{color}/{size}/{min_max}/{price_limit}', [\App\Http\Controllers\Front\ProductController::class, 'productSearchFiter'])->name('productSearchFiter');
   Route::get('product_category_filter/{search}/{color}/{size}/{min_max}/{price_limit}', [\App\Http\Controllers\Front\ProductController::class, 'productCategoryFiter'])->name('productCategoryFiter');

     Route::get('clear_cart', [\App\Http\Controllers\Front\CartController::class, 'clearCart'])->name('clearCart');

});

Route::get('cart', [\App\Http\Controllers\Front\WishlistProducts::class, 'cartItems'])->name('cart');
Route::get('product_cart_update/{variant_id}/{qty?}', [\App\Http\Controllers\Front\WishlistProducts::class, 'productCartUpdate'])->name('productCartUpdate');
Route::get('remove-cart-item/{variant_id}', [\App\Http\Controllers\Front\WishlistProducts::class, 'removeCartItem'])->name('removeCartItem');
Route::get('get-cart-item', [\App\Http\Controllers\Front\WishlistProducts::class, 'getCartItems'])->name('getCartItems');


Route::get('check_coupon_validity/{coupon}', [\App\Http\Controllers\Front\CartController::class, 'checkCouponValidity'])->name('checkCouponValidity');


Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('admin-profile',[UserController::class,'adminProfile'])->name('adminProfile');
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', \App\Http\Controllers\SizeController::class);
    Route::get('category_images', [CategoriesController::class, 'getCategoryImages'])->name('getCategoryImages');
    Route::resource('categories', CategoriesController::class);
    Route::get('get_images', [ProductController::class, 'getImages'])->name('getImages');
    Route::post('storeProduct', [ProductController::class, 'storeProduct'])->name('storeProduct');
//    Route::get('/product', function () {});
    Route::get('products/variants/{id}', [ProductController::class, 'getProdcutVariant'])->name('get_product_variant');
    Route::get('products/edit_variants/{variant_id}', [ProductController::class, 'editVariant'])->name('edit_variant');
    Route::post('products/update_variants/{variant_id}', [ProductController::class, 'updateVariant'])->name('update_variant');
    Route::delete('products_variants_delete/{variant_id}', [ProductController::class, 'deleteVariant'])->name('delete_variant');
    Route::resource('products', ProductController::class);
    Route::resource('general-settings', GeneralSettingsController::class);
    Route::get('assign-coupon-page',[CouponController::class,'assignCouponsList'])->name('assignCouponsList');
    Route::get('get-remaining-coupons',[CouponController::class,'getRemainingCouponsToAssign'])->name('getRemainingCouponsToAssign');
    Route::post('search-customer',[CouponController::class,'searchCustomer'])->name('searchCustomer');
    Route::post('assign-coupons',[CouponController::class,'assignCouponToCustomer'])->name('assignCouponToCustomer');
    Route::resource('coupons', CouponController::class);
    Route::resource('banners', \App\Http\Controllers\BannerController::class);
    Route::get('banner_images', [\App\Http\Controllers\BannerController::class, 'getBannerImages'])->name('getBannerImages');
    Route::post('getFirstcategory', [ProductController::class, 'getFirstcategory'])->name('getFirstcategory');
    Route::post('getSecondChildCategory', [ProductController::class, 'getSecondChildCategory'])->name('getSecondChildCategory');

    Route::get('orders-page', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders');
    Route::get('changeOrderStatus/{id}', [\App\Http\Controllers\OrderController::class, 'changeStatus'])->name('changeStatus');
    Route::get('updateStatus', [\App\Http\Controllers\OrderController::class, 'updateStatus'])->name('updateStatus');


    Route::get('/failed_jobs', [\App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');

   Route::get('/job/retry/{id}', function ($id) {

    Artisan::call('config:cache');
    Artisan::queue('queue:restart');

    sleep(2);
      $exitCode = Artisan::call('queue:retry', [
        'id' => $id
    ]);
   return Redirect::back();
});

    Route::group(['namespace' => 'Front'], function () {
        Route::post('update_profile', [CustomerController::class, 'updateProfile'])->name('update_profile');
        Route::post('save_address', [\App\Http\Controllers\Front\WishlistProducts::class, 'saveAddress'])->name('save_address');
        Route::get('change_address_status/{id}/{status}', [\App\Http\Controllers\Front\WishlistProducts::class, 'changeAddressStatus'])->name('changeAddressStatus');
        Route::get('profile', [\App\Http\Controllers\Front\WishlistProducts::class, 'cartOrders'])->name('cartOrders');
        Route::get('wishlist', [\App\Http\Controllers\Front\WishlistProducts::class, 'index'])->name('wishlist');
        Route::get('remove-wishlist/{id}/{variant_id}', [\App\Http\Controllers\Front\WishlistProducts::class, 'removeWishlistItem'])->name('removeWishlistItem');
        /*
                Route::get('remove-cart-item/{variant_id}', [\App\Http\Controllers\Front\WishlistProducts::class, 'removeCartItem'])->name('removeCartItem');
        */
        //Route::post('order-place', [\App\Http\Controllers\Front\WishlistProducts::class, 'orderPlace'])->name('orderPlace');
        Route::post('orderPlace', [\App\Http\Controllers\Front\WishlistProducts::class, 'orderPlace'])->name('orderPlace');
        Route::post('save-rating/{product_id}/{variant_id}', [\App\Http\Controllers\Front\WishlistProducts::class, 'saveRating'])->name('saveRating');
        Route::get('order_detail/{order_id}/{status}', [\App\Http\Controllers\Front\WishlistProducts::class, 'orderDetail'])->name('order_detail');



        Route::get('order_confirm', [\App\Http\Controllers\Front\CartController::class, 'orderConfirm'])->name('orderConfirm');


    });
});
