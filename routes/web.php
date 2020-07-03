<?php

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

// Frontend Routes
Route::get('/', 'IndexController@index');

// Category / Listing Page
Route::get('/products/{url}', 'ProductsController@products');

// Product Filter PAge
Route::match(['get', 'post'], '/products-filter', 'ProductsController@filter');

// Product Detail Page
Route::get('product/{id}', 'ProductsController@product');

// Get  Product Attribute Price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

// Add to Cart Route
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Cart Page
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');

// Delete Product from Cart Page
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');

// Update Product Quantity in Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Apply Coupon
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

// Users Login & Register Page
Route::get('/login-register', 'UsersController@userLoginRegister');

// User Forgot Password
Route::match(['get','post'], 'forgot-password','UsersController@forgotPassword');

// Users Register Form Submit
Route::post('/user-register', 'UsersController@register');

// Confirm Account
Route::get('confirm/{code}','UsersController@confirmAccount');

// Users Login Form Submit
Route::post('/user-login', 'UsersController@login');

// Users Logout
Route::get('/user-logout', 'UsersController@logout');

// Search Products
Route::post('/search-products','ProductsController@searchProducts');

// Check if User already exists
Route::match(['get', 'post'], '/check-email', 'UsersController@checkEmail');

// Check Zipcode
Route::post('/check-zipcode', 'ProductsController@checkZipcode');

// Check Subscriber Email
Route::post('/check-subscriber-email', 'NewsletterController@checkSubscriber');

// Check Subscriber Email
Route::post('/add-subscriber-email', 'NewsletterController@addSubscriber');

// All Routes after Login
Route::group(['middleware'=> ['frontlogin']], function(){
    // Users Account Page
    Route::match(['get','post'],'account', 'UsersController@account');
    // Check User Current Password
    Route::post('/check-user-pwd', 'UsersController@chkUserPassword');
    // Update User Password
    Route::post('/update-user-pwd', 'UsersController@updatePassword');
    // Checkout Page
    Route::match(['get','post'],'checkout', 'ProductsController@checkout');
    // Order Review Page
    Route::match(['get','post'],'/order-review','ProductsController@orderReview');
    // Place Order
    Route::match(['get','post'],'/place-order', 'ProductsController@placeOrder');
    // Thanks Page
    Route::get('/thanks', 'ProductsController@thanks');
    // Paypal Page
    Route::get('/paypal', 'ProductsController@paypal');
    // Users Orders Page
    Route::get('/orders', 'ProductsController@userOrders');
    // User Ordered Products Page
    Route::get('/orders/{id}', 'ProductsController@userOrdersDetails');
    // Paypal Thanks Page
    Route::get('/paypal/thanks', 'ProductsController@thanksPaypal');
    // Paypal Cancel Page
    Route::get('/paypal/cancel', 'ProductsController@cancelPaypal');
    // Wish List Page
    Route::match(['get','post'],'/wish-list','ProductsController@wishList');
    //Delete Product from Wish List
    Route::get('/wish-list/delete-product/{id}', 'ProductsController@deleteWishListProduct');

    //Payumoney Routes
    Route::get('/payment-method/card', 'StripeController@stripePayment');
    Route::post('/place-payment', 'StripeController@placeStripePayment');
    Route::get('/stripe/thanks', 'StripeController@stripeThanks');
});
    // Route::post('/payumoney/response', 'PayumoneyController@payumoneyResponse');
    // Route::get('/payumoney/thanks', 'PayumoneyController@payumoneyThanks');
    // Route::get('/payumoney/fail', 'PayumoneyController@payumoneyFail');
    // Route::get('/payumoney/verification/{id}', 'PayumoneyController@payumoneyVerification');
    // Route::get('/payumoney/verify', 'PayumoneyController@payumoneyVerify');

    // PayPal IPN
    Route::post('/paypal/ipn', 'ProductsController@ipnPaypal');


// Route::get('/', 'LandingPageController@index')->name('landing-page');
// Route::get('/magazin', 'ShopController@index')->name('shop.index');
// Route::get('/remedii', 'RemediiController@index')->name('remedii.index');
// Route::get('/cos', 'CartController@index')->name('cart.index');
// Route::post('/cos', 'CartController@store')->name('cart.store');
// Route::patch('/cos/{product}', 'CartController@update')->name('cart.update');
// Route::delete('/cos/{product}', 'CartController@destroy')->name('cart.destroy');
// Route::post('/cos/switchToSaveForLater/{product}','CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');


