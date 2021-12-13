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
use App\models\sertifikat;

class ControllerBackend extends Controller
{
    public function ShowError(){
        return view('html.404');
    }
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
       // dd($user);

        return $user;
    }

    public function PermissionMenu(){
        if(!empty(Auth::user()->id)){
        $iduser = Auth::user()->id;
        $datauserid = ControllerBackend::ShowLoginTopMenu();
     //   dd($datauserid);
        $menajemenmenu = permission_menu::select('*')->leftjoin('role','role.id_role','permission_menu.id_role')
                                   ->leftjoin('menu','menu.id','permission_menu.id_menu')
                                   ->leftjoin('permission','permission.id_role','role.id_role')
                                  // ->leftjoin('users','users.id','permission.id_user')
                                  // ->limit(10)->get();

                                  // ->leftjoin('role','role.id_role','permission.id_role')
                                   ->where('permission.id_user',$iduser)->get();
        } else{
           $menajemenmenu = ""; 
        }
      //  dd($menajemenmenu);
        return $menajemenmenu;
    }

    public function terminals(){
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $dataterminalget = terminal::orderby('id_terminal','DESC');
            if($datauserid->id_bptb !=null) {
            $dataterminalget->where('id_bptd',$datauserid->id_bptb);
            }
            $dataterminal = $dataterminalget->get();
            return $dataterminal;
    }

    public function ShowWebTos(){
      //  $datauserid = ControllerBackend::ShowLoginTopMenu();
        $dataterminal = terminal::select('*')
            ->leftjoin('kota','kota.id_kota','=','terminal.id_kota')
            ->leftjoin('bptb','bptb.id_bptb','=','terminal.id_bptd')
            ->get();
            $datatryek = trayek::orderby('id_trayek','DESC')->get();
        $databptd = bptb::orderby('id_bptb','DESC')->get();
        $datakota = kota::orderby('id_kota','DESC')->get();
        $datasdm = sdm::orderby('id','DESC')->get();
        return view('html.webtos',compact('dataterminal','databptd','datakota','datatryek','datasdm'));

    }

    public function ShowLogin(){
        return view('html.login');
    }

    public function ShowProfil(){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
        return view('html.profil',compact('datauserid','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowIndex(){
        $datamenu = ControllerBackend::PermissionMenu();
        //dd($datamenu);
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){

                if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ // dirjen
                    $grp_statistic_penumpang = DB::select("call grp_statistic_penumpang('ALL','ALL')");
                } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal==null){ // bptd
                    $grp_statistic_penumpang = DB::select("call grp_statistic_penumpang('".$datauserid->id_bptb."','ALL')");
                } else if($datauserid->id_bptb ==null && $datauserid->kode_terminal !=null){ // terminal
                    $grp_statistic_penumpang = DB::select("call grp_statistic_penumpang('ALL','".$datauserid->kode_terminal."')");
                }
                $grp_statistic_penumpangob = $grp_statistic_penumpang[0];
             //   dd($grp_statistic_penumpangob);
                $datakentiba = kendaraan_tiba::all();
                $jumlahTotalpenumpangtiba =0;
                $jumlahTotalpenumpangturun = 0;
                $jumlahTotalpenumpangnaik = 0;
                $jumlahpenumpangberangkat = 0;
                    foreach($datakentiba as $val){
                        $jumlahpenumpangtibaperharinya = (int)$val->jumlah_penumpang_tiba;
                        $jumlahTotalpenumpangtiba += $jumlahpenumpangtibaperharinya;

                        $jumlahpenumpangturunperharinya = (int)$val->jumlah_penumpang_turun;
                        $jumlahTotalpenumpangturun += $jumlahpenumpangturunperharinya;

                        $jumlahpenumpangnaikperharinya = (int)$val->jumlah_penumpang_naik;
                        $jumlahTotalpenumpangnaik += $jumlahpenumpangnaikperharinya;

                        $jumlahpenumpangberangkatperharinya = (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik;
                        $jumlahpenumpangberangkat += $jumlahpenumpangberangkatperharinya;
                    }
                    $datenow = date('Y');
                    $kurangdate = $datenow - 1; 
                    if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ // dirjen
                        $datagrafikkendaraan = DB::select("call grp_produksi_kendaraan('ALL', 'ALL')");
                        $datagrafikkendaraanjumkend = DB::select("call grp_jumlah_kendaraan('5', 'ALL')");

                    } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal==null){ // bptd
                        $datagrafikkendaraan = DB::select("call grp_produksi_kendaraan('".$datauserid->id_bptb."', 'ALL')");
                        $datagrafikkendaraanjumkend = DB::select("call grp_jumlah_kendaraan('".$datauserid->id_bptb."', 'ALL')");

                    } else if($datauserid->id_bptb ==null && $datauserid->kode_terminal !=null){ // terminal
                        $datagrafikkendaraan = DB::select("call grp_produksi_kendaraan('ALL', '".$datauserid->kode_terminal."')");
                        $datagrafikkendaraanjumkend = DB::select("call grp_jumlah_kendaraan('ALL', '".$datauserid->kode_terminal."')");
                    }



                    

            // dd($datagrafikkendaraan);

                return view('html.dashboard',compact(
                    'datauserid',
                    'jumlahTotalpenumpangtiba',
                    'jumlahTotalpenumpangturun',
                    'jumlahTotalpenumpangnaik',
                    'jumlahpenumpangberangkat',
                    'datagrafikkendaraan',
                    'datagrafikkendaraanjumkend',
                    'datamenu',
                    'grp_statistic_penumpangob'
                    ));
            } else {
                return redirect('/404');
            }
    }

    public function filter(Request $request){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $datakentiba = kendaraan_tiba::all();
        $jumlahTotalpenumpangtiba =0;
        $jumlahTotalpenumpangturun = 0;
        $jumlahTotalpenumpangnaik = 0;
        $jumlahpenumpangberangkat = 0;
            foreach($datakentiba as $val){
                $jumlahpenumpangtibaperharinya = (int)$val->jumlah_penumpang_tiba;
                $jumlahTotalpenumpangtiba += $jumlahpenumpangtibaperharinya;

                $jumlahpenumpangturunperharinya = (int)$val->jumlah_penumpang_turun;
                $jumlahTotalpenumpangturun += $jumlahpenumpangturunperharinya;

                $jumlahpenumpangnaikperharinya = (int)$val->jumlah_penumpang_naik;
                $jumlahTotalpenumpangnaik += $jumlahpenumpangnaikperharinya;

                $jumlahpenumpangberangkatperharinya = (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik;
                $jumlahpenumpangberangkat += $jumlahpenumpangberangkatperharinya;
            }
            $datenow = date('Y');
            $kurangdate = $datenow - 1; 
      //  dd($request->tahunproduksikendaraan);
        $datagrafikkendaraan = DB::select("SELECT BULAN, SUM(TOT_AKAP) TOT_AKAP, SUM(TOT_AKDP) TOT_AKDP
        FROM ( SELECT substring(convert(tgl_kadaluarsa_kps, character), 6, 2) BULAN,
                  CASE WHEN tipe_kendaraan = 'AKAP' THEN 1 ELSE 0 END TOT_AKAP,
                  CASE WHEN tipe_kendaraan = 'AKDP' THEN 1 ELSE 0 END TOT_AKDP
              FROM kendaraan
              WHERE CONVERT(tahun, decimal) = ".$request->tahunproduksikendaraan.") MAIN
        GROUP BY BULAN");

        $datagrafikkendaraan2 = DB::select("SELECT BULAN, SUM(TOT_KEND_TIBA) TOT_KEND_TIBA, SUM(TOT_KEND_KELUAR) TOT_KEND_KELUAR
        FROM ( SELECT substring(convert(tgl, character), 6, 2) BULAN,
                COUNT(no_kendaraan) TOT_KEND_TIBA,
                0 TOT_KEND_KELUAR
            FROM kendaraan_tiba
            WHERE substring(convert(tgl, character), 1, 4) = date('Y')
            GROUP BY substring(convert(tgl, character), 6, 2)
            UNION ALL
            SELECT substring(convert(tgl, character), 6, 2) BULAN,
                0 TOT_KEND_TIBA,
                COUNT(no_kendaraan) TOT_KEND_KELUAR
            FROM kendaraan_keluar
            WHERE substring(convert(tgl, character), 1, 4) = date('Y')
            GROUP BY substring(convert(tgl, character), 6, 2)
          ) MAIN
        GROUP BY BULAN;");

       // dd($datagrafikkendaraan);

        return view('html.dashboard',compact(
            'datauserid',
            'jumlahTotalpenumpangtiba',
            'jumlahTotalpenumpangturun',
            'jumlahTotalpenumpangnaik',
            'jumlahpenumpangberangkat',
            'datagrafikkendaraan',
            'datagrafikkendaraan2',
            'datamenu'
            ));
    }

    public function filter2(Request $request){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $datakentiba = kendaraan_tiba::all();
        $jumlahTotalpenumpangtiba =0;
        $jumlahTotalpenumpangturun = 0;
        $jumlahTotalpenumpangnaik = 0;
        $jumlahpenumpangberangkat = 0;
            foreach($datakentiba as $val){
                $jumlahpenumpangtibaperharinya = (int)$val->jumlah_penumpang_tiba;
                $jumlahTotalpenumpangtiba += $jumlahpenumpangtibaperharinya;

                $jumlahpenumpangturunperharinya = (int)$val->jumlah_penumpang_turun;
                $jumlahTotalpenumpangturun += $jumlahpenumpangturunperharinya;

                $jumlahpenumpangnaikperharinya = (int)$val->jumlah_penumpang_naik;
                $jumlahTotalpenumpangnaik += $jumlahpenumpangnaikperharinya;

                $jumlahpenumpangberangkatperharinya = (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik;
                $jumlahpenumpangberangkat += $jumlahpenumpangberangkatperharinya;
            }
$datenow = date('Y');
$kurangdate = $datenow - 1; 
$datagrafikkendaraan = DB::select("SELECT BULAN, SUM(TOT_AKAP) TOT_AKAP, SUM(TOT_AKDP) TOT_AKDP
FROM ( SELECT substring(convert(tgl_kadaluarsa_kps, character), 6, 2) BULAN,
          CASE WHEN tipe_kendaraan = 'AKAP' THEN 1 ELSE 0 END TOT_AKAP,
          CASE WHEN tipe_kendaraan = 'AKDP' THEN 1 ELSE 0 END TOT_AKDP
      FROM kendaraan
      WHERE CONVERT(tahun, decimal) = ".$kurangdate." ) MAIN
GROUP BY BULAN");

$datagrafikkendaraan2 = DB::select("SELECT BULAN, SUM(TOT_KEND_TIBA) TOT_KEND_TIBA, SUM(TOT_KEND_KELUAR) TOT_KEND_KELUAR
FROM ( SELECT substring(convert(tgl, character), 6, 2) BULAN,
        COUNT(no_kendaraan) TOT_KEND_TIBA,
        0 TOT_KEND_KELUAR
    FROM kendaraan_tiba
    WHERE substring(convert(tgl, character), 1, 4) = '".$request->tahunkend."'
    GROUP BY substring(convert(tgl, character), 6, 2)
    UNION ALL
    SELECT substring(convert(tgl, character), 6, 2) BULAN,
        0 TOT_KEND_TIBA,
        COUNT(no_kendaraan) TOT_KEND_KELUAR
    FROM kendaraan_keluar
    WHERE substring(convert(tgl, character), 1, 4) = '".$request->tahunkend."'
    GROUP BY substring(convert(tgl, character), 6, 2)
  ) MAIN
GROUP BY BULAN;");

      //  dd($datagrafikkendaraan);

        return view('html.dashboard',compact(
            'datauserid',
            'jumlahTotalpenumpangtiba',
            'jumlahTotalpenumpangturun',
            'jumlahTotalpenumpangnaik',
            'jumlahpenumpangberangkat',
            'datagrafikkendaraan',
            'datagrafikkendaraan2',
            'datamenu'
            ));
    }

    public function ShowUser(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
        $datauser = User::select('*')
            ->leftjoin('permission','users.id','=','permission.id_user')
            ->leftjoin('role','role.id_role','=','permission.id_role')
            ->leftjoin('bptb','bptb.id_bptb','=','permission.id_bptb')
            ->leftjoin('terminal','terminal.kode_terminal','permission.kode_terminal')
             ->where('users.username','!=',null)
             ->where('users.id','!=',2)
             ->where('users.id','!=',3)
            ->get();
          //  dd($datauser);
        $dataterminal = terminal::all();
        $datawilayah = bptb::orderby('id_bptb','DESC')->get();
        $datarole = role::orderby('id_role','ASC')->where('id_role','!=',1)->get();
        return view('html.user',compact('datauser','datawilayah','datarole','dataterminal','datauserid','datamenu'));
    } else {
        return redirect('/404');
    }
    }

    public function getbptdterminal($id){
        $upgetdata = terminal::where('id_bptd',$id)->get();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function ShowRegisterUser(Request $request){
        $password = Hash::make($request->password);
        $saveuser = new User();
        $saveuser->name     = $request->name;
        $saveuser->nik      = $request->nik;
        $saveuser->email    = $request->email;
        $saveuser->username = $request->username;
        $saveuser->no_telp  = $request->no_telp;
        $saveuser->alamat   = $request->alamat;
        $saveuser->password = $password;
        $saveuser->status   = 0;
        $saveuser->save();

        $savepermission = new permission();
        $savepermission->id_user        = $saveuser->id;
        $savepermission->id_role        = $request->id_role;
        $savepermission->id_bptb        = $request->id_bptb;
        $savepermission->kode_terminal  = $request->kode_terminal;
        $savepermission->save();
        return redirect('/user')->with('notif','Data berhasil tersimpan');
    }

    public function ShowUpdate($id){
        $upgetdata = User::select('*')
            ->leftjoin('permission','users.id','=','permission.id_user')
            ->leftjoin('role','role.id_role','=','permission.id_role')
            ->leftjoin('bptb','bptb.id_bptb','=','permission.id_bptb')
          //  ->leftjoin('terminal','terminal.id_terminal','permission.id_terminal')
            ->where('users.id',$id)
            ->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function ShowUpdateRegisterUser(Request $request){
        $password = Hash::make($request->password);
        $registeruser           = User::where('id',$request->id)->first();
        if($request->password==""){
            $pss = $registeruser->password;
        } else {
            $pss = $password;
        }
        $registeruser->name     = $request->name;
        $registeruser->nik      = $request->nik;
        $registeruser->email    = $request->email;
        $registeruser->username = $request->username;
        $registeruser->no_telp  = $request->no_telp;
        $registeruser->alamat   = $request->alamat;
        $registeruser->password = $pss;
        $registeruser->status   = 0;
        $registeruser->update();

        $savepermission = permission::where('id_user',$request->id)->first();
      //  $savepermission->id_wilayah     = $request->id_wilayah;
        // if($request->id_bptb !=null || $request->kode_terminal !=null){
        $savepermission->id_role        = $request->id_role;
        $savepermission->id_bptb        = $request->id_bptb;
        $savepermission->kode_terminal  = $request->kode_terminal;
        $savepermission->update();
       // }

        return redirect('/user')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeleteUser(Request $request){
            $data = User::where('id',$request->id)->delete();
            return redirect('/user')->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowWilayah(){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datawilayah = bptb::orderby('id_bptb','DESC')
            ->get();
            $databptd = bptb::orderby('id_bptb','DESC')->get();
            return view('html.wilayah',compact('datawilayah','databptd','datauserid','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowSimpanWilayah(Request $request){
        $titik_koordinat = array([
            'lat'   => $request->lat,
            'long'  => $request->long
        ]);
        $jsontitikkoordinat = json_encode($titik_koordinat);
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $savewilayah = new bptb();
        $savewilayah->bptb              = $request->bptb;
        // $savewilayah->nama_wilayah      = $request->nama_wilayah;
        // $savewilayah->induk_wilayah     = $request->induk_wilayah;
        // $savewilayah->level             = $request->level;
        // $savewilayah->no_telp           = $request->no_telp;
        // $savewilayah->alamat            = $request->alamat;
        // $savewilayah->titik_koordinat   = $jsontitikkoordinat;
        $savewilayah->status            = $status;
        $savewilayah->save();
        return redirect('/wilayah')->with('notif','Data berhasil tersimpan');
    }

    public function ShowUpdateWilayah($id){
        $upgetdata = bptb::where('id_bptb',$id)->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function ShowUpdatePostWilayah(Request $request){
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $savewilayah = bptb::where('id_bptb',$request->id)->first();
        $savewilayah->bptb      = $request->bptb;
        // $savewilayah->nama_wilayah      = $request->nama_wilayah;
        // $savewilayah->induk_wilayah     = $request->induk_wilayah;
        // $savewilayah->level             = $request->level;
        // $savewilayah->no_telp           = $request->no_telp;
        // $savewilayah->alamat            = $request->alamat;
        // $savewilayah->titik_koordinat   = helpersmaster::titikkoordinat($request->lat,$request->long);
        $savewilayah->status            = $status;
        $savewilayah->update();
        return redirect('/wilayah')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeleteWilayah(Request $request){
        $data = bptb::where('id_bptb',$request->id)->delete();
            return redirect('/wilayah')->with('notifdelete','Data berhasil dihapus');
    }









    public function ShowRole(){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
            $datamenus = menu::all();
            $data = role::orderby('id_role','DESC')->where('id_role','!=',1)->get();
            return view('html.role',compact('data','datauserid','datamenus','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowSimpanRole(Request $request){

            $saverole = new role();
            $saverole->role = $request->role;
            $saverole->status = 1;
            $saverole->save();

            // $simpanrolemenu = new permission_menu();
            // $simpanrolemenu->create = $request->create;
            // $simpanrolemenu->update = $request->update;
            // $simpanrolemenu->delete = $request->delete;
            // $simpanrolemenu->id_menu = $request->id_menu;
            // $simpanrolemenu->id_role = $saverole->id_role;
            // $simpanrolemenu->status = 1;
            // $simpanrolemenu->save();
            // 
            foreach($request['id_menu'] as $val){
               $simpanrolemenu = new permission_menu();  
               $simpanrolemenu->id_menu = $val;
               $simpanrolemenu->id_role = $saverole->id_role;
               $simpanrolemenu->create = 1;
               $simpanrolemenu->update = 1;
               $simpanrolemenu->delete = 1;
               $simpanrolemenu->save();
            }
           

        return redirect('/role')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUpdateDataRole($id){
        $upgetdata = role::where('id_role',$id)->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function edit_role($id=null,$ids=null){
            $datamenu = ControllerBackend::PermissionMenu();
            $datauserid = ControllerBackend::ShowLoginTopMenu();
            if(!empty($datauserid)){
            $datamenus = permission_menu::select('permission_menu.*','menu.*','permission_menu.id as id_permission')->leftjoin('menu','menu.id','permission_menu.id_menu')->where('id_role',$ids)->get();
            $menu = menu::all();
            $data = role::orderby('id_role','DESC')->where('id_role',$ids)->first();
            return view('html.edit_role',compact('data','datauserid','datamenu','menu','datamenus'));
            } else {
                return redirect('/404');
            } 
    }

     public function ShowUpdatePostRole(Request $request){
            $saverole = role::where('id_role',$request->id)->first();
            $saverole->role     = $request->role;
            $saverole->update(); 
            $datauserid = ControllerBackend::ShowLoginTopMenu();

            $simpanmenu = new permission_menu();
            $simpanmenu->id_role = $request->id;
            $simpanmenu->id_menu = $request->id_menu;
             $simpanmenu->lead = $request->lead;
            $simpanmenu->create = $request->create;
            $simpanmenu->update = $request->update; 
            $simpanmenu->delete = $request->delete;
            $simpanmenu->save();
            return redirect()->back()->with('notif','Data berhasil disimpan');
    }

      public function ShowDeleteRole(Request $request){
        $data = role::where('id_role',$request->id)->delete();
        return redirect('/role')->with('notifdelete','Data berhasil dihapus');
    }













    public function ShowTerminal(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
        $dataterminals = terminal::select('*')
            ->leftjoin('kota','kota.id_kota','=','terminal.id_kota')
            ->leftjoin('bptb','bptb.id_bptb','=','terminal.id_bptd');
            if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
            $dataterminals->where('terminal.kode_terminal',$datauserid->kode_terminal);
            } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
            $dataterminals->where('terminal.id_bptd',$datauserid->id_bptb);
            } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                $dataterminals->get();
            }
            $dataterminal = $dataterminals->get();
            $datatryek = trayek::orderby('id_trayek','DESC')->get();
        $databptd = bptb::orderby('id_bptb','DESC')->get();
        $datakota = kota::orderby('id_kota','DESC')->get();
        $datasdm = sdm::orderby('id','DESC')->get();

        $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',1)->first();
       // dd($menu);
        return view('html.terminal',compact('dataterminal','databptd','datakota','datatryek','datasdm','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowSimpanTerminal(Request $request){
        if($request->file('gambar_terminal')== ""){
            $fotogambarterminal = "-";
        } else {
            $file = $request->file('gambar_terminal');
            $extfoto = $file->getClientOriginalExtension();
            $fotogambarterminal = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/image',$fotogambarterminal);
        }
        if($request->jumlah_peringatan==""){
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $saveterminal = new terminal();
        $saveterminal->id_user          = Auth::user()->id;
        $saveterminal->kode_terminal    = $request->kode_terminal;
        $saveterminal->nama_terminal    = $request->nama_terminal;
        $saveterminal->no_telp          = $request->no_telp;
        $saveterminal->titik_koordinat  = helpersmaster::titikkoordinat($request->lat,$request->long);
        $saveterminal->alamat           = $request->alamat;
       // $saveterminal->gambar_terminal  = $fotogambarterminal;
        $saveterminal->id_bptd          = $request->id_bptd;
        $saveterminal->id_kota          = $request->id_kota;
        $saveterminal->tipe             = $request->tipe;
        $saveterminal->status_p3d       = $request->status_p3d;
        $saveterminal->luas_lahan       = $request->luas_lahan;
        $saveterminal->luas_bangunan    = $request->luas_bangunan;
        $saveterminal->luas_area_pengembangan    = $request->luas_area_pengembangan;
        $saveterminal->max_open_gate    = $warget;
        $saveterminal->save();
        return redirect('/terminal')->with('notif','Data berhasil tersimpan');
    }











    public function ShowEditTerminal($id){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
            $dataterminal = terminal::select('*')
              //  ->leftjoin('kota','kota.id_kota','=','terminal.id_kota')
                ->leftjoin('bptb','bptb.id_bptb','=','terminal.id_bptd')
                ->where('terminal.id_terminal',$id)
                ->first();
            $ddterminal = terminal::where('id_terminal',$id)->first();

              //  dd($dataterminal);
            $datatryek = trayek::orderby('id_trayek','DESC')->where('kode_terminal',$ddterminal->kode_terminal)->get();
            $databptd = bptb::orderby('id_bptb','DESC')->get();
            $datakota = kota::orderby('id_kota','DESC')->get();
            $datasdm = sdm::orderby('id','DESC')->where('kode_terminal',$ddterminal->kode_terminal)->get();
            $datakota = kota::orderby('id_kota','DESC')->get();
            $datawilayah = permission::select('*')
            ->leftjoin('bptb','bptb.id_bptb','=','permission.id_bptb')
            ->where('permission.id_user',Auth::user()->id)
            ->first();


            $datafas = fasilitas::orderby('id_fasilitas','DESC')->where('id_terminal',$id)->get();

            $datakota = kota::orderby('id_kota','DESC')->get();
            $datapo   = perusahaan_otobus::orderby('id_perusahaan_otobus','DESC')->where('kode_terminal',$ddterminal->kode_terminal)->get();

            $dataasset= data_asset::orderby('id_data_asset','DESC')->where('id_terminal',$id)->get();
           
                return view('html.edit_terminal',compact(
                    'dataterminal',
                    'databptd',
                    'datakota',
                    'datatryek',
                    'datasdm',
                    'datawilayah',
                    'datapo',
                    'datafas',
                    'dataasset',
                    'datauserid',
                    'datamenu'
                ));
        } else {
            return redirect('/404');
        }
    }

    public function ShowUpdatePostTerminal(Request $request){
        if($request->file('gambar_terminal')== ""){
            $fotogambarterminal = "-";
        } else {
            $file = $request->file('gambar_terminal');
            $extfoto = $file->getClientOriginalExtension();
            $fotogambarterminal = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/image',$fotogambarterminal);
        }
        $saveterminal = terminal::where('id_terminal',$request->id)->first();
        if($request->file('gambar_terminal')==""){
            $upfoto = $saveterminal->gambar_terminal;
        } else {
            $upfoto = $fotogambarterminal;
        }
        if($request->jumlah_peringatan==""){
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $saveterminal->kode_terminal    = $request->kode_terminal;
        $saveterminal->nama_terminal    = $request->nama_terminal;
        $saveterminal->no_telp          = $request->no_telp;
        $saveterminal->titik_koordinat  = helpersmaster::titikkoordinat($request->lat,$request->long);
        $saveterminal->alamat           = $request->alamat;
       // $saveterminal->gambar_terminal  = $upfoto;
        $saveterminal->id_bptd          = $request->id_bptd;
        $saveterminal->id_kota          = $request->id_kota;
        $saveterminal->tipe             = $request->tipe;
        $saveterminal->status_p3d       = $request->status_p3d;
        $saveterminal->luas_lahan       = $request->luas_lahan;
        $saveterminal->luas_bangunan    = $request->luas_bangunan;
        $saveterminal->luas_area_pengembangan    = $request->luas_area_pengembangan;
        $saveterminal->max_open_gate    = $warget;
        $saveterminal->update();
        return redirect('/terminal')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowSimpanSDMTerminal(Request $request){
        $simpansdm = new sdm();
        if ($request->file('foto') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('foto');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_hrm', $fileup);
        }
        $simpansdm->id_wilayah = $request->id_wilayah;
        $simpansdm->id_kota     = $request->id_kota;
        $simpansdm->kode_terminal = $request->id_terminal;
        $simpansdm->nip         = $request->nip;
        $simpansdm->nama_sdm    = $request->nama_sdm;
        $simpansdm->jabatan     = $request->jabatan;
        $simpansdm->tipe        = $request->tipe;
        $simpansdm->pendidikan_terakhir = $request->pendidikan_terakhir;
        $simpansdm->no_telp     = $request->no_telp;
        $simpansdm->alamat      = $request->alamat;
        $simpansdm->kode_pos    = $request->kode_pos;
        $simpansdm->foto_sdm        = $fileup;
        $simpansdm->save();
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil tersimpan');
    }


    public function ShowSimpanPOTerminal(Request $request){
        $datapo = new perusahaan_otobus();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $datapo->id_kota        = $request->id_kota;
        $datapo->kode_terminal  = $request->id_terminal;
        $datapo->kode_po        = $request->kode_po_bus;
        $datapo->nama_po        = $request->nama_po_bus;
        $datapo->nama_direktur  = $request->nama_direktur;
        $datapo->no_izin        = $request->no_izin;
        $datapo->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $datapo->tipe           = $request->tipe;
        $datapo->no_telp        = $request->no_telp;
        $datapo->alamat         = $request->alamat;
        $datapo->kode_pos       = $request->kode_pos;
        $datapo->status         = $status;
        $datapo->save();
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil tersimpan');
    }

    public function ShowUpdateDataPOBusTerminal(Request $request){
        $datapo = perusahaan_otobus::where('id_perusahaan_otobus',$request->id)->first();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $datapo->id_kota        = $request->id_kota;
        $datapo->kode_po        = $request->kode_po_bus;
        $datapo->nama_po        = $request->nama_po_bus;
        $datapo->nama_direktur  = $request->nama_direktur;
        $datapo->no_izin        = $request->no_izin;
        $datapo->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $datapo->tipe           = $request->tipe;
        $datapo->no_telp        = $request->no_telp;
        $datapo->alamat         = $request->alamat;
        $datapo->kode_pos       = $request->kode_pos;
        $datapo->status         = $status;
        $datapo->update();
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil diperbaharui');
    }

    public function ShowSimpanTrayekTerminal(Request $request){
        $simpantrayek = new trayek();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $simpantrayek->id_terminal  = $request->id_terminal;
        $simpantrayek->kode_trayek  = $request->kode_trayek;
        $simpantrayek->nama_trayek  = $request->nama_trayek;
        $simpantrayek->rute         = $request->rute;
        $simpantrayek->status       = $status;
        $simpantrayek->save();  
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUpdateDataTrayekTerminal(Request $request){
        $simpantrayek = trayek::where('id_trayek',$request->id)->first();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $simpantrayek->kode_trayek  = $request->kode_trayek;
        $simpantrayek->nama_trayek  = $request->nama_trayek;
        $simpantrayek->rute         = $request->rute;
        $simpantrayek->status       = $status;
        $simpantrayek->save();  
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil diperbaharui');
    }













    public function ShowUpdateDataTerminal($id){
        $upgetdata = terminal::select('*')
          //  ->leftjoin('kota','kota.id_kota','=','terminal.id_kota')
            ->leftjoin('bptb','bptb.id_bptb','=','terminal.id_bptd')
            ->where('terminal.id_terminal',$id)
            ->first();
         //   dd($upgetdata);
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    

    public function ShowDeleterTerminal(Request $request){
        $data = terminal::where('id_terminal',$request->id)->delete();
        return redirect('/terminal')->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowSDM(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
           // dd($datauserid->id_role);
            $datakota = kota::orderby('id_kota','DESC')->get();
            $datawilayah = permission::select('*')
            ->leftjoin('bptb','bptb.id_bptb','=','permission.id_bptb')
             ->leftjoin('terminal','terminal.kode_terminal','=','permission.kode_terminal')
            ->where('permission.id_user',Auth::user()->id)
            ->where('terminal.kode_terminal',$datauserid->kode_terminal)
            ->first();
            $dataresult = sdm::select('sdm.*','terminal.*','sdm.no_telp as nomor')
                ->leftjoin('terminal','terminal.kode_terminal','sdm.kode_terminal')->orderby('id','DESC');
                    if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
                    $dataresult->where('sdm.kode_terminal',$datauserid->kode_terminal);
                     } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
                    $dataresult->where('sdm.id_bptb',$datauserid->id_bptb);
                     } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                        $dataresult->get();
                    }
                    $datasdm = $dataresult->get();
          //     dd($datasdm);
                $dataterminal = ControllerBackend::terminals();
               // dd($dataterminal);

             $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',2)->first();

            return view('html.sdm',compact('datasdm','datakota','datawilayah','dataterminal','datauserid','menu','datamenu'));
        } else{
            return redirect('/404');
        }
    }

    public function ShowSimpanSDM(Request $request){
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpansdm = new sdm();
        if ($request->file('foto') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('foto');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_hrm', $fileup);
        }
        $simpansdm->kode_terminal = $datauserid->kode_terminal;
        $simpansdm->id_bptb     = $datauserid->id_bptb;
        $simpansdm->id_kota     = $request->id_kota;
        $simpansdm->kode_terminal = $request->id_terminal;
        $simpansdm->nip         = $request->nip;
        $simpansdm->nama_sdm    = $request->nama_sdm;
        $simpansdm->jabatan     = $request->jabatan;
        $simpansdm->tipe        = $request->tipe;
        $simpansdm->no_telp     = $request->no_telp;
        $simpansdm->alamat      = $request->alamat;
        $simpansdm->kode_pos    = $request->kode_pos;
        $simpansdm->pendidikan_terakhir = $request->pendidikan_terakhir;
        $simpansdm->foto_sdm = $fileup;
        $simpansdm->save();
        return redirect('/sdm')->with('notif','Data berhasil tersimpan');
    }


    public function ShowUpdateSDM($id){
        $upgetdata = sdm::select('terminal.*','sdm.*','sdm.tipe as tipes')->leftjoin('terminal','terminal.kode_terminal','sdm.kode_terminal')->orderby('id','DESC')
                ->where('id',$id)
                ->first();
        $datawilayah = permission::select('*')
        ->leftjoin('bptb','bptb.id_bptb','=','permission.id_bptb')
        ->where('permission.id_user',Auth::user()->id)
        ->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata ,
                'datawilayah' => $datawilayah 
                ], 201);
    }
    public function ShowUPdatePostSDM(Request $request){
        $simpansdm = sdm::where('id',$request->id)->first();
        if ($request->file('foto') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('foto');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_hrm', $fileup);
        }
       // $simpansdm->id_wilayah = $request->id_wilayah;
        $simpansdm->id_kota     = $request->id_kota;
        $simpansdm->kode_terminal = $request->id_terminal;
        $simpansdm->nip         = $request->nip;
        $simpansdm->nama_sdm    = $request->nama_sdm;
        $simpansdm->jabatan     = $request->jabatan;
        $simpansdm->tipe        = $request->tipe;
        $simpansdm->no_telp     = $request->no_telp;
        $simpansdm->alamat      = $request->alamat;
        $simpansdm->kode_pos    = $request->kode_pos;
        $simpansdm->pendidikan_terakhir = $request->pendidikan_terakhir;
        $simpansdm->foto_sdm = $fileup;
        $simpansdm->save();
        return redirect('/sdm')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUPdatePostSDMTerminal(Request $request){
        $simpansdm = sdm::where('id',$request->id)->first();
        if ($request->file('foto') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('foto');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_hrm', $fileup);
        }
        $simpansdm->id_wilayah = $request->id_wilayah;
        $simpansdm->id_kota     = $request->id_kota;
        $simpansdm->nip         = $request->nip;
        $simpansdm->nama_sdm    = $request->nama_sdm;
        $simpansdm->jabatan     = $request->jabatan;
        $simpansdm->tipe        = $request->tipe;
        $simpansdm->no_telp     = $request->no_telp;
        $simpansdm->alamat      = $request->alamat;
        $simpansdm->kode_pos    = $request->kode_pos;
        $simpansdm->pendidikan_terakhir = $request->pendidikan_terakhir;
        $simpansdm->foto_sdm = $fileup;
        $simpansdm->save();
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeleteSDM(Request $request){
        $data = sdm::where('id',$request->id)->delete();
        return redirect('/sdm')->with('notifdelete','Data berhasil dihapus');
    }
    public function ShowPO(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datakota = kota::orderby('id_kota','DESC')->get();
            $datapo   = perusahaan_otobus::orderby('id_perusahaan_otobus','DESC')->get();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',3)->first();
            return view('html.po',compact('datapo','datakota','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowEditPO($id){
         $datamenu = ControllerBackend::PermissionMenu();
            $datauserid = ControllerBackend::ShowLoginTopMenu();
             if(!empty($datauserid)){
                $datakota = kota::orderby('id_kota','DESC')->get();
                $datapo   = perusahaan_otobus::orderby('id_perusahaan_otobus','DESC')->where('id_perusahaan_otobus',$id)->first();
                $dataperusahaanotobus = perusahaan_otobus::orderby('id_perusahaan_otobus','DESC')->get();
                $datatryek = trayek::orderby('id_trayek','DESC')->get();
                $datakendaraan = kendaraan::select('trayek.*', 'prs.*', 'kendaraan.*','kendaraan.id_kendaraan as idks','prs.id_perusahaan_otobus as idps')
                            ->leftjoin('trayek','trayek.id_trayek','kendaraan.id_trayek')
                            ->leftjoin('perusahaan_otobus as prs','prs.kode_po','kendaraan.id_perusahaan_otobus')
                            ->where('prs.id_perusahaan_otobus',$id)
                            ->get();
                return view('html.edit_po',compact('datapo','datakota','dataperusahaanotobus','datakendaraan','datatryek','datauserid','datamenu'));
            } else {
                return redirect('/404');
            }
    }

    public function ShowSimpanKendaraanPO(Request $request){
       $simpankendaraan = new kendaraan();
       $simpankendaraan->no_kendaraan   = $request->no_kendaraan;
       $simpankendaraan->no_rangka      = $request->no_rangka;
       $simpankendaraan->no_mesin       = $request->no_mesin;
       $simpankendaraan->merek          = $request->merek;
       $simpankendaraan->jenis_kendaraan= $request->jenis_kendaraan;
       $simpankendaraan->tahun          = $request->tahun;
       $simpankendaraan->kapasitas      = $request->kapasitas;
       $simpankendaraan->tipe_kendaraan = $request->tipe;
       $simpankendaraan->id_perusahaan_otobus = $request->id_perusahaan_otobus;
       $simpankendaraan->id_trayek      = $request->id_trayek;
       $simpankendaraan->no_uji         = $request->no_uji;
       $simpankendaraan->tgl_kadaluarsa = $request->tgl_kadaluarsa;
       $simpankendaraan->no_kps         = $request->no_kps;
       $simpankendaraan->tgl_kadaluarsa_kps = $request->tgl_kadaluarsa_kps;
       $simpankendaraan->no_srut        = $request->no_srut;
       $simpankendaraan->masa_berlaku_kendaraan = $request->masa_berlaku_kendaraan;
       $simpankendaraan->save();
       return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUpdateKendaraanPO(Request $request){
       $simpankendaraan =kendaraan::where('id_kendaraan',$request->id)->first();
       $simpankendaraan->no_kendaraan   = $request->no_kendaraan;
       $simpankendaraan->no_rangka      = $request->no_rangka;
       $simpankendaraan->no_mesin       = $request->no_mesin;
       $simpankendaraan->merek          = $request->merek;
       $simpankendaraan->jenis_kendaraan= $request->jenis_kendaraan;
       $simpankendaraan->tahun          = $request->tahun;
       $simpankendaraan->kapasitas      = $request->kapasitas;
       $simpankendaraan->tipe_kendaraan = $request->tipe;
       $simpankendaraan->id_perusahaan_otobus = $request->id_perusahaan_otobus;
       $simpankendaraan->id_trayek      = $request->id_trayek;
       $simpankendaraan->no_uji         = $request->no_uji;
       $simpankendaraan->tgl_kadaluarsa = $request->tgl_kadaluarsa;
       $simpankendaraan->no_kps         = $request->no_kps;
       $simpankendaraan->tgl_kadaluarsa_kps = $request->tgl_kadaluarsa_kps;
       $simpankendaraan->no_srut        = $request->no_srut;
       $simpankendaraan->masa_berlaku_kendaraan = $request->masa_berlaku_kendaraan;
       $simpankendaraan->update();
       return redirect('/editpo/'.$request->id_perusahaan_otobus)->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeletePOKendaraan(Request $request){
        $data = kendaraan::where('id_kendaraan',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }










    public function ShowSimpanPO(Request $request){
        $datapo = new perusahaan_otobus();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $datapo->id_kota        = $request->id_kota;
        $datapo->kode_po        = $request->kode_po_bus;
        $datapo->nama_po        = $request->nama_po_bus;
        $datapo->nama_direktur  = $request->nama_direktur;
        $datapo->no_izin        = $request->no_izin;
        $datapo->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $datapo->tipe           = $request->tipe;
        $datapo->no_telp        = $request->no_telp;
        $datapo->alamat         = $request->alamat;
        $datapo->kode_pos       = $request->kode_pos;
        $datapo->status         = $status;
        $datapo->save();
        return redirect('/po')->with('notif','Data berhasil tersimpan');
    }
    public function ShowUpdateDataPO($id){
        $upgetdata = perusahaan_otobus::select('*')->orderby('id_perusahaan_otobus','DESC')
            ->where('id_perusahaan_otobus',$id)
            ->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata ,
                ], 201);
    }
    public function ShowUpdateDataPOBus(Request $request){
        $datapo = perusahaan_otobus::where('id_perusahaan_otobus',$request->id)->first();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $datapo->id_kota        = $request->id_kota;
        $datapo->kode_po        = $request->kode_po_bus;
        $datapo->nama_po        = $request->nama_po_bus;
        $datapo->nama_direktur  = $request->nama_direktur;
        $datapo->no_izin        = $request->no_izin;
        $datapo->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $datapo->tipe           = $request->tipe;
        $datapo->no_telp        = $request->no_telp;
        $datapo->alamat         = $request->alamat;
        $datapo->kode_pos       = $request->kode_pos;
        $datapo->status         = $status;
        $datapo->update();
        return redirect('/po')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeletePO(Request $request){
        $data = perusahaan_otobus::where('id_perusahaan_otobus',$request->id)->delete();
        return redirect('/po')->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowTrayek(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datatryek = trayek::orderBy('id_trayek','DESC')->get();
           // dd($datatryek);
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',4)->first();
            return view('html.trayek',compact('datatryek','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowEditTrayek($id){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $datatryek = trayek::orderby('id_trayek','DESC')->where('id_trayek',$id)->first();
        $dataterminal = terminal::orderby('id_terminal','DESC')->get();
        $masterterminaltrayek = master_terminal_trayek::select('*')
                                ->leftjoin('terminal','terminal.id_terminal','master_terminal_trayek.id_terminal')
                                ->leftjoin('trayek','trayek.id_trayek','=','master_terminal_trayek.id_trayek')
                                ->where('master_terminal_trayek.id_trayek',$id)
                                ->get();
        $mastertrayekkendaraan = kendaraan::select('perusahaan_otobus.*','kendaraan.*','kendaraan.id_kendaraan as idkendaraan')->join('perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus','=','kendaraan.id_perusahaan_otobus')
                                                       ->get();
        $masterterminalangkutantrayek = master_terminal_angkutan_trayek::select('*')->leftjoin('trayek','trayek.id_trayek','=','master_terminal_angkutan_trayek.id_trayek')
            ->leftjoin('kendaraan','kendaraan.id_kendaraan','=','master_terminal_angkutan_trayek.id_kendaraan')
            ->leftjoin('perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus','=','kendaraan.id_perusahaan_otobus')
            ->where('trayek.id_trayek',$id)
            ->get();

        return view('html.edit_trayek',compact('datatryek','dataterminal','masterterminaltrayek','mastertrayekkendaraan','masterterminalangkutantrayek','datauserid','datamenu'));
    }

    public function ShowSimpanTerminalTrayek(Request $request){
        $cekterminal = master_terminal_trayek::where('id_terminal',$request->id_terminal)
                                        ->where('id_trayek',$request->id_trayek)
                                        ->count();
        if($cekterminal==0){
            $simpan = new master_terminal_trayek();
            $simpan->id_trayek   = $request->id_trayek;
            $simpan->id_terminal = $request->id_terminal;
            $simpan->save();
            return redirect('/edittrayek/'.$request->id_trayek)->with('notif','Data berhasil tersimpan');
        } else {
            return redirect('/edittrayek/'.$request->id_trayek)->with('notifdouble','Data sudah ada sebelumnya');
        } 

    }

    public function ShowDeleteTrayekTerminal(Request $request){
        if($request->type=="terminal"){
            master_terminal_trayek::where('id',$request->id)->delete();
        } else {
            master_terminal_angkutan_trayek::where('id',$request->id)->delete();
        }
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowSimpanTrayekAngkutan(Request $request){
            $idken = $request->id_kendaraan;

           foreach ($idken as $kendraaan=>$value) {
            $simpanmastertrayekpokendaraan = new master_terminal_angkutan_trayek();
            $simpanmastertrayekpokendaraan->id_trayek = $request->id_trayek;
            $simpanmastertrayekpokendaraan->id_kendaraan = $value;
            $simpanmastertrayekpokendaraan->save();       
            }
            return redirect('/edittrayek/'.$request->id_trayek)->with('notif','Data berhasil tersimpan');

    }







    public function ShowSimpanTrayek(Request $request){
        $simpantrayek = new trayek();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $simpantrayek->kode_trayek  = $request->kode_trayek;
        $simpantrayek->nama_trayek  = $request->nama_trayek;
        $simpantrayek->rute         = $request->rute;
        $simpantrayek->status       = $status;
        $simpantrayek->save();  
        return redirect('/trayek')->with('notif','Data berhasil tersimpan');
    }
    public function SHowUpdateTrayek($id){
        $upgetdata = trayek::where('id_trayek',$id)->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }
    public function ShowUpdateDataTrayek(Request $request){
        $simpantrayek = trayek::where('id_trayek',$request->id)->first();
        if($request->status==1){
            $status = 1;
        } else {
            $status = 0;
        }
        $simpantrayek->kode_trayek  = $request->kode_trayek;
        $simpantrayek->nama_trayek  = $request->nama_trayek;
        $simpantrayek->rute         = $request->rute;
        $simpantrayek->status       = $status;
        $simpantrayek->save();  
        return redirect('/trayek')->with('notif','Data berhasil tersimpan');
    }
    public function ShowDeleteTrayek(Request $request){
        $data = trayek::where('id_trayek',$request->id)->delete();
        return redirect('/trayek')->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowKendaraan(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $dataperusahaanotobus = perusahaan_otobus::orderby('id_perusahaan_otobus','DESC')->get();
            $datatrayek = trayek::orderby('id_trayek','DESC')->get();
            $datakendaraan = kendaraan::select('*')
                            ->join('trayek','trayek.kode_trayek','kendaraan.id_trayek')
                           ->join('perusahaan_otobus as prs','prs.kode_po','kendaraan.id_perusahaan_otobus')
                            ->get();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',5)->first();
            return view('html.kendaraan',compact('datakendaraan','dataperusahaanotobus','datatrayek','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }
    public function ShowSimpanKendaraan(Request $request){
       $simpankendaraan = new kendaraan();
       $simpankendaraan->no_kendaraan   = $request->no_kendaraan;
       $simpankendaraan->no_rangka      = $request->no_rangka;
       $simpankendaraan->no_mesin       = $request->no_mesin;
       $simpankendaraan->merek          = $request->merek;
       $simpankendaraan->jenis_kendaraan= $request->jenis_kendaraan;
       $simpankendaraan->tahun          = $request->tahun;
       $simpankendaraan->kapasitas      = $request->kapasitas;
       $simpankendaraan->tipe_kendaraan = $request->tipe;
       $simpankendaraan->id_perusahaan_otobus = $request->id_perusahaan_otobus;
       $simpankendaraan->id_trayek      = $request->id_trayek;
       $simpankendaraan->no_uji         = $request->no_uji;
       $simpankendaraan->tgl_kadaluarsa = $request->tgl_kadaluarsa;
       $simpankendaraan->no_kps         = $request->no_kps;
       $simpankendaraan->tgl_kadaluarsa_kps = $request->tgl_kadaluarsa_kps;
       $simpankendaraan->no_srut        = $request->no_srut;
       $simpankendaraan->masa_berlaku_kendaraan = $request->masa_berlaku_kendaraan;
       $simpankendaraan->save();
       return redirect('/kendaraan')->with('notif','Data berhasil tersimpan');
    }
    public function ShowUpdateDataKendaraan($id){
        $datakendaraan = kendaraan::select('trayek.*', 'prs.*', 'kendaraan.*','kendaraan.id_kendaraan as idks')
                        ->leftjoin('trayek','trayek.id_trayek','kendaraan.id_trayek')
                        ->leftjoin('perusahaan_otobus as prs','prs.id_perusahaan_otobus','kendaraan.id_perusahaan_otobus')
                        ->where('kendaraan.id_kendaraan',$id)
                        ->first();
            return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $datakendaraan  
                ], 201);
    }
    public function ShowUpdateKendaraan(Request $request){
       $simpankendaraan =kendaraan::where('id_kendaraan',$request->id)->first();
       $simpankendaraan->no_kendaraan   = $request->no_kendaraan;
       $simpankendaraan->no_rangka      = $request->no_rangka;
       $simpankendaraan->no_mesin       = $request->no_mesin;
       $simpankendaraan->merek          = $request->merek;
       $simpankendaraan->jenis_kendaraan= $request->jenis_kendaraan;
       $simpankendaraan->tahun          = $request->tahun;
       $simpankendaraan->kapasitas      = $request->kapasitas;
       $simpankendaraan->tipe_kendaraan = $request->tipe;
       $simpankendaraan->id_perusahaan_otobus = $request->id_perusahaan_otobus;
       $simpankendaraan->id_trayek      = $request->id_trayek;
       $simpankendaraan->no_uji         = $request->no_uji;
       $simpankendaraan->tgl_kadaluarsa = $request->tgl_kadaluarsa;
       $simpankendaraan->no_kps         = $request->no_kps;
       $simpankendaraan->tgl_kadaluarsa_kps = $request->tgl_kadaluarsa_kps;
       $simpankendaraan->no_srut        = $request->no_srut;
       $simpankendaraan->masa_berlaku_kendaraan = $request->masa_berlaku_kendaraan;
       $simpankendaraan->update();
       return redirect('/kendaraan')->with('notif','Data berhasil diperbaharui');
    }

    public function ShowDeleteKendaraan(Request $request){
        $data = kendaraan::where('id_kendaraan',$request->id)->delete();
        return redirect('/kendaraan')->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowSimpanFasilitas(Request $request){
        if($request->file('gambar_fasilitas')== ""){
            $fotogambarfasilitasterminal = "-";
        } else {
            $file = $request->file('gambar_fasilitas');
            $extfoto = $file->getClientOriginalExtension();
            $fotogambarfasilitasterminal = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/fasilitas',$fotogambarfasilitasterminal);
        }
        $savefasilitas = new fasilitas();
        $savefasilitas->id_terminal = $request->idterminal;
        $savefasilitas->nama_fasilitas = $request->nama_fasilitas;
        $savefasilitas->kategori    = $request->kategori;
        $savefasilitas->gambar_fasilitas    = $fotogambarfasilitasterminal;
        $savefasilitas->deskripsi       = $request->deskripsi;
        $savefasilitas->save();
        return redirect('/editterminal/'.$request->idterminal)->with('notif','Data berhasil tersimpan');
    }

    public function updatedatapostfasilitas(Request $request){
        $savefasilitas = fasilitas::where('id_fasilitas',$request->idf)->first();
        if($request->file('gambar_fasilitas_up')== null){
            $gambarfas = $savefasilitas->gambar_fasilitas;
        } else {
            $file = $request->file('gambar_fasilitas_up');
            $extfoto = $file->getClientOriginalExtension();
            $gambarfas = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/fasilitas',$gambarfas);
        }

        $savefasilitas->id_terminal = $request->idterminal;
        $savefasilitas->nama_fasilitas = $request->nama_fasilitas;
        $savefasilitas->kategori    = $request->kategori;
        $savefasilitas->gambar_fasilitas    = $gambarfas;
        $savefasilitas->deskripsi       = $request->deskripsi;
        $savefasilitas->update();
        return redirect('/editterminal/'.$request->idterminal)->with('notif','Data berhasil tersimpan');
    }

    public function ShowUPdateFasilitas($id){
        $upgetdata = fasilitas::orderby('id_fasilitas','DESC')->where('id_fasilitas',$id)->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function ShowDeleteDetailterminal(Request $request){
        if($request->type=="fas"){
            $data = fasilitas::where('id_fasilitas',$request->idf)->delete();
        } else if($request->type=="sdm"){
            $data = sdm::where('id',$request->idf)->delete();
        } else if($request->type=="po"){
             $data = perusahaan_otobus::where('id_perusahaan_otobus',$request->idf)->delete();
        } else if ($request->type=="trayek"){
            $data = trayek::where('id_trayek',$request->idf)->delete();
        } else if ($request->type=="asset"){
            $data = data_asset::where('id_data_asset',$request->idf)->delete();
        }
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowSimpanAsset(Request $request){
        if($request->file('file_penempatan_lokasi')== ""){
            $file_penempatan_lokasi = "-";
        } else {
            $file = $request->file('file_penempatan_lokasi');
            $extfoto = $file->getClientOriginalExtension();
            $file_penempatan_lokasi = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/asset_terminal',$file_penempatan_lokasi);
        }

        if($request->file('file_bast_p3d')== ""){
            $file_bast_p3d = "-";
        } else {
            $file = $request->file('file_bast_p3d');
            $extfoto = $file->getClientOriginalExtension();
            $file_bast_p3d = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/asset_terminal',$file_bast_p3d);
        }

        if($request->file('sertifikat_tanah')== ""){
            $sertifikattanah = "-";
        } else {
            $file = $request->file('sertifikat_tanah');
            $extfoto = $file->getClientOriginalExtension();
            $sertifikattanah = rand(100000,1001238912).".".$extfoto;
            $file->move('upload/asset_terminal',$sertifikat_tanah);
        }


        $savefasilitasasset = new data_asset();
        $savefasilitasasset->id_terminal = $request->id_terminal;
        $savefasilitasasset->file_penempatan_lokasi = $file_penempatan_lokasi;
        $savefasilitasasset->file_bast_p3d    = $file_bast_p3d;
        $savefasilitasasset->sertifikat_tanah    = $sertifikattanah;
        $savefasilitasasset->save();
        return redirect('/editterminal/'.$request->id_terminal)->with('notif','Data berhasil tersimpan');
    }


    public function ShowDataKendaraanTiba(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $iduser = Auth::user()->id;
            $kendaraan_tibas = kendaraan_tiba::select('sdm.*','terminal.*','kendaraan.*','kendaraan_tiba.*','perusahaan_otobus.*','kendaraan_tiba.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                             ->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.kode_terminal_asal');
                                if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
                                $kendaraan_tibas->where('kendaraan_tiba.kode_terminal_asal',$datauserid->kode_terminal);
                                } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
                                $kendaraan_tibas->where('terminal.id_bptd',$datauserid->id_bptb);
                                } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_tibas->get();
                                }
                                $kendaraan_tiba = $kendaraan_tibas->get();

                            //->leftjoin('log_response_gate','kendaraan_tiba.no_kendaraan','log_response_gate.nomor_kendaraan')
                            //->orderby('log_response_gate.id','DESC')
                           // ->get();
                            //dd($kendaraan_tiba);
            $dataterminalget = permission::select('*')
                            ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',$iduser)
                            ->first();
                        //    dd($dataterminalget);
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',11)->first();

            return view('html.kendaraan_tiba',compact('kendaraan_tiba','dataterminal','dataterminalget','kendaraan','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowDataKendaraanKeluar(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $kendaraan_keluars = kendaraan_keluar::select('sdm.*','terminal.*','kendaraan.*','kendaraan_keluar.*','perusahaan_otobus.*','kendaraan_keluar.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_keluar.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_keluar.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                            ->leftjoin('terminal','terminal.kode_terminal','kendaraan_keluar.kode_terminal_asal');
                                if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
                                $kendaraan_keluars->where('kendaraan_keluar.kode_terminal_asal',$datauserid->kode_terminal);
                                 } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
                                $kendaraan_keluars->where('terminal.id_bptd',$datauserid->id_bptb);
                                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_keluars->get();
                                 }
                                $kendaraan_keluar = $kendaraan_keluars->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
                          //  ->get();
            $dataterminalget = permission::select('*')
                            ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',Auth::user()->id)
                            ->first();
                        //    dd($dataterminalget);
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',12)->first();
            return view('html.kendaraan_keluar',compact('kendaraan_keluar','dataterminal','dataterminalget','kendaraan','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowGetKendaraan($id){
        $datakendaraan = kendaraan::select('kendaraan.*','perusahaan_otobus.*','trayek.*','kendaraan.tgl_kadaluarsa as tglkadaluarsa')
        ->leftjoin('perusahaan_otobus','kendaraan.id_perusahaan_otobus','perusahaan_otobus.kode_po')
        ->leftjoin('trayek','trayek.kode_trayek','kendaraan.id_trayek')
       // ->leftjoin('terminal','terminal.id_terminal','perusahaan_otobus.id_terminal')
        ->where('kendaraan.no_kendaraan',$id)
        ->first();
         return response()->json([
                'success' => true,
                'message' => 'Data',
                'data'    => $datakendaraan  
                ], 201);
    }

    public function ShowSimpanKendaraanTiba(Request $request){
        $simpankendaraantiba = new kendaraan_tiba();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = 1;
        $simpankendaraantiba->status_eblue = 1;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->wilayah_terminal_asal = $request->terminal_asal;
        $simpankendaraantiba->save();
         return redirect()->back()->with('notif','Data berhasil tersimpan');
    }

    public function ShowUpdateKendaraanTiba(Request $request){
        $simpankendaraantiba = kendaraan_tiba::where('id_kendaraan_tiba',$request->id)->first();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = 1;
        $simpankendaraantiba->status_eblue = 1;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->jumlah_penumpang_tiba = $request->jumlah_penumpang;
        
        $simpankendaraantiba->update();
         return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUpdateKendaraanNaik(Request $request){
        $simpankendaraantiba = kendaraan_tiba::where('id_kendaraan_tiba',$request->id)->first();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = $request->status_spinoam;
        $simpankendaraantiba->status_eblue = $request->status_eblue;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->jumlah_penumpang_naik = $request->jumlah_penumpang;
        $simpankendaraantiba->update();
         return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function ShowUpdateKendaraanTurun(Request $request){
        $simpankendaraantiba = kendaraan_tiba::where('id_kendaraan_tiba',$request->id)->first();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = $request->status_spinoam;
        $simpankendaraantiba->status_eblue = $request->status_eblue;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->jumlah_penumpang_turun = $request->jumlah_penumpang;
        $simpankendaraantiba->update();
         return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }


    public function ShowSimpanKendaraanKeluar(Request $request){
        $simpankendaraantiba = new kendaraan_keluar();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = 1;
        $simpankendaraantiba->status_eblue = 1;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->save();
         return redirect()->back()->with('notif','Data berhasil tersimpan');
    }

    public function ShowUpdateKendaraanKeluar(Request $request){
        $simpankendaraantiba = kendaraan_keluar::where('id_kendaraan_keluar',$request->id)->first();
        $simpankendaraantiba->no_kendaraan = $request->no_kendaraan;
        $simpankendaraantiba->terminal_tujuan = $request->id_terminal;
        $simpankendaraantiba->tgl = $request->tgl;
        $simpankendaraantiba->jam   = $request->jam;
        $simpankendaraantiba->status_spinoam = 1;
        $simpankendaraantiba->status_eblue = 1;
        $simpankendaraantiba->catatan = $request->catatan;
        $simpankendaraantiba->nama_admin = $request->nama;
        $simpankendaraantiba->terminal_tujuan = $request->terminal_tujuan;
        $simpankendaraantiba->update();
         return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }



    public function ShowUpdateDataKendaraanTiba($id,$iduser){
        $kendaraan_tiba = kendaraan_tiba::select('kendaraan_tiba.*','sdm.*','kendaraan.*','perusahaan_otobus.*','trayek.*','kendaraan.tgl_kadaluarsa as tglkadaluarsa')
                        ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                        ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                        ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                        ->leftjoin('trayek','trayek.kode_trayek','kendaraan.id_trayek')
                        ->where('kendaraan_tiba.id_kendaraan_tiba',$id)
                       // ->orderby('kendaraan_tiba.id','DESC')
                        ->first();

         // $datakendaraan = kendaraan::select('*')
         //                    ->leftjoin('perusahaan_otobus','kendaraan.id_perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus')
         //                    ->leftjoin('trayek','trayek.id_trayek','kendaraan.id_trayek')
         //                   // ->leftjoin('terminal','terminal.id_terminal','perusahaan_otobus.id_terminal')
         //                    ->where('kendaraan.no_kendaraan',$kendaraan_tiba->no_kendaraan)
         //                    ->first();
        $dataterminalget = permission::select('*')
                        ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                        ->where('permission.id_user',$iduser)
                        ->first();

        return response()->json([
                'success' => true,
                'message' => 'Data',
                'data'    => $kendaraan_tiba,
                'data2' => $dataterminalget,
               // 'kendraaan'=> $datakendaraan
                ], 201);
    }

    public function ShowUpdateDataKendaraanKeluar($id,$iduser){
        $kendaraan_tiba = kendaraan_keluar::select('kendaraan_keluar.*','sdm.*','kendaraan.*','perusahaan_otobus.*','trayek.*','kendaraan.tgl_kadaluarsa as tglkadaluarsa')
                        ->leftjoin('sdm','sdm.nip','kendaraan_keluar.nip')
                        ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_keluar.no_kendaraan')
                        ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                        ->leftjoin('trayek','trayek.kode_trayek','kendaraan.id_trayek')
                        ->where('kendaraan_keluar.id_kendaraan_keluar',$id)
                       // ->orderby('kendaraan_tiba.id','DESC')
                        ->first();
        $dataterminalget = permission::select('*')
                        ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                        ->where('permission.id_user',$iduser)
                        ->first();

        return response()->json([
                'success' => true,
                'message' => 'Data',
                'data'    => $kendaraan_tiba,
                'data2' => $dataterminalget,
               // 'kendraaan'=> $datakendaraan
                ], 201);
    }

    public function ShowDeleteKendaraanTiba(Request $request){
         $data = kendaraan_tiba::where('id_kendaraan_tiba',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }


    public function ShowDeleteKendaraanKeluar(Request $request){
         $data = kendaraan_keluar::where('id_kendaraan_keluar',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowPenumpangTiba(){
         $datamenu = ControllerBackend::PermissionMenu();
         $datauserid = ControllerBackend::ShowLoginTopMenu();
          if(!empty($datauserid)){
             $kendaraan_tibas = kendaraan_tiba::select('terminal.*','sdm.*','kendaraan.*','kendaraan_tiba.*','perusahaan_otobus.*','kendaraan_tiba.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                            ->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.terminal_tujuan');
                                if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null ) {
                                    $kendaraan_tibas->where('kendaraan_tiba.kode_terminal_asal',$datauserid->kode_terminal);
                                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_tibas->get();
                                 }
                                    $kendaraan_tiba = $kendaraan_tibas->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
                           // ->get();
             $terminalasal = kendaraan_tiba::select('*')->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.kode_terminal_asal')->first();
            $dataterminalget = permission::select('*')
                            ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',Auth::user()->id)
                            ->first();
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
             $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',13)->first();

            return view('html.penumpang_tiba',compact('kendaraan_tiba','dataterminal','dataterminalget','kendaraan','datauserid','terminalasal','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowPenumpangTurun(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $kendaraan_tibas = kendaraan_tiba::select('terminal.*','sdm.*','kendaraan.*','kendaraan_tiba.*','perusahaan_otobus.*','kendaraan_tiba.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                             ->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.terminal_tujuan');
                              if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null ) {
                                    $kendaraan_tibas->where('kendaraan_tiba.kode_terminal_asal',$datauserid->kode_terminal);
                                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_tibas->get();
                                 }
                                $kendaraan_tiba = $kendaraan_tibas->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
                         //   ->get();
            $dataterminalget = permission::select('*')
                           ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',Auth::user()->id)
                            ->first();
                        //    dd($dataterminalget);
            $terminalasal = kendaraan_tiba::select('*')->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.kode_terminal_asal')->first();
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',14)->first();
            return view('html.penumpang_turun',compact('kendaraan_tiba','dataterminal','dataterminalget','kendaraan','datauserid','terminalasal','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowPenumpangNaik(){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $kendaraan_tibas = kendaraan_tiba::select('terminal.*','sdm.*','kendaraan.*','kendaraan_tiba.*','perusahaan_otobus.*','kendaraan_tiba.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                            ->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.terminal_tujuan');
                             if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null ) {
                                    $kendaraan_tibas->where('kendaraan_tiba.kode_terminal_asal',$datauserid->kode_terminal);
                                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_tibas->get();
                                 }
                                    $kendaraan_tiba = $kendaraan_tibas->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
                           // ->get();
            $terminalasal = kendaraan_tiba::select('*')->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.kode_terminal_asal')->first();
            $dataterminalget = permission::select('*')
                            ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',Auth::user()->id)
                            ->first();
                        //    dd($dataterminalget);
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
             $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',15)->first();
            return view('html.penumpang_naik',compact('kendaraan_tiba','dataterminal','dataterminalget','kendaraan','datauserid','terminalasal','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowPenumpangBerangkat(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $kendaraan_tibas = kendaraan_tiba::select('terminal.*','sdm.*','kendaraan.*','kendaraan_tiba.*','perusahaan_otobus.*','kendaraan_tiba.no_kendaraan as noken')
                            ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                            ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                            ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                            ->leftjoin('terminal','terminal.kode_terminal','kendaraan_tiba.terminal_tujuan');
                            if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null ) {
                                    $kendaraan_tibas->where('kendaraan_tiba.kode_terminal_asal',$datauserid->kode_terminal);
                                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                                    $kendaraan_tibas->get();
                                 }
                                    $kendaraan_tiba = $kendaraan_tibas->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
                           //->limit(1)
                         //   ->get();
                                                 //  dd($kendaraan_tiba);

            $dataterminalget = permission::select('*')
                            ->leftjoin('bptb','bptb.id_bptb','permission.id_bptb')
                            ->where('permission.id_user',Auth::user()->id)
                            ->first();
                        //    dd($dataterminalget);
            $dataterminal = terminal::all();
            $kendaraan = kendaraan::all();
            $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',16)->first();
            return view('html.penumpang_berangkat',compact('kendaraan_tiba','dataterminal','dataterminalget','kendaraan','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowSpionamKendaraan(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $dataspionamkendaraan = spionam_kendaraan::orderby('id','DESC')->get();
                           // ->orderby('kendaraan_tiba.id','DESC')
            return view('html.spionam_kendaraan',compact('dataspionamkendaraan','datauserid','datamenu'));
        } else {
            return redirect('/404');
        }
    }
    public function ShowSpionamPerusahaan(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
        $dataspionamperusahaan = spionam_perusahaan::orderby('id','DESC')->get();
        return view('html.spionam_perusahaan',compact('dataspionamperusahaan','datauserid','datamenu'));
    } else {
        return redirect('/404');
    }
    }
    public function ShowEblue(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
         $dataeblue = eblue::orderby('id','DESC')->get();
        return view('html.eblue',compact('dataeblue','datauserid','datamenu'));
    } else {
        return redirect('/404');
    }
    }
    public function ShowDipass(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
        $datadipass = dipass::orderby('id','DESC')->get();
        return view('html.dipass',compact('datadipass','datauserid','datamenu'));
    } else {
        return redirect('/404');
    }
    }

    public function ShowReportTerminalKendaraan(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datapenumpang = kendaraan_tiba::select('*')->join('kendaraan_keluar','kendaraan_tiba.tgl','kendaraan_keluar.tgl')
                                                       // ->leftjoin('terminal','kendaraan_tiba.terminal_tujuan','terminal.id_terminal')
                                                        ->where('kendaraan_keluar.tgl','2021-11-15')
                                                        ->get();
       //     dd($datapenumpang);
            return view('html.report_terminal_kendaraan',compact('datauserid','datapenumpang','datamenu'));
        } else {
            return redirect('/404');
        }
    }

   
public function ShowReportTerminalPenumpang($export=null){
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datamenu = ControllerBackend::PermissionMenu();
             // $dataterminal = terminal::where('id_bptd',$datauserid->id_bptb)->get();
             if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ //  dirjen
              $dataterminal = terminal::all();
              } else {
                $dataterminal = terminal::where('id_bptd',$datauserid->id_bptb)->get();
              }
             $databptd = bptb::where('id_bptb',$datauserid->id_bptb)->get();
             $tglsekarang =date('Y-m-d');
             $tgllawas = date('m') - 3;
             $tglbulanlalu =date('Y-'.$tgllawas.'-d');
             $databptdall = bptb::all();
            // $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('AKAP', '".$tglbulanlalu."', '".$tglsekarang."', '".$id_bptd."')");
            // dirjen
            if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ //  dirjen
              $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('ALL', '".$tglbulanlalu."', '".$tglsekarang."', 'ALL', 'ALL')");
            } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal==null){ // bptd
                $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('ALL', '".$tglbulanlalu."', '".$tglsekarang."', '".$datauserid->id_bptb."', 'ALL')");
            } else if($datauserid->id_bptb ==null && $datauserid->kode_terminal !=null){ // terminal
                $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('ALL', '".$tglbulanlalu."', '".$tglbulanlalu."', 'ALL', '".$datauserid->kode_terminal."')");
            } 

             $tgl = date('Y-m-d');
             $terminalasal = terminal::where('kode_terminal',$datauserid->kode_terminal)->first();
            $tipe = 'AKAP';
            $tglreportdari = "";
            $tglreportsampai = "";
            $kdterminal = "";
            $filter = "";
            if($export != "export"){
                return view('html.report_terminal_penumpang',compact('datauserid','datapenumpangkendaraanditerminaltiba','dataterminal','tgl','tipe','terminalasal','databptd','tglreportdari','tglreportsampai','kdterminal','datamenu','databptdall','export','filter'));
            } else {
                 return view('html.export_report',compact('datapenumpangkendaraanditerminaltiba','dataterminal','tgl','tipe','terminalasal','databptd','tglreportdari','tglreportsampai','kdterminal','datamenu','databptdall','export','filter'));
            }
        } else {
            return redirect('/404');
        }
    }


    public function filterreport(Request $request){
    $datamenu = ControllerBackend::PermissionMenu();
    $datauserid = ControllerBackend::ShowLoginTopMenu();
    if(!empty($datauserid)){
        if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ //  dirjen
          $dataterminal = terminal::all();
          } else {
            $dataterminal = terminal::where('id_bptd',$datauserid->id_bptb)->get();
          }
         $databptd = bptb::where('id_bptb',$datauserid->id_bptb)->get();
         $databptdall = bptb::all();
         $tglsekarang =date('Y-m-d');
        $tglfirst = $request->tglawal;
        $tglend = $request->tglakhir;
        //$datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('".$request->tipe."', '".$request->tglawal."', '".$request->tglakhir."', '".$datauserid->id_bptb."')");
       if($datauserid->id_bptb==null && $datauserid->kode_terminal==null){ //  dirjen
          $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('".$request->tipe."', '".$request->tglawal."', '".$request->tglakhir."', '".$request->id_bptb."', '".$request->kode_terminal."')");
        } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal==null){ // bptd
            if($request->kode_terminal=="ALL"){
            $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('".$request->tipe."', '".$request->tglawal."', '".$request->tglakhir."', '".$datauserid->id_bptb."', 'ALL')");
            } else {
                 $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('".$request->tipe."', '".$request->tglawal."', '".$request->tglakhir."', '".$datauserid->id_bptb."', '".$request->kode_terminal."')");
            }

        } else if($datauserid->id_bptb ==null && $datauserid->kode_terminal !=null){ // terminal
            $datapenumpangkendaraanditerminaltiba  = DB::select("call rpt_report_terminal('".$request->tipe."', '".$tglbulanlalu."', '".$tglbulanlalu."', 'ALL', '".$datauserid->kode_terminal."')");
        } 

  //  dd($datapenumpangkendaraanditerminaltiba);


         $terminalasal = terminal::where('kode_terminal',$datauserid->kode_terminal)->first();
        $tgl = $request->tgl;
            $tipe = $request->tipe;
     //   dd($datapenumpangkendaraanditerminaltiba);
        $tglreportdari = $request->tglawal;
        $tglreportsampai = $request->tglakhir;
        $getterminal = terminal::where('kode_terminal',$request->kode_terminal)->first();
        if($getterminal==null){
            $kdterminal = "";
        } else {
            $kdterminal = $getterminal->nama_terminal;
        }
       $filter = "export";
        if($request->export != "export"){
                return view('html.report_terminal_penumpang',compact('datauserid','datapenumpangkendaraanditerminaltiba','dataterminal','tgl','tipe','terminalasal','databptd','tglreportdari','tglreportsampai','kdterminal','datamenu','databptdall','export','filter'));
         } else {
                 return view('html.export_report',compact('datapenumpangkendaraanditerminaltiba','dataterminal','tgl','tipe','terminalasal','databptd','tglreportdari','tglreportsampai','kdterminal','datamenu','databptdall','export','filter'));
        }
    } else {
        return redirect('/404');
    }
}

    public function ShowInputDataPenumpang(){
        $dataterminal = terminal::all();
        return view('html.input_data_penumpang',compact('dataterminal'));
    }
    public function ShowUpdateChecker(Request $request){
        $upkend = kendaraan_tiba::where('no_kendaraan',$request->no_kendaraan)->first();
        if($upkend >= 0){
            $upkends = new kendaraan_tiba();
            $upkends->no_kendaraan = $request->no_kendaraan;
            $upkends->terminal_tujuan = $request->terminal_tujuan;
            $upkends->jumlah_penumpang_tiba = $request->jumlah_penumpang_tiba;
            $upkends->jumlah_penumpang_turun = $request->jumlah_penumpang_turun;
            $upkends->tgl = date('Y-m-d');
            $upkends->jam = date('h:i:s');
            $upkends->terminal_tujuan = $request->terminal_tujuan;
            $upkends->save();
        } else {
            $upkend->jumlah_penumpang_tiba = $request->jumlah_penumpang_tiba;
            $upkend->jumlah_penumpang_turun = $request->jumlah_penumpang_turun;
            $upkend->tgl = date('Y-m-d');
            $upkend->jam = date('h:i:s');
            $upkend->terminal_tujuan = $request->terminal_tujuan;
            $upkend->update();
        }
            

            $notif = "Jumlah penumpang berhasil diupdate";
        return redirect()->back()->with('notif',$notif);
    }

   // menu rancang bangun
    public function ShowRancangTerminal()
    {
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
        $dataterminal = ControllerBackend::terminals();
        // $datarancang_terminal = rancang_terminal::all();

        $datarancang_terminals = rancang_terminal::select('*')->leftjoin('terminal', 'terminal.kode_terminal', 'rancang_terminal.kode_terminal')
                                ->orderby('id_rancang_terminal', 'DESC');
           if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
            $datarancang_terminals->where('rancang_terminal.kode_terminal',$datauserid->kode_terminal);
             } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
            $datarancang_terminals->where('rancang_terminal.id_bptb',$datauserid->id_bptb);
             } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                $datarancang_terminals->get();
             }
            $datarancang_terminal = $datarancang_terminals->get();
          //  dd($datarancang_terminal);
         $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',6)->first();

            return view('html.rancangterminal', compact('datarancang_terminal', 'dataterminal','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }


    public function ShowSimpanRancangTerminal(Request $request)
    {
        // penamaan file dan file path upload rancang bangun
        if ($request->file('sk_penetapan_lokasi') == "") {
            $name_sk_penetapan_lokasi = "-";
            $path_sk_penetapan_lokasi = '-';
        } else {
            $file = $request->file('sk_penetapan_lokasi');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesk_penetapan_lokasi = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/sk_penetapan_lokasi', $filesk_penetapan_lokasi);
            $name_sk_penetapan_lokasi = $fileName;
            $path_sk_penetapan_lokasi = 'upload/sk_penetapan_lokasi/' . $filesk_penetapan_lokasi;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('ba_serah_terima') == "") {
            $name_ba_serah_terima = "-";
            $path_ba_serah_terima = '-';
        } else {
            $file = $request->file('ba_serah_terima');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileba_serah_terima = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/ba_serah_terima', $fileba_serah_terima);
            $name_ba_serah_terima = $fileName;
            $path_ba_serah_terima = 'upload/ba_serah_terima/' . $fileba_serah_terima;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('sertifikat') == "") {
            $name_sertifikat = "-";
            $path_sertifikat = '-';
        } else {
            $file = $request->file('sertifikat');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesertifikat = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/sertifikat', $filesertifikat);
            $name_sertifikat = $fileName;
            $path_sertifikat = 'upload/sertifikat/' . $filesertifikat;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('feasibility_study') == "") {
            $name_feasibility_study = "-";
            $path_feasibility_study = '-';
        } else {
            $file = $request->file('feasibility_study');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filefeasibilitystudy = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/feasibility_study', $filefeasibilitystudy);
            $name_feasibility_study = $fileName;
            $path_feasibility_study = 'upload/feasibility_study/' . $filefeasibilitystudy;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('master_plan') == "") {
            $name_master_plan = "-";
            $path_master_plan = '-';
        } else {
            $file = $request->file('master_plan');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filemaster_plan = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/master_plan', $filemaster_plan);
            $name_master_plan = $fileName;
            $path_master_plan = 'upload/master_plan/' . $filemaster_plan;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpanrancang_terminal = new rancang_terminal();
        $simpanrancang_terminal->kode_terminal    = $datauserid->kode_terminal;
        $simpanrancang_terminal->id_bptb = $datauserid->id_bptb;
        $simpanrancang_terminal->sk_penetapan_lokasi = $name_sk_penetapan_lokasi;
        $simpanrancang_terminal->sk_penetapan_lokasi_file = $path_sk_penetapan_lokasi;

        $simpanrancang_terminal->ba_serah_terima = $name_ba_serah_terima;
        $simpanrancang_terminal->ba_serah_terima_file = $path_ba_serah_terima;

        $simpanrancang_terminal->sertifikat = $name_sertifikat;
        $simpanrancang_terminal->sertifikat_file = $path_sertifikat;

        $simpanrancang_terminal->feasibility_study = $name_feasibility_study;
        $simpanrancang_terminal->feasibility_study_file = $path_feasibility_study;

        $simpanrancang_terminal->master_plan = $name_master_plan;
        $simpanrancang_terminal->master_plan_file = $path_master_plan;

        $simpanrancang_terminal->save();
        return redirect('/rancangterminal')->with('notif', 'Data berhasil tersimpan');
    }

    public function ShowUpdateRancangTerminal($id){
        
        $upgetdata = rancang_terminal::select('*')->leftjoin('terminal', 'terminal.kode_terminal', 'rancang_terminal.kode_terminal')->orderby('id_rancang_terminal', 'DESC')
        -> where('id_rancang_terminal', $id)
        ->first();
      //  dd($upgetdata);

        $datarancang_terminal = rancang_terminal::select('*')
              ->where('rancang_terminal.id_rancang_terminal', $id)
              ->first();

        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata ,
                'datarancang_terminal' => $datarancang_terminal
                ], 201);
    }

    public function ShowUpdatePostRancangTerminal(Request $request)
    {
        $simpanrancang_terminal = rancang_terminal::where('id_rancang_terminal', $request->idrc)->first();
        if ($request->file('sk_penetapan_lokasi') == "") {
                $name_sk_penetapan_lokasi = $simpanrancang_terminal->sk_penetapan_lokasi;
                $path_sk_penetapan_lokasi = $simpanrancang_terminal->sk_penetapan_lokasi;
            } else {
                $file = $request->file('sk_penetapan_lokasi');
              //  dd($file);
                $extfile = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
    
                $filesk_penetapan_lokasi = rand(100000, 1001238912) . "." . $extfile;
                $file->move('upload/sk_penetapan_lokasi', $filesk_penetapan_lokasi);
                $name_sk_penetapan_lokasi = $fileName;
                $path_sk_penetapan_lokasi = 'upload/sk_penetapan_lokasi/' . $filesk_penetapan_lokasi;
        }

        if ($request->file('ba_serah_terima') == "") {
            $name_ba_serah_terima = $simpanrancang_terminal->ba_serah_terima;
            $path_ba_serah_terima = $simpanrancang_terminal->ba_serah_terima;
        } else {
            $file = $request->file('ba_serah_terima');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileba_serah_terima = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/ba_serah_terima', $fileba_serah_terima);
            $name_ba_serah_terima = $fileName;
            $path_ba_serah_terima = 'upload/ba_serah_terima/' . $fileba_serah_terima;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('sertifikat') == "") {
            $name_sertifikat = $simpanrancang_terminal->sertifikat;
            $path_sertifikat = $simpanrancang_terminal->sertifikat;
        } else {
            $file = $request->file('sertifikat');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesertifikat = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/sertifikat', $filesertifikat);
            $name_sertifikat = $fileName;
            $path_sertifikat = 'upload/sertifikat/' . $filesertifikat;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('feasibility_study') == "") {
            $name_feasibility_study = $simpanrancang_terminal->feasibility_study;
            $path_feasibility_study = $simpanrancang_terminal->feasibility_study;
        } else {
            $file = $request->file('feasibility_study');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filefeasibilitystudy = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/feasibility_study', $filefeasibilitystudy);
            $name_feasibility_study = $fileName;
            $path_feasibility_study = 'upload/feasibility_study/' . $filefeasibilitystudy;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('master_plan') == "") {
            $name_master_plan = $simpanrancang_terminal->master_plan;
            $path_master_plan = $simpanrancang_terminal->master_plan;
        } else {
            $file = $request->file('master_plan');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filemaster_plan = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/master_plan', $filemaster_plan);
            $name_master_plan = $fileName;
            $path_master_plan = 'upload/master_plan/' . $filemaster_plan;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpanrancang_terminal->kode_terminal                  = $datauserid->kode_terminal;
        $simpanrancang_terminal->id_bptb =  $datauserid->id_bptb;
        $simpanrancang_terminal->sk_penetapan_lokasi            = $name_sk_penetapan_lokasi;
        $simpanrancang_terminal->sk_penetapan_lokasi_file       = $path_sk_penetapan_lokasi;
        $simpanrancang_terminal->ba_serah_terima                = $name_ba_serah_terima;
        $simpanrancang_terminal->ba_serah_terima_file           = $path_ba_serah_terima;
        $simpanrancang_terminal->sertifikat                     = $name_sertifikat;
        $simpanrancang_terminal->sertifikat_file                = $path_sertifikat;
        $simpanrancang_terminal->feasibility_study              = $name_feasibility_study;
        $simpanrancang_terminal->feasibility_study_file         = $path_feasibility_study;
        $simpanrancang_terminal->master_plan                    = $name_master_plan;
        $simpanrancang_terminal->master_plan_file               = $path_master_plan;
        $simpanrancang_terminal->update();
        return redirect('/rancangterminal')->with('notif', 'Data berhasil tersimpan');
    }

    public function ShowEditRancangTerminal($id)
    {
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $datarancang_terminal = rancang_terminal::select('*')
                ->leftjoin('kota', 'kota.id_kota', '=', 'terminal.id_kota')
                ->leftjoin('bptb', 'bptb.id_bptb', '=', 'terminal.id_bptd')
                ->where('id_terminal', $id)
                ->first();
            $datask_penetapan_lokasi = sk_penetapan_lokasi::orderby('sk_penetapan_lokasi', 'DESC')->get();
            $databa_serah_terima = ba_serah_terima::orderby('ba_serah_terima', 'DESC')->get();
            $datafeasibility_study = feasibility_study::orderby('feasibility_study', 'DESC')->get();
            $datasertifikat = sertifikat::orderby('sertifikat', 'DESC')->get();
            $datamaster_plan = master_plan::orderby('master_plan', 'DESC')->get();

            return view('html.rancangterminal', compact(
                'dataterminal',
                'datask_penetapan_lokasi',
                'databa_serah_terima',
                'datafeasibility_study',
                'datasertifikat',
                'datamaster_plan',
                'datauserid',
                'datamenu'
            ));
        } else {
            return redirect('/404');
        }
    }

    public function ShowDeleteRancangTerminal(Request $request)
    {
        $data = rancang_terminal::where('id_rancang_terminal', $request->idrt)->delete();
        return redirect('/rancangterminal')->with('notifdelete', 'Data berhasil dihapus');
    }

    public function ShowPengajuanTerminal()
    {
         $datamenu = ControllerBackend::PermissionMenu();
        $dataterminal = ControllerBackend::terminals();
        $datauserid = ControllerBackend::ShowLoginTopMenu();

         if(!empty($datauserid)){
            $datapengajuan_terminals = pengajuan_terminal::select('*')
                                        ->leftjoin('terminal', 'terminal.kode_terminal', 'pengajuan_terminal.kode_terminal')
                                        ->orderby('id_pengajuan_terminal', 'DESC');
                if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
                $datapengajuan_terminals->where('pengajuan_terminal.kode_terminal',$datauserid->kode_terminal);
                 } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
                $datapengajuan_terminals->where('pengajuan_terminal.id_bptb',$datauserid->id_bptb);
                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                    $datapengajuan_terminals->get();
                }
                $datapengajuan_terminal = $datapengajuan_terminals->get();
                $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',7)->first();

            return view('html.pengajuanterminal', compact('datapengajuan_terminal', 'dataterminal','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }


    public function ShowSimpanPengajuanTerminal(Request $request)
    {

        if ($request->file('gambar_teknis') == "") {
            $name_gambar_teknis = "-";
            $path_gambar_teknis = '-';
        } else {
            $file = $request->file('gambar_teknis');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filegambar_teknis = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/gambar_teknis', $filegambar_teknis);
            $name_gambar_teknis = $fileName;
            $path_gambar_teknis = 'upload/gambar_teknis/' . $filegambar_teknis;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('surat_usulan') == "") {
            $name_surat_usulan = "-";
            $path_surat_usulan = '-';
        } else {
            $file = $request->file('surat_usulan');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesurat_usulan = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/surat_usulan', $filesurat_usulan);
            $name_surat_usulan = $fileName;
            $path_surat_usulan = 'upload/surat_usulan/' . $filesurat_usulan;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('kak_tor') == "") {
            $name_kak_tor = "-";
            $path_kak_tor = '-';
        } else {
            $file = $request->file('kak_tor');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filekak_tor = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/kak_tor', $filekak_tor);
            $name_kak_tor = $fileName;
            $path_kak_tor = 'upload/kak_tor/' . $filekak_tor;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('surat_pertanggungjawaban_mutlak') == "") {
            $name_surat_pertanggungjawaban_mutlak = "-";
            $path_surat_pertanggungjawaban_mutlak = '-';
        } else {
            $file = $request->file('surat_pertanggungjawaban_mutlak');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesurat_pertanggungjawaban_mutlak = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/surat_pertanggungjawaban_mutlak', $filesurat_pertanggungjawaban_mutlak);
            $name_surat_pertanggungjawaban_mutlak = $fileName;
            $path_surat_pertanggungjawaban_mutlak = 'upload/surat_pertanggungjawaban_mutlak/' . $filesurat_pertanggungjawaban_mutlak;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('rencana_kerja') == "") {
            $name_rencana_kerja = "-";
            $path_rencana_kerja = '-';
        } else {
            $file = $request->file('rencana_kerja');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filerencana_kerja = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/rencana_kerja', $filerencana_kerja);
            $name_rencana_kerja = $fileName;
            $path_rencana_kerja = 'upload/rencana_kerja/' . $filerencana_kerja;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('justifikasi') == "") {
            $name_justifikasi = "-";
            $path_justifikasi = '-';
        } else {
            $file = $request->file('justifikasi');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filejustifikasi = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/justifikasi', $filejustifikasi);
            $name_justifikasi = $fileName;
            $path_justifikasi = 'upload/justifikasi/' . $filejustifikasi;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpanpengajuan_terminal = new pengajuan_terminal();
        $simpanpengajuan_terminal->kode_terminal    = $datauserid->kode_terminal;
        $simpanpengajuan_terminal->id_bptb = $datauserid->id_bptb;
        $simpanpengajuan_terminal->gambar_teknis = $name_gambar_teknis;
        $simpanpengajuan_terminal->gambar_teknis_file = $path_gambar_teknis;

        $simpanpengajuan_terminal->surat_usulan = $name_surat_usulan;
        $simpanpengajuan_terminal->surat_usulan_file = $path_surat_usulan;

        $simpanpengajuan_terminal->kak_tor = $name_kak_tor;
        $simpanpengajuan_terminal->kak_tor_file = $path_kak_tor;

        $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak =  $name_surat_pertanggungjawaban_mutlak;
        $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak_file = $path_surat_pertanggungjawaban_mutlak;

        $simpanpengajuan_terminal->rencana_kerja =  $name_rencana_kerja;
        $simpanpengajuan_terminal->rencana_kerja_file = $path_rencana_kerja;

        $simpanpengajuan_terminal->justifikasi =  $name_justifikasi;
        $simpanpengajuan_terminal->justifikasi_file = $path_justifikasi;

        $simpanpengajuan_terminal->save();
        return redirect('/pengajuanterminal')->with('notif', 'Data berhasil tersimpan');
    }

    public function ShowUpdatePengajuanTerminal($id){
        
        $upgetdata = pengajuan_terminal::select('*')->leftjoin('terminal', 'terminal.kode_terminal', 'pengajuan_terminal.kode_terminal')->orderby('id_pengajuan_terminal', 'DESC')
        -> where('id_pengajuan_terminal', $id)
        ->first();
      //  dd($upgetdata);

        $datapengajuan_terminal = pengajuan_terminal::select('*')
              ->where('pengajuan_terminal.id_pengajuan_terminal', $id)
              ->first();

        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata ,
                'datapengajuan_terminal' => $datapengajuan_terminal
                ], 201);
    }

    public function ShowUpdatePostPengajuanTerminal(Request $request)
    {
        $simpanpengajuan_terminal = pengajuan_terminal::where('id_pengajuan_terminal', $request->idpt)->first();

        if ($request->file('gambar_teknis') == "") {
            $name_gambar_teknis = $simpanpengajuan_terminal->gambar_teknis;
            $path_gambar_teknis = $simpanpengajuan_terminal->gambar_teknis;
        } else {
            $file = $request->file('gambar_teknis');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filegambar_teknis = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/gambar_teknis', $filegambar_teknis);
            $name_gambar_teknis = $fileName;
            $path_gambar_teknis = 'upload/gambar_teknis/' . $filegambar_teknis;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('surat_usulan') == "") {
            $name_surat_usulan = $simpanpengajuan_terminal->surat_usulan;
            $path_surat_usulan = $simpanpengajuan_terminal->surat_usulan;
        } else {
            $file = $request->file('surat_usulan');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesurat_usulan = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/surat_usulan', $filesurat_usulan);
            $name_surat_usulan = $fileName;
            $path_surat_usulan = 'upload/surat_usulan/' . $filesurat_usulan;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('kak_tor') == "") {
            $name_kak_tor = $simpanpengajuan_terminal->kak_tor;
            $path_kak_tor = $simpanpengajuan_terminal->kak_tor;
        } else {
            $file = $request->file('kak_tor');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filekak_tor = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/kak_tor', $filekak_tor);
            $name_kak_tor = $fileName;
            $path_kak_tor = 'upload/kak_tor/' . $filekak_tor;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('surat_pertanggungjawaban_mutlak') == "") {
            $name_surat_pertanggungjawaban_mutlak = $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak;
            $path_surat_pertanggungjawaban_mutlak = $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak;
        } else {
            $file = $request->file('surat_pertanggungjawaban_mutlak');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filesurat_pertanggungjawaban_mutlak = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/surat_pertanggungjawaban_mutlak', $filesurat_pertanggungjawaban_mutlak);
            $name_surat_pertanggungjawaban_mutlak = $fileName;
            $path_surat_pertanggungjawaban_mutlak = 'upload/surat_pertanggungjawaban_mutlak/' . $filesurat_pertanggungjawaban_mutlak;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('rencana_kerja') == "") {
            $name_rencana_kerja = $simpanpengajuan_terminal->rencana_kerja;
            $path_rencana_kerja = $simpanpengajuan_terminal->rencana_kerja;
        } else {
            $file = $request->file('rencana_kerja');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filerencana_kerja = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/rencana_kerja', $filerencana_kerja);
            $name_rencana_kerja = $fileName;
            $path_rencana_kerja = 'upload/rencana_kerja/' . $filerencana_kerja;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('justifikasi') == "") {
            $name_justifikasi = $simpanpengajuan_terminal->justifikasi;
            $path_justifikasi = $simpanpengajuan_terminal->justifikasi;
        } else {
            $file = $request->file('justifikasi');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filejustifikasi = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/justifikasi', $filejustifikasi);
            $name_justifikasi = $fileName;
            $path_justifikasi = 'upload/justifikasi/' . $filejustifikasi;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        // $simpanpengajuan_terminal = new pengajuan_terminal();
        // $simpanpengajuan_terminal->nama_terminal    = $request->nama_terminal;

        $simpanpengajuan_terminal->gambar_teknis = $name_gambar_teknis;
        $simpanpengajuan_terminal->gambar_teknis_file = $path_gambar_teknis;

        $simpanpengajuan_terminal->surat_usulan = $name_surat_usulan;
        $simpanpengajuan_terminal->surat_usulan_file = $path_surat_usulan;

        $simpanpengajuan_terminal->kak_tor = $name_kak_tor;
        $simpanpengajuan_terminal->kak_tor_file = $path_kak_tor;

        $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak =  $name_surat_pertanggungjawaban_mutlak;
        $simpanpengajuan_terminal->surat_pertanggungjawaban_mutlak_file = $path_surat_pertanggungjawaban_mutlak;

        $simpanpengajuan_terminal->rencana_kerja =  $name_rencana_kerja;
        $simpanpengajuan_terminal->rencana_kerja_file = $path_rencana_kerja;

        $simpanpengajuan_terminal->justifikasi =  $name_justifikasi;
        $simpanpengajuan_terminal->justifikasi_file = $path_justifikasi;

        $simpanpengajuan_terminal->update();
        return redirect('/pengajuanterminal')->with('notif', 'Data berhasil tersimpan');
    }


    public function ShowDeletePengajuanTerminal(Request $request)
    {
        $data = pengajuan_terminal::where('id_pengajuan_terminal', $request->idpt)->delete();
        return redirect('/pengajuanterminal')->with('notifdelete', 'Data berhasil dihapus');
    }

    public function ShowProsesPembangunan()
    {
         $datamenu = ControllerBackend::PermissionMenu();
        $dataterminal = terminal::all();
        // $datarancang_terminal = rancang_terminal::all();
         $datauserid = ControllerBackend::ShowLoginTopMenu();
         if(!empty($datauserid)){
            $dataproses_pembangunans = proses_pembangunan::select('*')->leftjoin('terminal', 'terminal.kode_terminal', 'proses_pembangunan.kode_terminal')->orderby('id_proses_pembangunan', 'DESC');
                if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
                $dataproses_pembangunans->where('proses_pembangunan.kode_terminal',$datauserid->kode_terminal);
                 } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
                $dataproses_pembangunans->where('proses_pembangunan.id_bptb',$datauserid->id_bptb);
                 } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                    $dataproses_pembangunans->get();
                }
                $dataproses_pembangunan = $dataproses_pembangunans->get();
                 $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',8)->first();

            return view('html.prosespembangunan', compact('dataproses_pembangunan', 'dataterminal','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function ShowSimpanProsesPembangunan(Request $request)
    {

        if ($request->file('imb') == "") {
            $name_imb = "-";
            $path_imb = '-';
        } else {
            $file = $request->file('imb');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileimb = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/imb', $fileimb);
            $name_imb = $fileName;
            $path_imb = 'upload/imb/' . $fileimb;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('andaln') == "") {
            $name_andaln = "-";
            $path_andaln = '-';
        } else {
            $file = $request->file('andaln');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileandaln = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/andaln', $fileandaln);
            $name_andaln = $fileName;
            $path_andaln = 'upload/andaln/' . $fileandaln;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('pcm') == "") {
            $name_pcm = "-";
            $path_pcm = '-';
        } else {
            $file = $request->file('pcm');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filepcm = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/pcm', $filepcm);
            $name_pcm = $fileName;
            $path_pcm = 'upload/pcm/' . $filepcm;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('mc') == "") {
            $name_mc = "-";
            $path_mc = '-';
        } else {
            $file = $request->file('mc');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filemc = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/mc', $filemc);
            $name_mc = $fileName;
            $path_mc = 'upload/mc/' . $filemc;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('laporan_progres') == "") {
            $name_laporan_progres = "-";
            $path_laporan_progres = '-';
        } else {
            $file = $request->file('laporan_progres');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filelaporan_progres = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/laporan_progres', $filelaporan_progres);
            $name_laporan_progres = $fileName;
            $path_laporan_progres = 'upload/laporan_progres/' . $filelaporan_progres;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpanproses_pembangunan = new proses_pembangunan();
        $simpanproses_pembangunan->kode_terminal    = $datauserid->kode_terminal;
        $simpanproses_pembangunan->id_bptb = $datauserid->id_bptb;
        $simpanproses_pembangunan->imb = $name_imb;
        $simpanproses_pembangunan->imb_file = $path_imb;

        $simpanproses_pembangunan->andaln = $name_andaln;
        $simpanproses_pembangunan->andaln_file = $path_andaln;

        $simpanproses_pembangunan->pcm = $name_pcm;
        $simpanproses_pembangunan->pcm_file = $path_pcm;

        $simpanproses_pembangunan->mc =  $name_mc;
        $simpanproses_pembangunan->mc_file = $path_mc;

        $simpanproses_pembangunan->laporan_progres =  $name_laporan_progres;
        $simpanproses_pembangunan->laporan_progres_file = $path_laporan_progres;

        $simpanproses_pembangunan->save();
        return redirect('/prosespembangunan')->with('notif', 'Data berhasil tersimpan');
    }


    public function ShowUpdateProsesPembangunan($id){
        
        $upgetdata = proses_pembangunan::select('*')->leftjoin('terminal', 'terminal.kode_terminal', 'proses_pembangunan.kode_terminal')->orderby('id_proses_pembangunan', 'DESC')
        -> where('id_proses_pembangunan', $id)
        ->first();
      //  dd($upgetdata);

        $dataproses_pembangunan = proses_pembangunan::select('*')
              ->where('proses_pembangunan.id_proses_pembangunan', $id)
              ->first();

        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata ,
                'dataproses_pembangunan' => $dataproses_pembangunan
                ], 201);
    }

    
    public function ShowUpdatePostProsesPembangunan(Request $request)
    {
        $simpanproses_pembangunan = proses_pembangunan::where('id_proses_pembangunan', $request->idpp)->first();

        if ($request->file('imb') == "") {
            $name_imb = $simpanproses_pembangunan->imb;
            $path_imb = $simpanproses_pembangunan->imb;
        } else {
            $file = $request->file('imb');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileimb = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/imb', $fileimb);
            $name_imb = $fileName;
            $path_imb = 'upload/imb/' . $fileimb;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('andaln') == "") {
            $name_andaln = $simpanproses_pembangunan->andaln;
            $path_andaln = $simpanproses_pembangunan->andaln;
        } else {
            $file = $request->file('andaln');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $fileandaln = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/andaln', $fileandaln);
            $name_andaln = $fileName;
            $path_andaln = 'upload/andaln/' . $fileandaln;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('pcm') == "") {
            $name_pcm = $simpanproses_pembangunan->pcm;
            $path_pcm = $simpanproses_pembangunan->pcm;
        } else {
            $file = $request->file('pcm');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filepcm = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/pcm', $filepcm);
            $name_pcm = $fileName;
            $path_pcm = 'upload/pcm/' . $filepcm;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('mc') == "") {
            $name_mc = $simpanproses_pembangunan->mc;
            $path_mc = $simpanproses_pembangunan->mc;
        } else {
            $file = $request->file('mc');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filemc = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/mc', $filemc);
            $name_mc = $fileName;
            $path_mc = 'upload/mc/' . $filemc;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        if ($request->file('laporan_progres') == "") {
            $name_laporan_progres = $simpanproses_pembangunan->laporan_progres;
            $path_laporan_progres = $simpanproses_pembangunan->laporan_progres;
        } else {
            $file = $request->file('laporan_progres');
            $extfile = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            $filelaporan_progres = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/laporan_progres', $filelaporan_progres);
            $name_laporan_progres = $fileName;
            $path_laporan_progres = 'upload/laporan_progres/' . $filelaporan_progres;
        }
        if ($request->jumlah_peringatan == "") {
            $warget = "0";
        } else {
            $warget = $request->jumlah_peringatan;
        }

        // $simpanproses_pembangunan = new proses_pembangunan();
        // $simpanproses_pembangunan->nama_terminal    = $request->nama_terminal;

        $simpanproses_pembangunan->imb = $name_imb;
        $simpanproses_pembangunan->imb_file = $path_imb;

        $simpanproses_pembangunan->andaln = $name_andaln;
        $simpanproses_pembangunan->andaln_file = $path_andaln;

        $simpanproses_pembangunan->pcm = $name_pcm;
        $simpanproses_pembangunan->pcm_file = $path_pcm;

        $simpanproses_pembangunan->mc =  $name_mc;
        $simpanproses_pembangunan->mc_file = $path_mc;

        $simpanproses_pembangunan->laporan_progres =  $name_laporan_progres;
        $simpanproses_pembangunan->laporan_progres_file = $path_laporan_progres;

        $simpanproses_pembangunan->update();
        return redirect('/prosespembangunan')->with('notif', 'Data berhasil tersimpan');
    }





    public function ShowDeleteProsesPembangunan(Request $request)
    {
        $data = proses_pembangunan::where('id_proses_pembangunan', $request->idpp)->delete();
        return redirect('/prosespembangunan')->with('notifdelete', 'Data berhasil dihapus');
    }

    public function ShowInputRampCheck(Request $request){
        $simpandatarampcheck = new rampcheck();
        if ($request->file('foto_kendaraan') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('foto_kendaraan');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/rampcheck', $fileup);
        }

        $simpandatarampcheck->no_kendaraan = $request->no_kendaraan;
        $simpandatarampcheck->foto_kendaraan = $fileup;
        $simpandatarampcheck->keterangan = $request->keterangan;
        $simpandatarampcheck->save();
        $notif = "Data RampCheck Berhasil disimpan";
        return redirect()->back()->with('notif',$notif);
    }

    public function ShowRampCheck(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
        $getdata = rampcheck::orderby('id','DESC');
        if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
            $getdata->where('rampcheck.kode_terminal',$datauserid->kode_terminal);
             } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
            $getdata->where('rampcheck.id_bptb',$datauserid->id_bptb);
             } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                $getdata->get();
             }
            $data = $getdata->get();
         $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',10)->first();

        return view('html.rampcheck',compact('data','datauserid','menu','datamenu'));
        } else {
            return redirect('/404');
        } 
    }

    public function updateramcheck($id){
        $upgetdata = rampcheck::where('id',$id)->first();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function updateinputrampcheck(Request $request){
         $simpandatarampcheck = rampcheck::where('id',$request->id)->first();
        // dd($simpandatarampcheck);
        if ($request->file('foto_kendaraan') == "") {
            $fileup = $simpandatarampcheck->foto_kendaraan;
        } else {
            $file = $request->file('foto_kendaraan');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/rampcheck', $fileup);
        }

        $simpandatarampcheck->no_kendaraan = $request->no_kendaraan;
        $simpandatarampcheck->foto_kendaraan = $fileup;
        $simpandatarampcheck->keterangan = $request->keterangan;
        $simpandatarampcheck->save();
        $notif = "Data RampCheck Berhasil diperbaharui";
        return redirect()->back()->with('notif',$notif);
    }

    public function ShowDeleteRampCheck(Request $request){
        $data = rampcheck::where('id',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowBuildingManagement(){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
     //   dd($datauserid);
        $dataasets = building_management::orderby('id','DESC');
        if($datauserid->id_bptb !=null && $datauserid->kode_terminal !=null) {
            $dataasets->where('building_management.kode_terminal',$datauserid->kode_terminal);
             } else if($datauserid->id_bptb !=null && $datauserid->kode_terminal ==null ) {
            $dataasets->where('building_management.id_bptb',$datauserid->id_bptb);
             } else if($datauserid->kode_terminal ==null && $datauserid->id_bptb ==null) {
                $dataasets->get();
            }
            $dataaset = $dataasets->get();

        $terminal = terminal::all();
        $menu = permission_menu::where('id_role',$datauserid->id_role)->where('id_menu',9)->first();

        return view('html.building_management',compact('datauserid','terminal','dataaset','menu','datamenu'));
        } else {
            return redirect('/404');
        } 
    }

    public function ShowSimpanDataAset(Request $request){
        $simpan = new building_management();
        if ($request->file('gambar_barang') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('gambar_barang');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_aset', $fileup);
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpan->kode_terminal = $datauserid->kode_terminal;
        $simpan->id_bptb = $datauserid->id_bptb;
        $simpan->kode_aset = $request->kode_aset;
        $simpan->nama_aset = $request->nama_aset;
        $simpan->tahun_pembelian = $request->tahun_pembelian;
        $simpan->gambar_barang = $fileup;
        $simpan->keterangan = $request->keterangan;
        $simpan->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function updatebuildingmanagement($id){
         $upgetdata = building_management::where('id',$id)
            ->first();
         //   dd($upgetdata);
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $upgetdata  
                ], 201);
    }

    public function updatedataaset(Request $request){
         $simpan = building_management::where('id',$request->id)->first();
        if ($request->file('gambar_barang') == "") {
            $fileup = $simpan->gambar_barang;
        } else {
            $file = $request->file('gambar_barang');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/foto_aset', $fileup);
        }
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpan->kode_aset = $request->kode_aset;
        $simpan->nama_aset = $request->nama_aset;
        $simpan->tahun_pembelian = $request->tahun_pembelian;
        $simpan->gambar_barang = $fileup;
        $simpan->keterangan = $request->keterangan;
        $simpan->save();
        return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function ShowhapusAset(Request $request){
        $data = building_management::where('id',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }



    public function ShowProfilTerminal($id)
    {
         $datamenu = ControllerBackend::PermissionMenu();
       // dd($dataterminal);
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
            $dataterminal = terminal::where('kode_terminal',$id)->first();
            $dataprofil_terminal = profil_terminal::select('*')
                                     ->join('terminal','terminal.kode_terminal','profil_terminal.kode_terminal')
                                     ->orderby('id_profil_terminal', 'DESC')
                                    ->where('profil_terminal.kode_terminal',$id)
                                    ->get();
                                //    dd($dataprofil_terminal);
            $datafasilitasutama = fasilitas_utama::where('kode_terminal',$id)->orderby('id','DESC')->get();
            $datafasilitaspenunjang = fasilitas_penunjang::where('kode_terminal',$id)->orderby('id','DESC')->get();
            $sertifikat = sertifikat::where('kode_terminal',$id)->get();

            return view('html.profil_terminal', compact('dataprofil_terminal', 'dataterminal', 'datauserid','dataterminal','datafasilitasutama','datafasilitaspenunjang','sertifikat','datamenu'));
        } else {
            return redirect('/404');
        }
        // return view('html.profil_terminal');
    }

    public function simpansertifikat(Request $request){
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        $simpan = new building_management();
        if ($request->file('file') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('file');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/sertifikat_2', $fileup);
        }
        $simpansertifikat = new sertifikat();
        $simpansertifikat->nama_file = $request->nama_file;
        $simpansertifikat->file = $fileup;
        $simpansertifikat->kode_terminal = $request->id;
        $simpansertifikat->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function deletesertifikat(Request $request){
        $data = sertifikat::where('id',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }






    public function ShowProfilTerminalPrint($id=null,$type=null)
    {
         $datamenu = ControllerBackend::PermissionMenu();
        $dataterminal = terminal::where('kode_terminal',$id)->first();
        
         $datauserid = ControllerBackend::ShowLoginTopMenu();
        $dataprofil_terminal = profil_terminal::select('*')
                                ->leftjoin('terminal', 'terminal.kode_terminal', 'profil_terminal.kode_terminal')
                                ->orderby('id_profil_terminal', 'DESC')
                                ->where('terminal.kode_terminal',$id)
                                ->limit(4)
                                ->get();
        $data_terminal = profil_terminal::select('*')
                                ->leftjoin('terminal', 'terminal.kode_terminal', 'profil_terminal.kode_terminal')
                                ->orderby('id_profil_terminal', 'DESC')
                                ->where('terminal.kode_terminal',$id)
                                ->first();
        $datafasilitasutama = fasilitas_utama::where('kode_terminal',$id)->orderby('id','DESC')->get();
        $datafasilitaspenunjang = fasilitas_penunjang::where('kode_terminal',$id)->orderby('id','DESC')->get();

        $hitungjumlahsdmpns = sdm::select('*')->leftjoin('terminal','terminal.kode_terminal','sdm.kode_terminal')
                                            ->where('terminal.kode_terminal',$id)
                                            ->where('sdm.tipe','ASN')
                                            ->count();
        $hitungjumlahsdmnonpns = sdm::select('*')->leftjoin('terminal','terminal.kode_terminal','sdm.kode_terminal')
                                            ->where('terminal.id_terminal',$id)
                                            ->where('sdm.tipe','PPNPN')
                                            ->count();
        $hitungjumlahsdmppns = sdm::select('*')->leftjoin('terminal','terminal.kode_terminal','sdm.kode_terminal')
                                            ->where('terminal.kode_terminal',$id)
                                            ->where('sdm.tipe','PPNS')
                                            ->count();
        $hitungjumlahakap = perusahaan_otobus::select('*')->leftjoin('terminal','terminal.kode_terminal','perusahaan_otobus.kode_terminal')
                                            ->where('terminal.kode_terminal',$id)
                                            ->where('perusahaan_otobus.tipe','AKAP')
                                            ->count();
        $hitungjumlahakadp = perusahaan_otobus::select('*')->leftjoin('terminal','terminal.kode_terminal','perusahaan_otobus.kode_terminal')
                                            ->where('terminal.kode_terminal',$id)
                                            ->where('perusahaan_otobus.tipe','AKADP')
                                            ->count();
                                         //   dd($hitungjumlahsdmnonpns);
        $datenow = date('Y-m-d');
        $formatdatenow = date('Y-m-d', strtotime('-1 days', strtotime($datenow)));

        $hitungjumlahkendaraanperhari = kendaraan_tiba::where('terminal_tujuan',$id)->where('tgl',$formatdatenow)->count();
        $hitungjumlahpenumpang = kendaraan_tiba::select('*')
                        ->leftjoin('sdm','sdm.nip','kendaraan_tiba.nip')
                        ->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                        ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                        ->leftjoin('terminal','terminal.id_terminal','kendaraan_tiba.terminal_tujuan')
                        ->where('terminal.kode_terminal',$id)
                        ->where('kendaraan_tiba.tgl',$formatdatenow)
                        ->get();
                  //      dd($hitungjumlahpenumpang);



       // dd($hitungjumlahpenumpang);
        if($datafasilitasutama !=null && $dataterminal !=null &&  $dataprofil_terminal !=null && $data_terminal !=null  ){
        if($type=="dashboard"){
        return view('html.print_profil', compact(
            'dataprofil_terminal', 
            'dataterminal', 
            'datauserid',
            'dataterminal',
            'data_terminal',
            'datafasilitasutama',
            'datafasilitaspenunjang',
            'hitungjumlahsdmpns',
            'hitungjumlahsdmnonpns',
            'hitungjumlahsdmppns',
            'hitungjumlahakap',
            'hitungjumlahakadp',
            'hitungjumlahkendaraanperhari',
            'hitungjumlahpenumpang',
            'datamenu'
        ));
        } else if($type=="web") {
            return view('html.print_web', compact(
            'dataprofil_terminal', 
            'dataterminal', 
            'data_terminal',
            'datafasilitasutama',
            'datafasilitaspenunjang',
            'hitungjumlahsdmpns',
            'hitungjumlahsdmnonpns',
            'hitungjumlahsdmppns',
            'hitungjumlahakap',
            'hitungjumlahakadp',
            'hitungjumlahkendaraanperhari',
            'hitungjumlahpenumpang',
            'datamenu'
        ));
        } else {
        return redirect()->back()->with('notif','Data Belum Ada');
        }
    }
    }

    public function ShowSimpanProfilTerminal(Request $request)
    {

        if ($request->file('kompetensi') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('kompetensi');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/file_kompetensi/', $fileup);
        }


        $simpanprofil_terminal = new profil_terminal();
        $simpanprofil_terminal->kompetensi_file = $fileup;
        $simpanprofil_terminal->kode_terminal = $request->id;
        $simpanprofil_terminal->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function ShowDeleteProfilTerminal(Request $request){
        $data = profil_terminal::where('id_profil_terminal',$request->id)->delete();
            return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function ShowSimpanFasilitasUtama(Request $request){
        $simpan = new fasilitas_utama();
        $simpan->nama_fasilitas_utama = $request->nama_fasilitas_utama;
        $simpan->status_barang_utama = $request->status_barang_utama;
        $simpan->kode_terminal = $request->id;
        $simpan->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function ShowSimpanFasilitasPenunjang(Request $request){
        $simpan = new fasilitas_penunjang();
        $simpan->nama_fasilitas_penunjang = $request->nama_fasilitas_penunjang;
        $simpan->status_barang_penunjang = $request->status_barang_penunjang;
        $simpan->kode_terminal = $request->id;
        $simpan->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function deletefasilitasutama(Request $request){
        $data = fasilitas_utama::where('id',$request->id)->delete();
            return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function deletefasilitaspenunjang(Request $request){
        $data = fasilitas_penunjang::where('id',$request->id)->delete();
            return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function kompetensi_sdm($id){
        $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
        $idsdm =  sdm::where('id',$id)->first();
        $kom = kompetensi_sdm::where('id_sdm',$id)->get();
        return view('html.kompetensi_sdm',compact('datauserid','idsdm','kom','datamenu'));
        } else {
            return redirect('/404');
        }
    }

    public function simpankompetensisdm(Request $request){
        $simpandariomborilsdm = new kompetensi_sdm();
        if ($request->file('file_sdm') == "") {
            $fileup = "-";
        } else {
            $file = $request->file('file_sdm');
            $extfile = $file->getClientOriginalExtension();
            $fileup = rand(100000, 1001238912) . "." . $extfile;
            $file->move('upload/file_kompetensi_sdm', $fileup);
        }
        $simpandariomborilsdm->id_sdm = $request->id;
        $simpandariomborilsdm->nama_file = $request->nama_file;
        $simpandariomborilsdm->file_sdm = $fileup;
        $simpandariomborilsdm->save();
        return redirect()->back()->with('notif','Data berhasil disimpan');
    }

    public function deletekompetensisdm(Request $request){
        $data = kompetensi_sdm::where('id',$request->id)->delete();
        return redirect()->back()->with('notifdelete','Data berhasil dihapus');
    }

    public function fotokendaraantiba($noken,$jam,$hal){
         $datamenu = ControllerBackend::PermissionMenu();
        $datauserid = ControllerBackend::ShowLoginTopMenu();
        if(!empty($datauserid)){
        $data = log_response_gate::where('log_response_gate.nomor_kendaraan',$noken)
                                              ->where('log_response_gate.jam',$jam)
                                              ->get();
                                          //    dd($data);
        return view('html.fotokendaraantiba',compact('datauserid','data','datamenu','hal'));
        } else {
            return redirect('/404');
        }
    }

    public function refreshkendaraan(){
        // $no_kendaraan = "A7764KA";
         // $getdata = helperAPI::api_bagren($no_kendaraan);
         // dd($getdata);
        // print_r($getdata['data'][0]['noken']);
        $datakendaraan = kendaraan::get();
        foreach ($datakendaraan as $val) {
            $getdata = vw_api_tos_spionam_blue::where('noken',$val->no_kendaraan)->get();
            foreach($getdata as $key){
              //  echo $key->perusahaan_id."<br>";
                $updatekend = kendaraan::where('no_kendaraan',$key->noken)->first();
                $updatekend->id_perusahaan_otobus = $key->perusahaan_id;
                $updatekend->tipe_kendaraan = $key->jenis_pelayanan;
                $updatekend->tgl_kadaluarsa = $key->tgl_exp_sk;
                $updatekend->tgl_kadaluarsa_kps = $key->tgl_exp_uji;
                $updatekend->merek = $key->merek;
                $updatekend->tahun = $key->tahun;
                $updatekend->no_kendaraan = $key->noken;
                $updatekend->id_trayek = $key->kode_trayek;
                $updatekend->update();
            }
           // $platno = 'Z7534HDZDD';
           //  $getdata = helperAPI::api_bagren($val->no_kendaraan);
            // $updatekend = kendaraan::where('no_kendaraan',$getdata['data'][0]['noken'])->first();
            // $updatekend->id_perusahaan_otobus = $getdata['data'][0]['perusahaan_id'];
            // $updatekend->tipe_kendaraan = $getdata['data'][0]['jenis_pelayanan'];
            // $updatekend->tgl_kadaluarsa = $getdata['data'][0]['tgl_exp_sk'];
            // $updatekend->tgl_kadaluarsa_kps = $getdata['data'][0]['tgl_exp_uji'];
            // $updatekend->merek = $getdata['data'][0]['merek'];
            // $updatekend->tahun = $getdata['data'][0]['tahun'];
            // $updatekend->no_kendaraan = $getdata['data'][0]['noken'];
            // $updatekend->id_trayek = $getdata['data'][0]['kode_trayek'];
            // $updatekend->update();
            // print_r($getdata['data'][0]['noken']);
        }

        return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function refreshpo(){
        // $no_kendaraan = "A7764KA";
         // $getdata = helperAPI::api_bagren($no_kendaraan);
         // dd($getdata);
        // print_r($getdata['data'][0]['noken']);
        $dataspionam = vw_api_tos_spionam_blue::select('perusahaan_id','nama_perusahaan','jenis_pelayanan','alamat_perusahaan')
                                                ->where('jenis_pelayanan','AKAP')
                                                ->distinct()
                                                ->get();
                                              //  dd($dataspionam);
        foreach ($dataspionam as $val) {
            $simpanPO = new perusahaan_otobus();
            $simpanPO->kode_po = $val->perusahaan_id;
            $simpanPO->nama_po = $val->nama_perusahaan;
            $simpanPO->tipe = $val->jenis_pelayanan;
            $simpanPO->alamat = $val->alamat_perusahaan;
            $simpanPO->save();
            }
     //   }

       // return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }

    public function refreshtrayek(){
        // $no_kendaraan = "A7764KA";
         // $getdata = helperAPI::api_bagren($no_kendaraan);
         // dd($getdata);
        // print_r($getdata['data'][0]['noken']);
        $dataspionam = vw_api_tos_spionam_blue::select('perusahaan_id','nama_perusahaan','jenis_pelayanan','alamat_perusahaan','kode_trayek','nama_trayek','rute')
                                                ->where('jenis_pelayanan','AKAP')
                                                ->distinct()
                                                ->get();
        foreach ($dataspionam as $val) {
            $simpanTRY = new trayek();
            $simpanTRY->kode_trayek = $val->kode_trayek;
            $simpanTRY->nama_trayek = $val->nama_trayek;
            $simpanTRY->rute = $val->rute;
            $simpanTRY->status = 1;
            $simpanTRY->save();
            }
     //   }

       // return redirect()->back()->with('notif','Data berhasil diperbaharui');
    }


}














