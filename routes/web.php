<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});

Route::get('/testConnection',function(){
    try {
        $results = DB::select('SELECT 1');
        echo "Connexion à la base de données réussie !";
    } catch (\Exception $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
});