<?php

use App\Http\Controllers\DashboardWebController;
use App\Http\Controllers\EventWebController;
use App\Http\Controllers\FinancialWebController;
use App\Http\Controllers\MemberWebController;
use App\Http\Controllers\Misc\MiscWebController;
use App\Http\Controllers\TagWebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});


Route::get('/', 'App\Http\Controllers\GymoveadminController@dashboard_1');
Route::get('/index', 'App\Http\Controllers\GymoveadminController@dashboard_1');
Route::post('/featured-menu-list', 'App\Http\Controllers\GymoveadminController@featured_menu_list');
Route::get('/workout-statistic', 'App\Http\Controllers\GymoveadminController@workout_statistic');
Route::get('/workoutplan', 'App\Http\Controllers\GymoveadminController@workoutplan');
Route::get('/distance-map', 'App\Http\Controllers\GymoveadminController@distance_map');
Route::post('/recent-activities', 'App\Http\Controllers\GymoveadminController@recent_activities');
Route::get('/food-menu', 'App\Http\Controllers\GymoveadminController@food_menu');
Route::post('/food-menu-list', 'App\Http\Controllers\GymoveadminController@food_menu_list');
Route::post('/trending-ingridients', 'App\Http\Controllers\GymoveadminController@trending_ingridients');
Route::get('/personal-record', 'App\Http\Controllers\GymoveadminController@personal_record');
Route::get('/app-calender', 'App\Http\Controllers\GymoveadminController@app_calender');
Route::get('/app-profile', 'App\Http\Controllers\GymoveadminController@app_profile');
Route::get('/post-details', 'App\Http\Controllers\GymoveadminController@post_details');
Route::get('/chart-chartist', 'App\Http\Controllers\GymoveadminController@chart_chartist');
Route::get('/chart-chartjs', 'App\Http\Controllers\GymoveadminController@chart_chartjs');
Route::get('/chart-flot', 'App\Http\Controllers\GymoveadminController@chart_flot');
Route::get('/chart-morris', 'App\Http\Controllers\GymoveadminController@chart_morris');
Route::get('/chart-peity', 'App\Http\Controllers\GymoveadminController@chart_peity');
Route::get('/chart-sparkline', 'App\Http\Controllers\GymoveadminController@chart_sparkline');
Route::get('/ecom-checkout', 'App\Http\Controllers\GymoveadminController@ecom_checkout');
Route::get('/ecom-customers', 'App\Http\Controllers\GymoveadminController@ecom_customers');
Route::get('/ecom-invoice', 'App\Http\Controllers\GymoveadminController@ecom_invoice');
Route::get('/ecom-product-detail', 'App\Http\Controllers\GymoveadminController@ecom_product_detail');
Route::get('/ecom-product-grid', 'App\Http\Controllers\GymoveadminController@ecom_product_grid');
Route::get('/ecom-product-list', 'App\Http\Controllers\GymoveadminController@ecom_product_list');
Route::get('/ecom-product-order', 'App\Http\Controllers\GymoveadminController@ecom_product_order');
Route::get('/email-compose', 'App\Http\Controllers\GymoveadminController@email_compose');
Route::get('/email-inbox', 'App\Http\Controllers\GymoveadminController@email_inbox');
Route::get('/email-read', 'App\Http\Controllers\GymoveadminController@email_read');
Route::get('/form-editor-summernote', 'App\Http\Controllers\GymoveadminController@form_editor_summernote');
Route::get('/form-element', 'App\Http\Controllers\GymoveadminController@form_element');
Route::get('/form-pickers', 'App\Http\Controllers\GymoveadminController@form_pickers');
Route::get('/form-validation-jquery', 'App\Http\Controllers\GymoveadminController@form_validation_jquery');
Route::get('/form-wizard', 'App\Http\Controllers\GymoveadminController@form_wizard');
Route::get('/map-jqvmap', 'App\Http\Controllers\GymoveadminController@map_jqvmap');
Route::get('/page-error-400', 'App\Http\Controllers\GymoveadminController@page_error_400');
Route::get('/page-error-403', 'App\Http\Controllers\GymoveadminController@page_error_403');
Route::get('/page-error-404', 'App\Http\Controllers\GymoveadminController@page_error_404');
Route::get('/page-error-500', 'App\Http\Controllers\GymoveadminController@page_error_500');
Route::get('/page-error-503', 'App\Http\Controllers\GymoveadminController@page_error_503');
Route::get('/page-forgot-password', 'App\Http\Controllers\GymoveadminController@page_forgot_password');
Route::get('/page-lock-screen', 'App\Http\Controllers\GymoveadminController@page_lock_screen');
Route::get('/page-login', 'App\Http\Controllers\GymoveadminController@page_login');
Route::get('/page-register', 'App\Http\Controllers\GymoveadminController@page_register');
Route::get('/table-bootstrap-basic', 'App\Http\Controllers\GymoveadminController@table_bootstrap_basic');
Route::get('/table-datatable-basic', 'App\Http\Controllers\GymoveadminController@table_datatable_basic');
Route::get('/uc-lightgallery', 'App\Http\Controllers\GymoveadminController@uc_lightgallery');
Route::get('/uc-nestable', 'App\Http\Controllers\GymoveadminController@uc_nestable');
Route::get('/uc-noui-slider', 'App\Http\Controllers\GymoveadminController@uc_noui_slider');
Route::get('/uc-select2', 'App\Http\Controllers\GymoveadminController@uc_select2');
Route::get('/uc-sweetalert', 'App\Http\Controllers\GymoveadminController@uc_sweetalert');
Route::get('/uc-toastr', 'App\Http\Controllers\GymoveadminController@uc_toastr');
Route::get('/ui-accordion', 'App\Http\Controllers\GymoveadminController@ui_accordion');
Route::get('/ui-alert', 'App\Http\Controllers\GymoveadminController@ui_alert');
Route::get('/ui-badge', 'App\Http\Controllers\GymoveadminController@ui_badge');
Route::get('/ui-button', 'App\Http\Controllers\GymoveadminController@ui_button');
Route::get('/ui-button-group', 'App\Http\Controllers\GymoveadminController@ui_button_group');
Route::get('/ui-card', 'App\Http\Controllers\GymoveadminController@ui_card');
Route::get('/ui-carousel', 'App\Http\Controllers\GymoveadminController@ui_carousel');
Route::get('/ui-dropdown', 'App\Http\Controllers\GymoveadminController@ui_dropdown');
Route::get('/ui-grid', 'App\Http\Controllers\GymoveadminController@ui_grid');
Route::get('/ui-list-group', 'App\Http\Controllers\GymoveadminController@ui_list_group');
Route::get('/ui-media-object', 'App\Http\Controllers\GymoveadminController@ui_media_object');
Route::get('/ui-modal', 'App\Http\Controllers\GymoveadminController@ui_modal');
Route::get('/ui-pagination', 'App\Http\Controllers\GymoveadminController@ui_pagination');
Route::get('/ui-popover', 'App\Http\Controllers\GymoveadminController@ui_popover');
Route::get('/ui-progressbar', 'App\Http\Controllers\GymoveadminController@ui_progressbar');
Route::get('/ui-tab', 'App\Http\Controllers\GymoveadminController@ui_tab');
Route::get('/ui-typography', 'App\Http\Controllers\GymoveadminController@ui_typography');
Route::get('/widget-basic', 'App\Http\Controllers\GymoveadminController@widget_basic');


