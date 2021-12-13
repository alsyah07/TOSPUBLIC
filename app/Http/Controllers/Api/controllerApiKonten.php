<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\MasterSoal;
use App\models\TbMapel;
use App\models\TbTryout;
use App\models\TbSoalText;
use App\models\TbTypesoal;
use App\models\TbMapelKelas;
use App\models\TbTopik;
use App\models\TbTipsTrick;
use App\models\TbPesertaTryout;
use App\models\TbSubTopik;
use App\models\TbSubTopikVideo;
use App\models\KirimJawaban;
use App\models\TbPersoal;
use App\models\TbSkor;
use App\Helpers\HelperKonten;
use Illuminate\Support\Facades\DB;
use App\models\TbSoalTryout;
use App\models\TbReferal;
use App\models\TbRedeem;
use App\models\tb_payment;
use App\models\tb_user_package;
use App\models\tb_package_master;

use App\models\TbTopikFastrack;
use App\models\TbKontenFastrack;
use App\models\MasterFastrack;
use App\models\MnilaiFastrack;
use Intervention\Image\ImageManagerStatic as Image;
class controllerApiKonten extends Controller
{
    // ------------------------API KHUSUS MASTER SOAL-------------------------
    public function MasterKonten(){
        $devent = HelperKonten::helpEvent();
        $dbanner = HelperKonten::helpbanner();
        $dtextDashboard = HelperKonten::helpTextDashboard();
        $dkompetensi = HelperKonten::helpKompetensi();
        $dserbaserbi = HelperKonten::helpSerbaserbi();
        $dtipsTrick = HelperKonten::helpTipsTrick();
        $dversion = HelperKonten::helpVersion();
        $dyoutube = HelperKonten::helpYoutube();

        $dataarray = [
            "event"             => $devent,
            "banner"            => $dbanner,
            "text_dashboard"    => $dtextDashboard,
            "kompetensi"        => $dkompetensi,
            "serbaserbi"        => $dserbaserbi,
            "tipstrick"         => $dtipsTrick,
            "version"           => $dversion,
            "youtube"           => $dyoutube,
        ];
        return  HelperKonten::responapi($dataarray);
    }

