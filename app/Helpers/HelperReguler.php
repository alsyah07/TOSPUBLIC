<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\models\SetupBenner;
use App\models\TbEvent;
use App\models\TbTextDashboard;
use App\models\UserLogin;
use App\models\TypeSoal;
use App\models\TbMapel;
use App\models\TbKompetensi;
use App\models\TbSerbaSerbi;
use App\models\TbSekolah;
use App\models\TbTipsTrick;
use App\models\TbTrialBankSoal;
use App\models\TbTrialKonten;
use App\models\TbUserKelas;
use App\models\TbVersion;
use App\models\TbYoutube;


class HelperReguler {
    public static function helpEvent(){
        $dataEvent = TbEvent::select('*')
                ->orderBy('id_event','DESC')
                ->get();

        return $dataEvent;
    }
    public static function helpTextDashboard(){
        $dataTextDashboard = TbTextDashboard::all();

        return $dataTextDashboard;
    }
    public static function helpbanner(){
        $default = SetupBenner::select('id','picture_location as banner_image','banner_link','banner_name as banner_title')
                ->orderBy('id','DESC')
                ->where('isall',1)
                ->where('status',1)
                ->get();

        return $default;
    }

    public static function helpbannersudahlogin($phonenumber){
        $userlogin = UserLogin::where('phonenumber',$phonenumber)->first();
        if($userlogin !=null){
            if ($userlogin->city=="MALUKU" || $userlogin->city=="maluku utara" || $userlogin->city=="Maluku utara" || $userlogin->city=="MALUKU UTARA" ||$userlogin->city=="Maluku Utara" ||
                $userlogin->city=="AMBON" ||
		$userlogin->city=="KAB. MALUKU BARAT TENGAH" ||
		$userlogin->city=="KAB. SERAM BAGIAN BARAT" ||
   		$userlogin->city=="KAB. SERAM BAGIAN TIMUR" ||
		$userlogin->city=="KAB. BURU" ||
		$userlogin->city=="KAB. BURU SELATAN" ||
		$userlogin->city=="KAB. KEPULAUAN TANIMBAR" ||
		$userlogin->city=="TUAL" ||
		$userlogin->city=="KAB. MALUKU TENGGARA" ||
		$userlogin->city=="KAB. MALUKU KEPULAUAN ARU" ||
		$userlogin->city=="KAB. MALUKU BARAT DAYA" ||
		$userlogin->city=="KAB. HALMAHERA BARAT" ||
		$userlogin->city=="KAB. HALMAHERA TIMUR" ||
		$userlogin->city=="KAB. HALMAHERA UTARA" ||
		$userlogin->city=="KAB. PULAU MOROTAI" ||
                $userlogin->city=="TERNATE" ||
		$userlogin->city=="KAB. HALMAHERA TENGAH" ||
		$userlogin->city=="KAB. HALMAHERA SELATAN" ||
		$userlogin->city=="KAB. KEPULAUAN SULA" ||
		$userlogin->city=="KAB. PULAU TALIABU" ||
		$userlogin->city=="KAB. TIDORE"

                ){
                $default = SetupBenner::select('id','picture_location as banner_image','banner_link','banner_name as banner_title')
                    ->orderBy('id','DESC')
                    ->where('isall',1)
                    ->where('status',2)
                    ->get();
                return $default;
            } else {
                $default = SetupBenner::select('id','picture_location as banner_image','banner_link','banner_name as banner_title')
                    ->orderBy('id','DESC')
                    ->where('isall',1)
                    ->where('status',1)
                    ->get();
                return $default;
            }
        } else {
             $default = SetupBenner::select('id','picture_location as banner_image','banner_link','banner_name as banner_title')
                    ->orderBy('id','DESC')
                    ->where('isall',1)
                    ->where('status',1)
                    ->get();
                return $default;
        }
    }

    public static function helpUserId($phonenumber){
        $data = UserLogin::where('phonenumber',$phonenumber)->first();
        $val = json_decode($data,true);
              //  dd($val);
            if ($data==null){
                $dt = null;
            } else {
                $dt = $data->ID;
            }
        return $dt;
    }

