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

use Illuminate\Mail\Markdown;

Route::get('mail', function () {

    $markdown = new Markdown(view(), config('mail.markdown'));
    return $markdown->render('email.contact', ['content' => [
        'name' => 'Jefferson Pereira',
        'phone' => '35 9999 9999',
        'email' => 'jefferson@gmail.com',
        'message' => 'jdflskjf djskfljsdo jfklsdjaklfj kldsaj fdkls jkldfs jklsdj k',
    ]]);
});

Route::get('/', 'SiteController@prelaunch');
//Site
Route::get('site', 'SiteController@home');
Route::get('nossos-servicos', 'SiteController@services');
Route::get('sobre', 'SiteController@about');
Route::get('contato', 'SiteController@contact');
Route::post('contato', 'SiteController@sendcontact');
Route::post('newsletter', 'SiteController@newsletter');

//Immobiles
Route::get('busca-de-imoveis', 'SiteController@searchimmobiles');
Route::get('registra-busca-de-imoveis', 'SiteController@setsessionsearch');
Route::get('imovel/{slug}', 'SiteController@immobile');