<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/getdipass', function () {
    // Return authenticated user model object serialized to json
    return auth()->user();
})->middleware('apidipass');


Route::post('/getspionam',function(){
	return auth()->user();
})->middleware('apispionam');

// token auth
Route::post('/apitoken','ApiControllerTos@apitoken');
Route::post('/logintoken','ApiControllerTos@logintoken');
Route::get('/updateuser/{id}','ControllerBackend@ShowUpdate');
Route::get('/updatewilayah/{id}','ControllerBackend@ShowUpdateWilayah');
Route::get('/updatedatarole/{id}','ControllerBackend@ShowUpdateDataRole');
Route::get('/updatedataterminal/{id}','ControllerBackend@ShowUpdateDataTerminal');
Route::get('/updatedatapo/{id}','ControllerBackend@ShowUpdateDataPO');
Route::get('/updatetrayek/{id}','ControllerBackend@SHowUpdateTrayek');
Route::get('/updatedatakendaraan/{id}','ControllerBackend@ShowUpdateDataKendaraan');
Route::post('/simpanfasilitas','ApiControllerTos@ShowSimpanFasilitas');
Route::get('/updatefasilitas/{id}','ControllerBackend@ShowUPdateFasilitas');

//api 
Route::post('/apigate','ApiControllerTos@ShowApiSpionam');
Route::post('/apiresponsegate','ApiControllerTos@ShowApiResponseGate');
Route::post('/apiresponsegateout','ApiControllerTos@ShowApiResponseGateOut');

Route::get('/getkendaraan/{id}','ControllerBackend@ShowGetKendaraan');
Route::get('/updatedatakendaraantiba/{id}/{id_user}','ControllerBackend@ShowUpdateDataKendaraanTiba');
Route::get('/updatedatakendaraankeluar/{id}/{id_user}','ControllerBackend@ShowUpdateDataKendaraanKeluar');

Route::get('/getdatapokendaraan/{kode_po}','ApiControllerTos@ShowGetDataPOKendaraan');
Route::post('/getdataupdatetikekendaraantiba','ApiControllerTos@getdataupdatetikekendaraantiba');
Route::get('/getdatapokendaraanmanual','ApiControllerTos@ShowGetDataPOKendaraanManual');

Route::get('/datapo','ApiControllerTos@ShowDataPO');
Route::get('/datakota','ApiControllerTos@ShowDataKota');
Route::get('/dataterminal/{idkota}','ApiControllerTos@ShowDataTerminal');

Route::get('/datakendaraan/{nomorkendaraan?}','ApiControllerTos@gShowDataKendaraan');
Route::get('/input_checker/{nokend}','ApiControllerTos@gShowInputChecker');

// api dipass
Route::post('/getdipass2','ApiControllerTos@ShowGetDipass');
Route::post('/getspionamkendaraan','ApiControllerTos@ShowGetSpionamKendaraan');
Route::post('/getspionamperusahaan','ApiControllerTos@ShowGetSpionamPerusahaan');
Route::post('/geteblue','ApiControllerTos@ShowGeBlue');

// api swinggate
Route::post('/swinggate','ApiControllerTos@swinggate');
Route::get('/gettiketuser','ApiControllerTos@gettiketuser');

// api grafik 
Route::get('/grafik/{tahun?}/{tahunend?}','ApiControllerTos@grafik');

Route::get('/typefids','ApiControllerTos@typefids');



