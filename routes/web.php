<?php
include_once 'web_builder.php';
view()->share(['title' => null]);

Route::get('/', function () {
    // $payload  = array(
    //     "iss" => "http://example.org",
    //     "aud" => "http://example.com",
    //     "iat" => 1356999524,
    //     "nbf" => 1357000000
    // );

    // $jwt = jwtencode($payload); 
    // $decoded = jwtdecode($jwt, array('HS256'));

    // dd($jwt);

    return view('welcome');
});

Route::get('login', 'AuthController@login')->name('getlogin');
Route::post('login', 'AuthController@postLogin');


Route::group(['prefix' => 'ajax', 'namespace' => 'Api'], function () {
    Route::get('city', 'AjaxController@city');
    Route::get('district/{city_id}', 'AjaxController@district');
});


Route::group([
    'prefix' => 'admin',
    'middleware' => ['BeforeAfter'],
    'as' => 'admin.',
    'namespace' => 'BE'
],
    function () {

        Route::get('', 'DashboardController@index')->name('home');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('logout', 'AuthController@getLogout')->name('logout');

        Route::resource('profile', 'ProfileController');

        Route::resource('admin', 'AdminController');
        Route::post('admin/grid', 'AdminController@grid');

        Route::resource('role', 'RoleController');
        Route::post('role/grid', 'RoleController@grid');

        Route::resource('manufacturer', 'ManufacturerController');
        Route::post('manufacturer/grid', 'ManufacturerController@grid');

        Route::resource('banner', 'BannerController');
        Route::post('banner/grid', 'BannerController@grid');

        Route::resource('sale_viethan', 'SaleViethanController');
        Route::post('sale_viethan/grid', 'SaleViethanController@grid');

        Route::resource('voucher', 'VoucherController');
        Route::post('voucher/grid', 'VoucherController@grid');

        Route::resource('code_voucher', 'CodeVoucherController');
        Route::post('code_voucher/grid', 'CodeVoucherController@grid');

        Route::resource('banner', 'BannerController');
        Route::post('banner/grid', 'BannerController@grid');

        Route::resource('banner', 'BannerController');
        Route::post('banner/grid', 'BannerController@grid');

        Route::resource('member', 'MemberController');
        Route::post('member/grid', 'MemberController@grid');

        Route::resource('area', 'AreaController');
        Route::post('area/grid', 'AreaController@grid');

        Route::resource('category', 'CategoryController');
        Route::post('category/grid', 'CategoryController@grid');

        Route::resource('color', 'ColorController');
        Route::post('color/grid', 'ColorController@grid');

        Route::resource('size', 'SizeController');
        Route::post('size/grid', 'SizeController@grid');

        Route::resource('product', 'ProductController');
        Route::post('product/grid', 'ProductController@grid');
        Route::post('product/upload', 'ProductController@upload')->name('product.upload');
        Route::post('product/upload-from-url', 'ProductController@uploadFromUrl');

        Route::resource('productdelete', 'ProductDeleteController');
        Route::post('productdelete/grid', 'ProductDeleteController@grid');

        Route::resource('image', 'ImageController');
        Route::post('image/grid', 'ImageController@grid');

        Route::get('setting/edit', 'SettingsController@index')->name('setting.index');
        Route::post('setting/edit', 'SettingsController@update')->name('setting.update');

    });