// Backend Admin Dashboard Routes
Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::group(['middleware' => ['adminlogin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    //Categories Routes (Admin)
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');

    //Products Routes
    Route::match(['get','post'], '/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'], '/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/export-products','ProductsController@exportProducts');
    Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
    Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');

    Route::match(['get','post'],'/admin/add-images/{id}', 'ProductsController@addImages');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');


    // Products Attributes Routes
    Route::match(['get','post'],'/admin/add-attributes/{id}', 'ProductsController@addAttributes');
    Route::match(['get','post'],'/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
    Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteProduct');

    //Coupon Routes
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@addCoupon');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@editCoupon');
    Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}', 'CouponsController@deleteCoupon');

    //Admin Banners Routes
    Route::match(['get', 'post'], '/admin/add-banner', 'BannersController@addBanner');
    Route::match(['get', 'post'], '/admin/edit-banner/{id}', 'BannersController@editBanner');
    Route::get('admin/view-banners', 'BannersController@viewBanners');
    Route::get('/admin/delete-banner/{id}', 'BannersController@deleteBanner');

    // Admin Orders Routes
    Route::get('/admin/view-orders', 'ProductsController@viewOrders');

    // Admin Orders Charts Route
    Route::get('/admin/view-orders-charts', 'ProductsController@viewOrdersCharts');

    // Admin Order Details Route
    Route::get('/admin/view-order/{id}', 'ProductsController@viewOrderDetails');

    // Order Invoice Route
    Route::get('/admin/view-order-invoice/{id}', 'ProductsController@viewOrderInvoice');

    // PDF Invoice Route
    Route::get('/admin/view-pdf-invoice/{id}', 'ProductsController@viewPDFInvoice');

    // Update Order Status
    Route::post('/admin/update-order-status', 'ProductsController@updateOrderStatus');

    // Admin Users Route
    Route::get('/admin/view-users', 'UsersController@viewUsers');

    // Admin Users Charts Route
    Route::get('/admin/view-users-charts', 'UsersController@viewUsersCharts');

    // Admin Users Countries Charts Route
    Route::get('/admin/view-users-countries-charts', 'UsersController@viewUsersCountriesCharts');

    // Export Users Route
    Route::get('/admin/export-users', 'UsersController@exportUsers');

    // Admin / Sub-Admins View Route
    Route::get('/admin/view-admins', 'AdminController@viewAdmins');

    // Add Admins / Sub-Admins Route
    Route::match(['get', 'post'], '/admin/add-admin', 'AdminController@addAdmin');

    // Edit Admins / Sub-Admins Route
    Route::match(['get', 'post'], '/admin/edit-admin/{id}', 'AdminController@editAdmin');

    // Add CMS Route
    Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

    // Edit CMS Route
    Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

    // View CMS Pages Route
    Route::get('/admin/view-cms-pages', 'CmsController@viewCmsPages');

    // Delete CMS Pages Route
    Route::get('/admin/delete-cms-page/{id}', 'CmsController@deleteCmsPages');

    // Get Enquiries
    Route::get('/admin/get-enquiries', 'CmsController@getEnquiries');
    // View Enquiries
    Route::get('/admin/view-enquiries', 'CmsController@viewEnquiries');

    // Currencies Routes
    // Add Currency Route
    Route::match(['get', 'post'], '/admin/add-currency', 'CurrencyController@addCurrency');

    // Edit Currency Route
    Route::match(['get', 'post'], '/admin/edit-currency/{id}', 'CurrencyController@editCurrency');

    // Delete Currency Route
    Route::get('/admin/delete-currency/{id}', 'CurrencyController@deleteCurrency');

    // View Currencies Route
    Route::get('/admin/view-currencies', 'CurrencyController@viewCurrencies');

    // View Shipping Charges
    Route::get('/admin/view-shipping', 'ShippingController@viewShipping');

    // Update Shipping Charges
    Route::match(['get', 'post'], '/admin/edit-shipping/{id}', 'ShippingController@editShipping');

    //View Newsletter Subscribers
    Route::get('/admin/view-newsletter-subscribers', 'NewsletterController@viewNewsletterSubscribers');

    // Update Newsletter Status
    Route::get('/admin/update-newsletter-status/{id}/{status}', 'NewsletterController@updateNewsletterStatus');

    // Delete Newsletter Email
    Route::get('/admin/delete-newsletter-email/{id}', 'NewsletterController@deleteNewsletterEmail');

    // Export Newsletter Emails
    Route::get('/admin/export-newsletter-emails', 'NewsletterController@exportNewsletterEmails');

});

Route::get('/logout', 'AdminController@logout');

// Diplay Contact Page
Route::match(['get', 'post'], '/page/contact', 'CmsController@contact');

// Diplay Post Page (for Vue.js)
Route::match(['get', 'post'], '/page/post', 'CmsController@addPost');

// Display CMS Page
Route::match(['get', 'post'], '/page/{url}', 'CmsController@cmsPage');

// Route::get('/home', 'HomeController@index')->name('home');
