<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\models\SetupBenner;

class HelperReguler {
    public static function helpEvent(){
        $dataEvent = DB::table(DB::raw('klassku_db.tb_event'))
                ->orderBy('id_event','DESC')
                ->get();

        return $dataEvent;
    }
    public static function helpTextDashboard(){
        $dataTextDashboard = DB::table(DB::raw('klassku_db.tb_text_dashboard'))->get();
        return $dataTextDashboard;
    }
    public static function helpbanner(){
        $default = SetupBenner::select('id','picture_location as banner_image','banner_link','banner_name as banner_title')
                ->orderBy('id','DESC')
                ->where('isall',1)
                ->get();

        return $default;
    }
    public static function helpUserId($phonenumber){
        $data = DB::table(DB::raw('klassku_db.user_login'))
            ->where('user_login.phonenumber',$phonenumber)
            ->first()->ID;
        $val = json_decode($data,true);
        return $val;
    }
    public static function helpDataUser($phonenumber){
        $data = DB::table(DB::raw('klassku_db.user_login'))
            ->where('user_login.phonenumber',$phonenumber)
            ->get();
        $val = $data[0];
        return $val;
    }
    public static function helpMapel($iduserLogin){
        $data = DB::table(DB::raw('klassku_db.tb_user_kelas'))
            ->join(DB::raw('klassku_db.tb_kelas'),'tb_user_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->where('tb_user_kelas.id_user',$iduserLogin)
            ->get();

        return $data;
    }
    public static function helpbanksoalTopik($fbuid,$jenjang,$kelas){
        if($kelas == null){
            $resultdatauser = DB::table(DB::raw('klassku_db.user_login'))
                    ->where('phonenumber',$fbuid)
                    ->get();
            $resdata = $resultdatauser->toArray();

            $data = DB::table(DB::raw('klassku_db.tb_mapel'))
                ->join(DB::raw('klassku_db.soal_lainlain'),'soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
                ->where('soal_lainlain.jenjang',$jenjang)
                ->get();
            $resultdata = $data->toArray();
        }else{
            $resultdatauser = DB::table(DB::raw('klassku_db.user_login'))
                    ->where('phonenumber',$fbuid)
                    ->get();
            $resdata = $resultdatauser->toArray();

            $data = DB::table(DB::raw('klassku_db.tb_mapel'))
                ->join(DB::raw('klassku_db.soal_lainlain'),'soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
                ->where('soal_lainlain.jenjang',$jenjang)
                ->where('soal_lainlain.kelas',$kelas)
                ->get();

            $resultdata = $data->toArray();
        }
        return $resultdata;
    }
    public static function helpTypesoal(){
        $dataTypesoal = DB::table(DB::raw('klassku_db.type_soal'))
                ->orderBy('id')
                ->get();

        return $dataTypesoal;
    }
    public static function helpTrialKonten(){
        $data = DB::table(DB::raw('klassku_db.tb_trial_konten'))
            ->join(DB::raw('klassku_db.tb_mapel_kelas'),'tb_trial_konten.id_mapel_kelas','=','tb_mapel_kelas.idmapkelas')
            ->join(DB::raw('klassku_db.tb_kelas'),'tb_mapel_kelas.id_kelas','=','tb_kelas.idkelas')
            ->join(DB::raw('klassku_db.tb_mapel'),'tb_mapel_kelas.id_mapel','=','tb_mapel.id')
            ->join(DB::raw('klassku_db.tb_sub_topik_video'),'tb_trial_konten.id_subtopik_video','=','tb_sub_topik_video.id')
            ->join(DB::raw('klassku_db.tb_video_mapel'),'tb_sub_topik_video.id_video_mapel','=','tb_video_mapel.idvideomapel')
            ->get();

        return $data;
    }
    public static function  helpTrialBankSoal(){
        $data = DB::table(DB::raw('klassku_db.tb_trial_banksoal'))
            ->join(DB::raw('klassku_db.master_soal'),'tb_trial_banksoal.id_master_soal','=','master_soal.ids')
            ->join(DB::raw('klassku_db.soal_lainlain'),'master_soal.id_lainlain','=','soal_lainlain.id')
            ->join(DB::raw('klassku_db.tb_mapel'),'soal_lainlain.id_educations_subject_rev_1','=','tb_mapel.id')
            ->get();

        return $data;
    }
    public static function helpKompetensi(){
        $dataKompetensi = DB::table(DB::raw('klassku_db.tb_kompetensi'))->get();
        return $dataKompetensi;
    }
    public static function helpSerbaserbi(){
        $dataSerbaserbi = DB::table(DB::raw('klassku_db.tb_serbaserbi'))->get();
        return $dataSerbaserbi;
    }
    public static function helpSekolahGuru(){
        $dataSekolahGuru = DB::table(DB::raw('klassku_guru.tb_sekolah'))->get();
        return $dataSekolahGuru;
    }
    public static function helpTipsTrick(){
        $dataTipsTrick = DB::table(DB::raw('klassku_db.tb_tipstrick'))->get();
        return $dataTipsTrick;
    }
    public static function helpVersion(){
        $dataVersion = DB::table(DB::raw('klassku_db.tb_version'))->get();
        return $dataVersion;
    }
    public static function helpYoutube(){
        $dataYoutube = DB::table(DB::raw('klassku_db.tb_youtube'))->get();
        return $dataYoutube;
    }
}
