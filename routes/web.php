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
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    // front
    Route::get('/', 'IndexController@index')->name('index');
    Route::post('/login/customer', 'Auth\CustomerLoginController@login')->name('customerLogin');
    Route::post('/login/customer_history', 'Auth\CustomerLoginController@historyLogin')->name('historyLogin');
    Route::post('/register/customer', 'Auth\RegisterController@createCustomer')->name('createCustomer');
    Route::post('/logout/customer', 'Auth\CustomerLoginController@logoutCustomer')->name('customerLogout');
    Route::post('/reset_password', 'Auth\CustomPasswordResetController@setlink')->name('reset_password');
    Route::get('/reset_password/{token}/{enpassword}', 'Auth\CustomPasswordResetController@reset')->name('reset_confirm');
    Route::post('/change_password', 'IndexController@changePassword')->name('change_password');
    Route::get('/checkLogin', 'Auth\CustomerLoginController@checkLogin')->name('checkLogin');
    Route::get('/search', 'IndexController@searchAll')->name('searchAll');
    // about
    Route::get('/about', 'IndexController@about')->name('about');
    // about credit
    Route::get('/about_fleet', 'IndexController@aboutCredit')->name('about_credit');
    Route::post('/about_credit', 'IndexController@storeFleet');
    // about job
    Route::get('/about/job', 'IndexController@aboutJob')->name('about_job');
    Route::get('/about/job/filter', 'IndexController@about_job_filter')->name('about_job_filter');
    Route::get('/about/job/{id}', 'IndexController@about_Job_detail')->name('about_job_detail');

    Route::get('/get_branch', 'IndexController@getBranch')->name('getBranch');
    // history
    Route::get('/history', 'IndexController@history')->name('history');
    Route::get('/history_detail', 'IndexController@history_detail')->name('history_detail');
    // history_cart
    Route::get('/history/purchase', 'EcommerceController@index')->name('history_purchase');
    Route::post('/history/purchase/save_review', 'EcommerceController@saveReview')->name('saveReview');
    // cart
    Route::get('/cart', 'CartController@Cart')->name('cart');
    Route::get('/cart/add', 'CartController@addToCart')->name('addcart');
    Route::get('/cart/add/product', 'CartController@addcartproduct')->name('addcartproduct');
    Route::get('/cart/add/number-product', 'CartController@putcartproduct')->name('putcartproduct');
    Route::post('/cart/save', 'CartController@update')->name('savecart');
    Route::post('/cart/save2', 'CartController@updateOrder1')->name('savecart2');
    Route::post('/cart/save3', 'CartController@updateOrder2')->name('savecart3');
    Route::post('/cart/save/sendmail', 'CartController@sendmail')->name('sendmailCart');
    Route::get('cart/remove', 'CartController@remove')->name('removeCart');
    Route::get('cart/promotion/code', 'CartController@getCode')->name('getCodeFront');
    Route::get('cart/promotion/code/check', 'CartController@checkCode')->name('checkCode');
    Route::post('/cart/save/order', 'CartController@updateOrder0')->name('saveOrder');

    Route::get('cart/order/remove', 'OrderController@remove')->name('removeOrder');
    
    Route::get('/cart/order/{id}', 'OrderController@mail_cart');
    Route::get('/cart/order', 'OrderController@order')->name('order');
    Route::get('/cart/order/process/2', 'OrderController@order2')->name('order2');
    Route::get('/cart/order/process/3', 'OrderController@order3')->name('order3');
    Route::get('/cart/order/get/car/model', 'OrderController@getModelFront')->name('getModelFront');
    Route::resource('orders', 'OrderController');
    Route::get('/cart/order/paybank/{id}', 'OrderController@orderpaybank')->name('orderpaybank');
    Route::get('/cart/order/installment/{id}', 'OrderController@orderinstallment')->name('orderinstallment');
    Route::post('/cart/order/purchase/result', 'OrderController@resultInstallment')->name('resultInstallment');
    Route::get('/cart/order/card/{id}', 'OrderController@ordercard')->name('ordercard');
    Route::post('/cart/order/purchase/result2', 'OrderController@resultCard')->name('resultCard');
    Route::post('/cart/order/purchase/callback', 'OrderController@cardcallback');
    Route::post('/cart/order/save/slip/{order_id}', 'OrderController@saveSlip')->name('saveSlip');
    Route::get('/branch/save/{id}', 'BranchFrontController@savebranch')->name('branch_save');
    // products
    Route::prefix('product')->group(function () {
        Route::get('product-car-model', 'ProductFrontController@getCarModel')->name('getCarModel');
        Route::get('product-car-year', 'ProductFrontController@getCarYear')->name('getCarYear');
        Route::get('product-car-model-have-product', 'ProductFrontController@getCarModelHaveProduct')->name('getCarModelHaveProduct');
        Route::get('product-car-year-have-product', 'ProductFrontController@getCarYearHaveProduct')->name('getCarYearHaveProduct');

        Route::get('product/tyre/height', 'ProductFrontController@carSizeB')->name('getCarSizeB');
        Route::get('product/tyre/line', 'ProductFrontController@carSizeC')->name('getCarSizeC');
        // Route::get('product/tyre/height', 'ProductFrontController@getCarHeight')->name('getCarHeight');
        // Route::get('product/tyre/line', 'ProductFrontController@getCarLine')->name('getCarLine');
        // product tyre
        Route::get('tyre/search_car', 'ProductFrontController@searchCar')->name('search_car_product');
        Route::get('tyre/search_info', 'ProductFrontController@tyreInfoSearch')->name('tyreInfoSearch');
        Route::get('tyre/filter/brand/{brand}', 'ProductFrontController@filterTyreBrand')->name('filter_tyre_brand');
        Route::get('tyre/filter/sort/{sort}', 'ProductFrontController@filterTyre')->name('filterTyre');
        Route::get('tyre/filter/category/{category}', 'ProductFrontController@filterCategory')->name('filterCategory');
        Route::get('tyre/search', 'ProductFrontController@tyreSearch')->name('tyreSearch');
        Route::get('tyre', 'ProductFrontController@product')->name('product');
        Route::get('tyre/{brand}/{id}/{slug}', 'ProductFrontController@product_detail')->name('product_detail');    
        // product other
        Route::get('other', 'ProductFrontController@product_other')->name('product_other');
        Route::get('other/{id}/{slug}', 'ProductFrontController@product_other_detail')->name('product_other_detail');
        // product oil
        Route::get('oil/filter/brand/{brand}', 'ProductOilFrontController@filterOilBrand')->name('filterOilBrand');
        Route::get('oil', 'ProductOilFrontController@product_oil')->name('product_oil');
        Route::get('oil/{brand}/{id}/{slug}', 'ProductOilFrontController@product_oil_detail')->name('product_oil_detail');
        Route::get('oil/search', 'ProductOilFrontController@searchOil')->name('searchOil');
        Route::get('oil/search_car', 'ProductOilFrontController@searchCarOil')->name('searchCarOil');
        Route::get('oil/filter', 'ProductOilFrontController@filterOil')->name('filterOil');
        // product shock
        Route::get('shock/filter/brand/{brand}', 'ProductShockFrontController@filterShockBrand')->name('filterShockBrand');
        Route::get('shock', 'ProductShockFrontController@product_shock')->name('product_shock');
        Route::get('shock/{brand}/{id}/{slug}', 'ProductShockFrontController@product_shock_detail')->name('product_shock_detail');
        Route::get('shock/search_car', 'ProductShockFrontController@searchCarShock')->name('searchCarShock');
        Route::get('shock/filter', 'ProductShockFrontController@filterShock')->name('filterShock');
        // product brake
        Route::get('brake/filter/brand/{brand}', 'ProductBrakeFrontController@filterBrakeBrand')->name('filterBrakeBrand');
        Route::get('brake', 'ProductBrakeFrontController@product_brake')->name('product_brake');
        Route::get('brake/{brand}/{id}/{slug}', 'ProductBrakeFrontController@product_brake_detail')->name('product_brake_detail');
        Route::get('brake/search_car', 'ProductBrakeFrontController@searchCarBrake')->name('searchCarBrake'); 
        Route::get('brake/filter', 'ProductBrakeFrontController@filterBrake')->name('filterBrake');       
        // product batt
        Route::get('battery/filter/brand/{brand}', 'ProductBattFrontController@filterBattBrand')->name('filterBattBrand');
        Route::get('battery', 'ProductBattFrontController@product_batt')->name('product_batt');
        Route::get('battery/{brand}/{id}/{slug}', 'ProductBattFrontController@product_batt_detail')->name('product_batt_detail');
        Route::get('battery/search', 'ProductBattFrontController@searchBatt')->name('searchBatt');
        Route::get('battery/search_car', 'ProductBattFrontController@searchCarBatt')->name('searchCarBatt');
        Route::get('battery/filter', 'ProductBattFrontController@filterBatt')->name('filterBatt');
        // air
        Route::get('air', 'ProductFrontController@air')->name('air');

        Route::get('get/{type}', 'ProductFrontController@getProduct')->name('getProduct');
        Route::get('get/category', 'ProductFrontController@getProduct2')->name('getProduct2');
        // compare
        Route::get('compare/check', 'CompareController@compareCheck')->name('compareCheck');
        Route::get('compare', 'CompareController@index')->name('compare');
        Route::get('compare/oil', 'CompareController@oil')->name('compareoil');
        Route::get('compare/shock', 'CompareController@shock')->name('compareshock');
        Route::get('compare/brake', 'CompareController@brake')->name('comparebrake');
        Route::get('compare/battery', 'CompareController@batt')->name('comparebatt');
        Route::get('compare/tyre', 'CompareController@getCompare')->name('getCompare');
        Route::get('compare/sort/{type}', 'CompareController@sortBrandCompare')->name('sortBrandCompare');
        Route::get('compare/select/{type}', 'CompareController@compareProduct')->name('compareProduct');
        Route::get('compare/modal/{type}/{sortBrand?}', 'CompareController@getModal')->name('compareModal');
        // review
        Route::get('review', 'EcommerceController@review')->name('review');
        Route::get('review/{type}/{brand}/{product}', 'EcommerceController@filter_review')->name('filter_review');
        Route::get('review-filter/get-brand', 'EcommerceController@getBrandReview')->name('getBrandReview');
        Route::get('review-filter/get-product', 'EcommerceController@getProductReview')->name('getProductReview');
        Route::get('review-get/more', 'EcommerceController@getMoreReview')->name('getMoreReview');
        
    });
    Route::get('branch/review', 'EcommerceController@reviewBranch')->name('reviewBranch');
    Route::get('branch/review/{province}', 'EcommerceController@reviewBranchProvince')->name('reviewBranchProvince');
    Route::get('branch/review/{province}/{id}', 'EcommerceController@reviewGetBranch')->name('reviewGetBranch');
    // advices
    Route::prefix('advice')->group(function () {
        // โช้คอัพ
        Route::get('shock', 'AdviceFrontController@advice')->name('advice');
        Route::get('shock/{slug}', 'AdviceFrontController@advice_detail')->name('advice_detail');
        // เบรก
        Route::get('brake', 'AdviceFrontController@brake')->name('brake');
        Route::get('brake/{slug}', 'AdviceFrontController@brake_detail')->name('brake_detail');
        // ยาง
        Route::get('tyre', 'AdviceFrontController@tyre')->name('tyre');
        Route::get('tyre/{slug}', 'AdviceFrontController@tyre_detail')->name('tyre_detail');
        // แบต
        Route::get('battery', 'AdviceFrontController@batt')->name('batt');
        Route::get('battery/{slug}', 'AdviceFrontController@batt_detail')->name('batt_detail');
        // น้ำมัน
        Route::get('oil', 'AdviceFrontController@oil')->name('oil');
        Route::get('oil/{slug}', 'AdviceFrontController@oil_detail')->name('oil_detail');
        // ปัด
        Route::get('wiper', 'AdviceFrontController@rain_c')->name('rain_c');
        Route::get('wiper/{slug}', 'AdviceFrontController@rain_c_detail')->name('rain_c_detail');
        // เครื่อง
        Route::get('engine', 'AdviceFrontController@engine')->name('engine');
        Route::get('engine/{slug}', 'AdviceFrontController@engine_detail')->name('engine_detail');
        // video
        Route::get('60sec', 'AdviceFrontController@video1')->name('video1');    
    });
    Route::get('b-quik-clip', 'AdviceFrontController@video2')->name('video2');
    Route::get('b-quik-clip/{sub_type}', 'AdviceFrontController@video2_filter')->name('video2_filter');
    // news
    Route::get('/news', 'IndexController@news')->name('news');
    Route::get('/news/{slug}', 'IndexController@news_detail')->name('news_detail');
    // promotion
    Route::get('/promotion', 'IndexController@promotion')->name('promotion');
    Route::get('/promotion/{slug}', 'IndexController@promotion_detail')->name('promotion_detail');    
    // สาขา
    Route::get('/branch', 'BranchFrontController@branch')->name('branch');
    Route::get('/branch/detail/{id}', 'BranchFrontController@branch_detail')->name('branch_detail');
    Route::get('/branch/search', 'BranchFrontController@searchBranch')->name('searchBranch');
    Route::get('/branch/searchAjax', 'BranchFrontController@searchBranchAjax')->name('searchBranchAjax');
    Route::get('/branch/searchResult', 'BranchFrontController@searchResult')->name('searchResult');
    // cctv
    Route::get('/cctv', 'CctvFrontController@cctv')->name('cctv');
    Route::get('/cctv/your_cctv', 'CctvFrontController@cctvDetail')->name('cctv_detail');
    Route::post('/cctv/your_cctv/login', 'CctvFrontController@cctvLogin')->name('cctvlogin');
    // contact
    Route::get('/contact', 'IndexController@contact')->name('contact');
    Route::post('/contact', 'IndexController@storeContact');

    Route::get('/form/{id}', 'IndexController@form')->name('form');
    Route::post('/form', 'IndexController@storeForm')->name('saveForm');

    Route::get('re_captcha', 'IndexController@reCaptcha')->name('re_captcha');

    Route::get('registration', 'PolicyController@registration')->name('registration');
    Route::get('cookie-policy', 'PolicyController@cookie')->name('cookie');
    Route::get('privacy-policy', 'PolicyController@privacy')->name('privacy');
    Route::get('terms-conditions', 'PolicyController@condition')->name('condition');
    // csr
    Route::get('csr', 'AdviceFrontController@csr')->name('csr');
    Route::get('csr/filter/{year}', 'AdviceFrontController@csr_filter')->name('csr_filter');
    Route::get('csr/{slug}', 'AdviceFrontController@csr_detail')->name('csr_detail');

    Route::prefix('login')->group(function () {
        Route::get('/{provider}', 'Auth\CustomerLoginController@redirectToProvider')->name('login.facebook');
        Route::get('/{provider}/callback', 'Auth\CustomerLoginController@handleProviderCallback')->name('login.provider.callback');
    });
    
});
    Route::get('/pdf', 'PDFController@pdf')->name('pdf');
    Route::get('/pdf2', 'PDFController@pdf2')->name('pdf2');
    Route::get('/{type}/view', 'PDFController@preview')->name('viewpdf');
    Route::get('/worksheet/{id}', 'PDFController@worksheet')->name('worksheet');
    Route::get('/receipt/{id}', 'PDFController@receipt')->name('receipt');

