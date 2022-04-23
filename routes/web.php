<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Route::get('/{locale?}', function ($locale = 'pt') {
    if ($locale != 'pt' && $locale != 'pt-BR') {
        $locale = 'pt';
    }

    App::setLocale($locale);

    return view('home');
});
