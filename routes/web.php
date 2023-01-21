<?php

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
//Una ruta se compone de la URL y de una funcion anonima la cual
//puede recibir parametros


Route::get('/', function () {
    return view('welcome');
});
Route::get('/usuario', function(){
    $usuario = "Francisco";
    return "Bienvenido a laravel $usuario";
});
//Ruta para hacer redirect en la rutas
Route::redirect('blog', 'admin/usuario', 301);

//Ruta con parametro obligatorio
Route::get('/usuario1/{$nombre}', function($nombre){
    return "Hola Usuario " . $nombre;
});
//Ruta con parametro opcional se agrega el simbolo ?
Route::get('/usuario2/{$nombre?}', function($nombre){
    return "Hola usuario " . $nombre;
});
//cambi