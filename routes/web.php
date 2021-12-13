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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/404','ControllerBackend@ShowError');
Route::get('/admin','ControllerBackend@ShowLogin');
Route::get('/','ControllerBackend@ShowWebTos');
Route::get('/profil','ControllerBackend@ShowProfil');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','ControllerBackend@ShowIndex');
Route::get('/user','ControllerBackend@ShowUser');
Route::post('/registeruser','ControllerBackend@ShowRegisterUser');
Route::post('/updateregisteruser','ControllerBackend@ShowUpdateRegisterUser');
Route::post('/deleteuser','ControllerBackend@ShowDeleteUser');
Route::get('/getbptdterminal/{id}','ControllerBackend@getbptdterminal');

Route::get('/menuakses','ControllerBackendTwo@menuakses');
Route::post('/insertmenu','ControllerBackendTwo@insertmenu');
Route::get('/updatedatamenu/{id}','ControllerBackendTwo@updatedatamenu');
Route::post('/updatemenu','ControllerBackendTwo@updatemenu');

// import
Route::get('/importkendaraan','ControllerBackendTwo@importkendaraan');
Route::post('/simpanimportkendaraantiba','ControllerBackendTwo@simpanimportkendaraantiba');
Route::get('/importkendaraankeluar','ControllerBackendTwo@importkendaraankeluar');
Route::post('/simpanimportkendaraankeluar','ControllerBackendTwo@simpanimportkendaraankeluar');

Route::post('/filter','ControllerBackend@filter');
Route::post('/filter2','ControllerBackend@filter2');

Route::get('/wilayah','ControllerBackend@ShowWilayah');
Route::post('/simpanwilayah','ControllerBackend@ShowSimpanWilayah');
Route::post('/updatepostwilayah','ControllerBackend@ShowUpdatePostWilayah');
Route::post('/deletewilayah','ControllerBackend@ShowDeleteWilayah');

Route::get('/role','ControllerBackend@ShowRole');
Route::post('/simpanrole','ControllerBackend@ShowSimpanRole');
Route::post('/deleterole','ControllerBackend@ShowDeleteRole');
Route::get('/edit_role/{idrole?}/{ids?}','ControllerBackend@edit_role');
Route::post('/updatepostrole','ControllerBackend@ShowUpdatePostRole');




Route::get('/terminal','ControllerBackend@ShowTerminal');
Route::post('/simpanterminal','ControllerBackend@ShowSimpanTerminal');
Route::post('/updatepostterminal','ControllerBackend@ShowUpdatePostTerminal');
Route::post('/deleteterminal','ControllerBackend@ShowDeleterTerminal');
Route::get('/editterminal/{id}','ControllerBackend@ShowEditTerminal');
Route::post('/simpansdmterminal','ControllerBackend@ShowSimpanSDMTerminal');
Route::post('/updatepostsdmterminal','ControllerBackend@ShowUPdatePostSDMTerminal');
Route::post('/simpanpoterminal','ControllerBackend@ShowSimpanPOTerminal');
Route::post('/updatedatapobusterminal','ControllerBackend@ShowUpdateDataPOBusTerminal');
Route::post('/simpantrayekterminal','ControllerBackend@ShowSimpanTrayekTerminal');

Route::get('/sdm','ControllerBackend@ShowSDM');
Route::post('/simpansdm','ControllerBackend@ShowSimpanSDM');
Route::get('/updatesdm/{id}','ControllerBackend@ShowUpdateSDM');
Route::post('/updatepostsdm','ControllerBackend@ShowUPdatePostSDM');
Route::post('/deletesdm','ControllerBackend@ShowDeleteSDM');
Route::post('/simpankendaraanpo','ControllerBackend@ShowSimpanKendaraanPO');
Route::post('/updatekendaraanpo','ControllerBackend@ShowUpdateKendaraanPO');

Route::get('/po','ControllerBackend@ShowPO');
Route::post('/simpanpo','ControllerBackend@ShowSimpanPO');
Route::post('/updatedatapobus','ControllerBackend@ShowUpdateDataPOBus');
Route::post('/deletepo','ControllerBackend@ShowDeletePO');
Route::get('/editpo/{id}','ControllerBackend@ShowEditPO');
Route::post('/deletepokendaraan','ControllerBackend@ShowDeletePOKendaraan');

