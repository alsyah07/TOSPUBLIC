<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\helperAPI;
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
use App\models\log_tiket_user;
use App\models\log_tiket_users;
use DB;
use Illuminate\Support\Str;
use App\models\token;
use App\User;
use Carbon\Carbon;
use App\models\typefids;
use App\models\vw_api_tos_spionam_blue;
use Illuminate\Support\Facades\Auth;

class ApiControllerTos extends Controller
{
    public function apitoken(Request $request){
            $token = Str::random(60);
            $user = User::find(1);
            $user->api_token = hash('sha256', $token); // <- This will be used in client access
            $user->save();
 
        return response()->json(['success'=>$token],200); 
    }

    // public function logintoken(Request $request){

    //         if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
    //         $user = Auth::user();
    //         $tokenResult =  $user->createToken('Personal Access Token');
    //         $token = $tokenResult->token;
    //         if($request->remember_me){
    //             $token->expires_at = Carbon::now()->addWeeks(1);
    //         }
    //         $token->save();
 
    //         return response()->json([
    //             'access_token'=>$tokenResult->accessToken,
    //             'token_type' => 'Bearer', 
    //             'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
    //         ]);
    //     }else{
    //         return response()->json(['error'=>'Unauthorized'],401);
    //     }
    // }

    public function ShowApiSpionam(Request $request){
        $jumlahgateterminal = terminal::where('kode_terminal',$request->kode_terminal)->first(); 
        $no_kendaraan = $request->nomor_kendaraan;
        $kode_terminal  = $request->kode_terminal;
        $tanggal      = $request->tanggal;
        $jam          = $request->jam;
        $statusbus = "IN";
        // data non maksimal
        if($jumlahgateterminal->max_open_gate==0){
                $type= "all";
                $data = helperAPI::SaveLoggate($no_kendaraan,$kode_terminal,$tanggal,$jam,$type,$statusbus);
                return helperAPI::responAll($data);

        // data maksimal
        } else {
            $type= "max";
            $data = helperAPI::SaveLoggate($no_kendaraan,$kode_terminal,$tanggal,$jam,$type,$statusbus);
            return helperAPI::responAll($data);
        }

    }

    public function ShowApiResponseGate(Request $request){
        $data = helperAPI::SaveResponseGate($request->all());
      //  $data['status_kendaraan'] = "IN";
        return helperAPI::responAll($data);
    }

    public function ShowApiResponseGateOut(Request $request){
        $data = helperAPI::SaveResponseGateOut($request->all());
      //  $data['status_kendaraan'] = "OUT";
        return helperAPI::responAll($data);
    }

    public function ShowSimpanFasilitas(Request $request){
        $savefasilitas = new fasilitas();
        $savefasilitas->id_terminal = $request->id_terminal;
        $savefasilitas->nama_fasilitas = $request->nama_fasilitas;
        $savefasilitas->kategori    = $request->kategori;
        $savefasilitas->gambar_fasilitas    = $request->gambar_fasilitas;
        $savefasilitas->deskripsi       = $request->deskripsi;
        $savefasilitas->save();
        return response()->json(['success'=>'Ajax request submitted successfully']);
    }

    public function ShowFasilitas(){
        $data = fasilitas::orderby('id_fasilitas','DESC')->get();
        return response()->json([
                'success' => true,
                'message' => 'Update data',
                'data'    => $data  
                ], 201);    
    }

    public function ShowGetDataPOKendaraan($id){
        $data = kendaraan_tiba::select('*')
            // ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
            // ->leftjoin('kendraaan','kendaraan_tiba.no_kendaraan','kendaraan.no_kendaraan')
            ->leftjoin('terminal','terminal.id_terminal','kendaraan_tiba.terminal_tujuan')
            ->where('terminal.id_terminal',$id)
            ->first();
       //     dd($data);

            $updatedatekendaraantiba = kendaraan_tiba::select('*')->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')->first();
            
        return helperAPI::responAll($data);
    }

    public function ShowGetDataPOKendaraanManual(){
        $data = kendaraan::select('*')
            ->leftjoin('perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus','kendaraan.id_perusahaan_otobus')
            ->leftjoin('kendaraan_tiba','kendaraan_tiba.no_kendaraan','kendaraan.no_kendaraan')
            ->leftjoin('terminal','terminal.id_terminal','kendaraan_tiba.terminal_tujuan')
            ->get();
        return helperAPI::responAll($data);
    }

