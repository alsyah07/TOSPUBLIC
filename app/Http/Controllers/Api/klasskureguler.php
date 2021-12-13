<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\HelperReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\models\TbSekolah;
use App\models\TbPaket;
use App\models\UserLogin;
use App\models\TypeSoal;
use App\models\LocArea;
use App\models\TbPembelian;
use App\models\TbDesPembayaran;
use App\models\UserSubscription;
use App\models\TbPayment;
use App\models\UserLog;
use App\models\TbUserRole;
use App\models\TbUserKelas;
use App\models\TbKelas;
use App\models\TbMapelKelas;
use App\models\TbPengumumanRead;
use App\models\TbTopik;
use App\models\TbSubTopik;
use App\models\TbSubTopikVideo;
use App\models\TbMapel;
use App\models\TbPermission;
use App\models\Vouchers;
use App\models\TbTugasSubmit;
use App\models\TbTugas;
use App\models\TbPengumuman;
use App\models\TbMasterSoal;
use App\models\TbRole;


class klasskureguler extends Controller{

    public function indexreguler_get(){
        $data = array('status'=>'invalid', 'err'=>'Invalid Request');
        return response()->json($data);
    }

    public function searchsubtopik_get($idtopik=null,$idkelas=null,$keyword=null){
        $rubahspasipencarian = $keyword;
        $textspasi = str_replace("%20"," ",$rubahspasipencarian);

        $data = TbSubTopik::select('*')
                ->leftJoin('tb_topik','tb_sub_topik.id_topik','=','tb_topik.idtop')
                ->leftJoin('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
                ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                //ambil video
                ->join('tb_sub_topik_video','tb_sub_topik.idsubtop','=','tb_sub_topik_video.id_sub_topik')
                ->join('tb_video_mapel','tb_sub_topik_video.id','=','tb_video_mapel.idvideomapel')
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

    public function searchklasskutopik_get($idmapel=null,$idkelas=null,$keyword=null){
        $rubahspasipencarian = $keyword;
        $textspasi = str_replace("%20"," ",$rubahspasipencarian);

        $dataquerytopik = TbTopik::select('*')
            ->join('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
            ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
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

    public function getmajorbyuser_get($phonenumber=null,$jenjang=null,$kelas=null,$sekolah=null){
        if($phonenumber == null){
            $dbanner        = HelperReguler::helpbanner();
            $dtextDashboard = HelperReguler::helpTextDashboard();
            $devent         = HelperReguler::helpEvent();
            $dtrialKonten   = HelperReguler::helpTrialKonten();
            $dtrialBankSoal = HelperReguler::helpTrialBankSoal();
            $dVersion       = HelperReguler::helpVersion();
            $dYoutube       = HelperReguler::helpYoutube();

            $dataArray = [
                'status'        => 'sukses',
                'kode'          => 1,
                "benner"        => $dbanner,
                "textdashboard" => $dtextDashboard,
                "datauser"      => null,
                "dataevent"     => $devent,
                "trialkonten"   => $dtrialKonten,
                "trialbanksoal" => $dtrialBankSoal,
                "versiklassku"  => $dVersion,
                "kontenyoutube" => $dYoutube
            ];
        }elseif($phonenumber != null){
            $dbanner            = HelperReguler::helpbannersudahlogin($phonenumber);
            $dtextDashboard     = HelperReguler::helpTextDashboard();
            $dhelpDataUser      = HelperReguler::helpDataUser($phonenumber);
            $iduserLogin        = HelperReguler::helpUserId($phonenumber);
          //  dd($iduserLogin);
            $dhelpMapel         = HelperReguler::helpMapel($iduserLogin);
            $dhelpbanksoalTopik = HelperReguler::helpbanksoalTopik($phonenumber,$jenjang,$kelas);
            $dhelpTypesoal      = HelperReguler::helpTypesoal();
            $devent             = HelperReguler::helpEvent();
            $dtrialKonten       = HelperReguler::helpTrialKonten();
            $dtrialBankSoal     = HelperReguler::helpTrialBankSoal();
            $dVersion           = HelperReguler::helpVersion();
            $dYoutube           = HelperReguler::helpYoutube();
            $loguser 			= HelperReguler::LogBeranda($phonenumber);


            if (empty($dhelpMapel)){
                $dataArray = array('status'=>'gagal','kode'=>0,'datapelajaran'=>'gagal');
            }else {
                $dataArray = array(
                    'status'        => 'sukses',
                    'kode'          => 1,
                    'datapelajaran' => $dhelpMapel,
                    'datauser'      => $dhelpDataUser,
                    'datatopik'     => $dhelpbanksoalTopik,
                    'typesoal'      => $dhelpTypesoal,
                    'benner'        => $dbanner,
                    'dataevent'     => $devent,
                    'textdashboard' => $dtextDashboard,
                    'trialkonten'   => $dtrialKonten,
                    'trialbanksoal' => $dtrialBankSoal,
                    'versiklassku'  => $dVersion,
                    'kontenyoutube' => $dYoutube,
                );
            }
        }

        return response()->json($dataArray);
    }

    public function tugasbelajar_get($idmapel=null,$namasekolah=null,$kelas=null,$idtugas=null){
        $getsekolah = "Sekolah Klassku guru";
        if($kelas==10 && $namasekolah==$getsekolah){
            $newkelas   = 22;
        } else if ($kelas==11 && $namasekolah==$getsekolah){
             $newkelas  = 22;
        } else if ($kelas==12 && $namasekolah==$getsekolah){
             $newkelas  = 22;

        } else if ($kelas==13 && $namasekolah==$getsekolah) {
            $newkelas   = 21;
        } else if ($kelas==14 && $namasekolah==$getsekolah){
             $newkelas  = 21;
        } else if ($kelas==15 && $namasekolah==$getsekolah){
             $newkelas  = 21;
        } else if ($namasekolah  !=$getsekolah){
             $newkelas  = $kelas;
        } else {
             $newkelas  = 20;
        }

        $data = DB::table('klassku_guru.tb_tugas as dt1')
                ->leftjoin('klassku_db.tb_mapel as dt2','dt2.id','=','dt1.id_mapel')
                ->leftjoin('klassku_guru.users as dt3','dt3.id','=','dt1.id_guru')
                ->leftjoin('klassku_db.tb_topik as dt4','dt4.idtop','=','dt1.id_topik')
                ->leftjoin('klassku_db.tb_mapel_kelas as tbmkls','tbmkls.idmapkelas','=','dt4.id_mapel_kelas')
               // ->select('dt1.kelas as kelasguru')
                ->where('dt3.nama_sekolah',str_replace("%20"," ",$namasekolah))
                ->where('dt1.kelas', $newkelas);

            if($idtugas == null){
                $data->where('dt1.id_mapel',$idmapel);
            }else{
                $data->where('dt1.id',$idtugas);
            }
            $output = $data->select(['dt1.*','dt2.*','dt4.*','dt3.*','dt1.id as idtugas','dt1.kelas as kelasguru'])->get();

               // dd($datakhusus);

            $dataresult = $output->toArray();
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

    public function pengumumanlacibelajar_get($kelas=null,$namasekolah=null,$idpeng=null){
        $datapengumuman = DB::table('klassku_guru.tb_pengumuman as dt1')
                    ->leftjoin('klassku_db.tb_mapel as dt2','dt2.id','=','dt1.id_mapel')
                    ->leftjoin('klassku_guru.users as dt3','dt3.id','=','dt1.id_guru')
                    ->where('dt3.nama_sekolah',str_replace("%20"," ",$namasekolah))
                    ->orderBy('dt1.id','DESC');

        if($idpeng==null) {
            $datapengumuman->where('dt1.kelas',$kelas);
        } else {
            $datapengumuman->where('dt1.id',$idpeng);
        }

        $output = $datapengumuman->select(['dt1.*','dt2.*','dt3.*','dt1.id as idpengumuman','dt1.kelas as kelas_pengumuman'])->get();

        $dataresult = $output->toArray();

        $ambilpengumumanbaca = TbPengumumanRead::where('id_pengumuman')
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

        $val = TbPengumumanRead::insert($tambahpengumuman);

        return response()->json($val);
    }

    public function uploadtugastoguru_post(Request $request){
        if(!$request->file['file_attachment']['name']){
            $res        = array();
            $akun       = 'Klassku';
            //$imagePath  = 'storage/tugas_submit/file_attachment';
            $imagePath  = '../../storage/tugas_submit/file_attachment';
            $path       = $request->file('file_attachment');
            $ext        = $path->getClientOriginalName();
            $ambiltype  = explode("/",$ext);
            $temp       = explode(".",$request->file['file_attachment'].".".$ambiltype[0]);
            $extension  = end($temp);
            $filedok    = str_replace($request->file['file_attachment'],$request->file['file_attachment'],$akun).'_'.time().''. "." .$extension;
            $path->move($imagePath, $filedok);

            $dataInsert = array(
                'notes'             => $request['catatan'],
                'tgl_submit'        => date('Y-m-d h:i:s'),
                'id_tugas'          => $request['id_tugas'],
                'id_siswa'          => $request['id_siswa'],
                'dokument_submit'   => $filedok,
            );
            TbTugasSubmit::insert($dataInsert);

            // $fileName = Carbon::now()->timestamp . $request->file( 'file_attachment' )->getClientOriginalName();
            // $request->file( 'file' )->move( 'assets/upload/file_attachment', $fileName );
            //$filenew = url( 'assets/upload/file_attachment/' . $fileName );

            if(!$request->file('file_attachment')){
                $data = array('msg' => 'error upload');
                return response()->json($data);
            }else{
                $data = $request->file();
                if(!empty($data['file_name'])){
                   //$res['image_url'] = 'storage/tugas_submit/file_attachment/'.$data['file_name'];
                   $res['image_url'] = '../../storage/tugas_submit/file_attachment/'.$data['file_name'];
                }if(!empty($res)){
                    echo json_encode(array("status" => 1, "data" => array() ,"msg" => 'upload successfully', 'url' => url(), "count" => '0'));
                }else{
                    echo json_encode(array("status" => 1,"data" => array() ,"msg" => 'not found', 'url' => url(), "count" => '0'));
                }
            }

        }
    }

    public function sekolah_get(){
        $dsekolah = TbSekolah::all();
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

    public function kelasuser_get($userid=null){
        $datafbuid = UserLogin::where(array('fbuid' => $userid))
                ->first()->ID;

        $dataPermission = TbPermission::select('*')
                    ->select('tb_kelas.kelas','tb_kelas.*')
                    ->distinct()
                    //->select([DB::raw('DISTINCT(tb_kelas.kelas)'), 'tb_kelas.*'])
                    ->join('user_login','tb_permission.user_id','=','user_login.ID')
                    ->join('tb_topik','tb_permission.topik_id','=','tb_topik.idtop')
                    ->join('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
                    ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                    ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
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

    public function mapelkelasuser_get($idkelas=null){
        $data = TbKelas::select('*')
            ->join('tb_mapel_kelas','tb_kelas.idkelas','=','tb_mapel_kelas.id_kelas')
            ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->where('tb_kelas.idkelas',$idkelas)
            ->get();

        $dataresult = $data->toArray();
        if (empty($dataresult)){
            $data = array('status'=>'gagal','kode'=>0,'datapelajaran'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datapelajaran'=>$dataresult);
        }
        return response()->json($data);
    }

    public function topik_get($idmapel=null ,$fbuid=null,$idkelas=null){
        $userid = UserLogin::where(array('phonenumber' => $fbuid))
                    ->first()->ID;

        $dataPermission = TbPermission::select('*')
                    ->join('tb_topik','tb_permission.topik_id','=','tb_topik.idtop')
                    ->join('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
                    ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
                    ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
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

    public function sub_topik_get($idtopik=null){
        $data = TbSubTopik::select('*')
            ->leftjoin('tb_topik','tb_sub_topik.id_topik','=','tb_topik.idtop')
            ->leftjoin('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
            ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            //ambil poster video
            ->join('tb_sub_topik_video','tb_sub_topik.idsubtop','=','tb_sub_topik_video.id_sub_topik')
            ->join('tb_video_mapel','tb_sub_topik_video.id','=','tb_video_mapel.idvideomapel')
            ->where('tb_sub_topik.id_topik',$idtopik)
            ->get();

      //  $resultsubtopik = $data->toArray();
        if(empty($data)){
            $data = array('status'=>'gagal','kode'=>0,'datasubtopik'=>'gagal');
        } else {
            $data = array('status'=>'sukses','kode'=>1,'datasubtopik'=>$data);
        }
        return response()->json($data);
    }

    public function videomapel_get($idsubtopik=null,$idkelas=null){
        $data = TbSubTopikVideo::select('*')
            ->leftjoin('tb_video_mapel','tb_sub_topik_video.id_sub_topik','=','tb_video_mapel.idvideomapel')
            ->leftjoin('tb_sub_topik','tb_sub_topik_video.id_sub_topik','=','tb_sub_topik.idsubtop')
            // ambil info kelas jenjang dan jurusan
            ->leftjoin('tb_topik','tb_sub_topik.id_topik','=','tb_topik.idtop')
            ->join('tb_mapel_kelas','tb_topik.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
            //ambil jenjang
            ->join('tb_mapel','tb_mapel.id','=','tb_mapel_kelas.id_mapel')
            ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
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

    public function getdatenow_get(){
        date_default_timezone_set('Asia/Jakarta');
        $DateNow = date('m-d-Y');
        echo $DateNow;
    }

    public function getbill_get($token=null){
        $userId = UserLogin::where(array('phonenumber' => $token))
                ->first()
                ->ID;

        date_default_timezone_set('Asia/Jakarta');
        $DateNow = date('Y-m-d');

        //cek notif pembayaran pertama
        $bayarreguler = UserSubscription::where('user_id','=',$userId)
                ->where('payment_status','=','LUNAS')
                ->get();

        $bayartryout = TbPayment::where('user_id','=',$userId)
                ->where('status','=','LUNAS')
                ->where('payment_channel','=','Tryout')
                ->get();

        $bayarfasttrack = TbPayment::where('user_id','=',$userId)
                ->where('status','=','LUNAS')
                ->where('payment_channel','=','Fastrack')
                ->get();

        $bayarpaket = TbPembelian::where('user_id','=',$userId)
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
                $pemlunas = UserSubscription::where('user_id','=',$userId)
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
                $pemlunas = TbPembelian::where('user_id','=',$userId)
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

    public function setstat_get($type=null,$deviceid=null,$fbuid=null,$remark=null,$kelas=null,$mapel=null,$topik=null,$subtopik=null,$video=null,$jenjang=null){
        $userId = UserLogin::where(array('fbuid' => trim($fbuid)))->first()->ID;
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
        UserLog::insert($dataStat);
        $data = array('status'=>'success','data'=>$userId);

        return response()->json($data);
    }

    public function getarea_get(){
        $data = LocArea::select('*')
            //DB::table(DB::raw('klassku_db.loc_area','id','TRIM(area_code) as area_code','TRIM(area_name) as area_name'))
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

    public function getsoal_get($idjudullainlain=null, $typesoal=null){
        $dataMaster = DB::table('klassku_db.master_soal as soal')
                ->join('klassku_db.soal_lainlain as dt2','soal.id_lainlain','=','dt2.id')
                ->where('dt2.judul',str_replace("%20"," ",$idjudullainlain))
                ->limit(11);
                
                if(!is_null($typesoal) && $typesoal !=0){
                    $dataMaster->where('soal.type_soal',$typesoal);
                }

        $output = $dataMaster->select('soal.*','dt2.*')->orderBy('soal.ids')->get();
        $dataresult = $output->toArray();

        $soalkosong = [
            "ids"=> 0,
            "id_educations_subject_rev_2" => null,
            "id_lainlain"=> null,
            "gambar_soal"=> null,
            "gambar_pembahasan"=>null,
            "video_pembahasan"=>null,
            "no_video"=>null,
            "kunci_jawaban"=>null,
            "type_soal"=>2,
            "keterangan_soal"=>null,
            "status"=> 1,
            "tingkat_soal"=>null,
            "id_educations_subject_rev_1"=>null,
            "jenjang"=>null,
            "kelas"=>null,
            "jurusan"=>null,
            "judul"=>null,
        ];

        if(empty($dataresult)){
            $data = array('status'=>'gagal', 'datasoal'=>[$soalkosong]);
        }else{
            $data = array('status'=>'sukses', 'datasoal'=>$dataresult);
        }
        return response($data);
    }

    public function typesoal_get(){
        $tipeSoal = TypeSoal::select('*')
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

    public function sendbillBankKartu_post(Request $request){
        $userId = UserLogin::where(array('phonenumber' => $request['token']))->first()->ID;
        //dd($userId);
        $cek = UserSubscription::where('user_id','=',$userId)->count();
        $ambildata = Vouchers::select('*')
                ->where('voucher_code',$request['voucher_code'])
                ->where('isActive', false)
                ->count();
        //dd($ambildata);


        if($cek > 0 || $ambildata > 0){
            $data = array('status'=>'error', 'message'=>'Kode voucher salah atau sudah pernah digunakan sebelumnya.');
        }else{
            $dataUpdate = array(
                'isActive'  => 1,
                'user_id'   => $userId,
                'date_used' => $request['start_date'],
            );
            Vouchers::where('voucher_code', $request['voucher_kode'])
                    ->update($dataUpdate);
            $dataInsert = array(
                'user_id'           => $userId,
                'voucher_code'      => $request['voucher_code'],
                'start_date'        => $request['start_date'],
                'end_date'          => $request['end_date'],
                'payment_status'    => 'LUNAS',
                'payment_no'        => $request['payment_no'],
            );
            UserSubscription::insert($dataInsert);
            $dataUserSubscriptions = UserSubscription::where('payment_no','=',$request['payment_no'])
                        ->get();

            $res = $dataUserSubscriptions->toArray();
            $data = array('status'=>'success', 'retdata' => $res);
        }

        return response()->json($data);
    }

    public function sendbill_post(Request $request){
        $userId = UserLogin::where(array('phonenumber' => $request['token']))->first()->ID;
        if($userId !=null){
            $query = UserLogin::select('*')
                    ->join('user_subscriptions','user_login.ID','=','user_subscriptions.user_id')
                    ->where('user_login.ID',$userId)
                    ->where('payment_status','LUNAS')
                    ->get();
            // pyment ini dgapus
            // kemudian di foreach dan cek apakah ada yang lunas atau tidak
            // jika lunas maka jalanin if jalanin voucher ada
            $dat = $query->count();

            if($dat > 0  || $request['voucher_code']==null){
                $data = array('status'=>'Sukses', 'kode'=>01, 'message'=>'Voucher sudah masuk, silahkan refresh halaman');
                return response()->json($data);
            }else{
                // url dari api landing page dan di sambung oleh post data dari voucher_code apps
                // $url = 'https://landing.klassku.com/api/v1/checkVoucher/'.$this->post('voucher_code');
                $url = 'http://landingpro.klassku.net/api/v1/checkVoucher/'.$request['voucher_code'];
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
                $datjsonarray = $tojson['response_data'];
                // proses simpan data ke user_subscriptions dengan ketentuan voucher_code di post bedasarakan data kode_voucher dari API landing pages
                // jika data status_code ==1 artinya data request sama dengan data yang di database maka jalankan
                // format waktu
                $waktusekarang = date('Y-m-d');
                $tagihan       = number_format(75000);
                $date          = date_create($waktusekarang);
                date_add($date,date_interval_create_from_date_string("365 days"));

                if($request['voucher_code']=="KLS-BPR"){
                    $dataInsert = array(
                        'user_id'        => $userId,
                        'voucher_code'   => $request['voucher_code'],
                        'start_date'     => date('Y-m-d'),
                        'end_date'       => date_format($date,"Y-m-d"),
                        'payment_status' => 'LUNAS',
                        'type_user'      =>'reguler',
                        'payment_no'     => $request['payment_no'],
                        'total_tagihan'  => $tagihan,
                    );
                    UserSubscription::insert($dataInsert);
                    $q = UserSubscription::where('payment_no','=',$request['payment_no'])->get();
                    $res = $q->toArray();
                }elseif($tojson['status_code']==1){
                    $dataInsert = array(
                        'user_id'        => $userId,
                        'voucher_code'   => $datjsonarray['voucher_code'],
                        'start_date'     => date('Y-m-d'),
                        'end_date'       => date_format($date,"Y-m-d"),
                        'payment_status' => 'LUNAS',
                        'type_user'      =>'reguler',
                        'payment_no'     => $request['payment_no'],
                        'total_tagihan'  => $tagihan,
                    );
                    UserSubscription::insert($dataInsert);

                        if($request['paket']==null || $request['paket']==''){           //simpan data reguler
                            $datakelas = TbMapelKelas::select('*')
                                    ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                                    ->join('tb_user_kelas','tb_kelas.idkelas','=','tb_user_kelas.id_kelas')
                                    ->where('tb_user_kelas.id_user','=',$userId)
                                    ->get();

                                    foreach($datakelas as $val){
                                        $ambiltopik = TbTopik::where('id_mapel_kelas','=',$val->idmapkelas)->get();
                                        //$resuldatatopik = $ambiltopik->first();

                                        foreach($ambiltopik as $valuetopik){
                                            $datasimpan = array(
                                                'topik_id' => $valuetopik->idtop,
                                                'user_id'  => $userId
                                            );
                                            TbPermission::insert($datasimpan);
                                        }
                                    }
                        }else{
                            $ambiltopikspaket = TbTopik::select('*')
                                        ->join('tb_paket_topik','tb_topik.idtop','=','tb_paket_topik.id_topik')
                                        ->join('user_login','tb_paket_topik.paket_topik','=','user_login.paket')
                                        ->where('user_login.ID','=',$userId)
                                        ->get();
                            //$resuldatatopikspaket = $ambiltopikspaket->first();

                            foreach($ambiltopikspaket as $valuetopikspaket){
                                $datasimpanspaket = array(
                                    'topik_id'  => $valuetopikspaket->idtop,
                                    'user_id'   => $userId
                                );
                                TbPermission::insert($datasimpanspaket);
                            }
                        }
                        $data = array('status'=>'success','kode'=>02,'message'=>'Kode voucher sukses');
                        return response()->json($data);
                }else{
                    // jika data status_code == 0 maka menjalankan voucher yang ada di backend CI
                    // ini mencari kode voucer..
                    $query = Vouchers::select('*')
                            ->where('voucher_code',$request['voucher_code'])
                            ->where('status','UNUSED')
                            ->get();

                    if($query->count() > 0){
                        $dataUpdate = array(
                            'isActive' => 1,
                            'user_id' => $userId,
                            'date_used' => $request['start_date'],
                            'status' => 'USED'
                        );
                        Vouchers::where('voucher_code',$request['voucher_code'])
                                ->update($dataUpdate);

                        $waktusekarang = date('Y-m-d');
                        $tagihan       = number_format(75000);
                        $date=date_create($waktusekarang);
                        date_add($date,date_interval_create_from_date_string("365 days"));
                        $expireddate = date_format($date,"Y-m-d");

                        $dataInsert = array(
                            'user_id'        => $userId,
                            'voucher_code'   => $request['voucher_code'],
                            'start_date'     => $waktusekarang,
                            'end_date'       => $expireddate,
                            'payment_status' => 'LUNAS',
                            'type_user'      => 'reguler',
                            'payment_no'     => $request['payment_no'],
                            'total_tagihan'  => $tagihan,
                        );
                        UserSubscription::insert($dataInsert);

                        if($request['paket']==null || $request['paket']==''){  //simpan data reguler
                            $datakelas = TbMapelKelas::select('*')
                                    ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                                    ->join('tb_user_kelas','tb_kelas.idkelas','=','tb_user_kelas.id_kelas')
                                    ->where('tb_user_kelas.id_user','=',$userId)
                                    ->get();
                            //$userdata = $datakelas->first();
                                foreach($datakelas as $value){
                                    $ambiltopik = TbTopik::where('id_mapel_kelas','=',$value->idmapkelas)->get();
                                    //$resuldatatopik = $ambiltopik->first();

                                    foreach($ambiltopik as $valuetopik){
                                        $datasimpan = array(
                                            'topik_id' => $valuetopik->idtop,
                                            'user_id'  => $userId
                                        );
                                        TbPermission::insert($datasimpan);
                                    }
                                }
                        }else{
                            $ambiltopiks = TbTopik::select('*')
                                        ->join('tb_paket_topik','tb_topik.idtop','=','tb_paket_topik.id_topik')
                                        ->join('user_login','tb_paket_topik.paket_topik','=','user_login.paket')
                                        ->where('user_login.ID','=',$userId)
                                        ->get();
                            //$resuldatatopiks = $ambiltopiks->first();
                                foreach($ambiltopiks as $valuetopiks){
                                    $datasimpans = array(
                                        'topik_id' => $valuetopiks->idtop,
                                        'user_id' => $userId
                                    );
                                    TbPermission::insert($datasimpans);
                                }
                        }
                        $data = array('status'=>'success','kode'=>02,'message'=>'Kode voucher sukses TEST');
                        return response()->json($data);
                    }else{
                        $data = array('status'=>'error', 'kode'=>253, 'message'=>'pengisian voucher gagal');
                        return response()->json($data);
                    }
                    $data = array('status'=>'-');
                    return response()->json($data);
                }
            }
        }

    }

    public function sendbillpaket_post(Request $request){
        $userId = UserLogin::where(array('fbuid' => $request['token']))->first()->ID;
        //dd($userId);
        $data = UserLogin::select('*')
            ->join('tb_pembelian','user_login.ID','=','tb_pembelian.user_id')
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
            TbPembelian::insert($dataInsertpembelian);

            //simpan data permission
            $datakelas = TbMapelKelas::select('*')
                    ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
                    ->join('tb_user_kelas','tb_kelas.idkelas','=','tb_user_kelas.id_kelas')
                    ->where('tb_user_kelas.id_user',$userId)
                    ->get();

                    foreach($datakelas as $val){
                        $ambiltopik = TbTopik::where('id_mapel_kelas','=',$val->idmapkelas)
                                    ->get();

                        foreach($ambiltopik as $valuetopik){
                            $datasimpan = array(
                                'topik_id' => $valuetopik->idtop,
                                'user_id' => $userId
                            );
                            TbPermission::insert($datasimpan);
                        }
                    }

                    $dataPembelian = TbPembelian::where('payment_no','=',$request['payment_no'])
                                ->get();
                    $res = $dataPembelian->toArray();
                    $data = array('status'=>'success', 'retdata' => $res);

                    return response()->json($data);

                    // jika data status_code == 0 maka menjalankan voucher yang ada di backend Laravel
                    // ini mencari kode voucer..
                    $dataVoucher = Vouchers::where('voucher_code',$request['voucher_code'])
                            ->where('isActive', false)
                            ->get();

                        if($dataVoucher->count() > 0){
                            $dataUpdate = array(
                                'isActive'  => 1,
                                'user_id'   => $userId,
                                'date_used' => $request['start_date'],
                                'status'    => 'USED'
                            );
                            $data = Vouchers::where('voucher_code', $request['voucher_code'])
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
        if($request['phonenumber']){
            $jurusan    = '';
            $insertId   = 0;
            UserLogin::select('email')
                    ->where('phonenumber',$request['phonenumber'])
                    ->first();
            $cekuserregister = UserLogin::select('*')
                            ->where('phonenumber','=',$request['phonenumber'])
                            ->first();
            $cekduplikat = $cekuserregister;
            if($cekduplikat != null){
            } else {
                $jenjang    =   trim($request['jenjang']);
                $kelas      =   trim($request['kelassma']);
                $jurusan    =   trim($request['jurusansma']);

                if(trim($request['jenjang']) == 'SMA' ) {
                    $jurusan = $request['jurusansma'];
                    $kelas   = $request['kelassma'];
                }elseif(trim($request['jenjang']) == 'SD' ){
                    $kelas = $request['kelassd'];
                    $jurusan = '';
                }elseif(trim($request['jenjang']) == 'SMP' ){
                    $kelas = $request['kelassmp'];
                    $jurusan = '';
                } else {
                     $kelas = null;
                     $jurusan = null;
                }
                $dataInsert = array(
                    'fullname'      => $request['fullname'],
                    'username'      => $request['username'],
                    'password'      => $request['password'],
                    'phonenumber'   => $request['phonenumber'],
                    'email'         => $request['email'],
                    'dob'           => $request['dob'],
                    'gender'        => $request['gender'],
                    'city'          => $request['kota'],
                    'area_code'     => $request['kota'],
                    'namasekolah'   => $request['namasekolah'],
                    'jenjang'       => $request['jenjang'],
                    'jurusan'       => $jurusan,
                    'kelas'         => $kelas,
                    'paket'         => $request['paketpendidikan'],
                    'fcmtoken'      => $request['fcmtoken'],
                    'fbuid'         => $request['fbuid'],
                    'device_id'     => $request['device_id'],
                );
                $insertId = UserLogin::insertGetId($dataInsert);
                $dummyvar = $insertId;

                //cek user kelas
                if ($request->post('jurusansma')=='IPA' && $request->post('kelassma') == '10'){
                    $kelasformat = '13';
                }elseif($request->post('jurusansma')=='IPA' && $request->post('kelassma') == '11'){
                    $kelasformat = '14';
                }elseif($request->post('jurusansma')=='IPA' &&$request->post('kelassma') =='12'){
                    $kelasformat = '15';
                }elseif($request->post('paketpendidikan')=='A' ){
                    $kelasformat = '16';
                }elseif($request->post('paketpendidikan')=='B' ) {
                    $kelasformat = '17';
                }elseif($request->post('paketpendidikan')=='C' && $request->post('jurusanpaket')=='IPS' ) {
                    $kelasformat = '18';
                }elseif($request->post('paketpendidikan')=='C' && $request->post('jurusanpaket')=='IPA' ) {
                    $kelasformat = '19';
                } else {
                    $kelasformat = $kelas;
                }
                $pak = $request['paketpendidikan'];
                $simpankelasuser = array (
                    'id_kelas'        => $kelasformat,
                    'id_user'         => $dummyvar
                );
                TbUserKelas::insert($simpankelasuser);
            }
            // batas akhir

            $data = array('status'=>'success','notif'=>'register berhasil','kode'=>'02');
            return response($data);
        }else{
            $data = array('status'=>'invalid', 'notif'=>'Terjadi kesalahan, silahkan ulangi pendaftaran.','kode'=>'03');
            return response($data);
        }
        $data = array('status'=>'invalid', 'success'=>'Sukses','notif'=>'register berhasil','kode'=>'02');
        return response($data);
    }

    public function get_randomreferal(){
        $users = UserLogin::all();
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
            $updatekodereferal = UserLogin::where('user_login.ID',$valuser->ID)
                        ->update($values);

        }
        return response()->json($updatekodereferal);
    }

    public function get_paketid($idpaket=null){
        $paketId = TbPaket::where('id',$idpaket)
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
        $dataPaket = TbPaket::all();
        $res = $dataPaket->toArray();
        if($res){
            $data = array('status'=>'sukses', 'data'=>$res);
        }else{
            $data = array('status'=>'gagal', 'data'=>'gagal');
        }

        return response()->json($data);
    }

    public function get_role($idpaket=null){
        $dataRole = TbRole::select('*')
                ->join('tb_paket','tb_role.id_paket','=','tb_paket.id')
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
        $iduserlogin = UserLogin::where(array('fbuid' => $userid))
                    ->first()->ID;

        $data = array(
            'user_id' => $iduserlogin,
            'id_role' => $idrole,
            'id_pembelian'=> $idpem,
        );
        TbUserRole::insert($data);
        if ($data)
        {
            $hasil = array('status'=>'sukses', 'data'=>$data);
        } else {
            $hasil = array('status'=>'gagal', 'data'=>'gagal');
        }

        return response()->json($hasil);
    }

    public function get_pembelian($userid=null){
        $iduserlogin = UserLogin::where(array('fbuid' => $userid))
                ->first()->ID;

        $dataku = TbPembelian::where('user_id','=',$iduserlogin)
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
        $userid = UserLogin::where(array('fbuid' => $userid))
                ->first()->ID;

        $usersub = UserSubscription::where('user_id','=',$userid)
                ->get();
        $dataquery = $usersub->toArray();

        $userpembelian = TbPembelian::select('*')
                ->join('tb_paket','tb_pembelian.paket_id','=','tb_paket.id')
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
        $data = TbDesPembayaran::all();
        $valArray = $data->toArray();
        if ($valArray){
            $data = array('status'=>'1', 'data'=>$valArray);
        } else {
            $data = array('status'=>'0', 'data'=>'gagal');
        }

        return response()->json($data);
    }

    public function updatedevice_get($id=null,$device=null,$fcmtoken=null,$fbuid=null){
        $dataInsert = array(
            'device_id' => $device,
            'fbuid' => $fbuid,
            'fcmtoken' => $fcmtoken,
        );
        UserLogin::where('ID',$id)
                ->update($dataInsert);
    }

}
