<?php

use App\Http\Controllers\autor_controller;
use App\Http\Controllers\libros_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('proy', 
    function(){
        return 'Hola Mundo';
    }
);*/
/**Rutas de Libros */
Route::get('libros/lista',
    [libros_controller::class,'lista_libros']  
)->middleware("auth:api");

Route::post('libros/guardar',
    [libros_controller::class,'guardar_libro']  
)->middleware("auth:api");

Route::post('libros/eliminar',
    [libros_controller::class,'eliminar_libro']  
)->middleware("auth:api");

/**Rutas de Autores */

Route::get('autores/lista',
    [autor_controller::class,'lista_autores']  
)->middleware("auth:api");

Route::get('autores/eliminar',
    [autor_controller::class,'eliminar_autor']  
)->middleware("auth:api");

Route::post('autores/guardar',
    [autor_controller::class,'guardar_autor']  
)->middleware("auth:api");


Route::post('login', function (Request $request){

    if(Auth::attempt (['email' => $request->email, 'password' => $request->password])){
    
    $user = Auth::user();
    
    //$success ['token'] = $user->create Token ('MyApp')-> accessToken; //$success['name'] = $user->name;
    
    $arr = array('acceso' => "Ok", 'error' =>"", 'token' => $user->createToken('MyApp')-> accessToken);
    
    return json_encode($arr);
    
    }
    
    else{
    
    $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña", 'token' => "");
    
    return json_encode($arr);
    }
});