    public function getdataupdatetikekendaraantiba(Request $request){
        $simpankendaraantiba = kendaraan_tiba::select('*')
                        ->leftjoin('kendaraan','kendaraan_tiba.no_kendaraan','kendaraan.no_kendaraan')
                        ->leftjoin('perusahaan_otobus','kendaraan.id_perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus')
                        ->leftjoin('terminal','terminal.id_terminal','kendaraan_tiba.terminal_tujuan')
                        ->where('terminal.kode_terminal',$request->kode_terminal)
                        ->where('kendaraan_tiba.jam',$request->jam)
                        ->first();
         $hitungpenumpang = intval($simpankendaraantiba->jumlah_penumpang_naik) + 1;
         $simpankendaraantiba->jumlah_penumpang_naik = $hitungpenumpang;
         $simpankendaraantiba->update();
         // $savelogtiket = new log_tiket_user();
         // $savelogtiket->nik = $nik;
         // $savelogtiket->save();
         $response = response()->json(
            [
                'api_status'         => '1',
                'api_response_code'  => 200,
                'api_message'        => 'Data masuk',
                'response' => $simpankendaraantiba,
            ]);

            return $response;

    }

     public function ShowDataPO(){
        $perusahaan_otobus = perusahaan_otobus::all();  
        return helperAPI::responAll($perusahaan_otobus);
    }

    public function ShowDataKota(){
        // $dataterminal = kota::select('terminal.id_kota','kota.nama_kota','terminal.id_bptd')->join('terminal','kota.id_kota','terminal.id_kota')
        //                                     ->where('terminal.id_bptd',5)
        //                                     ->distinct()
        //                                    // ->limit(4)
        //                                     ->get();  
        $dataterminal = kota::select('terminal.id_kota','kota.nama_kota','terminal.id_bptd')->join('terminal','kota.id_kota','terminal.id_kota')
                                            // ->where('terminal.id_bptd',5)
                                            ->distinct()
                                           // ->limit(4)
                                            ->get();  
   //  dd($dataterminal);
        return helperAPI::responAll($dataterminal);
    }

