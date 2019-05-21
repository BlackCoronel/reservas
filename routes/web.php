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

Route::get('/','indexController@index'); // Devuelve el index de la página web
Route::get('/logout','Auth\loginController@logout'); // Ruta para cerrar sesión
Route::get('/contacta','indexController@contacta'); // Ruta formulario de contacto
Route::get('/reservas','indexController@reservas'); // Ruta para la vista de de las reservas
Route::get('/cargarModelos/{id}','indexController@cargarModelos'); // Se encarga de cargar los modelos  mediante AJAX
Route::get('/cargarCarrocerias/{id}','indexController@cargarCarrocerias'); // Se encarga de cargar las carrocerias mediante AJAX
Route::get('/cargarHoras/{dia}','indexController@cargarHoras'); // Se encarga de cargar las horas disponibles mediante AJAX
Route::post('/reservar','reservasController@reserva'); // Ruta para hacer las reservas
Route::get('/estado','reservasController@consultar'); // Ruta que muestra la vista para consultar las reservas
Route::get('/estado/{referencia}','reservasController@consulta'); // Ruta para cargar por AJAX los estados de las reservas
Route::get('/asignarPlazos/{token}','reservasController@vistaPlazos'); // Devuelve la vista en caso de que haya plazos para escoger
Route::get('/asignarPlazos/{token}/{dia}/{hora}','reservasController@asignarPlazos'); // Registra la fecha elegida por el cliente
Route::post('/diferentePlazo/{token}','reservasController@diferentePlazo'); // Registra un plazo diferente al que nosotros le ofertamos
Route::get('/newPassword/{token}','adminController@vistaClave'); // Se encarga de mostrar la vista para confirmar la clave
Route::post('/newPassword/{token}','adminController@crearClave'); // Se encarga de mostrar la vista para confirmar la clave

Auth::routes();
Route::group(["middleware" => "auth"], function(){
    Route::get('/panel','adminController@index');
    Route::get('/cargarReserva/{id}','adminController@cargarReserva'); // Carga las reservas por JSON para luego poder editarlas por AJAX
    Route::get('/eliminarReserva/{id}','adminController@eliminarReserva'); // Elimina una reserva
    Route::group(['middleware' => "role"], function(){
        Route::get('/admin','adminController@index'); // Devuelve la vista del panel de administracion
        Route::post('/actualizarReserva/{id}','adminController@actualizarReserva'); // Se encarga de actualizar el estado de la reserva
        Route::post('/editarReserva/{id}','adminController@editarReserva'); // Se encarga de editar la reserva
        Route::post('/crearFechas/{id}','adminController@crearFechas'); // Se encarga de asignar fechas alternativas para el montaje
        Route::get('/register','adminController@vistaRegistro'); //Muestra la vista para registrar empresas
        Route::post('/registroEmpresa','adminController@registroEmpresa'); //Muestra la vista para registrar empresas
    });
});

