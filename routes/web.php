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
Route::get('/teste', 'SiteController@teste');
//Site
//Route::get('site', 'SiteController@home');
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

//Immobiles
Route::get('busca-de-imoveis', 'SiteController@searchProperties');
Route::post('busca-imovel-por-codigo', 'SiteController@searchPropertyCode');
Route::get('registra-busca-de-imoveis', 'SiteController@setSessionSearch');
Route::get('imovel/{slug?}', 'SiteController@property');

//Generator sitemap

Route::get('busca-de-imoveis-aluguel', 'SiteController@searchPropertiesRent');
Route::get('busca-de-imoveis-venda', 'SiteController@searchPropertiesSale');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