    public function ShowDataTerminal($id){
        $dataterminal = terminal::where('id_kota',$id)->get();  
       // dd($dataterminal);
        return helperAPI::responAll($dataterminal);
    }
    public function ShowGetDipass(Request $request){
        $cek = vw_api_tos_spionam_blue::where('noken',$request->noken)->count();
        if($cek > 0){
            $simpangetdipass = new vw_api_tos_spionam_blue();
            $simpangetdipass->perusahaan_id = $request->perusahaan_id;
            $simpangetdipass->jenis_pelayanan = $request->jenis_pelayanan;
            $simpangetdipass->nama_perusahaan    = $request->nama_perusahaan;
            $simpangetdipass->alamat_perusahaan = $request->alamat_perusahaan;
            $simpangetdipass->no_sk = $request->no_sk;
            $simpangetdipass->tgl_exp_sk = $request->tgl_exp_sk;
            $simpangetdipass->no_uji = $request->no_uji;
            $simpangetdipass->tgl_exp_uji = $request->tgl_exp_uji;
            $simpangetdipass->merek = $request->merek;
            $simpangetdipass->tahun = $request->tahun;
            $simpangetdipass->noken = $request->noken;
            $simpangetdipass->kode_trayek = $request->kode_trayek;
            $simpangetdipass->nama_trayek    = $request->nama_trayek;
            $simpangetdipass->rute = $request->rute;
            $simpangetdipass->masa_berlaku_blue  = $request->masa_berlaku_blue;
            $simpangetdipass->save();
        } else {
            $simpangetdipass = vw_api_tos_spionam_blue::where('noken',$request->noken)->first();
            $simpangetdipass->perusahaan_id = $request->perusahaan_id;
            $simpangetdipass->jenis_pelayanan = $request->jenis_pelayanan;
            $simpangetdipass->nama_perusahaan    = $request->nama_perusahaan;
            $simpangetdipass->alamat_perusahaan = $request->alamat_perusahaan;
            $simpangetdipass->no_sk = $request->no_sk;
            $simpangetdipass->tgl_exp_sk = $request->tgl_exp_sk;
            $simpangetdipass->no_uji = $request->no_uji;
            $simpangetdipass->tgl_exp_uji = $request->tgl_exp_uji;
            $simpangetdipass->merek = $request->merek;
            $simpangetdipass->tahun = $request->tahun;
            $simpangetdipass->noken = $request->noken;
            $simpangetdipass->kode_trayek = $request->kode_trayek;
            $simpangetdipass->nama_trayek    = $request->nama_trayek;
            $simpangetdipass->rute = $request->rute;
            $simpangetdipass->masa_berlaku_blue  = $request->masa_berlaku_blue;
            $simpangetdipass->update();
        }
        return helperAPI::responAll($simpangetdipass);
    }
    public function ShowGetSpionamKendaraan(Request $request){
        $cek = spionam_kendaraan::where('noken',$request->noken)->count();
        if($cek > 0){
            $simpangetspionam = new spionam_kendaraan();
            $simpangetspionam->perusahaan_id    = $request->perusahaan_id;
            $simpangetspionam->jenis_pelayanan  = $request->jenis_pelayanan;
            $simpangetspionam->no_uji           = $request->no_uji;
            $simpangetspionam->tgl_exp_uji      = $request->tgl_exp_uji;
            $simpangetspionam->no_kps           = $request->no_kps;
            $simpangetspionam->tgl_exp_kps      = $request->tgl_exp_kps;
            $simpangetspionam->no_rangka        = $request->no_rangka;
            $simpangetspionam->no_mesin         = $request->no_mesin;
            $simpangetspionam->merek            = $request->merek;
            $simpangetspionam->tahun            = $request->tahun;
            $simpangetspionam->noken            = $request->noken;
            $simpangetspionam->kode_trayek      = $request->kode_trayek;
            $simpangetspionam->nama_trayek      = $request->nama_trayek;
            $simpangetspionam->masa_berlaku     = $request->masa_berlaku;
            $simpangetspionam->no_reg_kend     = $request->no_reg_kend;
            $simpangetspionam->rute             = $request->rute;
            $simpangetspionam->save();
        } else {
            $simpangetspionam = spionam_kendaraan::where('noken',$request->noken)->first();
            $simpangetspionam->perusahaan_id    = $request->perusahaan_id;
            $simpangetspionam->jenis_pelayanan  = $request->jenis_pelayanan;
            $simpangetspionam->no_uji           = $request->no_uji;
            $simpangetspionam->tgl_exp_uji      = $request->tgl_exp_uji;
            $simpangetspionam->no_kps           = $request->no_kps;
            $simpangetspionam->tgl_exp_kps      = $request->tgl_exp_kps;
            $simpangetspionam->no_rangka        = $request->no_rangka;
            $simpangetspionam->no_mesin         = $request->no_mesin;
            $simpangetspionam->merek            = $request->merek;
            $simpangetspionam->tahun            = $request->tahun;
            $simpangetspionam->noken            = $request->noken;
            $simpangetspionam->kode_trayek      = $request->kode_trayek;
            $simpangetspionam->nama_trayek      = $request->nama_trayek;
            $simpangetspionam->masa_berlaku     = $request->masa_berlaku;
            $simpangetspionam->no_reg_kend     = $request->no_reg_kend;
            $simpangetspionam->rute             = $request->rute;
            $simpangetspionam->update();
        }
        
        return helperAPI::responAll($simpangetspionam);
    }
     public function ShowGetSpionamPerusahaan(Request $request){
        $simpangetspionam = new spionam_perusahaan();
        $simpangetspionam->perusahaan_id    = $request->perusahaan_id;
        $simpangetspionam->nama_perusahaan  = $request->nama_perusahaan;
        $simpangetspionam->alamat           = $request->alamat;
        $simpangetspionam->no_sk            = $request->no_sk;
        $simpangetspionam->tgl_exp_sk       = $request->tgl_exp_sk;
        $simpangetspionam->save();
        return helperAPI::responAll($simpangetspionam);
    }
    public function ShowGeBlue(Request $request){
        $simpangeteblue = new eblue();
        $simpangeteblue->nama_pemilik               = $request->nama_pemilik;
        $simpangeteblue->alamat_pemilik             = $request->alamat_pemilik;
        $simpangeteblue->no_registrasi_kendaraan    = $request->no_registrasi_kendaraan;
        $simpangeteblue->no_rangka                  = $request->no_rangka;
        $simpangeteblue->no_mesin                   = $request->no_mesin;
        $simpangeteblue->jenis_kendaraan            = $request->jenis_kendaraan;
        $simpangeteblue->merk                       = $request->merk;
        $simpangeteblue->tipe                       = $request->tipe;
        $simpangeteblue->keterangan_hasil_uji       = $request->keterangan_hasil_uji;
        $simpangeteblue->masa_berlaku               = $request->masa_berlaku;
        $simpangeteblue->petugas_penguji            = $request->petugas_penguji;
        $simpangeteblue->nrp_petugas_penguji        = $request->nrp_petugas_penguji;
        $simpangeteblue->unit_pelaksana_teknis      = $request->unit_pelaksana_teknis;
        $simpangeteblue->save();   
        return helperAPI::responAll($simpangeteblue); 
    }