    public static function LogBeranda($phonenumber){
        $data = UserLogin::where('phonenumber',$phonenumber)->first();
         if(!empty($data)){
        // log user
            $datetime = date("d-m-Y H:i:s");
            $date = date("d-m-Y");
            $time = date("H:i:s");
           // $timestamp_sr = strtotime($datetime);
                $post = [
                    'UserID'    => $data->ID,
                    'LogName'   => 'LOGIN',
                  //  'timestamp' => $timestamp_sr,
                    'kota'      => $data->city,
                    'jam'       => $time,
                    'tanggal'   => $date,
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://enk9ow88jemp015.m.pipedream.net');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                $response = curl_exec($ch);

                return $response;
            }

                //dd($response);
                //var_export($response);
            // log user
    }

    public static function helpDataUser($phonenumber){
        $data = UserLogin::leftjoin('user_subscriptions','user_subscriptions.user_id','=','user_login.ID')
                ->leftjoin('tb_payment','tb_payment.user_id','=','user_login.ID')
            ->where('phonenumber',$phonenumber)
            ->first();
        $val = json_decode($data,true);

        return $val;
    }
    public static function helpMapel($iduserLogin){
        $data = TbUserKelas::select('*')
            ->join('tb_kelas','tb_user_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join('tb_mapel_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->where('tb_user_kelas.id_user',$iduserLogin)
            ->get();

        return $data;
    }

    public static function helpbanksoalTopik($fbuid,$jenjang,$kelas){
        if($kelas == null){
            $resultdatauser = UserLogin::where('phonenumber',$fbuid)
                    ->get();
            $resdata = $resultdatauser->toArray();

            $data = TbMapel::select('*')
                ->join('soal_lainlain','soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
                ->where('soal_lainlain.jenjang',$jenjang)
                ->get();

            $resultdata = $data->toArray();
        }else{
            $resultdatauser = UserLogin::where('phonenumber',$fbuid)
                    ->get();
            $resdata = $resultdatauser->toArray();

            $data = TbMapel::select('*')
                ->join('soal_lainlain','soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
                ->where('soal_lainlain.jenjang',$jenjang)
                ->where('soal_lainlain.kelas',$kelas)
                ->get();

            $resultdata = $data->toArray();
        }
        return $resultdata;
    }

    public static function helpTypesoal(){
        $dataTypesoal = TypeSoal::select('*')
                ->orderBy('id')
                ->get();

        return $dataTypesoal;
    }
    public static function helpTrialKonten(){
        $data = TbTrialKonten::select('*')
            ->join('tb_mapel_kelas','tb_trial_konten.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
            ->join('tb_kelas','tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join('tb_mapel','tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->join('tb_sub_topik_video','tb_trial_konten.id_subtopik_video','=','tb_sub_topik_video.id')
            ->join('tb_video_mapel','tb_sub_topik_video.id_video_mapel','=','tb_video_mapel.idvideomapel')
            ->orderBy('idtrialkonten','ASC')
            ->get();

        return $data;
    }
    public static function  helpTrialBankSoal(){
        $data = TbTrialBankSoal::select('*')
            ->join('master_soal','tb_trial_banksoal.id_master_soal','=','master_soal.ids')
            ->join('soal_lainlain','master_soal.id_lainlain','=','soal_lainlain.id')
            ->join('tb_mapel','soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
            ->get();

        return $data;
    }
    public static function helpKompetensi(){
        $dataKompetensi = TbKompetensi::all();
        return $dataKompetensi;
    }
    public static function helpSerbaserbi(){
        $dataSerbaserbi = TbSerbaSerbi::all();
        return $dataSerbaserbi;
    }
    public static function helpSekolahGuru(){
        $dataSekolahGuru = TbSekolah::all();
        return $dataSekolahGuru;
    }
    public static function helpTipsTrick(){
        $dataTipsTrick = TbTipsTrick::all();
        return $dataTipsTrick;
    }
    public static function helpVersion(){
        $dataVersion = TbVersion::all();
        return $dataVersion;
    }
    public static function helpYoutube(){
        $dataYoutube = TbYoutube::all();
        return $dataYoutube;
    }
}
