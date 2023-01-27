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


Auth::routes(['verify' => 'true']);
Route::group(['middleware' => 'verified'], function(){
    Route::resource('/entrada', 'EntradaController');
    Route::get('/home', 'HomeController@index')->name('home');
});




Route::get('/probarconexion', function(){
    try{
        DB::connection()->getPdo();
    } catch(\Exception $e){
        die("No se puede Conectar a la base de datos. Revise porfavor su codigo de Error: ".$e);
    }
});
Route::get('/consulta', function(){
    /*Trae todos los campos */
    //$usuarios=DB::table('users')->get();
    /*Traé el primer usuario*/
    //$usuarios=DB::table('users')->first();
    /*Trae todos los registros de una columna */
    //$usuarios=DB::table('users')->select('email')->get();
    /*Trae 2 o mas columnas enviadas en un array */
    $usuarios=DB::table('users')
    ->select(['name','email'])
    ->get();
    dd($usuarios);
});





Route::get('/consultaentradas', function(){
    $entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('user_id','=','6')
    ->get();
    dd($entradas);
});
Route::get('/consultalike', function(){
    $entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('titulo','like','%Kevon%')
    ->orWhere('titulo','like','%Lora%')
    ->get();
    dd($entradas);
});
Route::get('/consulta_debug', function(){
    $entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('titulo','like','%Kevon%')
    ->orWhere('titulo','like','%Lora%')
    ->toSql();
    dd($entradas);
});
Route::get('/inerjoin', function(){
    $entradas=DB::table('entradas')
    ->join('users','entradas.user_id','=','users.id')
    ->get();
    dd($entradas);
});
Route::get('/inerjoin2', function(){
    $entradas=DB::table('entradas')
    ->join('users','entradas.user_id','=','users.id')
    ->select(['users.*','entradas.titulo'])
    ->get();
    dd($entradas);
});

/**INSETANDO REGITROS CON QUERY BULDER */
Route::get('/insertar', function(){
    $insertando=DB::table('users')
    ->insert([
        "name" => "Juan Pérez",
        "email" => "jperezz@gmail.com",
        "password" => "jpez"
    ]);
    dd($insertando);
});

Route::get('/insertar_getid', function(){
    $insertando=DB::table('users')
    ->insertGetId([
        "name" => "Juan Moreno",
        "email" => "jmoreno@gmail.com",
        "password" => "jmorado"
    ]);
    dd($insertando);
});

/**UDATE */
Route::get('/actualizar', function(){
    $insertando=DB::table('users')
    ->where('id','=','4')
    ->update([
        "name" => "Juan Pérez",
        "email" => "jperezz@gmail.com",
        "password" => "jpez"
    ]);
    dd($insertando);
});
/**DELETE */
Route::get('/eliminar', function(){
    $insertando=DB::table('users')
    ->where('id','=','8')
    ->delete();
    dd($insertando);
});




Route::get('/usuario', function(){
    $usuario = "Francisco";
    return "Bienvenido a laravel $usuario";
});
//Ruta para hacer redirect en la rutas
Route::redirect('blog', 'admin/usuario', 301);

//Ruta con parametro obligatorio
Route::get('/usuario1/{nombre}', function($nombre){
    return "Hola Usuario " . $nombre;
});
//Ruta con parametro opcional se agrega el simbolo ?
Route::get('/usuario2/{nombre?}', function($nombre = "Default"){
    return "Hola usuario " . $nombre;
});
//Ruta con varios paraetros opionales
Route::get('/usuario3/{nombre?}/{apellido?}', function($nombre = "", $apellido = ""){
    return "Hola $nombre $apellido";
});
//Se pueden usar expresiones regulares Ver documentacion
//Ruta que solo acepta mayusculas y minusculas
Route::get('/usuario4/{nombre?}/{apellido?}', function($nombre = "", $apellido = ""){
    return "Hola $nombre $apellido";
})->where('nombre', '[A-Za-z]+');
//Ruta que solo mayus y min en ambos parametros
Route::get('/usuario5/{nombre?}/{apellido?}', function($nombre = "", $apellido = ""){
    return "Hola $nombre $apellido";
})->where(['nombre'=>'[A-Za-z]+', 'apellido'=>'[A-Za-z]+']);
//LAS RUTAS PUEDEN SER NOMBREADAS ESTO ES UNA BUENA PRACTICA PARA USAR LAS
//EN LAS VISTAS PARA LOS LINKS
Route::get('user/profile', function(){
    return "hola";
})->name('profile');
//Generando URL o links
//$url = route('profile');
//Gerarndo redirects
//return redirect()->route('profile');

//SE PUEDEN GERAR GRUPOS DE RUSTAAS
Route::group(['prefix' => 'admin'], function(){
    Route::get('/usuario6/{nombre?}/{apellido?}', function($nombre = "", $apellido = ""){
        return "Hola $nombre $apellido";
    })->where(['nombre'=>'[A-Za-z]+', 'apellido'=>'[A-Za-z]+']);    
});

//HELPERS En la documentacion podemos ver todos los helpers en Diggin Deeper helpers
//helper env
Route::get('/host', function(){
    return env('DB_HOST');
});
//helper config
Route::get('/zone', function(){
    return config('app.timezone');
});

//Forma 2
Route::get('/producto', function(){
    return view('producto', ["nombre" => "impresora LX300", "marca" => "Epson"]);
});

Route::get('/prueba', function(){
    return view('prueba');
});