    public function Mapel(){
        $dataMapel = TbMapelKelas::select('*')
                    ->leftjoin('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
                    ->leftjoin('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                    ->get();

        return  HelperKonten::responapi($dataMapel);
    }

    public function Topik(){
        $dataTopik = TbTopik::select('*')
                    ->join('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
                    ->get();

        return  HelperKonten::responapi($dataTopik);
    }

    public function SubTopik(){
        $subTopik = TbSubTopik::select('*')
                    ->join('tb_topik','tb_sub_topik.id_topik','=','tb_topik.idtop')
                    ->get();

        return  HelperKonten::responapi($subTopik);
    }

    public function Video(){
        $dataVideo = TbSubTopikVideo::select('*')
                    ->leftjoin('tb_sub_topik','tb_sub_topik_video.id_sub_topik','=','tb_sub_topik.idsubtop')
                    ->leftjoin('tb_video_mapel','tb_sub_topik_video.id_video_mapel','=','tb_video_mapel.idvideomapel')
                    ->get();

        return  HelperKonten::responapi($dataVideo);
    }
    //------------------------------AKHIR API KHUSUS MASTER SOAL------------------------------

    //------------------------------API KHUSUS TRYOUT-----------------------------------
    public function post_tb_peserta_tryout(Request $request){
        if ($request['pilihan1_jurusan']=="undefined"
            || $request['pilihan1_universitas']=="undefined"
            || $request['pilihan2_jurusan']=="undefined"
            || $request['pilihan2_universitas']=="undefined"
            || $request['nisn']=="undefined"
            || $request['tipe_soal']=="undefined"

        ){ 
            $dataPeserta = null;
            $pesanapi ="";
            $apiresponberhasil ="";
            $objectarray ="";
            $link = ""; 

            return HelperKonten::responpeserta($link,$dataPeserta,$pesanapi,$apiresponberhasil,$objectarray);
        } else {
                // $cekkoderef = DB::table('klassku_db.user_login As loginuser')
                //             ->where('loginuser.kode_referal',$request['kode_referal'])
                //             ->first();
                // if ($cekkoderef == null){
                //         $kd_ref = $request['kode_referal'];
                // } else {
                //     $kd_ref = "";
                // }
                    $text = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
                    $panj = 6;
                    $txtl = strlen($text)-1;
                    $koderef = '';
                    for($i=1; $i<=$panj; $i++){
                        $koderef .= $text[rand(0, $txtl)];
                    }  
                    $values = array('kode_referal' => $koderef);
                    $updatekodereferal = DB::table('klassku_db.user_login As loginuser')
                            ->where('loginuser.phonenumber',$request['user_unique_id'])
                            ->update($values);

                    if ($request->file('swafoto')==""){
                        $filebaru = "-";
                    } else {
                        // proses input file dokumen pengumuman
                        $filedok = $request->file('swafoto');
                        $ext = $filedok->getClientOriginalExtension();
                        $filebaru = rand(100000,1001238912).".".$ext;
                        $filebaruup = Image::make($filedok->getRealPath());              
                        $filebaruup->resize(200, 200);
                        $filedok->move('storage/swafoto',$filebaru);
                    //--------------------------------------------batas file upload pengumuman
                    }

                     $cekuniqpeserta = TbPesertaTryout::where('user_unique_id',$request['user_unique_id'])
                        ->first();
                    if($cekuniqpeserta !=null || $cekuniqpeserta !=""){
                         $dataPeserta =  TbPesertaTryout::where('user_unique_id',$request['user_unique_id'])
                        ->first();
                        if ($request->file('swafoto')==""){
                            $upfoto = $request['updatefoto'];
                        } else {
                            $upfoto = $filebaru;
                        }

                        $dataPeserta->tryout_id               = 4;
                        $dataPeserta->user_unique_id          = $request['user_unique_id'];
                        $dataPeserta->pilihan1_jurusan        = $request['pilihan1_jurusan'];
                        $dataPeserta->pilihan1_universitas    = $request['pilihan1_universitas'];
                        $dataPeserta->pilihan2_jurusan        = $request['pilihan2_jurusan'];
                        $dataPeserta->pilihan2_universitas    = $request['pilihan2_universitas'];
                        $dataPeserta->nisn                    = $request['nisn'];
                     //   $dataPeserta->kode_referal            = strtoupper($kd_ref);
                        $dataPeserta->swafoto                 = $upfoto;
                        $dataPeserta->tipe_soal               = $request['tipe_soal'];
                        $dataPeserta->save();
                    }else{
                        $dataPeserta                          = new TbPesertaTryout();

                        $dataPeserta->tryout_id               = 4;
                        $dataPeserta->user_unique_id          = $request['user_unique_id'];
                        $dataPeserta->pilihan1_jurusan        = $request['pilihan1_jurusan'];
                        $dataPeserta->pilihan1_universitas    = $request['pilihan1_universitas'];
                        $dataPeserta->pilihan2_jurusan        = $request['pilihan2_jurusan'];
                        $dataPeserta->pilihan2_universitas    = $request['pilihan2_universitas'];
                        $dataPeserta->nisn                    = $request['nisn'];
                     //   $dataPeserta->kode_referal            = strtoupper($kd_ref);
                        $dataPeserta->swafoto                 = $filebaru;
                        $dataPeserta->tipe_soal               = $request['tipe_soal'];
                        $dataPeserta->save();

                        // $iduser = DB::table(DB::raw('klassku_db.user_login as db_userlogin'))
                        //     ->where('db_userlogin.phonenumber',$request['user_unique_id'])
                        //     ->first();

                        // $simpankodereferal = new TbReferal();
                        // $simpankodereferal->kode_referal = strtoupper($kd_ref);
                        // $simpankodereferal->id_user      = $iduser->ID;
                        // $simpankodereferal->datetime     = strtotime("now");
                        // $simpankodereferal->save();
                    }


                 $apiresponberhasil  = 1200;
                 $pesanapi           = 'Post Peserta Tryout';
                 $objectarray        = 'Post_peserta_Tryout';
                 $notif = "Pendaftaran sudah kami terima, tim akan konfirmasi 1 X 24 jam";
                 return HelperKonten::respondaftarpeserta($dataPeserta,$pesanapi,$apiresponberhasil,$objectarray,$notif);
         }
    }


    public function get_tb_peserta_tryout($tryout_id,$user_unique_id){
        $dataPesertaTryout = TbPesertaTryout::join(DB::raw('klassku_db.user_login As loginuser'),'loginuser.phonenumber','=','tb_peserta_tryout.user_unique_id')
                            ->where('user_unique_id',$user_unique_id)->first();
        $datartyout = TbTryout::first();
        $pesanapi           = "Get Peserta Tryout";
        $apiresponberhasil  = 1100;
        $objectarray        = "tryout";
        $user               = "user";
        $pilihanjurusan     = "pilihan jurusan";
        $bil=$dataPesertaTryout->ID; // Inisialisasi variabel bil ID

        if ($dataPesertaTryout->tipe_soal == "Soshum"){ //Kondisi
            $link = $datartyout->link_tryout_a;
        }else {
            $link = $datartyout->link_tryout_b;
        }

        return  HelperKonten::responpeserta($link,$dataPesertaTryout,$pesanapi,$apiresponberhasil,$objectarray,$tryout_id,$user,$user_unique_id,$pilihanjurusan);
    }

    public function update_tb_peserta_tryout(Request $req){
        $dataPeserta =  TbPesertaTryout::where('tryout_id',$req['tryout_id'])
                        ->where('user_unique_id',$req['user_unique_id'])
                        ->first();

        $dataPeserta['pilihan1_jurusan']        = $req['pilihan1_jurusan'];
        $dataPeserta['pilihan1_universitas']    = $req['pilihan1_universitas'];
        $dataPeserta['pilihan2_jurusan']        = $req['pilihan2_jurusan'];
        $dataPeserta['pilihan2_universitas']    = $req['pilihan2_universitas'];
        $dataPeserta['nisn']                    = $req['nisn'];

        $dataPeserta->update();
        $apiresponberhasil  = 1100;
        $pesanapi           = 'Update Peserta Tryout';
        $objectarray        = 'Update Tryout';
        $link = ""; 
        return HelperKonten::responpeserta($link,$dataPeserta,$pesanapi,$apiresponberhasil,$objectarray);
    }
    //-----------------------------AKHIR API KHUSUS TRYOUT--------------------------

    //-----------------------------API CEK TB REDEEM-----------------------------------
   public function get_cek_tb_redeem($kode_referal){
        $iduser = DB::table(DB::raw('konten_db.tb_referal as db1_tb1'))
                    ->leftJoin(DB::raw('klassku_db.user_login AS db2_tb2'),'db1_tb1.kode_referal','=','db2_tb2.kode_referal')
                    ->where('db1_tb1.kode_referal',$kode_referal)
                    ->orderby('db1_tb1.id','ASC')
                    ->first();

         $datauser = DB::table(DB::raw('konten_db.tb_referal as db1_tb1'))
                    ->leftJoin(DB::raw('klassku_db.user_login AS db2_tb2'),'db1_tb1.id_user','=','db2_tb2.ID')
                    ->leftJoin(DB::raw('klassku_db.tb_payment AS db3_tb3'),'db1_tb1.id_user','=','db3_tb3.user_id')
                    ->where('db1_tb1.kode_referal',$kode_referal)
                    ->where('db3_tb3.status','LUNAS')
                    ->orderby('db1_tb1.id','ASC')
                    ->get();

        $hitungjumlahredeem  = TbReferal::where('kode_referal',$kode_referal)->count();
        if($iduser==null){
            $hitungjumlahreferal = 0;
        } else {
            $hitungjumlahreferal = TbRedeem::where('id_user',$iduser->ID)->count();
        }
        $akumulasireferal    = $hitungjumlahreferal * 5;
        $jumlahreferal       = $hitungjumlahredeem - $akumulasireferal; 



        $apiresponberhasil  = 1100;
        $pesanapi           = 'Get Tb Redeem';
        $objectarray        = 'get_tb_Redeem';
        $objectarray1       = 'jumlah_Redeem';
        return HelperKonten::responkontentryout($datauser,$jumlahreferal,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1);
    }
    // ----------------------------AKHIR CEK TB REDEEM----------------------------------

    //-----------------------------API SOAL TRYOUT--------------------------
    public function get_soal_tryout(){
        $dataTryout = TbTryout::select('*')->first();
       // dd($dataTryout);

        $timestamp_server = time();
        $dummy_timestamp = 1604109600;

        $jeda_waktu = 0;

        // if ($jeda_waktu < 0){
        //     $jeda_waktu = 0;
        // }else{
        //     $jeda_waktu = $jeda_waktu;
        // }
        // $dataSoaltyrout = TbSoalTryout::select('*')->get();

        $dataTahapanSoal = HelperKonten::tahapanTryout();

           // var_dump($soal);
          // $letsoal = $soal;
                $datajoin['dd1']   = MasterSoal::select('ids','tahapan_soal','sumber_soal','gambar_soal','kunci_jawaban','tingkat_kesulitan','judul_soal','ada_text','tb_soal_text.id as idt','text')
                            ->leftJoin('tb_tryout','master_soal.waktu','=','tb_tryout.durasi')
                            ->leftJoin('tb_soal_tryout','master_soal.ids','=','tb_soal_tryout.id_mastersoal')
                            ->leftjoin('tb_soal_text','master_soal.id_text','=','tb_soal_text.id')
                            ->where('master_soal.tahapan_soal','penalaran_umum')
                            ->get();

                $datajoin['dd2']  = MasterSoal::select('ids','tahapan_soal','sumber_soal','gambar_soal','kunci_jawaban','tingkat_kesulitan','judul_soal','ada_text','tb_soal_text.id as idt','text')
                            ->leftJoin('tb_tryout','master_soal.waktu','=','tb_tryout.durasi')
                            ->leftJoin('tb_soal_tryout','master_soal.ids','=','tb_soal_tryout.id_mastersoal')
                            ->leftjoin('tb_soal_text','master_soal.id_text','=','tb_soal_text.id')
                            ->where('master_soal.tahapan_soal','pengetahuan_kuantitatif')
                            ->get();

                $datajoin['dd3']   = MasterSoal::select('ids','tahapan_soal','sumber_soal','gambar_soal','kunci_jawaban','tingkat_kesulitan','judul_soal','ada_text','tb_soal_text.id as idt','text')
                            ->leftJoin('tb_tryout','master_soal.waktu','=','tb_tryout.durasi')
                            ->leftJoin('tb_soal_tryout','master_soal.ids','=','tb_soal_tryout.id_mastersoal')
                            ->leftjoin('tb_soal_text','master_soal.id_text','=','tb_soal_text.id')
                            ->where('master_soal.tahapan_soal','pemahaman_membaca_dan_menulis')
                            ->get();

                $datajoin['dd4']   = MasterSoal::select('ids','tahapan_soal','sumber_soal','gambar_soal','kunci_jawaban','tingkat_kesulitan','judul_soal','ada_text','tb_soal_text.id as idt','text')
                            ->leftJoin('tb_tryout','master_soal.waktu','=','tb_tryout.durasi')
                            ->leftJoin('tb_soal_tryout','master_soal.ids','=','tb_soal_tryout.id_mastersoal')
                            ->leftjoin('tb_soal_text','master_soal.id_text','=','tb_soal_text.id')
                            ->where('master_soal.tahapan_soal','pengetahuan_dan_pemahaman_umum')
                            ->get();

        $apiresponberhasil  = 1200;
        $pesanapi           = 'Get_Soal_Tryout';
        $objectarray        = 'tryout';
        $objectarray1       = 'group_soal';

        return HelperKonten::responapi($dataTryout,$dataTahapanSoal,$dataTryout,$datajoin,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1,$dataTahapanSoal, $timestamp_server,$jeda_waktu);
    }
    //-----------------------------AKHIR API SOAL TRYOUT--------------------------

    //-----------------------------AWAL API GET TB TRYOUT--------------------------
    public function get_tb_tryout($id,$user_unique_id){
        $dataTyout = TbTryout::select('*')
                        ->where('tb_tryout.id',$id)
                        ->first();
        $cekuniqpeserta =  TbPesertaTryout::where('user_unique_id',$user_unique_id)
                            ->first();
        if ($cekuniqpeserta==null){
            $dataPeserta = 0;
        } else {
        $dataPeserta = TbPesertaTryout::where('tryout_id',$id)
                        ->where('user_unique_id',$user_unique_id)
                        ->first();
        }
        $objectarray        = "tryout";
        // dd($dataTyout);

        $pesanapi           = "Get Tryout";
        $apiresponberhasil  = 1000;
        $link = ""; 

    return  HelperKonten::responpeserta($link,$dataTyout,$pesanapi,$apiresponberhasil,$objectarray,$dataPeserta);
    }
     //-----------------------------AKHIR API GET TB TRYOUT--------------------------

    //-----------------------------AWAL API POST KIRIM JAWABAN--------------------------
    public function post_kirim_jawaban(Request $request){
        $datajson = json_encode(request()->all());
        $jsontoarray = json_decode($datajson,true);
        $detail = json_encode($jsontoarray['detail_data']);

        //--------------------------NILAISOAL-----------------------------------
        $datajawaban                    = new KirimJawaban();
        $jumlahPeserta = TbPesertaTryout::count();

        $hasilData = HelperKonten::HasilSkor($jumlahPeserta);

        $datajawaban->id_tryout         = $jsontoarray['id_tryout'];
        $datajawaban->user_unique_id    = $jsontoarray['user_unique_id'];
        $datajawaban->tanggal           = $jsontoarray['tanggal'];
        $datajawaban->durasi            = $jsontoarray['durasi'];
        $datajawaban->jawaban_benar     = $jsontoarray['jawaban_benar'];
        $datajawaban->jawaban_salah     = $jsontoarray['jawaban_salah'];
        $datajawaban->tidak_menjawab    = $jsontoarray['tidak_menjawab'];
        $datajawaban->nilai_total       = $jsontoarray['nilai_total'];
        $datajawaban->detail_data       = $detail;
        $datajawaban->nilai_skor        = $hasilData;

        $datajawaban->save();

        //--------------------------PERSOAL------------------------------
        $tampilData = $jsontoarray['detail_data'];
        $query = TbPersoal::where('user_unique_id',$request['user_unique_id'])
                ->count();

        $jumlahPeserta = TbPesertaTryout::count();

        if($query > 0){
            $dataSimpanPerSoal                    = new TbPersoal();
            $dataSimpanPerSoal->user_unique_id    = $jsontoarray['user_unique_id'];

            $dataSimpanPerSoal->update();
        }else{
            $data = array();
            $no = 1;
            foreach($tampilData as $val){
                $data['id_soal'][$no] = $val['ids'];
                $data['no_urut'][$no] = $val['status'];
                $no++;
            }
            $dataSimpanPerSoal          = new TbPersoal();

            $dataSimpanPerSoal->id_tryout         = $jsontoarray['id_tryout'];
            $dataSimpanPerSoal->user_unique_id    = $jsontoarray['user_unique_id'];

            $dataSimpanPerSoal->soal_1  = $data['no_urut'][1];
            $dataSimpanPerSoal->soal_2  = $data['no_urut'][2];
            $dataSimpanPerSoal->soal_3  = $data['no_urut'][3];
            $dataSimpanPerSoal->soal_4  = $data['no_urut'][4];
            $dataSimpanPerSoal->soal_5  = $data['no_urut'][5];
            $dataSimpanPerSoal->soal_6  = $data['no_urut'][6];
            $dataSimpanPerSoal->soal_7  = $data['no_urut'][7];
            $dataSimpanPerSoal->soal_8  = $data['no_urut'][8];
            $dataSimpanPerSoal->soal_9  = $data['no_urut'][9];
            $dataSimpanPerSoal->soal_10 = $data['no_urut'][10];
            $dataSimpanPerSoal->soal_11 = $data['no_urut'][11];
            $dataSimpanPerSoal->soal_12 = $data['no_urut'][12];
            $dataSimpanPerSoal->soal_13 = $data['no_urut'][13];
            $dataSimpanPerSoal->soal_14 = $data['no_urut'][14];
            $dataSimpanPerSoal->soal_15 = $data['no_urut'][15];
            $dataSimpanPerSoal->soal_16 = $data['no_urut'][16];
            $dataSimpanPerSoal->soal_17 = $data['no_urut'][17];
            $dataSimpanPerSoal->soal_18 = $data['no_urut'][18];
            $dataSimpanPerSoal->soal_19 = $data['no_urut'][19];
            $dataSimpanPerSoal->soal_20 = $data['no_urut'][20];
            $dataSimpanPerSoal->soal_21 = $data['no_urut'][21];
            $dataSimpanPerSoal->soal_22 = $data['no_urut'][22];
            $dataSimpanPerSoal->soal_23 = $data['no_urut'][23];
            $dataSimpanPerSoal->soal_24 = $data['no_urut'][24];
            $dataSimpanPerSoal->soal_25 = $data['no_urut'][25];
            $dataSimpanPerSoal->soal_26 = $data['no_urut'][26];
            $dataSimpanPerSoal->soal_27 = $data['no_urut'][27];
            $dataSimpanPerSoal->soal_28 = $data['no_urut'][28];
            $dataSimpanPerSoal->soal_29 = $data['no_urut'][29];
            $dataSimpanPerSoal->soal_30 = $data['no_urut'][30];
            $dataSimpanPerSoal->soal_31 = $data['no_urut'][31];
            $dataSimpanPerSoal->soal_32 = $data['no_urut'][32];
            $dataSimpanPerSoal->soal_33 = $data['no_urut'][33];
            $dataSimpanPerSoal->soal_34 = $data['no_urut'][34];
            $dataSimpanPerSoal->soal_35 = $data['no_urut'][35];
            $dataSimpanPerSoal->soal_36 = $data['no_urut'][36];
            $dataSimpanPerSoal->soal_37 = $data['no_urut'][37];
            $dataSimpanPerSoal->soal_38 = $data['no_urut'][38];
            $dataSimpanPerSoal->soal_39 = $data['no_urut'][39];
            $dataSimpanPerSoal->soal_40 = $data['no_urut'][40];
            $dataSimpanPerSoal->soal_41 = $data['no_urut'][41];
            $dataSimpanPerSoal->soal_42 = $data['no_urut'][42];
            $dataSimpanPerSoal->soal_43 = $data['no_urut'][43];
            $dataSimpanPerSoal->soal_44 = $data['no_urut'][44];
            $dataSimpanPerSoal->soal_45 = $data['no_urut'][45];
            $dataSimpanPerSoal->soal_46 = $data['no_urut'][46];
            $dataSimpanPerSoal->soal_47 = $data['no_urut'][47];
            $dataSimpanPerSoal->soal_48 = $data['no_urut'][48];
            $dataSimpanPerSoal->soal_49 = $data['no_urut'][49];
            $dataSimpanPerSoal->soal_50 = $data['no_urut'][50];
            $dataSimpanPerSoal->soal_51 = $data['no_urut'][51];
            $dataSimpanPerSoal->soal_52 = $data['no_urut'][52];
            $dataSimpanPerSoal->soal_53 = $data['no_urut'][53];
            $dataSimpanPerSoal->soal_54 = $data['no_urut'][54];
            $dataSimpanPerSoal->soal_55 = $data['no_urut'][55];
            $dataSimpanPerSoal->soal_56 = $data['no_urut'][56];
            $dataSimpanPerSoal->soal_57 = $data['no_urut'][57];
            $dataSimpanPerSoal->soal_58 = $data['no_urut'][58];
            $dataSimpanPerSoal->soal_59 = $data['no_urut'][59];
            $dataSimpanPerSoal->soal_60 = $data['no_urut'][60];
            $dataSimpanPerSoal->soal_61 = $data['no_urut'][61];
            $dataSimpanPerSoal->soal_62 = $data['no_urut'][62];
            $dataSimpanPerSoal->soal_63 = $data['no_urut'][63];
            $dataSimpanPerSoal->soal_64 = $data['no_urut'][64];
            $dataSimpanPerSoal->soal_65 = $data['no_urut'][65];
            $dataSimpanPerSoal->soal_66 = $data['no_urut'][66];
            $dataSimpanPerSoal->soal_67 = $data['no_urut'][67];
            $dataSimpanPerSoal->soal_68 = $data['no_urut'][68];
            $dataSimpanPerSoal->soal_69 = $data['no_urut'][69];
            $dataSimpanPerSoal->soal_70 = $data['no_urut'][70];
            $dataSimpanPerSoal->soal_71 = $data['no_urut'][71];
            $dataSimpanPerSoal->soal_72 = $data['no_urut'][72];
            $dataSimpanPerSoal->soal_73 = $data['no_urut'][73];
            $dataSimpanPerSoal->soal_74 = $data['no_urut'][74];
            $dataSimpanPerSoal->soal_75 = $data['no_urut'][75];
            $dataSimpanPerSoal->soal_76 = $data['no_urut'][76];
            $dataSimpanPerSoal->soal_77 = $data['no_urut'][77];
            $dataSimpanPerSoal->soal_78 = $data['no_urut'][78];
            $dataSimpanPerSoal->soal_79 = $data['no_urut'][79];
            $dataSimpanPerSoal->soal_80 = $data['no_urut'][80];
            $dataSimpanPerSoal->save();

        }

        $data = array();
        $no = 1;
        $cek = HelperKonten::nilaiSkor($jumlahPeserta);

        foreach($tampilData as $val){
            $data['id_soal'][$no] = $val['ids'];
            $no++;
        }

        foreach($data['id_soal'] as $validsoal){
            $no = 1;
            foreach($cek as $vul){
                if ($no==$validsoal){

                $dataSimpanSkor          = new TbSkor();

                $dataSimpanSkor->id_tryout     = $jsontoarray['id_tryout'];
                $dataSimpanSkor->id_soal       = $validsoal;
                $dataSimpanSkor->skor          = $vul;
                $dataSimpanSkor->save();
            }
            $no++;

            }
        }


        $apiresponberhasil  = 1200;
        $pesanapi           = 'Post_kirim_jawaban';
        $objectarray        = 'Post_kirim_jawaban';
        $objectarray1       = 'Detail data';

    return HelperKonten::responkirimjawaban($datajawaban,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1,$jumlahPeserta);
    }
     //-----------------------------AKHIR API POST KIRIM JAWABAN--------------------------

    //-------------------------------AWAL API POST CEK SKOR-------------------------------

    public function post_cek_skor(Request $request){
        $cekuniqpeserta = KirimJawaban::where('id_tryout',$request['id_tryout'])
                        ->where('user_unique_id',$request['user_unique_id'])
                        ->first();

        //--------------------------NILAISOAL-----------------------------------

        if($cekuniqpeserta != null || $cekuniqpeserta= ""){
            $dataCekSkor                    = new KirimJawaban();

            $dataCekSkor->tanggal           = $cekuniqpeserta->tanggal;
            $dataCekSkor->durasi            = $cekuniqpeserta->durasi;
            $dataCekSkor->jawaban_benar     = $cekuniqpeserta->jawaban_benar;
            $dataCekSkor->jawaban_salah     = $cekuniqpeserta->jawaban_salah;
            $dataCekSkor->tidak_menjawab    = $cekuniqpeserta->tidak_menjawab;
            $dataCekSkor->nilai_total       = $cekuniqpeserta->nilai_total;
            $dataCekSkor->detail_data       = $cekuniqpeserta->detail_data;
            $dataCekSkor->nilai_skor        = $cekuniqpeserta->nilai_skor;

            $dataCekSkor->update();
        }


        $apiresponberhasil  = 1200;
        $pesanapi           = 'Post cek skor';
        $objectarray        = 'Post_cek_skor';

        return HelperKonten::responkirimjawaban($dataCekSkor,$pesanapi,$apiresponberhasil,$objectarray);
    }
    //-------------------------------AKHIR API POST CEK SKOR-------------------------------
    
    public function showsimpanredeem(Request $request){
        $joinData      = DB::table(DB::raw('klassku_db.user_login as user'))
            ->where('user.kode_referal',$request['kode_referal'])
            ->first();
            $redeem = TbRedeem::orderby('id','DESC')->where('id_user',$joinData->ID)->count();

            if ($redeem <= 0){
                $dataRedeem                           = new TbRedeem();
                $dataRedeem->id_user                  = $joinData->ID;
                $dataRedeem->no_hp                    = $request['nohp'];
                $dataRedeem->channel                  = $request['channel'];
                $dataRedeem->tanggal                  = date('Y-m-d');
                $dataRedeem->save();
            }
    }

    public function ShowGanjilGenap(Request $request){
        $bil=2340; // Inisialisasi variabel bil dengan nilai 10

        if ($bil % 2 == 0){ //Kondisi
            echo "$bil Merupakan Bilangan Genap"; //Kondisi true
        }else {
            echo "$bil Merupakan Bilangan Ganjil"; //Kondisi false
        }
    }

    public function updateStatusRedeem($id){
        $status = TbRedeem::findOrFail($id)
                ->where('status',1)
                ->where('id',$id)
                ->update(['status' => 2]);
        $apiresponberhasil  = 1200;
        $pesanapi           = 'UpdateStatus';
        $objectarray        = 'update_status_redeem';
        return HelperKonten::responkirimjawaban($status,$pesanapi,$apiresponberhasil,$objectarray);
    }
    public function updateStatusPeserta($id){
        $status = TbPesertaTryout::where('user_unique_id',$id)
                ->first();
         if (empty($status)){
            $notif = "Pendaftaran sudah kami terima, tim akan konfirmasi 1 X 24 jam";
         }
         elseif ($status->status==1){
            $notif = "Pendaftaran sudah kami terima, tim akan konfirmasi 1 X 24 jam";
         } else {
            $notif= "Akun anda sudah disetujui";
         }     
        $apiresponberhasil  = 1200;
        $pesanapi           = 'UpdateStatus';
        $objectarray        = 'update_status_peserta';
        return HelperKonten::responkirimjawaban($status,$pesanapi,$apiresponberhasil,$objectarray,$notif);
    }

    public function ShowTopikFastrack($id){
       // $data = TbTopikFastrack::all();
         $data   = DB::table(DB::raw('klassku_db.tb_mapel as mapel'))
        ->join('konten_db.tb_topik_fastrack as topikfasttrack','topikfasttrack.id_mapel','=','mapel.id')
        ->get();

        $apiresponberhasil  = 1200;
        $pesanapi           = 'datatopikfastarck';
        $objectarray        = 'datatopikfastarck';
        return HelperKonten::responapiall($data,$apiresponberhasil,$pesanapi,$objectarray);
    }

    public function ShowKontenVideo($id,$novideo){
        $datavideofastrack= TbKontenFastrack::where('id_topik_fastrack',$id)
        ->where('no_video',$novideo)
        ->get();
        $apiresponberhasil  = 1200;
        $pesanapi           = 'datavideofastrack';
        $objectarray        = 'datavideofastrack';
        return HelperKonten::responapiall($datavideofastrack,$apiresponberhasil,$pesanapi,$objectarray);
    }

    public function ShowSoalFastrack($id,$tingkat_kesulitan){
        $getdatasoalfastrack   = DB::table(DB::raw('klassku_db.master_soal as mastersoal'))
            ->join('konten_db.tb_master_fastrack as masterfastrack','mastersoal.ids','=','masterfastrack.id_master_soal')
            ->join('konten_db.tb_topik_fastrack as topikfastrack','masterfastrack.id_topik_fastrack','=','topikfastrack.id')
            ->where('masterfastrack.id_topik_fastrack',$id)
            ->where('mastersoal.gambar_soal', '!=' , '')
            ->where('mastersoal.tingkat_soal',$tingkat_kesulitan)
            ->get();
            if ($getdatasoalfastrack=='[]'){
                $datasoalfastrack = null;
            } else {
                $datasoalfastrack = $getdatasoalfastrack;
            }
        $apiresponberhasil  = 1200;
        $pesanapi           = 'soalfastrack';
        $objectarray        = 'soalfastrack';
        return HelperKonten::responapiall($datasoalfastrack,$apiresponberhasil,$pesanapi,$objectarray);
    }

    public function ShowKontenVideoPembahasan($id,$tingkat_kesulitan,$nosoal){
        $datasoalfastrack   = DB::table(DB::raw('klassku_db.master_soal as mastersoal'))
            ->join('konten_db.tb_master_fastrack as masterfastrack','mastersoal.ids','=','masterfastrack.id_master_soal')
            ->join('konten_db.tb_topik_fastrack as topikfastrack','masterfastrack.id_topik_fastrack','=','topikfastrack.id')
            ->where('masterfastrack.id_topik_fastrack',$id)
            ->where('mastersoal.tingkat_soal',$tingkat_kesulitan)
            ->where('mastersoal.no_video',$nosoal)
            ->get();
          //  dd($datasoalfastrack);
        $apiresponberhasil  = 1200;
        $pesanapi           = 'videopambahasan';
        $objectarray        = 'videopambahasan';
        return HelperKonten::responapiall($datasoalfastrack,$apiresponberhasil,$pesanapi,$objectarray);
    }

    public function ShowSimpanNilaiFastrack(Request $request){
            $simpandatanilaifastrack  = new MnilaiFastrack();
            $simpandatanilaifastrack->user_id       = $request['user_id'];
            $simpandatanilaifastrack->id_topik      = $request['id_topik'];
            $simpandatanilaifastrack->tingkat_soal  = $request['tingkat_soal'];
            $simpandatanilaifastrack->jumlah_soal   = $request['jumlah_soal'];
            $simpandatanilaifastrack->jawaban_benar = $request['jawaban_benar'];
            $simpandatanilaifastrack->jawaban_salah = $request['jawaban_salah'];
            $simpandatanilaifastrack->tidak_menjawab= $request['tidak_menjawab'];
            $simpandatanilaifastrack->nilai_akhir   = $request['nilai_akhir'];
            $simpandatanilaifastrack->save();
    }

     public function cek_points($token){
            $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/cek_points/'.$token;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec ($ch);
                    $err = curl_error($ch); 
                    curl_close ($ch);
                    // merubah json menjadi array
                    $tojsons = json_decode($response,TRUE);
            return $tojsons;
    }

    public function updatepoint($token,$point,$activity){
        $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/updatepoint/'.$token.'/'.$point.'/'.$activity;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec ($ch);
                    $err = curl_error($ch); 
                    curl_close ($ch);
                    // merubah json menjadi array
                    $tojsons = json_decode($response,TRUE);
            return $tojsons;
    }

    public function merchant($id=null){
        if($id==null){
        $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/merchant';
        } else {
        $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/merchant/'.$id;
        } 
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec ($ch);
                    $err = curl_error($ch); 
                    curl_close ($ch);
                    // merubah json menjadi array
                    $tojsons = json_decode($response,TRUE);
            return $tojsons;
    }

    public function history_merchant($id=null){
         if($id==null){
        $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/history_merchant';
        } else {
        $url = 'http://klasskupoint.hermansyahali.my.id/api/v1/history_merchant/'.$id;
        } 
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec ($ch);
                    $err = curl_error($ch); 
                    curl_close ($ch);
                    // merubah json menjadi array
                    $tojsons = json_decode($response,TRUE);
            return $tojsons;

    }
    public function user_merchant(Request $request){
        $post = [
            'user_id' => $request->user_id,
            'user_token' => $request->user_token,
            'merchant_id'   => $request->merchant_id,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://klasskupoint.hermansyahali.my.id/api/v1/user_merchant');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
      //  var_export($response);
        return $response;
    }
    
}