Route::get('/trayek','ControllerBackend@ShowTrayek');
Route::post('/simpantrayek','ControllerBackend@ShowSimpanTrayek');
Route::post('/updatedatatrayekterminal','ControllerBackend@ShowUpdateDataTrayekTerminal');
Route::post('/updatetrayek','ControllerBackend@ShowUpdateDataTrayek');
Route::post('/deletetrayek','ControllerBackend@ShowDeleteTrayek');
Route::get('/edittrayek/{id}','ControllerBackend@ShowEditTrayek');
Route::post('/simpanterminaltrayek','ControllerBackend@ShowSimpanTerminalTrayek');
Route::post('/deletetrayekterminal','ControllerBackend@ShowDeleteTrayekTerminal');
Route::post('/simpantrayekangkutan','ControllerBackend@ShowSimpanTrayekAngkutan');

Route::get('/kendaraan','ControllerBackend@ShowKendaraan');
Route::post('/simpankendaraan','ControllerBackend@ShowSimpanKendaraan');
Route::post('/deletekendaraan','ControllerBackend@ShowDeleteKendaraan');
Route::post('/updatekendaraan','ControllerBackend@ShowUpdateKendaraan');


Route::post('/simpanfasilitas','ControllerBackend@ShowSimpanFasilitas');
Route::post('/updatedatapostfasilitas','ControllerBackend@updatedatapostfasilitas');
Route::post('/deletedetailterminal','ControllerBackend@ShowDeleteDetailterminal');

Route::post('/simpanasset','ControllerBackend@ShowSimpanAsset');

Route::get('/datakendaraantiba','ControllerBackend@ShowDataKendaraanTiba');
Route::get('/datakendaraankeluar','ControllerBackend@ShowDataKendaraanKeluar');

Route::get('/datapenumpangtiba','ControllerBackend@ShowDataPenumpangTiba');
Route::get('/datapenumpangkeluar','ControllerBackend@ShowDataPenumpangKeluar');
Route::get('/datapenumpangberangkat','ControllerBackend@ShowDataPenumpangBerangkat');

Route::post('/simpankendaraantiba','ControllerBackend@ShowSimpanKendaraanTiba');
Route::post('/updatekendaraantiba','ControllerBackend@ShowUpdateKendaraanTiba');
Route::post('/updatekendaraannaik','ControllerBackend@ShowUpdateKendaraanNaik');
Route::post('/updatekendaraanturun','ControllerBackend@ShowUpdateKendaraanTurun');
Route::post('/deletekendaraantiba','ControllerBackend@ShowDeleteKendaraanTiba');

//Route::post('/simpankendaraankeluar','ControllerBackend@ShowSimpanKendaraanKeluar');
Route::post('/updatekendaraankeluar','ControllerBackend@ShowUpdateKendaraanKeluar');
Route::post('/deletekendaraankeluar','ControllerBackend@ShowDeleteKendaraanKeluar');


Route::post('/simpankendaraankeluar','ControllerBackend@ShowSimpanKendaraanKeluar');

Route::get('/penumpangtiba','ControllerBackend@ShowPenumpangTiba');
Route::get('/penumpangturun','ControllerBackend@ShowPenumpangTurun');
Route::get('/penumpangnaik','ControllerBackend@ShowPenumpangNaik');
Route::get('/penumpangberangkat','ControllerBackend@ShowPenumpangBerangkat');

Route::get('/spionamkendaraan','ControllerBackend@ShowSpionamKendaraan');
Route::get('/spionamperusahaan','ControllerBackend@ShowSpionamPerusahaan');
Route::get('/eblue','ControllerBackend@ShowEblue');
Route::get('/dipass','ControllerBackend@ShowDipass');

Route::get('/report_terminal_kendaraan','ControllerBackend@ShowReportTerminalKendaraan');
Route::get('/report_terminal_penumpang/{export?}','ControllerBackend@ShowReportTerminalPenumpang');
Route::post('/filterreport','ControllerBackend@filterreport');

Route::get('/inputdatapenumpang','ControllerBackend@ShowInputDataPenumpang');
Route::post('/updatechecker','ControllerBackend@ShowUpdateChecker');

Route::post('/inputrampcheck','ControllerBackend@ShowInputRampCheck');
Route::get('/rampcheck','ControllerBackend@ShowRampCheck');
Route::get('/updateramcheck/{id}','ControllerBackend@updateramcheck');
Route::post('/updateinputrampcheck','ControllerBackend@updateinputrampcheck');

