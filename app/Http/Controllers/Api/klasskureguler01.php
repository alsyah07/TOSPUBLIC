<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\HelperReguler;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\models\TbTugasGuru; //Database -> KlasskuGuru

class klasskureguler extends Controller{

    public function indexreguler_get(){
        $data = array('status'=>'invalid', 'err'=>'Invalid Request');
        return response()->json($data);
    }

    public function get_searchsubtopik($idtopik=null,$idkelas=null,$keyword=null){
        $rubahspasipencarian = $keyword;
        $textspasi = str_replace("%20"," ",$rubahspasipencarian);

        $data = DB::table(DB::raw('klassku_db.tb_sub_topik'))
                ->leftJoin(DB::raw('klassku_db.tb_topik'),'tb_topik.idtop','=','tb_sub_topik.id_topik')
                ->leftJoin(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
                ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
                //ambil video
                ->join(DB::raw('klassku_db.tb_sub_topik_video'),'tb_sub_topik_video.id_sub_topik','=','tb_sub_topik.idsubtop')
                ->join(DB::raw('klassku_db.tb_video_mapel'),'tb_video_mapel.idvideomapel','=','tb_sub_topik_video.id')
                ->where('tb_sub_topik.id_topik',$idtopik)
                ->where('sub_topik_mapel','like',"%".$textspasi."%")
                ->get();

        $resultsubtopik = $data->toArray();

        if(empty($resultsubtopik)){
            $data = array('status'=>'gagal','kode'=>0,'datasubtopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datasubtopik'=>$resultsubtopik);
        }

        return response()->json($data);
    }

    public function get_searchklasskutopik($idmapel=null,$idkelas=null,$keyword=null){
        $rubahspasipencarian = $keyword;
        $textspasi = str_replace("%20"," ",$rubahspasipencarian);

        $dataquerytopik = DB::table(DB::raw('klassku_db.tb_topik'))
            ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
            ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel.id','=','tb_mapel_kelas.id_mapel')
            ->where('tb_mapel_kelas.id_mapel',$idmapel)
            ->where('tb_mapel_kelas.id_kelas',$idkelas)
            ->where('tb_topik.topik_mapel','like',"%".$textspasi."%")
            ->get();
        $dataresulttopik = $dataquerytopik->toArray();
        $hitungtopik = $dataquerytopik->count();
        if (empty($dataresulttopik)){
            $data = array('status'=>'gagal','kode'=>0,'datatopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datatopik'=>$dataresulttopik,'jumtopik'=>$hitungtopik);
        }

        return response()->json($data);
    }

    public function get_majorbyuser($phonenumber=null,$jenjang=null,$kelas=null,$sekolah=null){
        if($phonenumber == null){
            $dbanner = HelperReguler::helpbanner();
            $dtextDashboard = HelperReguler::helpTextDashboard();
            $devent = HelperReguler::helpEvent();
            $dtrialKonten = HelperReguler::helpTrialKonten();
            $dtrialBankSoal = HelperReguler::helpTrialBankSoal();
            $dVersion = HelperReguler::helpVersion();
            $dYoutube = HelperReguler::helpYoutube();

            $dataArray = [
                'status'=>'sukses',
                'kode'=>1,
                "benner" => $dbanner,
                "textdashboard" => $dtextDashboard,
                "datauser" => null,
                "dataevent" => $devent,
                "trialkonten" => $dtrialKonten,
                "trialbanksoal" => $dtrialBankSoal,
                "versiklassku" => $dVersion,
                "kontenyoutube" => $dYoutube
            ];
        }elseif($phonenumber != null){
            $dbanner = HelperReguler::helpbanner();
            $dtextDashboard = HelperReguler::helpTextDashboard();
            $dhelpDataUser = HelperReguler::helpDataUser($phonenumber);
            $iduserLogin = HelperReguler::helpUserId($phonenumber,$sekolah);
            $dhelpMapel = HelperReguler::helpMapel($iduserLogin);
            $dhelpbanksoalTopik = HelperReguler::helpbanksoalTopik($phonenumber,$jenjang,$kelas);
            $dhelpTypesoal = HelperReguler::helpTypesoal();
            $devent = HelperReguler::helpEvent();
            $dtrialKonten = HelperReguler::helpTrialKonten();
            $dtrialBankSoal = HelperReguler::helpTrialBankSoal();
            $dVersion = HelperReguler::helpVersion();
            $dYoutube = HelperReguler::helpYoutube();

            if (empty($dhelpMapel)){
                $dataArray = array('status'=>'gagal','kode'=>0,'datapelajaran'=>'gagal');
            }else {
                $dataArray = array(
                    'status'=>'sukses',
                    'kode'=>1,
                    'datapelajaran'=>$dhelpMapel,
                    'datauser'=>$dhelpDataUser,
                    'datatopik' => $dhelpbanksoalTopik,
                    'typesoal' => $dhelpTypesoal,
                    'benner'=>$dbanner,
                    'dataevent' => $devent,
                    'textdashboard'=>$dtextDashboard,
                    'trialkonten' => $dtrialKonten,
                    'trialbanksoal' => $dtrialBankSoal,
                    'versiklassku' => $dVersion,
                    'kontenyoutube' => $dYoutube,
                );
            }
        }

        return response()->json($dataArray);
    }

    public function get_tugasbelajar($idmapel=null,$namasekolah=null,$kelas=null,$idtugas=null){
        $data = TbTugasGuru::select('*')
            ->leftjoin(DB::raw('klassku_db.tb_mapel as dt2'),'dt2.id','=','tb_tugas.id_mapel')
            ->leftjoin('users','users.id','=','tb_tugas.id_guru')
            ->leftjoin(DB::raw('klassku_db.tb_topik as dt3'),'dt3.idtop','=','tb_tugas.id_topik')
            ->where('users.nama_sekolah',str_replace("%20"," ",$namasekolah))
            ->where('tb_tugas.kelas', $kelas)
            ->get();

            if($idtugas == null){
            $data = TbTugasGuru::select('*')
                ->where('tb_tugas.id_mapel',$idmapel)
                ->get();
            }else{
            $data = TbTugasGuru::select('*')
                ->where('tb_tugas.id',$idtugas)
                ->get();
            }

            $dataresult = $data->toArray();
            if (empty($dataresult)){
                $data = array('status'=>'gagal','kode'=>0,'datalaci'=>'gagal');
            } else {
            $data = array(
                'status'=>'sukses',
                'kode'=>1,
                'datalaci' => $dataresult,
            );
            }
        return response()->json($data);
    }

    public function get_pengumumanlacibelajar($kelas=null,$namasekolah=null,$idpeng=null){
        $datapengumuman = DB::table(DB::raw('klassku_guru.tb_pengumuman'))
                ->leftjoin(DB::raw('klassku_db.tb_mapel'),'tb_mapel.id','=','tb_pengumuman.id_mapel')
                ->leftjoin(DB::raw('klassku_guru.users'),'users.id','=','tb_pengumuman.id_guru')
                ->where('users.nama_sekolah',str_replace("%20"," ",$namasekolah))
                ->orderBy('tb_pengumuman.id','DESC')
                ->get();

        if($idpeng==null) {
            $datapengumuman->where('tb_pengumuman.kelas',$kelas);
        } else {
            $datapengumuman->where('tb_pengumuman.id',$idpeng);
        }
        $query = $datapengumuman;
        $dataresult = $query->toArray();

        $ambilpengumumanbaca = DB::table(DB::raw('klassku_guru.tb_pengumuman_read'))
                            ->where('id_pengumuman')
                            ->get();
        $querypen = $ambilpengumumanbaca;
        $dataresultreadpeng = $querypen->toArray();

        if (empty($dataresult)){
            $data = array('status'=>'gagal','kode'=>0,'datapengumuman'=>'gagal');
            } else {
            $data = array(
                'status'=>'sukses',
                'kode'=>1,
                'datapengumuman' => $dataresult,
                'readpengumuman' => $dataresultreadpeng,
            );
        }
        return response()->json($data);
    }

    public function subcribepengumuman_post(Request $request){
        $tambahpengumuman = [
            'id_pengumuman' => $request->id_pengumuman,
            'id_siswa'      => $request->id_siswa,
            'tgl_baca'      => date('Y-m-d')
        ];

        $val = DB::table(DB::raw('klassku_guru.tb_pengumuman_read'))->insert($tambahpengumuman);

        return response()->json($val);
    }

    public function uploadtugastoguru_post(Request $request){
        if(!$request->file['file_attachment']['name']){
            $res        = array();
            $name       = 'Klassku';
            $imagePath  = public_path() . '/assets/upload/file_attachment';
            $formatnya  = $request['typefile'];
            $ambiltype  = explode("/",$formatnya);
            $temp       = explode(".",$request->hasFile['file_attachment']['name'].".".$ambiltype[0]);
            $extension  = end($temp);
            $filenew    = str_replace($request->hasFile['file_attachment']['name'],$name,$request->hasFile['file_attachment']['name']).'_'.time().''. "." .$extension;
            $config['file_name']   = $filenew;
            $config['upload_path'] = $imagePath;

            // $fileName = Carbon::now()->timestamp . $request->file( 'file_attachment' )->getClientOriginalName();
            // $request->file( 'file' )->move( 'assets/upload/file_attachment', $fileName );
            //$filenew = url( 'assets/upload/file_attachment/' . $fileName );

            $dataInsert = array(
                'notes'             => $request['catatan'],
                'tgl_submit'        => date('Y-m-d h:i:s'),
                'id_tugas'          => $request['id_tugas'],
                'id_siswa'          => $request['id_siswa'],
                'dokument_submit'   => $filenew,
            );
            DB::table(DB::raw('klassku_guru.tb_tugas_submit'))->insert($dataInsert);

            if(!$request->file('file_attachment')){
                $data = array('msg' => 'error upload');
                return response()->json($data);
            }else{
                $data = $request->data();
                if(!empty($data['file_name'])){
                    $res['image_url'] = 'assets/upload/file_attachment/'.$data['file_name'];
                }if(!empty($res)){
                    echo json_encode(array("status" => 1, "data" => array() ,"msg" => 'upload successfully', 'url' => url(), "count" => '0'));
                }else{
                    echo json_encode(array("status" => 1,"data" => array() ,"msg" => 'not found', 'url' => url(), "count" => '0'));
                }
            }

        }
    }

    public function get_sekolah(){
        $dsekolah = DB::table(DB::raw('klassku_guru.tb_sekolah'))->get();
        $dataArray = $dsekolah->toArray();

        if (empty($dataArray)){
            $data = array('status'=>'gagal','kode'=>0,'datasekolah'=>'gagal');
        } else {
            $data = array(
                'status'=>'sukses',
                'kode'=>1,
                'datasekolah' => $dataArray,
            );
        }
        return response()->json($data);
    }

    public function get_kelasuser($userid=null){
        $datafbuid = DB::table(DB::raw('klassku_db.user_login'))
                ->where(array('fbuid' => $userid))
                ->first()->ID;

        $dataPermission = DB::table(DB::raw('klassku_db.tb_permission'))
                    ->select([DB::raw('DISTINCT(tb_kelas.kelas)'), 'tb_kelas.*'])
                    ->join(DB::raw('klassku_db.user_login'),'user_login.ID','=','tb_permission.user_id')
                    ->join(DB::raw('klassku_db.tb_topik'),'tb_topik.idtop','=','tb_permission.topik_id')
                    ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
                    ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
                    ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel.id','=','tb_mapel_kelas.id_mapel')
                    ->orderBy('tb_kelas.kelas','DESC')
                    ->where('tb_permission.user_id',$datafbuid)
                    ->get();

        $dataresult = $dataPermission->toArray();
        if (empty($dataresult)){
            $data = array('status'=>'gagal','kode'=>0,'datatopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datakelas'=>$dataresult);
        }
        return response()->json($data);
    }

    public function get_mapelkelasuser($idkelas=null){
        $data = DB::table(DB::raw('klassku_db.tb_kelas'))
            ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel.id','=','tb_mapel_kelas.id_mapel')
            ->where('tb_kelas.idkelas',$idkelas)
            ->get();

        $dataresult = $data->toArray();
        if (empty($dataresult)){
            $data = array('status'=>'gagal','kode'=>0,'datapelajaran'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datapelajaran'=>$dataresult);
            // datauser untuk beranda
        }
        return response()->json($data);
    }

    public function get_topik($idmapel=null ,$fbuid=null,$idkelas=null){
        $userid = DB::table(DB::raw('klassku_db.user_login'))
                    ->where(array('phonenumber' => $fbuid))
                    ->first()->ID;

        $dataPermission = DB::table(DB::raw('klassku_db.tb_permission'))
                    ->join(DB::raw('klassku_db.tb_topik'),'tb_topik.idtop','=','tb_permission.topik_id')
                    ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
                    ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel.id','=','tb_mapel_kelas.id_mapel')
                    ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
                    ->where('tb_mapel_kelas.id_mapel',$idmapel)
                    ->where('tb_permission.user_id',$userid)
                    ->get();

        $dataresulttopik = $dataPermission->toArray();
        if (empty($dataresulttopik)){
            $data = array('status'=>'gagal','kode'=>0,'datatopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datatopik'=>$dataresulttopik);
        }
        return response()->json($data);
    }

    public function get_subtopik($idtopik=null){
        $data = DB::table(DB::raw('klassku_db.tb_sub_topik'))
            ->leftjoin(DB::raw('klassku_db.tb_topik'),'tb_topik.idtop','=','tb_sub_topik.id_topik')
            ->leftjoin(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
            ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
            //ambil poster video
            ->join(DB::raw('klassku_db.tb_sub_topik_video'),'tb_sub_topik_video.id_sub_topik','=','tb_sub_topik.idsubtop')
            ->join(DB::raw('klassku_db.tb_video_mapel'),'tb_video_mapel.idvideomapel','=','tb_sub_topik_video.id')
            ->where('tb_sub_topik.id_topik',$idtopik)
            ->get();

        $resultsubtopik = $data->toArray();
        if(empty($resultsubtopik)){
            $data = array('status'=>'gagal','kode'=>0,'datasubtopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datasubtopik'=>$resultsubtopik);
        }
        return response()->json($data);
    }

    public function get_videomapel($idsubtopik=null,$idkelas=null){
        $data = DB::table(DB::raw('klassku_db.tb_sub_topik_video'))
            ->leftjoin(DB::raw('klassku_db.tb_video_mapel'),'tb_video_mapel.idvideomapel','=','tb_sub_topik_video.id_sub_topik')
            ->leftjoin(DB::raw('klassku_db.tb_sub_topik'),'tb_sub_topik.idsubtop','=','tb_sub_topik_video.id_sub_topik')
            // ambil info kelas jenjang dan jurusan
            ->leftjoin(DB::raw('klassku_db.tb_topik'),'tb_topik.idtop','=','tb_sub_topik.id_topik')
            ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.idmapkelas','=','tb_topik.id_mapel_kelas')
            //ambil jenjang
            ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
            ->where('tb_sub_topik_video.id_sub_topik',$idsubtopik)
            ->get();

        $dataresultvideomapel = $data->toArray();
        if(empty($dataresultvideomapel)){
            $data = array('status'=>'gagal','kode'=>0,'datavideo'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datavideo'=>$dataresultvideomapel);
        }
        return response()->json($data);
    }

    public function get_datenow(){
        date_default_timezone_set('Asia/Jakarta');
        $DateNow = date('m-d-Y');
        echo $DateNow;
    }

    public function get_billget($token=null){
        $userId = DB::table(DB::raw('klassku_db.user_login'))
                ->where(array('phonenumber' => $token))
                ->first()
                ->ID;

        date_default_timezone_set('Asia/Jakarta');
        $DateNow = date('Y-m-d');

        //cek notif pembayaran pertama
        $bayarreguler = DB::table(DB::raw('klassku_db.user_subscriptions'))
                ->where('user_id','=',$userId)
                ->where('payment_status','=','LUNAS')
                ->get();

        $bayartryout = DB::table(DB::raw('klassku_db.tb_payment'))
                ->where('user_id','=',$userId)
                ->where('status','=','LUNAS')
                ->where('payment_channel','=','Tryout')
                ->get();

        $bayarfasttrack = DB::table(DB::raw('klassku_db.tb_payment'))
                ->where('user_id','=',$userId)
                ->where('status','=','LUNAS')
                ->where('payment_channel','=','Fastrack')
                ->get();

        $bayarpaket = DB::table(DB::raw('klassku_db.tb_pembelian'))
                ->where('user_id','=',$userId)
                ->get();

        $datapayreguler             = $bayarreguler->toArray();
        $databayarpaymenttryout     = $bayartryout->first();
        $databayarpaymentfastrack   = $bayarfasttrack->first();
        $datapaypaket               = $bayarpaket->toArray();

        if(empty($datapaypaket)){
            if(empty($datapayreguler)){
                if($databayarpaymenttryout !=null && $databayarpaymentfastrack !=null){  //insert pembayaran pertama
                    $notif = "Transaksi berhasil";
                }
                $notif = "Transaksi berhasil";
                $retdata = array('status'=>'sukses','no_status'=>'0', 'retdatareguler'=>'bayar_awal','retdatatryout'=> $databayarpaymenttryout, 'retdatafastrack'=>$databayarpaymentfastrack, "notif"=>$notif);

                return response()->json($retdata);
            }elseif($datapayreguler){
                if($databayarpaymenttryout !=null && $databayarpaymentfastrack !=null){
                    $notif = "Transaksi berhasil,silahkan lakukan pendaftaran tryout";
                }
                $notif = "Transaksi berhasil,silahkan lakukan pendaftaran tryout";
                $pemlunas = DB::table(DB::raw('klassku_db.user_subscriptions'))
                        ->where('user_id','=',$userId)
                        ->where('payment_status','=','LUNAS')
                        ->get();
                $datalunas = $pemlunas->toArray();
                $retdata = array('status'=>'sukses','no_status'=>'1', 'retdatareguler'=>$datalunas,'retdatatryout'=> $databayarpaymenttryout, 'retdatafastrack'=>$databayarpaymentfastrack,"notif"=>$notif);

                return response()->json($retdata);
            }
        }else{
            if(empty($datapaypaket)){
                // insert pembayaran pertama
                $retdatapaket = array('status'=>'sukses','no_status'=>'0', 'retdatapaket'=>'bayar_awal');
            }elseif($datapaypaket){
                $pemlunas = DB::table(DB::raw('klassku_db.tb_pembelian'))
                        ->where('user_id','=',$userId)
                        ->where('payment_status','=','LUNAS')
                        ->get();
                $datalunas = $pemlunas->toArray();
                $retdatapaket = array('status'=>'sukses','no_status'=>'1', 'retdatapaket'=>$datalunas);

                foreach($datalunas as $val){ // cek tanggal masa aktif dengan tanggal sekarang
                    $lunaspayment = $val->finish_date <= $DateNow;
                    if($lunaspayment){
                        $retdatapaket = array('status'=>'sukses','no_status'=>'2', 'retdata'=>'habis_masa_aktif');

                        return response()->json($retdatapaket);
                    }elseif(!$lunaspayment){

                    }
                }
            }
            return response()->json($retdatapaket);
        }
        if(true){
            $retdata = array('status'=>'sukses','no_status'=>'1');

            return response()->json($retdata);
        }
    }

    public function get_setstat($type=null,$deviceid=null,$fbuid=null,$remark=null,$kelas=null,$mapel=null,$topik=null,$subtopik=null,$video=null,$jenjang=null){
        $userId = DB::table(DB::raw('klassku_db.user_login'))->where(array('fbuid' => trim($fbuid)))->first()->ID;
        $statType = '000';
        if($type == 'Open Klassku'){
            $statType = '001'; // ok
        }
        if($type == 'Login'){
            $statType = '002'; // ok
        }
        if ($type =='Register'){
            $statType ='003'; // ok
        }
        if ($type =='Beranda_Sebelum_Login'){
            $statType ='004'; // ok
        }
        if($type == 'Beranda_Sesudah_Login'){
            $statType = '005'; // ok
        }
        if($type =='Trial_Konten'){ // profile
            $statType ='006'; // ok
        }
        if ($type=='Trial_Bank_Soal'){
            $statType ='007';
        }
        if($type =='konten'){
            $statType ='008'; // ok
        }
        if($type =='Mata_Pelajaran'){
            $statType ='009'; // ok
        }
        if($type =='Topik_Pelajaran'){
            $statType ='010'; // ok
        }
        if($type =='Subtopik_Pelajaran'){
            $statType ='011'; // ok
        }
        if($type =='Bank_Soal'){
            $statType ='012'; // ok
        }
        if($type =='Soal'){
            $statType ='013'; // ok
        }
        if($type =='Profil'){
            $statType ='014'; // ok
        }
        if($type =='Tryout'){
            $statType ='015'; // ok
        }
        if($type =='Download_Video'){
            $statType ='016'; // ok
        }
        if($type =='Putar_Video'){
            $statType ='017'; // ok
        }
        if($type =='Voucher'){
            $statType ='018'; // ok
        }

        $nowFormat = date('Y-m-d H:i:s');
        $dataStat = array(
            'user_id'       => $userId,
            'log_id'        => $statType,
            'device_id'     => $deviceid,
            'log_datetime'  => $nowFormat,
            'remark'        => $remark,
            'kelas'         => $kelas,
            'jenjang'       => $jenjang,
            'mapel'         => str_replace("%20"," ",$mapel),
            'topik'         => str_replace("%20"," ",$topik),
            'subtopik'      => str_replace("%20"," ",$subtopik),
            'video'         => str_replace("%20"," ",$video)
        );
        DB::table(DB::raw('klassku_db.user_log'))->insert($dataStat);
        $data = array('status'=>'success','data'=>$userId);

        return response()->json($data);
    }

    public function get_area(){
        $data = DB::table(DB::raw('klassku_db.loc_area','id','TRIM(area_code) as area_code','TRIM(area_name) as area_name'))
            ->orderBy('area_code')
            ->get();
        $res = $data->toArray();

        if(empty($res)){
            $data = array('status'=>'err', 'retdata'=>'error');
        } else {
            $data = array('status'=>'success', 'retdata'=>$res);
        }
        return response()->json($data);
    }

    public function get_soal($idjudullainlain=null, $typesoal=null){
        if(!is_null($typesoal) && $typesoal != 0){
            $dataMaster = DB::table(DB::raw('klassku_db.master_soal'))
                ->join(DB::raw('klassku_db.soal_lainlain'),'soal_lainlain.id','=','master_soal.id_lainlain')
                ->where('soal_lainlain.judul',str_replace("%20"," ",$idjudullainlain))
                ->orderBy('master_soal.ids')
                ->inRandomOrder()
                ->limit(20)
                ->get();

        $dataresult = $dataMaster->toArray();
        if($dataresult){
            $data = array('status'=>'sukses', 'datasoal'=>$dataresult);
        }else{
            $data = array('status'=>'gagal', 'datasoal'=>'gagal');
        }

        return response()->json($data);
        }
    }

    public function get_typesoal(){
        $tipeSoal = DB::table(DB::raw('klassku_db.type_soal'))
                ->orderBy('id')
                ->get();
        $default = $tipeSoal->toArray();

        if(empty($default)){
            $data = array('status'=>'gagal','data'=>'gagal');
        } else {
            $data = array('status'=>'sukses','data'=>$default);
        }

        return response()->json($data);
    }

    public function login_post(Request $request){
        $email      = $request->email;
        $password   = $request->password;

        $dataLogin       = DB::table(DB::raw('klassku_db.master_soal'))->where('email',$email)->first();
        if($dataLogin->count() > 0){
            $token = DB::table(DB::raw('klassku_db.master_soal'))
                    ->where(array('email' => $email))
                    ->get();
            $data = array('status'=>'success', 'retdata'=> array('klassku_token'=>$token, 'email'=>$email ));

            return response()->json($data);
        }else{
            $data = array('status'=>'invalid', 'err'=>'Email atau Kata Kunci Anda salah, silahkan coba lagi.');

            return response()->json($data);
        }
    }

    public function sendbillBankKartu_post(Request $request){
        $userId = DB::table(DB::raw('klassku_db.master_soal'))->where(array('phonenumber' => $request['token']))->first()->ID;

        $data = DB::table(DB::raw('klassku_db.vouchers'))
                ->select('*')
                ->where('voucher_code',$request['voucher_code'])
                ->where('isActive', false);

        if($data->count() > 0){
            $dataUpdate = array(
                'isActive'  => 1,
                'user_id'   => $userId,
                'date_used' => $request['start_date'],
            );
            $data = DB::table(DB::raw('klassku_db.vouchers'))
                    ->where('vouchers.voucher_code', $request['voucher_kode'])
                    ->update($dataUpdate);
            $dataInsert = array(
                'user_id'           => $userId,
                'voucher_code'      => $request['voucher_code'],
                'start_date'        => $request['start_date'],
                'end_date'          => $request['end_date'],
                'payment_status'    => 'LUNAS',
                'payment_no'        => $request['payment_no'],
            );
            DB::table(DB::raw('klassku_db.user_subscriptions'))->insert($dataInsert);
            $dataUserSubscriptions = DB::table(DB::raw('klassku_db.user_subscriptions'))
                        ->where('payment_no','=',$request['payment_no'])
                        ->get();

            $res = $dataUserSubscriptions->toArray();
            $data = array('status'=>'success', 'retdata' => $res);
        }else{
            $data = array('status'=>'error', 'message'=>'Kode voucher salah atau sudah pernah digunakan sebelumnya.');
        }

        return response()->json($data);
    }

    public function sendbillpaket_post(Request $request){
        $userId = DB::table(DB::raw('klassku_db.user_login'))->where(array('fbuid' => $request['token']))->first()->ID;
        //dd($userId);
        $data = DB::table(DB::raw('klassku_db.user_login'))
            ->join('tb_pembelian','tb_pembelian.user_id','=','user_login.ID')
            ->where('user_login.fbuid',$request['token'])
            ->where('payment_status','LUNAS')
            ->get();
        //dd($data);

        $res = $data->toArray();
        if($res){
            $data = array('status'=>'Sukses', 'kode'=> '02', 'message'=>'Voucher sudah masuk, silahkan refresh halaman');

            return response()->json($data);
        }else{
            $url = 'http://landingdev.klassku.net/api/v1/checkVoucher/'.$request['voucher_code'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec ($ch);
            $err = curl_error($ch);  //if you need
            curl_close ($ch);
            // merubah json menjadi array
            $tojson = json_decode($response,TRUE);
            // ambil field array response_data yang isinya ada kode_voucher
            $datajsonarray = $tojson['response_data'];
                $dataInsertpembelian = array(
                    'user_id'           => $userId,
                    'voucher_code'      => $datajsonarray['voucher_code'],
                    'start_date'        => $request['start_date'],
                    'payment_status'    => 'LUNAS',
                    'payment_no'        => $request['payment_no'],
                    'paket_id'          => $request['paket_id'],
                    'finish_date'       => $request['end_date'],
                    'total_bill'        => 75000,
                );
            DB::table(DB::raw('klassku_db.tb_pembelian'))->insert($dataInsertpembelian);

            //simpan data permission
            $datakelas = DB::table(DB::raw('klassku_db.tb_mapel_kelas'))
                    ->join(DB::raw('klassku_db.tb_kelas'),'tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
                    ->join(DB::raw('klassku_db.tb_user_kelas'),'tb_user_kelas.id_kelas','=','tb_kelas.idkelas')
                    ->where('tb_user_kelas.id_user',$userId)
                    ->get();

                    foreach($datakelas as $val){
                        $ambiltopik = DB::table(DB::raw('klassku_db.tb_topik'))
                                    ->where('id_mapel_kelas','=',$val->idmapkelas)
                                    ->get();
                        $resuldatatopik = $ambiltopik->first();

                        foreach($resuldatatopik as $valuetopik){
                            $datasimpan = array(
                                'topik_id' => $valuetopik->idtop,
                                'user_id' => $userId
                            );
                            $simpandata = DB::table(DB::raw('klassku_db.tb_permission'))->insert($datasimpan);
                            return $simpandata;
                        }
                    }

                    $dataPembelian = DB::table(DB::raw('klassku_db.tb_pembelian'))
                                ->where('payment_no','=',$request['payment_no'])
                                ->get();
                    $res = $dataPembelian->toArray();
                    $data = array('status'=>'success', 'retdata' => $res);

                    return response()->json($data);

                    // jika data status_code == 0 maka menjalankan voucher yang ada di backend Laravel
                    // ini mencari kode voucer..
                    $dataVoucher = DB::table(DB::raw('klassku_db.vouchers'))
                        ->select('*')
                        ->where('voucher_code',$request['voucher_code'])
                        ->where('isActive', false);

                        if($dataVoucher->count() > 0){
                            $dataUpdate = array(
                                'isActive'  => 1,
                                'user_id'   => $userId,
                                'date_used' => $request['start_date'],
                                'status'    => 'USED'
                            );
                            $data = DB::table(DB::raw('klassku_db.vouchers'))
                                ->where('voucher_code', $request['voucher_code'])
                                ->update($dataUpdate);
                        }else{
                            $data = array('status'=>'error', 'kode'=> '01', 'message'=>'Kode voucher salah atau sudah pernah digunakan sebelumnya.');
                        }

                    return response()->json($data);
        }
    }

    public function notification_post(Request $request){
        $statuspendidikan = trim($request['statuspendidikan']);
        if ($statuspendidikan==''){
            $data = array('status'=>'warning','notif'=>'Silahkan cek data pendidikan anda');

            return response()->json($data);
        }else{
            if($statuspendidikan=='paket'){
                $jenjang =   $request['jenjang']=='';
                $kelas   =   $request['kelassma']=='';
                $jurusan =   $request['jurusansma']=='';
                if($request['paketpendidikan']=='C' && $request['jurusanpaket']==''){
                    $data = array('status'=>'warning','notif'=>'Jurusan anda tidak boleh kosong');
                }elseif($request['paketpendidikan']==''){
                    $data = array('status'=>'warning','notif'=>'Paket tidak boleh kosong');
                }

                return response()->json($data);
            }elseif($statuspendidikan=='reguler'){
                $jenjang =   $request['jenjang'];
                $kelas   =   $request['kelassma'];
                $jurusan =   $request['jurusansma'];

                    if($request['jenjang']==''){
                        $data = array('status'=>'warning','notif'=>'Silahkan cek jenjang anda');
                    }elseif($jenjang == 'SD'){
                        if($request['kelassd']==''){
                            $data = array('status'=>'warning','notif'=>'Kelas tidak boleh kosong');
                        }
                    }elseif($jenjang == 'SMP'){
                        if($request['kelassmp']==''){
                            $data = array('status'=>'warning','notif'=>'Kelas tidak boleh kosong');
                        }
                    }elseif($jenjang == 'SMA'){
                        if($request['jurusansma']==''){
                            $data = array('status'=>'warning','notif'=>'Jurusan tidak boleh kosong');
                        }elseif($request['kelassma']==''){
                            $data = array('status'=>'warning','notif'=>'Kelas tidak boleh kosong');
                        }
                    }

                    return response()->json($data);
            }
        }
    }

    public function registeruser_post(Request $request){
        $jenjang =   $request['jenjang'];

        if($request['phonenumber']){
            $jurusan = '';
            $insertId = 0;
            $dataUser = DB::table(DB::raw('klassku_db.user_login'))
                    ->where('phonenumber','=',$request['phonenumber'])
                    ->get();
            if($dataUser->count() > 0){
                $data = array('status'=>'invalid', 'kode'=>'01', 'notif'=>'Email sudah pernah didaftarkan.');
                $jenjang =  trim($request['jenjang']);
                $kelas =   trim($request['kelassma']);
                $jurusan =   trim($request['jurusansma']);

                if(trim($request['jenjang']) == 'SMA'){
                    $jurusan = $request['jurusansma'];
                    $kelas = $request['kelassma'];
                }elseif(trim($request['jenjang']) == 'SD' ){
                    $kelas = $request['kelassd'];
                    $jurusan = '';
                }elseif(trim($request['jenjang']) == 'SMP' ){
                    $kelas = $request['kelassmp'];
                    $jurusan = '';
                }
                $telp = str_replace('62', '0', $request['phonenumber']);
                $dataUpdate = array(
                    'fullname' => $request['fullname'],
                    'username' => $request['username'],
                    'password' => $request['password'],
                    'phonenumber' => $telp,
                    'email' => $request['email'],
                    'dob' => $request['dob'],
                    'gender' => $request['gender'],
                    'city' => $request['kota'],
                    'area_code' => $request['kota'],
                    'namasekolah' => $request['namasekolah'],
                    'jenjang' => $request['jenjang'],
                    'jurusan' => $jurusan,
                    'paket' => $request['paketpendidikan'],
                    'kelas' => $kelas,
                    'fbuid' => $request['fbuid'],
                    'device_id' => $request['device_id'],
                   // 'kode_referal'=>$koderef
                );
                $updateData = DB::table('klassku_db.user_login')
                        ->where('email',$request['email'])
                        ->update($dataUpdate);

                $insertId = DB::table(DB::raw('klassku_db.user_login'))
                        ->where(array('email' => $request['email']))
                        ->first()->ID;
                $dummyvar = $insertId;

                if($request['jurusansma']=='IPA' && $request['kelassma']=='10'){
                    $kelasformat = '13';
                }elseif($request['jurusansma']=='IPA' && $request['kelassma']=='11'){
                    $kelasformat = '14';
                }elseif($request['jurusansma']=='IPA' && $request['kelassma']=='12'){
                    $kelasformat = '15';
                }elseif($request['paketpendidikan']=='A'){
                    $kelasformat = '16';
                }elseif($request['paketpendidikan']=='B'){
                    $kelasformat = '17';
                }elseif($request['paketpendidikan']=='C' && $request['jurusansma']=='IPS'){
                    $kelasformat = '18';
                }elseif($request['paketpendidikan']=='C' && $request['jurusansma']=='IPA'){
                    $kelasformat = '19';
                }else{
                    $kelasformat = $kelas;
                }
                $pak = $request['paketpendidikan'];
                $simpankelasuser = array (
                    'id_kelas'        => $kelasformat,
                    'id_user'         => $dummyvar
                );
                DB::table(DB::raw('klassku_db.tb_user_kelas'))->insert($simpankelasuser);
            }else{
                $jenjang =  trim($request['jenjang']);
                $kelas =   trim($request['kelassma']);
                $jurusan =   trim($request['jurusansma']);

                if(trim($request['jenjang']) == 'SMA' ){
                    $jurusan = $request['jurusansma'];
                    $kelas = $request['kelassma'];
                }elseif(trim($request['jenjang']) == 'SD' ){
                    $kelas = $request['kelassd'];
                    $jurusan = '';
                }elseif(trim($request['jenjang']) == 'SMP' ){
                    $kelas = $request['kelassmp'];
                    $jurusan = '';
                }

                $dataInsert = array(
                    'fullname' => $request['fullname'],
                    'username' => $request['username'],
                    'password' => $request['password'],
                    'phonenumber' => $request['phonenumber'],
                    'email' => $request['email'],
                    'dob' => $request['dob'],
                    'gender' => $request['gender'],
                    'city' => $request['kota'],
                    'area_code' => $request['kota'],
                    'namasekolah' => $request['namasekolah'],
                    'jenjang' => $request['jenjang'],
                    'jurusan' => $jurusan,
                    'kelas' => $kelas,
                    'paket' => $request['paketpendidikan'],
                    'fbuid' => $request['fbuid'],
                    'device_id' => $request['device_id'],
                  //  'kode_referal'=>$koderef
                );
                $data = DB::table(DB::raw('klassku_db.user_login'))->insertGetId($dataInsert);
                $dummyvar = $data;

                //cek user kelas
                if($request['jurusansma']=='IPA' && $request['kelassma']=='10'){
                    $kelasformat = '13';
                }elseif($request['jurusansma']=='IPA' && $request['kelassma']=='11'){
                    $kelasformat = '14';
                }elseif($request['jurusansma']=='IPA' && $request['kelassma']=='12'){
                    $kelasformat = '15';
                }elseif($request['paketpendidikan']=='A'){
                    $kelasformat = '16';
                }elseif($request['paketpendidikan']=='B'){
                    $kelasformat = '17';
                }elseif($request['paketpendidikan']=='C' && $request['jurusansma']=='IPS'){
                    $kelasformat = '18';
                }elseif($request['paketpendidikan']=='C' && $request['jurusansma']=='IPA'){
                    $kelasformat = '19';
                }else{
                    $kelasformat = $kelas;
                }
                $pak = $request['paketpendidikan'];
                $simpankelasuser = array (
                    'id_kelas'        => $kelasformat,
                    'id_user'         => $dummyvar
                );
                $data = DB::table(DB::raw('klassku_db.tb_user_kelas'))->insert($simpankelasuser);
            }
                $data = array('status'=>'success','notif'=>'register berhasil','kode'=>'02');

                return response()->json($data);
        }else{
            $data = array('status'=>'invalid', 'notif'=>'Terjadi kesalahan, silahkan ulangi pendaftaran.','kode'=>'03');

            return response()->json($data);
        }
        $data = array('status'=>'invalid', 'success'=>'Sukses','notif'=>'register berhasil','kode'=>'02');

        return response()->json($data);
    }

    public function get_randomreferal(){
        $users = DB::table(DB::raw('klassku_db.user_login'))->get();
        $dataquery = $users->toArray($users);

        foreach($dataquery as $valuser){
            $text = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
            $panj = 6;
            $txtl = strlen($text)-1;
            $koderef = '';
            for($i=1; $i<=$panj; $i++){
                $koderef .= $text[rand(0, $txtl)];
            }
            $values = array('kode_referal' => $koderef);
            $updatekodereferal = DB::table('klassku_db.user_login')
                        ->where('user_login.ID',$valuser->ID)
                        ->update($values);

        }
        return response()->json($updatekodereferal);
    }

    public function get_paketid($idpaket=null){
        $paketId = DB::table(DB::raw('klassku_db.tb_paket'))
                ->where('id',$idpaket)
                ->get();

        $hasil = $paketId->toArray($paketId);
        if ($hasil)
        {
            $data = array('status'=>'1', 'data'=>$hasil);
        } else {
            $data = array('status'=>'0', 'data'=>'gagal');
        }

        return response()->json($data);
    }

    public function get_paketpembayaran(){
        $dataPaket = DB::table(DB::raw('klassku_db.tb_paket'))->get();
        $res = $dataPaket->toArray();
        if($res){
            $data = array('status'=>'sukses', 'data'=>$res);
        }else{
            $data = array('status'=>'gagal', 'data'=>'gagal');
        }

        return response()->json($data);
    }

    public function get_role($idpaket=null){
        $dataRole = DB::table(DB::raw('klassku_db.tb_role'))
                ->join(DB::raw('klassku_db.tb_paket'),'tb_paket.id','=','tb_role.id_paket')
                ->where('tb_paket.id',$idpaket)
                ->get();

        $masukArray = $dataRole->toArray();
        if(empty($masukArray)){
            $data = array('status'=>'gagal','kode'=>0,'datarole'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datarole'=>$masukArray);
        }
        return response()->json($data);
    }

    public function simpanrole_post(Request $request){
        $userid = $request['user_id'];
        $idrole = $request['id_role'];
        $idpem = $request['id_pembelian'];
        $iduserlogin = DB::table(DB::raw('klassku_db.user_login'))
                    ->where(array('fbuid' => $userid))
                    ->first()->ID;

        $data = array(
            'user_id' => $iduserlogin,
            'id_role' => $idrole,
            'id_pembelian'=> $idpem,
        );
        DB::table(DB::raw('klassku_db.tb_user_role'))->insert($data);
        if ($data)
        {
            $hasil = array('status'=>'sukses', 'data'=>$data);
        } else {
            $hasil = array('status'=>'gagal', 'data'=>'gagal');
        }

        return response()->json($hasil);
    }

    public function get_pembelian($userid=null){
        $iduserlogin = DB::table(DB::raw('klassku_db.user_login'))
                ->where(array('fbuid' => $userid))
                ->first()->ID;

        $dataku = DB::table(DB::raw('klassku_db.tb_pembelian'))
                ->where('user_id','=',$iduserlogin)
                ->get();

        $dataquery = $dataku->toArray();
        if ($dataquery)
        {
            $data = array('status'=>'sukses', 'data'=>$dataquery);
        } else {
            $data = array('status'=>'gagal', 'data'=>'gagal');
        }

        return response()->json($data);
    }

    public function get_detailpembayaran($userid=null){
        $userid = DB::table(DB::raw('klassku_db.user_login'))
                ->where(array('fbuid' => $userid))
                ->first()->ID;

        $usersub = DB::table(DB::raw('klassku_db.user_subscriptions'))
                ->where('user_id','=',$userid)
                ->get();
        $dataquery = $usersub->toArray();

        $userpembelian = DB::table(DB::raw('klassku_db.tb_pembelian'))
                ->join(DB::raw('klassku_db.tb_paket'),'tb_paket.id','=','tb_pembelian.paket_id')
                ->where('tb_pembelian.user_id','=',$userid)
                ->get();
        $dataquerypembelian = $userpembelian->toArray();

        if($dataquery || $dataquerypembelian){
            $data = array('status'=>'1','data'=>$dataquery,'datapembelian'=>$dataquerypembelian);
        }else{
            $data = array('status'=>'0','data'=>'gagal');
        }

        return response()->json($data);
    }

    public function get_deskripsidetail(){
        $data = DB::table(DB::raw('klassku_db.tb_des_pembayaran'))->get();
        $valArray = $data->toArray();
        if ($valArray){
            $data = array('status'=>'1', 'data'=>$valArray);
        } else {
            $data = array('status'=>'0', 'data'=>'gagal');
        }

        return response()->json($data);
    }
}
