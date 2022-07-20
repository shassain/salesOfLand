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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        $proyectos=App\Proyecto::with('terrenos.coordenadas','terrenos.categoria','imagenes')->get();
        return view('login',compact("proyectos"));
    });
    Route::get('inicio', function () {
        $proyectos=App\Proyecto::with('terrenos.coordenadas','terrenos.categoria','imagenes')->get();
        return view('inicio',compact("proyectos"));
    })->name('login');
    Route::get("login",function(){
        $proyectos=App\Proyecto::with('terrenos.coordenadas','terrenos.categoria','imagenes')->get();
        return view('login',compact("proyectos")); 
    });
    Route::get("coordenadas","TerrenoController@coordenadasAll")->name("terrenos.coordenadasAll");
});
Route::get('password/reset', 'ForgotPassworController@showLinkRequestForm');
Route::post('password/email', 'ForgotPassworController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'PassworController@showResetForm');
Route::post('password/reset', 'PassworController@reset');
Route::post('login','LoginController@login');
Route::get('logout','LoginController@logout');

Route::resource('home', 'HomeController');












//desde aqui las rutas que se deben de revisar
Route::group(['middleware'=>'auth'],function (){
    Route::get('/map','MapController@index')->name('map.index');
    
        /*
        |--------------------------------------------------------------------------
        |usuarios
        |--------------------------------------------------------------------------
        */
    Route::get('/usuarios', 'UserController@index')
        ->name('users.index');
    
    Route::get('/usuarios/{user}', 'UserController@show')
        ->where('user', '[0-9]+')
        ->name('users.show');
    
    Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');
    
    Route::post('/usuarios', 'UserController@store');
    
    Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');
    
    Route::put('/usuarios/{user}', 'UserController@update');
    
    Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');
    
    Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');
    
    
    Route::get('/cliente',function(){
        return view('clientes.index');
    });
    Route::get('/RegistroClientes',function(){
        return view('clientes.create');
    });
    
    Route::get('/cli', 'ClienteController@index')
        ->name('clientes.index');
    
    Route::get('/cli/nuevo', 'ClienteController@create')->name('clientes.create');
    
    Route::post('/cli/crear','ClienteController@store');

    Route::get('/cli/{cliente}/editar', 'ClienteController@edit')->name('clientes.edit');
    Route::put('/cli/{cliente}', 'ClienteController@update');

    Route::delete('/cli/{clientes}', 'ClienteController@destroy')->name('clientes.destroy');


    Route::get('/practica',function(){
        return view('practica.index');
    });

    Route::resource('roles', 'Core\RoleController');
    Route::get("roles_usuario/{id}",'Core\RoleController@usuarios');
  //  Route::patch('permission/{role}', 'Api\DataController@storePermission')->name('permission.store');



//hasta aqui las rutas que se deben de revisar
    Route::resource('proyecto','ProyectoController');
    Route::get('asing_map/{id}','ProyectoController@asignar')->name("proyecto.asing_map");
    Route::get('asing_img/{id}','ProyectoController@asignarimg')->name("proyecto.asing_img");
    Route::post('asing_img/{id}','ProyectoController@promo')->name("proyecto.saveimgpromo");
    
    Route::any("subirimagenproyecto",'ProyectoController@imagentemporal');
    Route::post('eliminararchivo/{id}','ProyectoController@eliminar');
    Route::post("seleccionimagen","ProyectoController@seleccionimagen");
    Route::post("savemapeste","ProyectoController@savemapeste")->name("savemapeste");
    Route::get("terrenos/{id}","TerrenoController@index")->name("terrenos.index");
    Route::post("terrenos/{id}","TerrenoController@store")->name("terrenos.store");
    Route::put("terrenosupdate/","TerrenoController@update")->name("terrenos.update");
    Route::get("terrenosshow/","TerrenoController@show")->name("terrenos.show");
    Route::get("coordenadas/{id}","TerrenoController@coordenadas")->name("terrenos.coordenadas");
    Route::post("coordenadaspost","TerrenoController@coordenadasAll")->name("terrenos.coordenadasAllpost");

    
    //tipos de terreno
    Route::resource('tiposterreno','TiposterrenoController');
    //pronto pago y multa
    Route::resource('pagosmulta','PagoMultaController');
    //adm terenos
    Route::resource('admterrenos','AdmTerrenosController');
    Route::get('admterrenos/{id}/ventas','AdmTerrenosController@ventas');
    Route::get('admterrenos/{id}/reserva','AdmTerrenosController@reserva');

    //clientes

    Route::resource("cliente","ClienteController");
});