Route::post('/deleterampcheck','ControllerBackend@ShowDeleteRampCheck');
Route::get('/building_management','ControllerBackend@ShowBuildingManagement');
Route::get('/updatebuildingmanagement/{id}','ControllerBackend@updatebuildingmanagement');
Route::post('/updatedataaset','ControllerBackend@updatedataaset');
Route::post('/simpandataaset','ControllerBackend@ShowSimpanDataAset');
Route::post('/hapusaset','ControllerBackend@ShowhapusAset');

// tambahan rancang bangun
// rancang terminal
Route::get('/rancangterminal', 'ControllerBackend@ShowRancangTerminal');
Route::post('/simpanrancangterminal', 'ControllerBackend@ShowSimpanRancangTerminal');
Route::get('/updaterancangterminal/{id}','ControllerBackend@ShowUpdateRancangTerminal');
Route::post('/updatepostrancangterminal', 'ControllerBackend@ShowUpdatePostRancangTerminal');
Route::post('/deleterancangterminal', 'ControllerBackend@ShowDeleteRancangTerminal');
Route::get('/editrancangterminal/{id}', 'ControllerBackend@ShowEditRancangTerminal');

// pengajuan terminal
Route::get('/pengajuanterminal', 'ControllerBackend@ShowPengajuanTerminal');
Route::post('/simpanpengajuanterminal', 'ControllerBackend@ShowSimpanPengajuanTerminal');
Route::get('/updatepengajuanterminal/{id}','ControllerBackend@ShowUpdatePengajuanTerminal');
Route::post('/updatepostpengajuanterminal', 'ControllerBackend@ShowUpdatePostPengajuanTerminal');
Route::post('/deletepengajuanterminal', 'ControllerBackend@ShowDeletePengajuanTerminal');
Route::get('/editpengajuanterminal/{id}', 'ControllerBackend@ShowEditPengajuanTerminal');

// proses pembangunan
Route::get('/prosespembangunan', 'ControllerBackend@ShowProsesPembangunan');
Route::post('/simpanprosespembangunan', 'ControllerBackend@ShowSimpanProsesPembangunan');
Route::get('/updateprosespembangunan/{id}','ControllerBackend@ShowUpdateProsesPembangunan');
Route::post('/updatepostprosespembangunan', 'ControllerBackend@ShowUpdatePostProsesPembangunan');
Route::post('/deleteprosespembangunan', 'ControllerBackend@ShowDeleteProsesPembangunan');
Route::get('/editprosespembangunan/{id}', 'ControllerBackend@ShowEditProsesPembangunan');
// akhir tambah rancang bangun
// 
Route::get('/profilterminal/{id}', 'ControllerBackend@ShowProfilTerminal');
Route::get('/profilterminalprint/{id}/{type?}', 'ControllerBackend@ShowProfilTerminalPrint');
Route::post('/simpanprofilterminal', 'ControllerBackend@ShowSimpanProfilTerminal');

Route::post('/deleteprofilterminal','ControllerBackend@ShowDeleteProfilTerminal');

Route::post('/simpanfasilitasutama','ControllerBackend@ShowSimpanFasilitasUtama');
Route::post('/simpanfasilitaspenunjang','ControllerBackend@ShowSimpanFasilitasPenunjang');

Route::post('/deletefasilitasutama','ControllerBackend@deletefasilitasutama');
Route::post('/deletefasilitaspenunjang','ControllerBackend@deletefasilitaspenunjang');

Route::get('/kompetensi_sdm/{id}','ControllerBackend@kompetensi_sdm');

Route::post('/simpankompetensisdm','ControllerBackend@simpankompetensisdm');
Route::post('/deletekompetensisdm','ControllerBackend@deletekompetensisdm');

Route::get('/fotokendaraan/{noken}/{jam}/{hal}','ControllerBackend@fotokendaraantiba');

Route::get('/refreshkendaraan','ControllerBackend@refreshkendaraan');
Route::get('/refreshpo','ControllerBackend@refreshpo');
Route::get('/refreshtrayek','ControllerBackend@refreshtrayek');

Route::post('/simpansertifikat','ControllerBackend@simpansertifikat');
Route::post('/deletesertifikat','ControllerBackend@deletesertifikat');























































