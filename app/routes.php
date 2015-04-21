<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['uses' => 'LayoutController@masterView']);

Route::get('appView', ['uses' => 'LayoutController@appView']);
Route::get('headerView', ['uses' => 'LayoutController@headerView']);
Route::get('asideView', ['uses' => 'LayoutController@asideView']);
Route::get('navView', ['uses' => 'LayoutController@navView']);
Route::get('headerDataView', ['uses' => 'LayoutController@headerDataView']);


//---------------Authentication
Route::get('login', ['uses' => 'LoginController@index']);
Route::post('checklogin', ['uses' => 'LoginController@checklogin']);
Route::get('dashboard', ['uses' => 'LoginController@dashboard']);
Route::post('checkAuthentication', ['uses' => 'LoginController@checkAuthentication']);
Route::post('logout', ['uses' => 'LoginController@logout']);
//---------------Authentication ends


Route::controller('general_modules', 'GeneralModulesController');
Route::controller('modules', 'ModulesController');

Route::group(['before' => 'permission'], function () {
//---------------Marketing-----------------
    Route::controller('marketing_countries', 'MarketingCountriesController');
    Route::controller('marketing_states', 'MarketingStatesController');
    Route::controller('marketing_categories', 'MarketingCategoriesController');
    Route::controller('timezones', 'TimezonesController');
    Route::controller('leads_statuses', 'LeadsStatusesController');
    Route::controller('sheets', 'SheetsController');
    Route::controller('marketing_datas', 'MarketingDatasController');
    Route::controller('roles', 'RolesController');
    Route::controller('permissions', 'PermissionsController');
//---------------Marketing ends--------------------
});