Route::group([
    'prefix' => 'admin/auth'
], function(){
    Auth::routes();
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['role:admin'],
    'as' => 'admin.'
], function () {
    //Dashboard
    Route::get('dashboard', [DashboardWebController::class, 'index'])->name('dashboard.index');

    //Event
    Route::group([
        'prefix' => 'event',
        'as' => 'event.'
    ], function (){
        Route::get('/', [EventWebController::class, 'index'])->name('index');
        Route::post('/', [EventWebController::class, 'store'])->name('store');
        Route::get('/create', [EventWebController::class, 'create'])->name('create');
        Route::put('/{event}/update', [EventWebController::class, 'update'])->name('update');
        Route::get('/{event}/edit', [EventWebController::class, 'edit'])->name('edit');
        Route::post('/{event}/delete', [EventWebController::class, 'destroy'])->name('destroy');
    });

    //Member
    Route::group([
        'prefix' => 'member',
        'as' => 'member.'
    ], function(){
        Route::get('/', [MemberWebController::class, 'index'])->name('index');
        Route::post('/', [MemberWebController::class, 'store'])->name('store');
        Route::put('/{member}/update', [MemberWebController::class, 'update'])->name('update');
        Route::post('/{member}/delete', [MemberWebController::class, 'destroy'])->name('destroy');
    });

    //Tag
    Route::group([
        'prefix' => 'tag',
        'as' => 'tag.'
    ], function(){
        Route::get('/', [TagWebController::class, 'index'])->name('index');
        Route::post('/', [TagWebController::class, 'store'])->name('store');
        Route::put('/{tag}/update', [TagWebController::class, 'update'])->name('update');
        Route::post('/{tag}/delete', [TagWebController::class, 'destroy'])->name('destroy');
    });

    //Finance
    Route::group([
        'prefix' => 'finance',
        'as' => 'finance.'
    ], function(){
        Route::get('/', [FinancialWebController::class, 'index'])->name('index');
        Route::post('/', [FinancialWebController::class, 'store'])->name('store');
        Route::put('/{finance}/update', [FinancialWebController::class, 'update'])->name('update');
        Route::post('/{finance}/delete', [FinancialWebController::class, 'destroy'])->name('destroy');
    });


});

Route::group([
    'prefix' => 'misc',
    'as' => 'misc.'
], function () {
    Route::get('/{tag_id}/member', [MiscWebController::class, 'getMemberByTag'])->name('member-by-tag');
    Route::get('/{finance_id}/image', [MiscWebController::class, 'getImage'])->name('image');
});
