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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'SiteController@home');
Route::get('nossos-servicos', 'SiteController@services');
Route::get('sobre', 'SiteController@about');
Route::get('contato', 'SiteController@contact');
Route::post('contato', 'SiteController@sendcontact');
Route::post('newsletter', 'SiteController@newsletter');

//Enterprises
Route::get('empreendimentos', 'SiteController@enterprises');
Route::get('empreendimento/{slug}', 'SiteController@enterprise');

Route::get('blue', 'SiteController@blue');
Route::get('chateau', 'SiteController@chateau');
Route::get('easy', 'SiteController@easy');
Route::get('green', 'SiteController@green');
Route::get('lumiere', 'SiteController@lumiere');
Route::get('unique', 'SiteController@unique');

Route::get('busca-de-imoveis', 'SiteController@searchProperties')->name('property.search_properties');
Route::post('busca-imovel-por-codigo', 'SiteController@searchPropertyCode')->name('property.search_per_code');
Route::get('registra-busca-de-imoveis', 'SiteController@setSessionSearch')->name('property.set_filter');
Route::get('imovel/{slug?}', 'SiteController@property');

//Generator sitemap

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
