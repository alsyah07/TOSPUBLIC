<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\models\wilayah;
use App\models\role;
use App\models\permission;
use App\models\bptb;
use App\models\terminal;
use App\models\kota;
use App\models\sdm;
use App\models\trayek;
use App\models\perusahaan_otobus;
use App\Helpers\helpersmaster;
use App\Helpers\helperAPI;
use App\models\kendaraan;
use App\models\fasilitas;
use App\models\data_asset;
use App\models\master_terminal_trayek;
use App\models\master_terminal_angkutan_trayek;
use App\models\kendaraan_tiba;
use App\models\kendaraan_keluar;
use App\models\spionam_kendaraan;
use App\models\spionam_perusahaan;
use App\models\dipass;
use App\models\eblue;
use App\models\rampcheck;
use App\models\building_management;
use App\models\profil_terminal;
use App\models\fasilitas_utama;
use App\models\fasilitas_penunjang;
use App\models\kompetensi_sdm;
use App\models\log_response_gate;
// tambahan data rancang bangun
use App\models\rancang_terminal;
use App\models\pengajuan_terminal;
use App\models\proses_pembangunan;
use App\models\vw_api_tos_spionam_blue;
use Auth;
use Session;
use DB;
use App\models\permission_menu;
use App\models\menu;
use App\Imports\ImportExcelkendaraanTiba;
use App\Imports\ImportExcelkendaraanKeluar;
use Maatwebsite\Excel\Facades\Excel;
use App\models\sertifikat;

class ControllerBackendTwo extends Controller
{
     public function ShowLoginTopMenu(){
        if(!empty(Auth::user()->id)){
            $iduser = Auth::user()->id;
            $user = User::select('*')->leftjoin('permission','permission.id_user','users.id')
                                  ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                                  ->leftjoin('terminal','terminal.kode_terminal','permission.kode_terminal')
                                  ->leftjoin('role','role.id_role','permission.id_role')
                                  ->where('users.id',$iduser)->first();
        } else{
           $user = ""; 
        }
        return $user;
    }
    public function PermissionMenu(){
        if(!empty(Auth::user()->id)){
        $iduser = Auth::user()->id;
        $menajemenmenu = permission_menu::select('*')->leftjoin('role','role.id_role','permission_menu.id_role')
                                   ->leftjoin('menu','menu.id','permission_menu.id_menu')
                                   ->leftjoin('permission','permission.id_role','role.id_role')
                                   ->leftjoin('users','users.id','permission.id_user')
                                  // ->limit(10)->get();

                                  // ->leftjoin('role','role.id_role','permission.id_role')
                                   ->where('users.id',$iduser)->get();
        } else{
           $menajemenmenu = ""; 
        }
      //  dd($menajemenmenu);

        return $menajemenmenu;
    }


    public function menuakses(){
        $datamenu = ControllerBackendTwo::PermissionMenu();
        $datauserid = ControllerBackendTwo::ShowLoginTopMenu();
        $permission_menu = permission_menu::select('permission_menu.*','menu.*','role.*','permission_menu.id as id_permission')->leftjoin('menu','menu.id','permission_menu.id_menu')->leftjoin('role','role.id_role','permission_menu.id_role')->get();
        //dd($permission_menu);
        $menu = menu::orderby('id','ASC')->get();
        $role = role::orderby('id_role','DESC')->get();
        return view('html.menu',compact('datauserid','menu','role','permission_menu','datamenu'));
    }

    public function insertmenu(Request $request){
        if(empty($request->create)){
            $add = 0;
        } else {
            $add = $request->create;
        }

        if(empty($request->update)){
            $up = 0;
        } else {
            $up = $request->update;
        }

        if(empty($request->delete)){
            $del = 0;
        } else {
            $del = $request->delete;
        }

        $simpanmenu = new permission_menu();
        $simpanmenu->id_role = $request->id_role;
        $simpanmenu->id_menu = $request->id_menu;
        $simpanmenu->create = $add;
        $simpanmenu->update = $up;
        $simpanmenu->delete = $del;
        $simpanmenu->save();
        $notif = "Data berhasil disimpan";
        return redirect()->back()->with('notif',$notif);
    }

    public function updatedatamenu($id){
        $permission_menu = permission_menu::where('id',$id)->first();

        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $permission_menu  
                ], 201);
    }

    public function updatemenu(Request $request){
    //  dd($request->all());
        if(empty($request->lead)){
            $web = 0;
        } else {
            $web = $request->lead;
        }

        if(empty($request->create)){
            $add = 0;
        } else {
            $add = $request->create;
        }

        if(empty($request->update)){
            $up = 0;
        } else {
            $up = $request->update;
        }

        if(empty($request->delete)){
            $del = 0;
        } else {
            $del = $request->delete;
        }
        //dd($up);

        $simpanmenu = permission_menu::where('id',$request->id)->first();
        // $simpanmenu->id_role = $request->id_role;
        $simpanmenu->lead  =  $web;
        $simpanmenu->create = $add;
        $simpanmenu->update = $up;
        $simpanmenu->delete = $del;
        $simpanmenu->update();
        $notif = "Data berhasil diperbaharui";
        return redirect()->back()->with('notif',$notif);
    }

    public function importkendaraan(){
        $datamenu = ControllerBackendTwo::PermissionMenu();
        $datauserid = ControllerBackendTwo::ShowLoginTopMenu();
        return view('html.importkendaraan',compact('datauserid','datamenu'));
    }

    public function simpanimportkendaraantiba(Request $request){
        // validasi
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);
 
        // menangkap file excel
        $file = $request->file('importkendaraan');
 
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
 
        // upload ke folder file_siswa di dalam folder public
        $file->move('import/file_excel_kendaraan_tiba',$nama_file);
 
        // import data
        Excel::import(new ImportExcelkendaraanTiba, public_path('/import/file_excel_kendaraan_tiba/'.$nama_file));
 
        // notifikasi dengan session
        Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
        // alihkan halaman kembali
        $notif = "Data berhasil diimport";
        return redirect('/datakendaraantiba')->with('notif',$notif);
    }

    public function importkendaraankeluar(){
        $datauserid = ControllerBackendTwo::ShowLoginTopMenu();
        $datamenu = ControllerBackendTwo::PermissionMenu();
        return view('html.importkendaraankeluar',compact('datauserid','datamenu'));
    }

    public function simpanimportkendaraankeluar(Request $request){
        // validasi
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);
 
        // menangkap file excel
        $file = $request->file('importkendaraan');
 
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
 
        // upload ke folder file_siswa di dalam folder public
        $file->move('import/file_excel_kendaraan_keluar',$nama_file);
 
        // import data
        Excel::import(new ImportExcelkendaraanKeluar, public_path('/import/file_excel_kendaraan_keluar/'.$nama_file));
 
        // notifikasi dengan session
        Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
        // alihkan halaman kembali
        $notif = "Data berhasil diimport";
        return redirect('/datakendaraankeluar')->with('notif',$notif);
    }
}



