// -------------------------------------------------------------------------------------------------------------

// back
// Authentication
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('cms', 'LoginController@showLoginForm')->name('login');
    Route::post('cms', 'LoginController@login');
    Route::post('cms/logout', 'LoginController@logoutAdmin')->name('logout');

    // Registration Routes...
    Route::get('admin/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('admin/register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('admin/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('admin/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('admin/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('admin/password/reset', 'ResetPasswordController@reset');
});

Route::get('/admin/home', 'HomeController@index')->name('admin.home');
Route::post('/admin/upload_imaage', 'HomeController@upload')->name('upload');
Route::post('/admin/upload_imaage2', 'HomeController@upload2')->name('upload2');
// user
Route::get('users-data', 'UserController@list')->name('user.data');
Route::get('admin/user/export', 'UserController@export')->name('userExport');
Route::resource('admin/user', 'UserController');
Route::get('/admin/user', 'UserController@index')->name('admin.user');
Route::post('admin/updatepassword', 'UserController@updatepassword')->name('updatepassword');
Route::get('/admin/changeStatus', 'UserController@changeStatus')->name('changeStatus');
// permission
Route::get('admin/role/permission', 'PermissionController@getRoleid')->name('getRoleid');
Route::resource('admin/permission', 'PermissionController');
Route::get('/admin/permission', 'PermissionController@index')->name('admin.permission');
// customer
Route::get('customers-data/{type}/{start}/{end}', 'CustomerComtroller@list')->name('customer.data');
Route::get('admin/customer/export', 'CustomerComtroller@export')->name('customerExport');
Route::get('admin/customer/filter', 'CustomerComtroller@filter')->name('customerFilter');
Route::resource('admin/customer', 'CustomerComtroller');
Route::get('/admin/customer', 'CustomerComtroller@index')->name('admin.customer');
Route::get('/admin/customer2', 'CustomerComtroller@index2')->name('admin.customer2');
Route::get('/admin/customer2/{id}/edit', 'CustomerComtroller@edit2')->name('customer.edit.ecom');
Route::post('admin/updatepasswordcustomer', 'CustomerComtroller@updatepassword')->name('updatepasswordcustomer');
Route::get('/admin/changeStatusCustomer', 'CustomerComtroller@changeStatus')->name('changeStatusCustomer');
// profile
Route::get('/admin/profile', 'ProfileController@index')->name('admin.profile');
Route::post('/admin/edit', 'ProfileController@edit')->name('edit');
Route::post('/admin/password', 'ProfileController@password');
// role
Route::resource('admin/role', 'RoleController');
Route::get('/admin/role', 'RoleController@index')->name('admin.role');
Route::get('/admin/changeStatusRole', 'RoleController@changeStatus')->name('changeStatusRole');
// group
Route::resource('admin/group', 'GroupController');
Route::get('/admin/group', 'GroupController@index')->name('admin.group');
Route::get('/admin/changeStatusGroup', 'GroupController@changeStatus')->name('changeStatusGroup');
// email setting
Route::resource('admin/emailSetting', 'EmailSetting');
Route::get('email-data', 'EmailSetting@list');
Route::get('/admin/emailSetting', 'EmailSetting@index')->name('admin.emailSetting');
// banner
Route::get('banners-data', 'BannerController@list')->name('banner.data');
Route::resource('admin/banner', 'BannerController');
Route::get('/admin/banner', 'BannerController@index')->name('admin.banner');
Route::get('/admin/changeStatusBanner', 'BannerController@changeStatus')->name('changeStatusBanner');
Route::post('/admin/banner/changepriority', 'BannerController@changePriorityBanner')->name('changePriorityBanner');
// product banner
Route::resource('admin/product_banner', 'ProductBannerController');
Route::get('/admin/product_banner', 'ProductBannerController@index')->name('admin.product_banner');
Route::get('/admin/changeStatusProductBanner', 'ProductBannerController@changeStatus')->name('changeStatusProductBanner');
// promotion
Route::delete('admin/image_delete/{id}', 'PromotionController@imageDelete');
Route::delete('admin/image_delete2/{id}', 'PromotionController@imageDelete2');
Route::delete('admin/promotion/image_delete/{id}', 'PromotionController@imageDeletePromotion');
Route::resource('admin/promotion', 'PromotionController');
Route::get('/admin/promotion', 'PromotionController@index')->name('admin.promotion');
Route::get('/promotion-data', 'PromotionController@list')->name('promotion.data');
Route::get('/admin/changeStatusPromotion', 'PromotionController@changeStatus')->name('changeStatusPromotion');
Route::post('/admin/promotion/changepriority', 'PromotionController@changePriorityPromotion')->name('changePriorityPromotion');
// news
Route::delete('admin/news/image_delete/{id}', 'NewsController@imageDelete');
Route::delete('admin/news/image_delete2/{id}', 'NewsController@imageDelete2');
Route::delete('admin/news/image_delete3/{id}', 'NewsController@imageDeleteNews');
Route::resource('admin/news', 'NewsController');
Route::get('/admin/news', 'NewsController@index')->name('admin.news');
Route::get('/news-data', 'NewsController@list')->name('news.data');
Route::get('/admin/changeStatusNews', 'NewsController@changeStatus')->name('changeStatusNews');
Route::post('/admin/news/changepriority', 'NewsController@changePriorityNews')->name('changePriorityNews');
// branch
Route::get('/admin/branch/filter', 'BranchController@filterBranch')->name('filterBranch');
Route::resource('admin/branch', 'BranchController');
Route::get('/admin/branch', 'BranchController@index')->name('admin.branch');
Route::get('/branch-data', 'BranchController@list')->name('branch.data');
Route::get('/admin/changeStatusBranch', 'BranchController@changeStatus')->name('changeStatusBranch');

// advice
Route::delete('admin/advice/image/delete/{id}/{type}', 'AdviceController@delete_image');
Route::delete('admin/image_delete3/{id}', 'AdviceController@imageDelete');
Route::delete('admin/image_delete4/{id}', 'AdviceController@imageDelete2');
Route::get('/admin/advice/filter', 'AdviceController@filterAdvice')->name('filterAdvice');
Route::resource('admin/advice', 'AdviceController');
Route::get('/admin/advice', 'AdviceController@index')->name('admin.advice');
Route::get('/advice-data', 'AdviceController@list')->name('advice.data');
Route::get('/admin/changeStatusAdvice', 'AdviceController@changeStatus')->name('changeStatusAdvice');
Route::post('/admin/advice/changepriority', 'AdviceController@changePriorityAdvice')->name('changePriorityAdvice');
// cctv
Route::get('/cctv-data', 'CctvController@list')->name('cctv.data');
Route::get('/cctv_camera-data/{id}', 'CctvController@list2')->name('cctv_camera.data');
Route::resource('admin/cctv', 'CctvController');
Route::get('/admin/cctv', 'CctvController@index')->name('admin.cctv');
Route::get('/admin/changeStatusCctv', 'CctvController@changeStatus')->name('changeStatusCctv');
Route::get('/admin/changeStatusCamera', 'CctvController@changeStatusCamera')->name('changeStatusCamera');
Route::post('/admin/addcamera', 'CctvController@addCamera')->name('addCamera');
Route::patch('/admin/updatecamera', 'CctvController@cameraUpdate')->name('cameraUpdate');
Route::delete('/admin/cctv/delete_camera/{id}', 'CctvController@cameraDelete')->name('cameraDelete');
// cctv customer
Route::resource('admin/cctv_customer', 'CctvCustomerController');
Route::get('/admin/cctv_customer', 'CctvCustomerController@index')->name('admin.cctv_customer');
Route::get('/admin/changeStatusCctvCustomer', 'CctvCustomerController@changeStatus')->name('changeStatusCctvCustomer');
// fleet user
Route::get('fleet-data/{start}/{end}', 'FleetController@list')->name('fleet.data');
Route::get('/admin/fleet-get', 'FleetController@getFleet')->name('getFleet');
Route::get('/admin/fleet/filter', 'FleetController@filter')->name('fleetFilter');
Route::get('/admin/fleet/export', 'FleetController@export')->name('fleetExport');
Route::resource('admin/fleet', 'FleetController');
Route::get('/admin/fleet', 'FleetController@index')->name('admin.fleet');
Route::get('/admin/changeStatusFleet', 'FleetController@changeStatus')->name('changeStatusFleet');

// job
Route::get('/admin/job/getjob', 'JobController@getjob')->name('getjob');
Route::resource('admin/job', 'JobController');
Route::get('/admin/job', 'JobController@index')->name('admin.job');
Route::get('/job-data', 'JobController@list')->name('job.data');
Route::get('/admin/changeStatusJob', 'JobController@changeStatus')->name('changeStatusJob');
// job icon
Route::resource('admin/job_icon', 'JobIconController');
Route::get('/admin/job_icon', 'JobIconController@index')->name('admin.job_icon');
Route::get('/job_icon-data', 'JobIconController@list')->name('job_icon.data');
Route::get('/admin/changeStatusIcon', 'JobIconController@changeStatus')->name('changeStatusIcon');
Route::delete('/admin/icon/pdf_delete/{id}', 'JobIconController@pdfDelete')->name('pdfDelete');
// job apply
Route::get('job_apply-data/{start}/{end}', 'JobApplyController@list')->name('job_apply.data');
Route::get('/admin/job_apply/filter', 'JobApplyController@filter')->name('jobFilter');
Route::get('/admin/job_apply/export', 'JobApplyController@export')->name('jobExport');
Route::resource('admin/job_apply', 'JobApplyController');
Route::get('/admin/job_apply', 'JobApplyController@index')->name('admin.job_apply');
// air
Route::resource('admin/air', 'AirController');
Route::get('/admin/air', 'AirController@index')->name('admin.air');
Route::get('/air-data', 'AirController@list')->name('air.data');
Route::get('/admin/changeStatusAir', 'AirController@changeStatus')->name('changeStatusAir');
// product
Route::get('/products-data/{type}', 'ProductController@productsList')->name('product.data');
Route::get('/product-service-data', 'ProductController@serviceList')->name('service.data');
Route::get('/admin/product/service', 'ProductController@service')->name('admin.service');
Route::post('/admin/product/service/update', 'ProductController@serviceUpdate')->name('serviceUpdate');
Route::resource('admin/product', 'ProductController');
Route::get('/admin/product', 'ProductController@index')->name('admin.product');
Route::get('/admin/changeStatusProduct', 'ProductController@changeStatus')->name('changeStatusProduct');
Route::get('/admin/deleteProductImage', 'ProductController@deleteProductImage')->name('deleteProductImage');
Route::post('/admin/product/import', 'ProductController@import')->name('product.import');
// product other
Route::resource('admin/product_other', 'ProducOthertController');
Route::get('/admin/product_other', 'ProducOthertController@index')->name('admin.product_other');
Route::get('/product_other-data', 'ProducOthertController@list')->name('product_other.data');
Route::get('/admin/changeStatusOther', 'ProducOthertController@changeStatus')->name('changeStatusOther');
Route::get('/admin/deleteProductOtherImage', 'ProducOthertController@deleteProductOtherImage')->name('deleteProductOtherImage');
// product warranty
Route::get('/admin/warranty/filter', 'WarrantyController@filterWarranty')->name('filterWarranty');
Route::resource('admin/warranty', 'WarrantyController');
Route::get('/admin/warranty', 'WarrantyController@index')->name('admin.warranty');
Route::get('/warranty-data', 'WarrantyController@list')->name('warranty.data');
Route::get('/admin/changeStatusWarranty', 'WarrantyController@changeStatus')->name('changeStatusWarranty');
// product category
Route::resource('admin/category', 'CategoryController');
Route::get('/admin/category', 'CategoryController@index')->name('admin.category');
Route::get('/category-data', 'CategoryController@list')->name('category.data');
Route::get('/admin/changeStatusCategory', 'CategoryController@changeStatus')->name('changeStatusCategory');
// product information
Route::resource('admin/information', 'InformationController');
Route::get('/admin/information', 'InformationController@index')->name('admin.information');
Route::get('/information-data', 'InformationController@list')->name('information.data');
Route::get('/admin/changeStatusInformation', 'InformationController@changeStatus')->name('changeStatusInformation');
Route::get('/admin/Information/filter', 'InformationController@filterInformation')->name('filterInformation');
// product brand
Route::get('/admin/brand/filter', 'BrandController@filterBrand')->name('filterBrand');
Route::resource('admin/brand', 'BrandController');
Route::get('/admin/brand', 'BrandController@index')->name('admin.brand');
Route::get('/brand-data', 'BrandController@list')->name('brand.data');
Route::get('/admin/changeStatusBrand', 'BrandController@changeStatus')->name('changeStatusBrand');

// youtube
Route::get('/admin/youtube/filter', 'YoutubeController@filterVideo')->name('filterVideo');
Route::resource('admin/youtube', 'YoutubeController');
Route::get('/admin/youtube', 'YoutubeController@index')->name('admin.youtube');
Route::get('/youtube-data', 'YoutubeController@list')->name('youtube.data');
Route::get('/admin/changeStatusYoutube', 'YoutubeController@changeStatus')->name('changeStatusYoutube');
Route::post('/admin/youtube/changepriority', 'YoutubeController@changePriorityVideo')->name('changePriorityVideo');
// contact
Route::get('contact-data/{start}/{end}', 'ContactController@list')->name('contact.data');
Route::get('/admin/contact-get', 'ContactController@getContact')->name('getContact');
Route::get('/admin/contact-export', 'ContactController@export')->name('contactExport');
Route::get('/admin/contact-filter', 'ContactController@filter')->name('contactFilter');
Route::resource('admin/contact', 'ContactController');
Route::get('/admin/contact', 'ContactController@index')->name('admin.contact');

// car
Route::get('/car-brand-data', 'CarController@list1')->name('carbrand.data');
Route::get('/car-model-data/{brand_id}', 'CarController@list2')->name('carmodel.data');
Route::get('/car-year-data/{model_id}', 'CarController@list3')->name('caryear.data');
Route::resource('admin/car', 'CarController');
Route::get('/admin/car', 'CarController@index')->name('admin.car');
Route::delete('/admin/car_delete/model/{id}', 'CarController@modelDelete')->name('modelDelete');
Route::delete('/admin/car_delete/year/{id}', 'CarController@yearDelete')->name('yearDelete');
// ร่นรถ + รหัส
Route::get('/matching-data', 'CarProductController@list')->name('matching.data');
Route::resource('admin/car_product', 'CarProductController');
Route::get('/admin/car_product', 'CarProductController@index')->name('admin.car_product');
Route::get('/admin/car_product-model', 'CarProductController@getModel')->name('getModel');
Route::get('/admin/car_product-year', 'CarProductController@getYear')->name('getYear');
Route::get('/admin/car_product/get-data/{id}', 'CarProductController@getData')->name('getData');

// ecommerce
Route::get('admin/e/home', 'HomeController@index2')->name('admin.home2');
Route::get('admin/customer/history/{id}', 'HomeController@history')->name('customer.history');
// cart
    // promotion
    Route::get('product_promotion-data', 'ProductPromotionController@list');
    Route::get('admin/product_promotion/code', 'ProductPromotionController@getCode')->name('getCode');
    Route::resource('admin/product_promotion', 'ProductPromotionController');
    Route::get('admin/product_promotion', 'ProductPromotionController@index')->name('admin.product_promotion');
    Route::get('admin/changeStatusCode', 'ProductPromotionController@changeStatus')->name('changeStatusCode');
    // mail
    Route::get('mail-data', 'MailController@list')->name('mail.data');
    Route::resource('admin/mail', 'MailController');
    Route::get('admin/mail', 'MailController@index')->name('admin.mail');
    // pdf sheet
    Route::get('worksheet-data', 'WorksheetController@list')->name('worksheet.data');
    Route::resource('admin/worksheet', 'WorksheetController');
    Route::get('admin/worksheet', 'WorksheetController@index')->name('admin.worksheet');
    // order
    Route::get('admin/order/export', 'OrderManagementController@export')->name('orderExport');
    Route::get('order-data/{start}/{end}', 'OrderManagementController@list');
    Route::get('admin/order', 'OrderManagementController@index')->name('admin.order');
    Route::get('admin/order/{id}', 'OrderManagementController@detail')->name('admin.order_detail');
    Route::get('admin/order_approve', 'OrderManagementController@approve')->name('approveOrder');
    Route::get('admin/order_cancel', 'OrderManagementController@cancel')->name('cancelOrder');
    Route::get('admin/order/filter/status/{status}', 'OrderManagementController@filter')->name('filterOrder');
    Route::get('admin/order/filter/payment/{payment}', 'OrderManagementController@filterPayment')->name('filterPaymentOrder');
    Route::get('admin/order/filter/date', 'OrderManagementController@filterDate')->name('filterDateOrder');
    Route::post('admin/order/edit/date-time', 'OrderManagementController@editOrder')->name('editOrder');
    Route::patch('admin/order/edit/date-time/update', 'OrderManagementController@update')->name('order.update');
    Route::get('admin/order/edit/date-time/history/{order_id}', 'OrderManagementController@history')->name('order.history');
    // review
    Route::get('review-data/{start}/{end}', 'OrderManagementController@list2');
    Route::get('admin/review', 'OrderManagementController@review')->name('admin.review');
    Route::get('admin/review_detail', 'OrderManagementController@getReview')->name('getReview');
    Route::post('admin/review/save', 'OrderManagementController@approvedReview')->name('approvedReview');
    Route::get('admin/review/filter/status/{status}', 'OrderManagementController@filterReview');
    Route::get('admin/review/filter/rating/{rating}', 'OrderManagementController@filterRatingReview');
    Route::get('admin/review/filter/date', 'OrderManagementController@filterDateReview')->name('filterDateReview');
// csr
Route::get('admin/csr', 'AdviceController@csr')->name('admin.csr');
Route::get('csr-data', 'AdviceController@list2')->name('csr.data');
Route::get('admin/csr/{id}/edit', 'AdviceController@editCSR')->name('editCSR');
// email
Route::get('admin/e/email', 'EmailSetting@index2')->name('admin.email_ecom');
// term & condition
Route::get('terms-data', 'MailController@list2')->name('terms.data');
Route::get('admin/terms-condition', 'MailController@terms')->name('admin.terms');
Route::get('admin/terms-condition/{id}/edit', 'MailController@terms_edit')->name('terms.edit');
// check mail
Route::get('admin/mail-check', 'SendMailController@check')->name('mail.check');