    public function gShowDataKendaraan1($nokendaraan){
        $datakendaraan= Array([
            'nomor_kendaraan' => "A12345678CD",
            'nomor_rangka' => '1234567',
            'nomor_mesin' => '0807078786',
            'merek' => 'HINO',
            'jenis_kendaraan' => 'Bus Sedang',
            'kapasitas'=> '20',
            'tipe'=> 'AKAP',
            'id_perusahaan_otobus'=> '1',
            'id_trayek'=> '1',
            'no_uji'=> '02112021',
            'tgl_kadaluarsa'=> '2021-10-26',
            'no_kps'=> '8945784655657',
            'tgl_kadaluarsa_kps'=> '2020-10-26',
            'no_srut' => '36583748',
            'masa_berlaku_kendaraan' => '2021-12-15'
        ]);

        foreach ($datakendaraan as $key => $value) {
            if($nokendaraan == $value['nomor_kendaraan']){
                 return helperAPI::responAll($datakendaraan); 
            }
        }
       // return $datakendaraan; 
    }

    public function gShowDataKendaraan($nokendaraan){
        $dataspionam = spionam_kendaraan::where('noken',$nokendaraan)->first();
        return helperAPI::responAll($dataspionam); 
    }

    public function gShowInputChecker($nokend){
        $datakendaraan = kendaraan::select('*')->leftjoin('kendaraan_tiba','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                                                    ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                                                    ->leftjoin('trayek','trayek.kode_trayek','kendaraan.id_trayek')
                                                    ->leftjoin('terminal','terminal.id_terminal','kendaraan_tiba.terminal_tujuan')
                                                    ->where('kendaraan.no_kendaraan',$nokend)
                                                    ->first();
        return helperAPI::responAll($datakendaraan); 
    }

    public function swinggate(Request $request){
        $datenow = date('Y-m-d');
        $cekdatatiketuser = log_tiket_users::select('*')->leftjoin('tiket_user_vending_mesin','tiket_user_vending_mesin.nik','log_tiket_users.nik')
                                            ->where('log_tiket_users.nik',$request->nik)
                                            // ->where('log_tiket_users.kode_po',$request->kode_po)
                                            // ->where('log_tiket_users.kode_terminal',$request->kode_terminal)
                                            ->first();
       if(is_null($cekdatatiketuser)){
            $res = "Data tidak tersedia, Silahkan coba kembali";
            $st = 110;
            $status = false;
       } else if ($cekdatatiketuser->status_tiket=="OPEN"){
            $res = "Tiket sudah digunakan";
            $st = 112;
            $status = false;
       } else if($cekdatatiketuser->tgl_tiket != $request->tgl_masuk_tiket){
            $res = "Tiket Expired";
            $st = 113;
            $status = false;
       } else {
            $res = "Tiket Sukses";
            $st = 114;
            $status = true;

            $updatetiketuser = log_tiket_users::where('nik',$request->nik)->first();
            $updatetiketuser->tgl_masuk_tiket = $request->tgl_masuk_tiket;
            $updatetiketuser->jam_masuk_tiket = $request->jam_masuk_tiket;
            $updatetiketuser->kode_terminal = $request->kode_terminal;
            $updatetiketuser->kode_po = $request->kode_po;
            $updatetiketuser->status_tiket = $request->status_tiket;
            $updatetiketuser->update();

       }

       $response = response()->json(
            [
                'api_status'         => $st,
                'api_response_code'  => 200,
                'api_message'        => $res,
                'response'           => $status,
        ]);

         return $response; 
    }

    public function gettiketuser(){
        $data = log_tiket_users::select('*')->join('tiket_user_vending_mesin','log_tiket_users.id_tiket_user_vending_mesin','tiket_user_vending_mesin.id_data_tiket_user')->get();
        $data['terminal'] = [
            "kode_terminal" => "GMT"
        ];
        return helperAPI::responAll($data); 
    }

    public function grafik($tahun=null,$tahunend=null){
        $datagrafikkendaraan = kendaraan::select('*')->leftjoin('perusahaan_otobus','kendaraan.id_perusahaan_otobus','perusahaan_otobus.id_perusahaan_otobus')
        ->where('tipe_kendaraan','AKAP')
        ->distinct()
       // ->where('kendaraan.tahun',$tahun)
        ->whereBetween('kendaraan.tahun',[$tahun,$tahunend])                                           // 
        ->get();
        return helperAPI::responAll($datagrafikkendaraan); 
    }

   public function typefids(){
        $data = typefids::all();
        return response()->json($data);
    }



}































