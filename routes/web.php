<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route; 
use App\Helpers\Cipher;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { 
    // $cipherText= new Cipher();
    // $procedure=$cipherText->decrypt('/BsTdVYjxRLaJ4qFJtodbA==');
    // $prueba=$cipherText->encrypt('franco');
    // return '<h1>'.$procedure.'</h1>';
    // dd($procedure);
    return view('index');
});
