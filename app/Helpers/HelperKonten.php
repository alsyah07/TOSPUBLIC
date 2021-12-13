<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use App\models\MasterSoal;
use App\models\TbMapel;
use App\models\TbSoalText;
use App\models\TbTypesoal;
use App\models\SetupBenner;
use App\models\TbEvent;
use App\models\TbSerbaserbi;
use App\models\TbKompetensi;
use App\models\TbTipsTrick;
use App\models\TbTextDasboard;
use App\models\TbPesertaTryout;
use App\models\TbVersion;
use App\models\TbYoutube;
use App\models\TbSkor;
use App\models\KirimJawaban;
use App\models\TbPersoal;
use Illuminate\Support\Facades\DB;


class HelperKonten {

    public static function responapiall($data,$pesanapi,$apiresponberhasil,$objectarray){
        if($data != null || $data != ""){
            $responkonten = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => $apiresponberhasil,
                        'response_message' => $pesanapi,
                        'parameters' => [
                            $objectarray => $data
                        ]
                    ]
                ]
            );
        } else{
            $responkonten = response()->json(
            [
                'api_status'         => '2',
                'api_response_code'  => 500,
                'api_message'        => 'Api Failed',
                'api_data'           => [
                        'response_code' => $apiresponberhasil,
                        'response_message' => $pesanapi,
                        'parameters' => [
                            $objectarray => 'kosong'
                        ]
                    ]
            ]);
        }
            return $responkonten;
    }

    public static function respondaftarpeserta($dataPeserta,$pesanapi,$apiresponberhasil,$objectarray,$notif){
        if ($dataPeserta !=null || $dataPeserta !=""){
            $responpeserta = response()->json(
                [
                    'api_status'         => '1',
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code'     =>  $apiresponberhasil,
                        'response_message'   =>  $pesanapi,
                        'parameters'        => [
                                $objectarray => $dataPeserta,
                                'notif'      => $notif,
                        ]
                    ]
                ]
            );
        } else {
            $responpeserta = response()->json(
                [
                    'api_status'         => '2',
                    'api_response_code'  => 500,
                    'api_message'        => 'Api Failed',
                ]
                );
            }
            return $responpeserta;
    }

    public static function responkontentryout($datauser,$dataredeem,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1){
        $textberhasilredeem = "Selamat redeem kamu berhasil, silahkan tunggu pulsa dari kami";
        $textgagalredeem    = "Mohon maaf redeem sudah penuh"; 
        if($datauser != null || $datauser != ""){
            $responkonten = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => $apiresponberhasil,
                        'response_message' => $pesanapi,
                        'parameters' => [
                            $objectarray => $datauser,
                            $objectarray1 => $dataredeem,
                            'textredeemberhasil' => $textberhasilredeem,
                            'textredeemgagal'    => $textgagalredeem,
                        ]
                    ]
                ]
            );
        } else{
            $responkonten = response()->json(
            [
                'api_status'         => '2',
                'api_response_code'  => 500,
                'api_message'        => 'Api Failed',
            ]);
        }
            return $responkonten;
    }


    public static function responkonten($dataredeem,$jumlahDataRedeem,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1){
        $textberhasilredeem = "Selamat redeem kamu berhasil, silahkan tunggu pulsa dari kami";
        $textgagalredeem    = "Mohon maaf redeem sudah penuh";
        if($dataredeem != null || $dataredeem != ""){
            $responkonten = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => $apiresponberhasil,
                        'response_message' => $pesanapi,
                        'parameters' => [
                            $objectarray1 => $jumlahDataRedeem,
                            $objectarray => $dataredeem,
                            'textredeemberhasil' => $textberhasilredeem,
                            'textredeemgagal'    => $textgagalredeem,
                        ]
                    ]
                ]
            );
        } else{
            $responkonten = response()->json(
            [
                'api_status'         => '2',
                'api_response_code'  => 500,
                'api_message'        => 'Api Failed',
            ]);
        }
            return $responkonten;
    }



    public static function responapi($dataTryout,$dataTahapanSoal,$datarespon,$datajoin,$pesanapi,$apiresponberhasil,$objectarray,$objectarray1,$tahapanTryout,$timestamp_server,$jeda_waktu){
        // dd($datajoin['dd4']);
        $dataSoal1 =$datajoin['dd1'];
        $dataSoal2 =$datajoin['dd2'];
        $dataSoal3 =$datajoin['dd3'];
        $dataSoal4 =$datajoin['dd4'];

        $dataTryout['timestamp_server'] =  $timestamp_server;
        $dataTryout['jeda_waktu'] =$jeda_waktu;

        for($i = 1; $i <= sizeof($dataTahapanSoal);$i++){
            $dummy[$i-1] = $dataTahapanSoal[$i];
            $dummy[$i-1]['soal'] = $dataSoal1;
        }

        for($i = 2;$i==2;$i++){
            $dummy[$i-1] = $dataTahapanSoal[$i];
            $dummy[$i-1]['soal'] = $dataSoal2;
        }

        for($i = 3;$i==3;$i++){
            $dummy[$i-1] = $dataTahapanSoal[$i];
            $dummy[$i-1]['soal'] = $dataSoal3;
        }

        for($i = 4;$i==4;$i++){
            $dummy[$i-1] = $dataTahapanSoal[$i];
            $dummy[$i-1]['soal'] = $dataSoal4;
        }
        //dd($dataTahapanSoal);  cus 4


        if ($datarespon !=null || $datarespon !=""){
            $responapi = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => $apiresponberhasil,
                        'response_message' => $pesanapi,
                        'parameters' => [
                            $objectarray => $dataTryout,
                            $objectarray1 => $dummy
                        ]
                    ]
                ]
            );
        } else {
            $responapi = response()->json(
                [
                    'api_status'         => 2,
                    'api_response_code'  => 500,
                    'api_message'        => 'Api Failed',
                ]
                );
            }
        return $responapi;
    }

    public static function responpeserta($link,$datarespon,$pesanapi,$apiresponberhasil,$objectarray){
        if ($datarespon !=null || $datarespon !=""){
            $responpeserta = response()->json(
                [
                    'api_status'         => '1',
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code'     =>  $apiresponberhasil,
                        'response_message'   =>  $pesanapi,
                        'parameters'        => [
                            $objectarray => $datarespon,
                            'link' => $link
                        ]
                    ]
                ]
            );
        } else {
            $responpeserta = response()->json(
                [
                    'api_status'         => '2',
                    'api_response_code'  => 500,
                    'api_message'        => 'Api Failed',
                ]
                );
            }
            return $responpeserta;
    }

    public static function helpEvent(){
        $dataEvent = TbEvent::all();
        return $dataEvent;
    }
    public static function helpTextDashboard(){
        $dataTextDashboard = TbTextDasboard::all();
        return $dataTextDashboard;
    }
    public static function helpbanner(){
        $default = SetupBenner::all();
        return $default;
    }
    public static function helpKompetensi(){
        $dataKompetensi = TbKompetensi::all();
        return $dataKompetensi;
    }
    public static function helpSerbaserbi(){
        $dataSerbaserbi = TbSerbaserbi::all();
        return $dataSerbaserbi;
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

    public static function tahapanTryout(){
        $tahapan1 = array(
            'tahapan_soal' => "penalaran_umum",
            'durasi'       => "20",
            'no_urut'      => "1",
        );
        $tahapan2 = array(
            'tahapan_soal' => "pengetahuan_kuantitatif",
            'durasi'       => "20",
            'no_urut'      => "2",
        );
        $tahapan3 = array(
            'tahapan_soal' => "pemahaman_membaca_dan_menulis",
            'durasi'       => "20",
            'no_urut'      => "3",
        );
        $tahapan4 = array(
            'tahapan_soal' => "pengetahuan_dan_pemahaman_umum",
            'durasi'       => "20",
            'no_urut'      => "4",
        );

        $dataArrayTahapan = array(
            "1" => $tahapan1,
            "2" => $tahapan2,
            "3" => $tahapan3,
            "4" => $tahapan4,
        );

        return $dataArrayTahapan;
    }

    public static function responkirimjawaban($datarespon,$pesanapi,$apiresponberhasil,$objectarray,$notif){
        if($datarespon !=null || $datarespon != ""){
         //   dd($datarespon->detail_data);
            // $resdatadetail = json_decode($datarespon->detail_data);
            // $drt =  $datarespon[0]['detail_data'];


            $responkirimjawaban = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code'     =>  $apiresponberhasil,
                        'response_message'   =>  $pesanapi,
                        'parameters' => [
                            $objectarray => $datarespon,
                            'notif'      => $notif,
                        ]
                    ]
                ]
            );
        }else{
            $responkirimjawaban = response()->json(
                [
                    'api_status'         => '2',
                    'api_response_code'  => 500,
                    'api_message'        => 'Api Failed',
                ]
            );
        }
        return $responkirimjawaban;
    }

    public static function nilaiSkor($jumlahPeserta){
        $query1 = TbPersoal::select('*')->where('soal_1','!=','tidak jawab')->get();
        $query2 = TbPersoal::select('*')->where('soal_2','!=','tidak jawab')->get();
        $query3 = TbPersoal::select('*')->where('soal_3','!=','tidak jawab')->get();
        $query4 = TbPersoal::select('*')->where('soal_4','!=','tidak jawab')->get();
        $query5 = TbPersoal::select('*')->where('soal_5','!=','tidak jawab')->get();
        $query6 = TbPersoal::select('*')->where('soal_6','!=','tidak jawab')->get();
        $query7 = TbPersoal::select('*')->where('soal_7','!=','tidak jawab')->get();
        $query8 = TbPersoal::select('*')->where('soal_8','!=','tidak jawab')->get();
        $query9 = TbPersoal::select('*')->where('soal_9','!=','tidak jawab')->get();
        $query10 = TbPersoal::select('*')->where('soal_10','!=','tidak jawab')->get();
        $query11 = TbPersoal::select('*')->where('soal_11','!=','tidak jawab')->get();
        $query12 = TbPersoal::select('*')->where('soal_12','!=','tidak jawab')->get();
        $query13 = TbPersoal::select('*')->where('soal_13','!=','tidak jawab')->get();
        $query14 = TbPersoal::select('*')->where('soal_14','!=','tidak jawab')->get();
        $query15 = TbPersoal::select('*')->where('soal_15','!=','tidak jawab')->get();
        $query16 = TbPersoal::select('*')->where('soal_16','!=','tidak jawab')->get();
        $query17 = TbPersoal::select('*')->where('soal_17','!=','tidak jawab')->get();
        $query18 = TbPersoal::select('*')->where('soal_18','!=','tidak jawab')->get();
        $query19 = TbPersoal::select('*')->where('soal_19','!=','tidak jawab')->get();
        $query20 = TbPersoal::select('*')->where('soal_20','!=','tidak jawab')->get();
        $query21 = TbPersoal::select('*')->where('soal_21','!=','tidak jawab')->get();
        $query22 = TbPersoal::select('*')->where('soal_22','!=','tidak jawab')->get();
        $query23 = TbPersoal::select('*')->where('soal_23','!=','tidak jawab')->get();
        $query24 = TbPersoal::select('*')->where('soal_24','!=','tidak jawab')->get();
        $query25 = TbPersoal::select('*')->where('soal_25','!=','tidak jawab')->get();
        $query26 = TbPersoal::select('*')->where('soal_26','!=','tidak jawab')->get();
        $query27 = TbPersoal::select('*')->where('soal_27','!=','tidak jawab')->get();
        $query28 = TbPersoal::select('*')->where('soal_28','!=','tidak jawab')->get();
        $query29 = TbPersoal::select('*')->where('soal_29','!=','tidak jawab')->get();
        $query30 = TbPersoal::select('*')->where('soal_30','!=','tidak jawab')->get();
        $query31 = TbPersoal::select('*')->where('soal_31','!=','tidak jawab')->get();
        $query32 = TbPersoal::select('*')->where('soal_32','!=','tidak jawab')->get();
        $query33 = TbPersoal::select('*')->where('soal_33','!=','tidak jawab')->get();
        $query34 = TbPersoal::select('*')->where('soal_34','!=','tidak jawab')->get();
        $query35 = TbPersoal::select('*')->where('soal_35','!=','tidak jawab')->get();
        $query36 = TbPersoal::select('*')->where('soal_36','!=','tidak jawab')->get();
        $query37 = TbPersoal::select('*')->where('soal_37','!=','tidak jawab')->get();
        $query38 = TbPersoal::select('*')->where('soal_38','!=','tidak jawab')->get();
        $query39 = TbPersoal::select('*')->where('soal_39','!=','tidak jawab')->get();
        $query40 = TbPersoal::select('*')->where('soal_40','!=','tidak jawab')->get();
        $query41 = TbPersoal::select('*')->where('soal_41','!=','tidak jawab')->get();
        $query42 = TbPersoal::select('*')->where('soal_42','!=','tidak jawab')->get();
        $query43 = TbPersoal::select('*')->where('soal_43','!=','tidak jawab')->get();
        $query44 = TbPersoal::select('*')->where('soal_44','!=','tidak jawab')->get();
        $query45 = TbPersoal::select('*')->where('soal_45','!=','tidak jawab')->get();
        $query46 = TbPersoal::select('*')->where('soal_46','!=','tidak jawab')->get();
        $query47 = TbPersoal::select('*')->where('soal_47','!=','tidak jawab')->get();
        $query48 = TbPersoal::select('*')->where('soal_48','!=','tidak jawab')->get();
        $query49 = TbPersoal::select('*')->where('soal_49','!=','tidak jawab')->get();
        $query50 = TbPersoal::select('*')->where('soal_50','!=','tidak jawab')->get();
        $query51 = TbPersoal::select('*')->where('soal_51','!=','tidak jawab')->get();
        $query52 = TbPersoal::select('*')->where('soal_52','!=','tidak jawab')->get();
        $query53 = TbPersoal::select('*')->where('soal_53','!=','tidak jawab')->get();
        $query54 = TbPersoal::select('*')->where('soal_54','!=','tidak jawab')->get();
        $query55 = TbPersoal::select('*')->where('soal_55','!=','tidak jawab')->get();
        $query56 = TbPersoal::select('*')->where('soal_56','!=','tidak jawab')->get();
        $query57 = TbPersoal::select('*')->where('soal_57','!=','tidak jawab')->get();
        $query58 = TbPersoal::select('*')->where('soal_58','!=','tidak jawab')->get();
        $query59 = TbPersoal::select('*')->where('soal_59','!=','tidak jawab')->get();
        $query60 = TbPersoal::select('*')->where('soal_60','!=','tidak jawab')->get();
        $query61 = TbPersoal::select('*')->where('soal_61','!=','tidak jawab')->get();
        $query62 = TbPersoal::select('*')->where('soal_62','!=','tidak jawab')->get();
        $query63 = TbPersoal::select('*')->where('soal_63','!=','tidak jawab')->get();
        $query64 = TbPersoal::select('*')->where('soal_64','!=','tidak jawab')->get();
        $query65 = TbPersoal::select('*')->where('soal_65','!=','tidak jawab')->get();
        $query66 = TbPersoal::select('*')->where('soal_66','!=','tidak jawab')->get();
        $query67 = TbPersoal::select('*')->where('soal_67','!=','tidak jawab')->get();
        $query68 = TbPersoal::select('*')->where('soal_68','!=','tidak jawab')->get();
        $query69 = TbPersoal::select('*')->where('soal_69','!=','tidak jawab')->get();
        $query70 = TbPersoal::select('*')->where('soal_70','!=','tidak jawab')->get();
        $query71 = TbPersoal::select('*')->where('soal_71','!=','tidak jawab')->get();
        $query72 = TbPersoal::select('*')->where('soal_72','!=','tidak jawab')->get();
        $query73 = TbPersoal::select('*')->where('soal_73','!=','tidak jawab')->get();
        $query74 = TbPersoal::select('*')->where('soal_74','!=','tidak jawab')->get();
        $query75 = TbPersoal::select('*')->where('soal_75','!=','tidak jawab')->get();
        $query76 = TbPersoal::select('*')->where('soal_76','!=','tidak jawab')->get();
        $query77 = TbPersoal::select('*')->where('soal_77','!=','tidak jawab')->get();
        $query78 = TbPersoal::select('*')->where('soal_78','!=','tidak jawab')->get();
        $query79 = TbPersoal::select('*')->where('soal_79','!=','tidak jawab')->get();
        $query80 = TbPersoal::select('*')->where('soal_80','!=','tidak jawab')->get();

        //---------------benar-------------------
        $benar_1 = 0;
        $benar_2 = 0;
        $benar_3 = 0;
        $benar_4 = 0;
        $benar_5 = 0;
        $benar_6 = 0;
        $benar_7 = 0;
        $benar_8 = 0;
        $benar_9 = 0;
        $benar_10 = 0;
        $benar_11 = 0;
        $benar_12 = 0;
        $benar_13 = 0;
        $benar_14 = 0;
        $benar_15 = 0;
        $benar_16 = 0;
        $benar_17 = 0;
        $benar_18 = 0;
        $benar_19 = 0;
        $benar_20 = 0;
        $benar_21 = 0;
        $benar_22 = 0;
        $benar_23 = 0;
        $benar_24 = 0;
        $benar_25 = 0;
        $benar_26 = 0;
        $benar_27 = 0;
        $benar_28 = 0;
        $benar_29 = 0;
        $benar_30 = 0;
        $benar_31 = 0;
        $benar_32 = 0;
        $benar_33 = 0;
        $benar_34 = 0;
        $benar_35 = 0;
        $benar_36 = 0;
        $benar_37 = 0;
        $benar_38 = 0;
        $benar_39 = 0;
        $benar_40 = 0;
        $benar_41 = 0;
        $benar_42 = 0;
        $benar_43 = 0;
        $benar_44 = 0;
        $benar_45 = 0;
        $benar_46 = 0;
        $benar_47 = 0;
        $benar_48 = 0;
        $benar_49 = 0;
        $benar_50 = 0;
        $benar_51 = 0;
        $benar_52 = 0;
        $benar_53 = 0;
        $benar_54 = 0;
        $benar_55 = 0;
        $benar_56 = 0;
        $benar_57 = 0;
        $benar_58 = 0;
        $benar_59 = 0;
        $benar_60 = 0;
        $benar_61 = 0;
        $benar_62 = 0;
        $benar_63 = 0;
        $benar_64 = 0;
        $benar_65 = 0;
        $benar_66 = 0;
        $benar_67 = 0;
        $benar_68 = 0;
        $benar_69 = 0;
        $benar_70 = 0;
        $benar_71 = 0;
        $benar_72 = 0;
        $benar_73 = 0;
        $benar_74 = 0;
        $benar_75 = 0;
        $benar_76 = 0;
        $benar_77 = 0;
        $benar_78 = 0;
        $benar_79 = 0;
        $benar_80 = 0;

        $salah_1 = 0;
        $salah_2 = 0;
        $salah_3 = 0;
        $salah_4 = 0;
        $salah_5 = 0;
        $salah_6 = 0;
        $salah_7 = 0;
        $salah_8 = 0;
        $salah_9 = 0;
        $salah_10 = 0;
        $salah_11 = 0;
        $salah_12 = 0;
        $salah_13 = 0;
        $salah_14 = 0;
        $salah_15 = 0;
        $salah_16 = 0;
        $salah_17 = 0;
        $salah_18 = 0;
        $salah_19 = 0;
        $salah_20 = 0;
        $salah_21 = 0;
        $salah_22 = 0;
        $salah_23 = 0;
        $salah_24 = 0;
        $salah_25 = 0;
        $salah_26 = 0;
        $salah_27 = 0;
        $salah_28 = 0;
        $salah_29 = 0;
        $salah_30 = 0;
        $salah_31 = 0;
        $salah_32 = 0;
        $salah_33 = 0;
        $salah_34 = 0;
        $salah_35 = 0;
        $salah_36 = 0;
        $salah_37 = 0;
        $salah_38 = 0;
        $salah_39 = 0;
        $salah_40 = 0;
        $salah_41 = 0;
        $salah_42 = 0;
        $salah_43 = 0;
        $salah_44 = 0;
        $salah_45 = 0;
        $salah_46 = 0;
        $salah_47 = 0;
        $salah_48 = 0;
        $salah_49 = 0;
        $salah_50 = 0;
        $salah_51 = 0;
        $salah_52 = 0;
        $salah_53 = 0;
        $salah_54 = 0;
        $salah_55 = 0;
        $salah_56 = 0;
        $salah_57 = 0;
        $salah_58 = 0;
        $salah_59 = 0;
        $salah_60 = 0;
        $salah_61 = 0;
        $salah_62 = 0;
        $salah_63 = 0;
        $salah_64 = 0;
        $salah_65 = 0;
        $salah_66 = 0;
        $salah_67 = 0;
        $salah_68 = 0;
        $salah_69 = 0;
        $salah_70 = 0;
        $salah_71 = 0;
        $salah_72 = 0;
        $salah_73 = 0;
        $salah_74 = 0;
        $salah_75 = 0;
        $salah_76 = 0;
        $salah_77 = 0;
        $salah_78 = 0;
        $salah_79 = 0;
        $salah_80 = 0;


        $data = array();

        foreach($query1 as $val){
            if($val['soal_1'] == null){

            }else if($val['soal_1'] == 'benar'){
                $benar_1++;
            }else if($val['soal_1'] == 'salah'){
                $salah_1++;
            }
            $orang_jawab = $benar_1 + $salah_1;
        }
        $soal1 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_1 /$jumlahPeserta));

        foreach($query2 as $val){
            if($val['soal_2'] == null){

            }else if($val['soal_2'] == 'benar'){
                $benar_2++;
            }else if($val['soal_2'] == 'salah'){
                $salah_2++;
            }
            $orang_jawab = $benar_2 + $salah_2;
        }
        $soal2 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_2 /$jumlahPeserta));

        foreach($query3 as $val){
            if($val['soal_3'] == null){

            }else if($val['soal_3'] == 'benar'){
                $benar_3++;
            }else if($val['soal_3'] == 'salah'){
                $salah_3++;
            }
            $orang_jawab = $benar_3 + $salah_3;
        }
        $soal3 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_3 /$jumlahPeserta));

        foreach($query4 as $val){
            if($val['soal_4'] == null){

            }else if($val['soal_4'] == 'benar'){
                $benar_4++;
            }else if($val['soal_4'] == 'salah'){
                $salah_4++;
            }
            $orang_jawab = $benar_4 + $salah_4;
        }
        $soal4 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_4 /$jumlahPeserta));

        foreach($query5 as $val){
            if($val['soal_5'] == null){

            }else if($val['soal_5'] == 'benar'){
                $benar_5++;
            }else if($val['soal_5'] == 'salah'){
                $salah_5++;
            }
            $orang_jawab = $benar_5 + $salah_5;
        }
        $soal5 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_5 /$jumlahPeserta));

        foreach($query6 as $val){
            if($val['soal_6'] == null){

            }else if($val['soal_6'] == 'benar'){
                $benar_6++;
            }else if($val['soal_6'] == 'salah'){
                $salah_6++;
            }
            $orang_jawab = $benar_6 + $salah_6;
        }
        $soal6 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_6 /$jumlahPeserta));

        foreach($query7 as $val){
            if($val['soal_7'] == null){

            }else if($val['soal_7'] == 'benar'){
                $benar_7++;
            }else if($val['soal_7'] == 'salah'){
                $salah_7++;
            }
            $orang_jawab = $benar_7 + $salah_7;
        }
        $soal7 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_7 /$jumlahPeserta));

        foreach($query8 as $val){
            if($val['soal_8'] == null){

            }else if($val['soal_8'] == 'benar'){
                $benar_8++;
            }else if($val['soal_8'] == 'salah'){
                $salah_8++;
            }
            $orang_jawab = $benar_8 + $salah_8;
        }
        $soal8 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_8 /$jumlahPeserta));

        foreach($query9 as $val){
            if($val['soal_9'] == null){

            }else if($val['soal_9'] == 'benar'){
                $benar_9++;
            }else if($val['soal_9'] == 'salah'){
                $salah_9++;
            }
            $orang_jawab = $benar_9 + $salah_9;
        }
        $soal9 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_9 /$jumlahPeserta));

        foreach($query10 as $val){
            if($val['soal_10'] == null){

            }else if($val['soal_10'] == 'benar'){
                $benar_10++;
            }else if($val['soal_10'] == 'salah'){
                $salah_10++;
            }
            $orang_jawab = $benar_10 + $salah_10;
        }
        $soal10 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_10 /$jumlahPeserta));

        foreach($query11 as $val){
            if($val['soal_11'] == null){

            }else if($val['soal_11'] == 'benar'){
                $benar_11++;
            }else if($val['soal_11'] == 'salah'){
                $salah_11++;
            }
            $orang_jawab = $benar_11 + $salah_11;
        }
        $soal11 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_11 /$jumlahPeserta));

        foreach($query12 as $val){
            if($val['soal_12'] == null){

            }else if($val['soal_12'] == 'benar'){
                $benar_12++;
            }else if($val['soal_12'] == 'salah'){
                $salah_12++;
            }
            $orang_jawab = $benar_12 + $salah_12;
        }
        $soal12 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_12 /$jumlahPeserta));

        foreach($query13 as $val){
            if($val['soal_13'] == null){

            }else if($val['soal_13'] == 'benar'){
                $benar_13++;
            }else if($val['soal_13'] == 'salah'){
                $salah_13++;
            }
            $orang_jawab = $benar_13 + $salah_13;
        }
        $soal13 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_13 /$jumlahPeserta));

        foreach($query14 as $val){
            if($val['soal_14'] == null){

            }else if($val['soal_14'] == 'benar'){
                $benar_14++;
            }else if($val['soal_14'] == 'salah'){
                $salah_14++;
            }
            $orang_jawab = $benar_14 + $salah_14;
        }
        $soal14 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_14 /$jumlahPeserta));

        foreach($query15 as $val){
            if($val['soal_15'] == null){

            }else if($val['soal_15'] == 'benar'){
                $benar_15++;
            }else if($val['soal_15'] == 'salah'){
                $salah_15++;
            }
            $orang_jawab = $benar_15 + $salah_15;
        }
        $soal15 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_15 /$jumlahPeserta));

        foreach($query16 as $val){
            if($val['soal_16'] == null){

            }else if($val['soal_16'] == 'benar'){
                $benar_16++;
            }else if($val['soal_16'] == 'salah'){
                $salah_16++;
            }
            $orang_jawab = $benar_16 + $salah_16;
        }
        $soal16 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_16 /$jumlahPeserta));

        foreach($query17 as $val){
            if($val['soal_17'] == null){

            }else if($val['soal_17'] == 'benar'){
                $benar_17++;
            }else if($val['soal_17'] == 'salah'){
                $salah_17++;
            }
            $orang_jawab = $benar_17 + $salah_17;
        }
        $soal17 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_17 /$jumlahPeserta));

        foreach($query18 as $val){
            if($val['soal_18'] == null){

            }else if($val['soal_18'] == 'benar'){
                $benar_18++;
            }else if($val['soal_18'] == 'salah'){
                $salah_18++;
            }
            $orang_jawab = $benar_18 + $salah_18;
        }
        $soal18 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_18 /$jumlahPeserta));

        foreach($query19 as $val){
            if($val['soal_19'] == null){

            }else if($val['soal_19'] == 'benar'){
                $benar_19++;
            }else if($val['soal_19'] == 'salah'){
                $salah_19++;
            }
            $orang_jawab = $benar_19 + $salah_19;
        }
        $soal19 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_19 /$jumlahPeserta));

        foreach($query20 as $val){
            if($val['soal_20'] == null){

            }else if($val['soal_20'] == 'benar'){
                $benar_20++;
            }else if($val['soal_20'] == 'salah'){
                $salah_20++;
            }
            $orang_jawab = $benar_20 + $salah_20;
        }
        $soal20 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_20 /$jumlahPeserta));

        foreach($query21 as $val){
            if($val['soal_21'] == null){

            }else if($val['soal_21'] == 'benar'){
                $benar_21++;
            }else if($val['soal_21'] == 'salah'){
                $salah_21++;
            }
            $orang_jawab = $benar_21 + $salah_21;
        }
        $soal21 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_21 /$jumlahPeserta));

        foreach($query22 as $val){
            if($val['soal_22'] == null){

            }else if($val['soal_22'] == 'benar'){
                $benar_22++;
            }else if($val['soal_22'] == 'salah'){
                $salah_22++;
            }
            $orang_jawab = $benar_22 + $salah_22;
        }
        $soal22 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_22 /$jumlahPeserta));

        foreach($query23 as $val){
            if($val['soal_23'] == null){

            }else if($val['soal_23'] == 'benar'){
                $benar_23++;
            }else if($val['soal_23'] == 'salah'){
                $salah_23++;
            }
            $orang_jawab = $benar_23 + $salah_23;
        }
        $soal23 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_23 /$jumlahPeserta));

        foreach($query24 as $val){
            if($val['soal_24'] == null){

            }else if($val['soal_24'] == 'benar'){
                $benar_24++;
            }else if($val['soal_24'] == 'salah'){
                $salah_24++;
            }
            $orang_jawab = $benar_24 + $salah_24;
        }
        $soal24 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_24 /$jumlahPeserta));

        foreach($query25 as $val){
            if($val['soal_25'] == null){

            }else if($val['soal_25'] == 'benar'){
                $benar_25++;
            }else if($val['soal_25'] == 'salah'){
                $salah_25++;
            }
            $orang_jawab = $benar_25 + $salah_25;
        }
        $soal25 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_25 /$jumlahPeserta));

        foreach($query26 as $val){
            if($val['soal_26'] == null){

            }else if($val['soal_26'] == 'benar'){
                $benar_26++;
            }else if($val['soal_26'] == 'salah'){
                $salah_26++;
            }
            $orang_jawab = $benar_26 + $salah_26;
        }
        $soal26 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_26 /$jumlahPeserta));

        foreach($query27 as $val){
            if($val['soal_27'] == null){

            }else if($val['soal_27'] == 'benar'){
                $benar_27++;
            }else if($val['soal_27'] == 'salah'){
                $salah_27++;
            }
            $orang_jawab = $benar_27 + $salah_27;
        }
        $soal27 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_27 /$jumlahPeserta));

        foreach($query28 as $val){
            if($val['soal_28'] == null){

            }else if($val['soal_28'] == 'benar'){
                $benar_28++;
            }else if($val['soal_28'] == 'salah'){
                $salah_28++;
            }
            $orang_jawab = $benar_28 + $salah_28;
        }
        $soal28 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_28 /$jumlahPeserta));

        foreach($query29 as $val){
            if($val['soal_29'] == null){

            }else if($val['soal_29'] == 'benar'){
                $benar_29++;
            }else if($val['soal_29'] == 'salah'){
                $salah_29++;
            }
            $orang_jawab = $benar_29 + $salah_29;
        }
        $soal29 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_29 /$jumlahPeserta));

        foreach($query30 as $val){
            if($val['soal_30'] == null){

            }else if($val['soal_30'] == 'benar'){
                $benar_30++;
            }else if($val['soal_30'] == 'salah'){
                $salah_30++;
            }
            $orang_jawab = $benar_30 + $salah_30;
        }
        $soal30 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_30 /$jumlahPeserta));

        foreach($query31 as $val){
            if($val['soal_31'] == null){

            }else if($val['soal_31'] == 'benar'){
                $benar_31++;
            }else if($val['soal_31'] == 'salah'){
                $salah_31++;
            }
            $orang_jawab = $benar_31 + $salah_31;
        }
        $soal31 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_31 /$jumlahPeserta));

        foreach($query32 as $val){
            if($val['soal_32'] == null){

            }else if($val['soal_32'] == 'benar'){
                $benar_32++;
            }else if($val['soal_32'] == 'salah'){
                $salah_32++;
            }
            $orang_jawab = $benar_32 + $salah_32;
        }
        $soal32 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_32 /$jumlahPeserta));

        foreach($query33 as $val){
            if($val['soal_33'] == null){

            }else if($val['soal_33'] == 'benar'){
                $benar_33++;
            }else if($val['soal_33'] == 'salah'){
                $salah_33++;
            }
            $orang_jawab = $benar_33 + $salah_33;
        }
        $soal33 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_33 /$jumlahPeserta));

        foreach($query34 as $val){
            if($val['soal_34'] == null){

            }else if($val['soal_34'] == 'benar'){
                $benar_34++;
            }else if($val['soal_34'] == 'salah'){
                $salah_34++;
            }
            $orang_jawab = $benar_34 + $salah_34;
        }
        $soal34 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_34 /$jumlahPeserta));

        foreach($query35 as $val){
            if($val['soal_35'] == null){

            }else if($val['soal_35'] == 'benar'){
                $benar_35++;
            }else if($val['soal_35'] == 'salah'){
                $salah_35++;
            }
            $orang_jawab = $benar_35 + $salah_35;
        }
        $soal35 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_35 /$jumlahPeserta));

        foreach($query36 as $val){
            if($val['soal_36'] == null){

            }else if($val['soal_36'] == 'benar'){
                $benar_36++;
            }else if($val['soal_36'] == 'salah'){
                $salah_36++;
            }
            $orang_jawab = $benar_36 + $salah_36;
        }
        $soal36 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_36 /$jumlahPeserta));

        foreach($query37 as $val){
            if($val['soal_37'] == null){

            }else if($val['soal_37'] == 'benar'){
                $benar_37++;
            }else if($val['soal_37'] == 'salah'){
                $salah_37++;
            }
            $orang_jawab = $benar_37 + $salah_37;
        }
        $soal37 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_37 /$jumlahPeserta));

        foreach($query38 as $val){
            if($val['soal_38'] == null){

            }else if($val['soal_38'] == 'benar'){
                $benar_38++;
            }else if($val['soal_38'] == 'salah'){
                $salah_38++;
            }
            $orang_jawab = $benar_33 + $salah_38;
        }
        $soal38 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_38 /$jumlahPeserta));

        foreach($query39 as $val){
            if($val['soal_39'] == null){

            }else if($val['soal_39'] == 'benar'){
                $benar_39++;
            }else if($val['soal_39'] == 'salah'){
                $salah_39++;
            }
            $orang_jawab = $benar_39 + $salah_39;
        }
        $soal39 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_39 /$jumlahPeserta));

        foreach($query40 as $val){
            if($val['soal_40'] == null){

            }else if($val['soal_40'] == 'benar'){
                $benar_40++;
            }else if($val['soal_40'] == 'salah'){
                $salah_40++;
            }
            $orang_jawab = $benar_40 + $salah_40;
        }
        $soal40 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_40 /$jumlahPeserta));

        foreach($query41 as $val){
            if($val['soal_41'] == null){

            }else if($val['soal_41'] == 'benar'){
                $benar_41++;
            }else if($val['soal_41'] == 'salah'){
                $salah_41++;
            }
            $orang_jawab = $benar_41 + $salah_41;
        }
        $soal41 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_41 /$jumlahPeserta));

        foreach($query42 as $val){
            if($val['soal_42'] == null){

            }else if($val['soal_42'] == 'benar'){
                $benar_42++;
            }else if($val['soal_42'] == 'salah'){
                $salah_42++;
            }
            $orang_jawab = $benar_42 + $salah_42;
        }
        $soal42 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_42 /$jumlahPeserta));

        foreach($query43 as $val){
            if($val['soal_43'] == null){

            }else if($val['soal_43'] == 'benar'){
                $benar_43++;
            }else if($val['soal_43'] == 'salah'){
                $salah_43++;
            }
            $orang_jawab = $benar_43 + $salah_43;
        }
        $soal43 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_43 /$jumlahPeserta));

        foreach($query44 as $val){
            if($val['soal_44'] == null){

            }else if($val['soal_44'] == 'benar'){
                $benar_44++;
            }else if($val['soal_44'] == 'salah'){
                $salah_44++;
            }
            $orang_jawab = $benar_44 + $salah_44;
        }
        $soal44 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_44 /$jumlahPeserta));

        foreach($query45 as $val){
            if($val['soal_45'] == null){

            }else if($val['soal_45'] == 'benar'){
                $benar_45++;
            }else if($val['soal_45'] == 'salah'){
                $salah_45++;
            }
            $orang_jawab = $benar_45 + $salah_45;
        }
        $soal45 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_45 /$jumlahPeserta));

        foreach($query46 as $val){
            if($val['soal_46'] == null){

            }else if($val['soal_46'] == 'benar'){
                $benar_46++;
            }else if($val['soal_46'] == 'salah'){
                $salah_46++;
            }
            $orang_jawab = $benar_46 + $salah_46;
        }
        $soal46 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_46 /$jumlahPeserta));

        foreach($query47 as $val){
            if($val['soal_47'] == null){

            }else if($val['soal_47'] == 'benar'){
                $benar_47++;
            }else if($val['soal_47'] == 'salah'){
                $salah_47++;
            }
            $orang_jawab = $benar_47 + $salah_47;
        }
        $soal47 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_47 /$jumlahPeserta));

        foreach($query48 as $val){
            if($val['soal_48'] == null){

            }else if($val['soal_48'] == 'benar'){
                $benar_48++;
            }else if($val['soal_48'] == 'salah'){
                $salah_48++;
            }
            $orang_jawab = $benar_48 + $salah_48;
        }
        $soal48 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_48 /$jumlahPeserta));

        foreach($query49 as $val){
            if($val['soal_49'] == null){

            }else if($val['soal_49'] == 'benar'){
                $benar_49++;
            }else if($val['soal_49'] == 'salah'){
                $salah_49++;
            }
            $orang_jawab = $benar_49 + $salah_49;
        }
        $soal49 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_49 /$jumlahPeserta));

        foreach($query50 as $val){
            if($val['soal_50'] == null){

            }else if($val['soal_50'] == 'benar'){
                $benar_50++;
            }else if($val['soal_50'] == 'salah'){
                $salah_50++;
            }
            $orang_jawab = $benar_50 + $salah_50;
        }
        $soal50 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_50 /$jumlahPeserta));

        foreach($query51 as $val){
            if($val['soal_51'] == null){

            }else if($val['soal_51'] == 'benar'){
                $benar_51++;
            }else if($val['soal_51'] == 'salah'){
                $salah_51++;
            }
            $orang_jawab = $benar_51 + $salah_51;
        }
        $soal51 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_51 /$jumlahPeserta));

        foreach($query52 as $val){
            if($val['soal_52'] == null){

            }else if($val['soal_52'] == 'benar'){
                $benar_52++;
            }else if($val['soal_52'] == 'salah'){
                $salah_52++;
            }
            $orang_jawab = $benar_52 + $salah_52;
        }
        $soal52 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_52 /$jumlahPeserta));

        foreach($query53 as $val){
            if($val['soal_53'] == null){

            }else if($val['soal_53'] == 'benar'){
                $benar_53++;
            }else if($val['soal_53'] == 'salah'){
                $salah_53++;
            }
            $orang_jawab = $benar_53 + $salah_53;
        }
        $soal53 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_53 /$jumlahPeserta));

        foreach($query54 as $val){
            if($val['soal_54'] == null){

            }else if($val['soal_54'] == 'benar'){
                $benar_54++;
            }else if($val['soal_54'] == 'salah'){
                $salah_54++;
            }
            $orang_jawab = $benar_54 + $salah_54;
        }
        $soal54 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_54 /$jumlahPeserta));

        foreach($query55 as $val){
            if($val['soal_55'] == null){

            }else if($val['soal_55'] == 'benar'){
                $benar_55++;
            }else if($val['soal_55'] == 'salah'){
                $salah_55++;
            }
            $orang_jawab = $benar_55 + $salah_55;
        }
        $soal55 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_55 /$jumlahPeserta));

        foreach($query56 as $val){
            if($val['soal_56'] == null){

            }else if($val['soal_56'] == 'benar'){
                $benar_56++;
            }else if($val['soal_56'] == 'salah'){
                $salah_56++;
            }
            $orang_jawab = $benar_51 + $salah_56;
        }
        $soal56 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_56 /$jumlahPeserta));

        foreach($query57 as $val){
            if($val['soal_57'] == null){

            }else if($val['soal_57'] == 'benar'){
                $benar_57++;
            }else if($val['soal_5'] == 'salah'){
                $salah_57++;
            }
            $orang_jawab = $benar_57 + $salah_57;
        }
        $soal57 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_57 /$jumlahPeserta));

        foreach($query58 as $val){
            if($val['soal_58'] == null){

            }else if($val['soal_58'] == 'benar'){
                $benar_58++;
            }else if($val['soal_58'] == 'salah'){
                $salah_58++;
            }
            $orang_jawab = $benar_58 + $salah_58;
        }
        $soal58 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_58 /$jumlahPeserta));

        foreach($query59 as $val){
            if($val['soal_59'] == null){

            }else if($val['soal_59'] == 'benar'){
                $benar_59++;
            }else if($val['soal_59'] == 'salah'){
                $salah_59++;
            }
            $orang_jawab = $benar_59 + $salah_59;
        }
        $soal59 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_59 /$jumlahPeserta));

        foreach($query60 as $val){
            if($val['soal_60'] == null){

            }else if($val['soal_60'] == 'benar'){
                $benar_60++;
            }else if($val['soal_60'] == 'salah'){
                $salah_60++;
            }
            $orang_jawab = $benar_60 + $salah_60;
        }
        $soal60 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_60 /$jumlahPeserta));

        foreach($query61 as $val){
            if($val['soal_61'] == null){

            }else if($val['soal_61'] == 'benar'){
                $benar_61++;
            }else if($val['soal_61'] == 'salah'){
                $salah_61++;
            }
            $orang_jawab = $benar_61 + $salah_61;
        }
        $soal61 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_61 /$jumlahPeserta));

        foreach($query62 as $val){
            if($val['soal_62'] == null){

            }else if($val['soal_62'] == 'benar'){
                $benar_62++;
            }else if($val['soal_62'] == 'salah'){
                $salah_62++;
            }
            $orang_jawab = $benar_62 + $salah_62;
        }
        $soal62 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_62 /$jumlahPeserta));

        foreach($query63 as $val){
            if($val['soal_63'] == null){

            }else if($val['soal_63'] == 'benar'){
                $benar_63++;
            }else if($val['soal_63'] == 'salah'){
                $salah_63++;
            }
            $orang_jawab = $benar_63 + $salah_63;
        }
        $soal63 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_63 /$jumlahPeserta));

        foreach($query64 as $val){
            if($val['soal_64'] == null){

            }else if($val['soal_64'] == 'benar'){
                $benar_64++;
            }else if($val['soal_64'] == 'salah'){
                $salah_64++;
            }
            $orang_jawab = $benar_64 + $salah_64;
        }
        $soal64 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_64 /$jumlahPeserta));

        foreach($query65 as $val){
            if($val['soal_65'] == null){

            }else if($val['soal_65'] == 'benar'){
                $benar_65++;
            }else if($val['soal_65'] == 'salah'){
                $salah_65++;
            }
            $orang_jawab = $benar_65 + $salah_65;
        }
        $soal65 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_65 /$jumlahPeserta));

        foreach($query66 as $val){
            if($val['soal_66'] == null){

            }else if($val['soal_66'] == 'benar'){
                $benar_66++;
            }else if($val['soal_66'] == 'salah'){
                $salah_66++;
            }
            $orang_jawab = $benar_66 + $salah_66;
        }
        $soal66 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_66 /$jumlahPeserta));

        foreach($query67 as $val){
            if($val['soal_67'] == null){

            }else if($val['soal_67'] == 'benar'){
                $benar_67++;
            }else if($val['soal_67'] == 'salah'){
                $salah_67++;
            }
            $orang_jawab = $benar_67 + $salah_67;
        }
        $soal67 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_67 /$jumlahPeserta));

        foreach($query68 as $val){
            if($val['soal_68'] == null){

            }else if($val['soal_68'] == 'benar'){
                $benar_68++;
            }else if($val['soal_68'] == 'salah'){
                $salah_68++;
            }
            $orang_jawab = $benar_61 + $salah_68;
        }
        $soal68 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_68 /$jumlahPeserta));

        foreach($query69 as $val){
            if($val['soal_69'] == null){

            }else if($val['soal_69'] == 'benar'){
                $benar_69++;
            }else if($val['soal_69'] == 'salah'){
                $salah_69++;
            }
            $orang_jawab = $benar_69 + $salah_69;
        }
        $soal69 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_69 /$jumlahPeserta));

        foreach($query70 as $val){
            if($val['soal_70'] == null){

            }else if($val['soal_70'] == 'benar'){
                $benar_70++;
            }else if($val['soal_70'] == 'salah'){
                $salah_70++;
            }
            $orang_jawab = $benar_70 + $salah_70;
        }
        $soal70 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_70 /$jumlahPeserta));

        foreach($query71 as $val){
            if($val['soal_71'] == null){

            }else if($val['soal_71'] == 'benar'){
                $benar_71++;
            }else if($val['soal_71'] == 'salah'){
                $salah_71++;
            }
            $orang_jawab = $benar_71 + $salah_71;
        }
        $soal71 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_71 /$jumlahPeserta));

        foreach($query72 as $val){
            if($val['soal_72'] == null){

            }else if($val['soal_72'] == 'benar'){
                $benar_72++;
            }else if($val['soal_72'] == 'salah'){
                $salah_72++;
            }
            $orang_jawab = $benar_72 + $salah_72;
        }
        $soal72 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_72 /$jumlahPeserta));

        foreach($query73 as $val){
            if($val['soal_73'] == null){

            }else if($val['soal_73'] == 'benar'){
                $benar_73++;
            }else if($val['soal_73'] == 'salah'){
                $salah_73++;
            }
            $orang_jawab = $benar_73 + $salah_73;
        }
        $soal73 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_73 /$jumlahPeserta));

        foreach($query74 as $val){
            if($val['soal_74'] == null){

            }else if($val['soal_74'] == 'benar'){
                $benar_74++;
            }else if($val['soal_74'] == 'salah'){
                $salah_74++;
            }
            $orang_jawab = $benar_74 + $salah_74;
        }
        $soal74 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_74 /$jumlahPeserta));

        foreach($query75 as $val){
            if($val['soal_75'] == null){

            }else if($val['soal_75'] == 'benar'){
                $benar_75++;
            }else if($val['soal_75'] == 'salah'){
                $salah_75++;
            }
            $orang_jawab = $benar_75 + $salah_75;
        }
        $soal75 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_75 /$jumlahPeserta));

        foreach($query76 as $val){
            if($val['soal_76'] == null){

            }else if($val['soal_76'] == 'benar'){
                $benar_76++;
            }else if($val['soal_76'] == 'salah'){
                $salah_76++;
            }
            $orang_jawab = $benar_76 + $salah_76;
        }
        $soal76 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_76 /$jumlahPeserta));

        foreach($query77 as $val){
            if($val['soal_77'] == null){

            }else if($val['soal_77'] == 'benar'){
                $benar_77++;
            }else if($val['soal_77'] == 'salah'){
                $salah_77++;
            }
            $orang_jawab = $benar_77 + $salah_77;
        }
        $soal77 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_77 /$jumlahPeserta));

        foreach($query78 as $val){
            if($val['soal_78'] == null){

            }else if($val['soal_78'] == 'benar'){
                $benar_78++;
            }else if($val['soal_78'] == 'salah'){
                $salah_78++;
            }
            $orang_jawab = $benar_78 + $salah_78;
        }
        $soal78 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_78 /$jumlahPeserta));

        foreach($query79 as $val){
            if($val['soal_79'] == null){

            }else if($val['soal_79'] == 'benar'){
                $benar_79++;
            }else if($val['soal_79'] == 'salah'){
                $salah_79++;
            }
            $orang_jawab = $benar_79 + $salah_79;
        }
        $soal79 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_79 /$jumlahPeserta));

        foreach($query80 as $val){
            if($val['soal_80'] == null){

            }else if($val['soal_80'] == 'benar'){
                $benar_80++;
            }else if($val['soal_80'] == 'salah'){
                $salah_80++;
            }
            $orang_jawab = $benar_80 + $salah_80;
        }
        $soal80 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_80 /$jumlahPeserta));

        $skorSoal_1 = $soal1;
        $skorSoal_2 = $soal2;
        $skorSoal_3 = $soal3;
        $skorSoal_4 = $soal4;
        $skorSoal_5 = $soal5;
        $skorSoal_6 = $soal6;
        $skorSoal_7 = $soal7;
        $skorSoal_8 = $soal8;
        $skorSoal_9 = $soal9;
        $skorSoal_10 = $soal10;
        $skorSoal_11 = $soal11;
        $skorSoal_12 = $soal12;
        $skorSoal_13 = $soal13;
        $skorSoal_14 = $soal14;
        $skorSoal_15 = $soal15;
        $skorSoal_16 = $soal16;
        $skorSoal_17 = $soal17;
        $skorSoal_18 = $soal18;
        $skorSoal_19 = $soal19;
        $skorSoal_20 = $soal20;
        $skorSoal_21 = $soal21;
        $skorSoal_22 = $soal22;
        $skorSoal_23 = $soal23;
        $skorSoal_24 = $soal24;
        $skorSoal_25 = $soal25;
        $skorSoal_26 = $soal26;
        $skorSoal_27 = $soal27;
        $skorSoal_28 = $soal28;
        $skorSoal_29 = $soal29;
        $skorSoal_30 = $soal30;
        $skorSoal_31 = $soal31;
        $skorSoal_32 = $soal32;
        $skorSoal_33 = $soal33;
        $skorSoal_34 = $soal34;
        $skorSoal_35 = $soal35;
        $skorSoal_36 = $soal36;
        $skorSoal_37 = $soal37;
        $skorSoal_38 = $soal38;
        $skorSoal_39 = $soal39;
        $skorSoal_40 = $soal40;
        $skorSoal_41 = $soal41;
        $skorSoal_42 = $soal42;
        $skorSoal_43 = $soal43;
        $skorSoal_44 = $soal44;
        $skorSoal_45 = $soal45;
        $skorSoal_46 = $soal46;
        $skorSoal_47 = $soal47;
        $skorSoal_48 = $soal48;
        $skorSoal_49 = $soal49;
        $skorSoal_50 = $soal50;
        $skorSoal_51 = $soal51;
        $skorSoal_52 = $soal52;
        $skorSoal_53 = $soal53;
        $skorSoal_54 = $soal54;
        $skorSoal_55 = $soal55;
        $skorSoal_56 = $soal56;
        $skorSoal_57 = $soal57;
        $skorSoal_58 = $soal58;
        $skorSoal_59 = $soal59;
        $skorSoal_60 = $soal60;
        $skorSoal_61 = $soal61;
        $skorSoal_62 = $soal62;
        $skorSoal_63 = $soal63;
        $skorSoal_64 = $soal64;
        $skorSoal_65 = $soal65;
        $skorSoal_66 = $soal66;
        $skorSoal_67 = $soal67;
        $skorSoal_68 = $soal68;
        $skorSoal_69 = $soal69;
        $skorSoal_70 = $soal70;
        $skorSoal_71 = $soal71;
        $skorSoal_72 = $soal72;
        $skorSoal_73 = $soal73;
        $skorSoal_74 = $soal74;
        $skorSoal_75 = $soal75;
        $skorSoal_76 = $soal76;
        $skorSoal_77 = $soal77;
        $skorSoal_78 = $soal78;
        $skorSoal_79 = $soal79;
        $skorSoal_80 = $soal80;

        $semua = array(
            '1' => $skorSoal_1,
            '2' => $skorSoal_2,
            '3' => $skorSoal_3,
            '4' => $skorSoal_4,
            '5' => $skorSoal_5,
            '6' => $skorSoal_6,
            '7' => $skorSoal_7,
            '8' => $skorSoal_8,
            '9' => $skorSoal_9,
            '10' => $skorSoal_10,
            '11' => $skorSoal_11,
            '12' => $skorSoal_12,
            '13' => $skorSoal_13,
            '14' => $skorSoal_14,
            '15' => $skorSoal_15,
            '16' => $skorSoal_16,
            '17' => $skorSoal_17,
            '18' => $skorSoal_18,
            '19' => $skorSoal_19,
            '20' => $skorSoal_20,
            '21' => $skorSoal_21,
            '22' => $skorSoal_22,
            '23' => $skorSoal_23,
            '24' => $skorSoal_24,
            '25' => $skorSoal_25,
            '26' => $skorSoal_26,
            '27' => $skorSoal_27,
            '28' => $skorSoal_28,
            '29' => $skorSoal_29,
            '30' => $skorSoal_30,
            '31' => $skorSoal_31,
            '32' => $skorSoal_32,
            '33' => $skorSoal_33,
            '34' => $skorSoal_34,
            '35' => $skorSoal_35,
            '36' => $skorSoal_36,
            '37' => $skorSoal_37,
            '38' => $skorSoal_38,
            '39' => $skorSoal_39,
            '40' => $skorSoal_40,
            '41' => $skorSoal_41,
            '42' => $skorSoal_42,
            '43' => $skorSoal_43,
            '44' => $skorSoal_44,
            '45' => $skorSoal_45,
            '46' => $skorSoal_46,
            '47' => $skorSoal_47,
            '48' => $skorSoal_48,
            '49' => $skorSoal_49,
            '50' => $skorSoal_50,
            '51' => $skorSoal_51,
            '52' => $skorSoal_52,
            '53' => $skorSoal_53,
            '54' => $skorSoal_54,
            '55' => $skorSoal_55,
            '56' => $skorSoal_56,
            '57' => $skorSoal_57,
            '58' => $skorSoal_58,
            '59' => $skorSoal_59,
            '60' => $skorSoal_60,
            '61' => $skorSoal_61,
            '62' => $skorSoal_62,
            '63' => $skorSoal_63,
            '64' => $skorSoal_64,
            '65' => $skorSoal_65,
            '66' => $skorSoal_66,
            '67' => $skorSoal_67,
            '68' => $skorSoal_68,
            '69' => $skorSoal_69,
            '70' => $skorSoal_70,
            '71' => $skorSoal_71,
            '72' => $skorSoal_72,
            '73' => $skorSoal_73,
            '74' => $skorSoal_74,
            '75' => $skorSoal_75,
            '76' => $skorSoal_76,
            '77' => $skorSoal_77,
            '78' => $skorSoal_78,
            '79' => $skorSoal_79,
            '80' => $skorSoal_80
        );
        return $semua;
    }

    public static function HasilSkor($jumlahPeserta){
        $query1 = TbPersoal::select('*')->where('soal_1','!=','tidak jawab')->get();
        $query2 = TbPersoal::select('*')->where('soal_2','!=','tidak jawab')->get();
        $query3 = TbPersoal::select('*')->where('soal_3','!=','tidak jawab')->get();
        $query4 = TbPersoal::select('*')->where('soal_4','!=','tidak jawab')->get();
        $query5 = TbPersoal::select('*')->where('soal_5','!=','tidak jawab')->get();
        $query6 = TbPersoal::select('*')->where('soal_6','!=','tidak jawab')->get();
        $query7 = TbPersoal::select('*')->where('soal_7','!=','tidak jawab')->get();
        $query8 = TbPersoal::select('*')->where('soal_8','!=','tidak jawab')->get();
        $query9 = TbPersoal::select('*')->where('soal_9','!=','tidak jawab')->get();
        $query10 = TbPersoal::select('*')->where('soal_10','!=','tidak jawab')->get();
        $query11 = TbPersoal::select('*')->where('soal_11','!=','tidak jawab')->get();
        $query12 = TbPersoal::select('*')->where('soal_12','!=','tidak jawab')->get();
        $query13 = TbPersoal::select('*')->where('soal_13','!=','tidak jawab')->get();
        $query14 = TbPersoal::select('*')->where('soal_14','!=','tidak jawab')->get();
        $query15 = TbPersoal::select('*')->where('soal_15','!=','tidak jawab')->get();
        $query16 = TbPersoal::select('*')->where('soal_16','!=','tidak jawab')->get();
        $query17 = TbPersoal::select('*')->where('soal_17','!=','tidak jawab')->get();
        $query18 = TbPersoal::select('*')->where('soal_18','!=','tidak jawab')->get();
        $query19 = TbPersoal::select('*')->where('soal_19','!=','tidak jawab')->get();
        $query20 = TbPersoal::select('*')->where('soal_20','!=','tidak jawab')->get();
        $query21 = TbPersoal::select('*')->where('soal_21','!=','tidak jawab')->get();
        $query22 = TbPersoal::select('*')->where('soal_22','!=','tidak jawab')->get();
        $query23 = TbPersoal::select('*')->where('soal_23','!=','tidak jawab')->get();
        $query24 = TbPersoal::select('*')->where('soal_24','!=','tidak jawab')->get();
        $query25 = TbPersoal::select('*')->where('soal_25','!=','tidak jawab')->get();
        $query26 = TbPersoal::select('*')->where('soal_26','!=','tidak jawab')->get();
        $query27 = TbPersoal::select('*')->where('soal_27','!=','tidak jawab')->get();
        $query28 = TbPersoal::select('*')->where('soal_28','!=','tidak jawab')->get();
        $query29 = TbPersoal::select('*')->where('soal_29','!=','tidak jawab')->get();
        $query30 = TbPersoal::select('*')->where('soal_30','!=','tidak jawab')->get();
        $query31 = TbPersoal::select('*')->where('soal_31','!=','tidak jawab')->get();
        $query32 = TbPersoal::select('*')->where('soal_32','!=','tidak jawab')->get();
        $query33 = TbPersoal::select('*')->where('soal_33','!=','tidak jawab')->get();
        $query34 = TbPersoal::select('*')->where('soal_34','!=','tidak jawab')->get();
        $query35 = TbPersoal::select('*')->where('soal_35','!=','tidak jawab')->get();
        $query36 = TbPersoal::select('*')->where('soal_36','!=','tidak jawab')->get();
        $query37 = TbPersoal::select('*')->where('soal_37','!=','tidak jawab')->get();
        $query38 = TbPersoal::select('*')->where('soal_38','!=','tidak jawab')->get();
        $query39 = TbPersoal::select('*')->where('soal_39','!=','tidak jawab')->get();
        $query40 = TbPersoal::select('*')->where('soal_40','!=','tidak jawab')->get();
        $query41 = TbPersoal::select('*')->where('soal_41','!=','tidak jawab')->get();
        $query42 = TbPersoal::select('*')->where('soal_42','!=','tidak jawab')->get();
        $query43 = TbPersoal::select('*')->where('soal_43','!=','tidak jawab')->get();
        $query44 = TbPersoal::select('*')->where('soal_44','!=','tidak jawab')->get();
        $query45 = TbPersoal::select('*')->where('soal_45','!=','tidak jawab')->get();
        $query46 = TbPersoal::select('*')->where('soal_46','!=','tidak jawab')->get();
        $query47 = TbPersoal::select('*')->where('soal_47','!=','tidak jawab')->get();
        $query48 = TbPersoal::select('*')->where('soal_48','!=','tidak jawab')->get();
        $query49 = TbPersoal::select('*')->where('soal_49','!=','tidak jawab')->get();
        $query50 = TbPersoal::select('*')->where('soal_50','!=','tidak jawab')->get();
        $query51 = TbPersoal::select('*')->where('soal_51','!=','tidak jawab')->get();
        $query52 = TbPersoal::select('*')->where('soal_52','!=','tidak jawab')->get();
        $query53 = TbPersoal::select('*')->where('soal_53','!=','tidak jawab')->get();
        $query54 = TbPersoal::select('*')->where('soal_54','!=','tidak jawab')->get();
        $query55 = TbPersoal::select('*')->where('soal_55','!=','tidak jawab')->get();
        $query56 = TbPersoal::select('*')->where('soal_56','!=','tidak jawab')->get();
        $query57 = TbPersoal::select('*')->where('soal_57','!=','tidak jawab')->get();
        $query58 = TbPersoal::select('*')->where('soal_58','!=','tidak jawab')->get();
        $query59 = TbPersoal::select('*')->where('soal_59','!=','tidak jawab')->get();
        $query60 = TbPersoal::select('*')->where('soal_60','!=','tidak jawab')->get();
        $query61 = TbPersoal::select('*')->where('soal_61','!=','tidak jawab')->get();
        $query62 = TbPersoal::select('*')->where('soal_62','!=','tidak jawab')->get();
        $query63 = TbPersoal::select('*')->where('soal_63','!=','tidak jawab')->get();
        $query64 = TbPersoal::select('*')->where('soal_64','!=','tidak jawab')->get();
        $query65 = TbPersoal::select('*')->where('soal_65','!=','tidak jawab')->get();
        $query66 = TbPersoal::select('*')->where('soal_66','!=','tidak jawab')->get();
        $query67 = TbPersoal::select('*')->where('soal_67','!=','tidak jawab')->get();
        $query68 = TbPersoal::select('*')->where('soal_68','!=','tidak jawab')->get();
        $query69 = TbPersoal::select('*')->where('soal_69','!=','tidak jawab')->get();
        $query70 = TbPersoal::select('*')->where('soal_70','!=','tidak jawab')->get();
        $query71 = TbPersoal::select('*')->where('soal_71','!=','tidak jawab')->get();
        $query72 = TbPersoal::select('*')->where('soal_72','!=','tidak jawab')->get();
        $query73 = TbPersoal::select('*')->where('soal_73','!=','tidak jawab')->get();
        $query74 = TbPersoal::select('*')->where('soal_74','!=','tidak jawab')->get();
        $query75 = TbPersoal::select('*')->where('soal_75','!=','tidak jawab')->get();
        $query76 = TbPersoal::select('*')->where('soal_76','!=','tidak jawab')->get();
        $query77 = TbPersoal::select('*')->where('soal_77','!=','tidak jawab')->get();
        $query78 = TbPersoal::select('*')->where('soal_78','!=','tidak jawab')->get();
        $query79 = TbPersoal::select('*')->where('soal_79','!=','tidak jawab')->get();
        $query80 = TbPersoal::select('*')->where('soal_80','!=','tidak jawab')->get();

        //---------------benar-------------------
        $benar_1 = 0;
        $benar_2 = 0;
        $benar_3 = 0;
        $benar_4 = 0;
        $benar_5 = 0;
        $benar_6 = 0;
        $benar_7 = 0;
        $benar_8 = 0;
        $benar_9 = 0;
        $benar_10 = 0;
        $benar_11 = 0;
        $benar_12 = 0;
        $benar_13 = 0;
        $benar_14 = 0;
        $benar_15 = 0;
        $benar_16 = 0;
        $benar_17 = 0;
        $benar_18 = 0;
        $benar_19 = 0;
        $benar_20 = 0;
        $benar_21 = 0;
        $benar_22 = 0;
        $benar_23 = 0;
        $benar_24 = 0;
        $benar_25 = 0;
        $benar_26 = 0;
        $benar_27 = 0;
        $benar_28 = 0;
        $benar_29 = 0;
        $benar_30 = 0;
        $benar_31 = 0;
        $benar_32 = 0;
        $benar_33 = 0;
        $benar_34 = 0;
        $benar_35 = 0;
        $benar_36 = 0;
        $benar_37 = 0;
        $benar_38 = 0;
        $benar_39 = 0;
        $benar_40 = 0;
        $benar_41 = 0;
        $benar_42 = 0;
        $benar_43 = 0;
        $benar_44 = 0;
        $benar_45 = 0;
        $benar_46 = 0;
        $benar_47 = 0;
        $benar_48 = 0;
        $benar_49 = 0;
        $benar_50 = 0;
        $benar_51 = 0;
        $benar_52 = 0;
        $benar_53 = 0;
        $benar_54 = 0;
        $benar_55 = 0;
        $benar_56 = 0;
        $benar_57 = 0;
        $benar_58 = 0;
        $benar_59 = 0;
        $benar_60 = 0;
        $benar_61 = 0;
        $benar_62 = 0;
        $benar_63 = 0;
        $benar_64 = 0;
        $benar_65 = 0;
        $benar_66 = 0;
        $benar_67 = 0;
        $benar_68 = 0;
        $benar_69 = 0;
        $benar_70 = 0;
        $benar_71 = 0;
        $benar_72 = 0;
        $benar_73 = 0;
        $benar_74 = 0;
        $benar_75 = 0;
        $benar_76 = 0;
        $benar_77 = 0;
        $benar_78 = 0;
        $benar_79 = 0;
        $benar_80 = 0;

        $salah_1 = 0;
        $salah_2 = 0;
        $salah_3 = 0;
        $salah_4 = 0;
        $salah_5 = 0;
        $salah_6 = 0;
        $salah_7 = 0;
        $salah_8 = 0;
        $salah_9 = 0;
        $salah_10 = 0;
        $salah_11 = 0;
        $salah_12 = 0;
        $salah_13 = 0;
        $salah_14 = 0;
        $salah_15 = 0;
        $salah_16 = 0;
        $salah_17 = 0;
        $salah_18 = 0;
        $salah_19 = 0;
        $salah_20 = 0;
        $salah_21 = 0;
        $salah_22 = 0;
        $salah_23 = 0;
        $salah_24 = 0;
        $salah_25 = 0;
        $salah_26 = 0;
        $salah_27 = 0;
        $salah_28 = 0;
        $salah_29 = 0;
        $salah_30 = 0;
        $salah_31 = 0;
        $salah_32 = 0;
        $salah_33 = 0;
        $salah_34 = 0;
        $salah_35 = 0;
        $salah_36 = 0;
        $salah_37 = 0;
        $salah_38 = 0;
        $salah_39 = 0;
        $salah_40 = 0;
        $salah_41 = 0;
        $salah_42 = 0;
        $salah_43 = 0;
        $salah_44 = 0;
        $salah_45 = 0;
        $salah_46 = 0;
        $salah_47 = 0;
        $salah_48 = 0;
        $salah_49 = 0;
        $salah_50 = 0;
        $salah_51 = 0;
        $salah_52 = 0;
        $salah_53 = 0;
        $salah_54 = 0;
        $salah_55 = 0;
        $salah_56 = 0;
        $salah_57 = 0;
        $salah_58 = 0;
        $salah_59 = 0;
        $salah_60 = 0;
        $salah_61 = 0;
        $salah_62 = 0;
        $salah_63 = 0;
        $salah_64 = 0;
        $salah_65 = 0;
        $salah_66 = 0;
        $salah_67 = 0;
        $salah_68 = 0;
        $salah_69 = 0;
        $salah_70 = 0;
        $salah_71 = 0;
        $salah_72 = 0;
        $salah_73 = 0;
        $salah_74 = 0;
        $salah_75 = 0;
        $salah_76 = 0;
        $salah_77 = 0;
        $salah_78 = 0;
        $salah_79 = 0;
        $salah_80 = 0;


        $data = array();
        $orang_jawab =0;
        foreach($query1 as $val){
            if($val['soal_1'] == null){

            }else if($val['soal_1'] == 'benar'){
                $benar_1++;
            }else if($val['soal_1'] == 'salah'){
                $salah_1++;
            }
            $orang_jawab = $benar_1 + $salah_1;

        }
        $soal1 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_1 /$jumlahPeserta));


        foreach($query2 as $val){
            if($val['soal_2'] == null){

            }else if($val['soal_2'] == 'benar'){
                $benar_2++;
            }else if($val['soal_2'] == 'salah'){
                $salah_2++;
            }
            $orang_jawab = $benar_2 + $salah_2;
        }
        $soal2 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_2 /$jumlahPeserta));

        foreach($query3 as $val){
            if($val['soal_3'] == null){

            }else if($val['soal_3'] == 'benar'){
                $benar_3++;
            }else if($val['soal_3'] == 'salah'){
                $salah_3++;
            }
            $orang_jawab = $benar_3 + $salah_3;
        }
        $soal3 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_3 /$jumlahPeserta));

        foreach($query4 as $val){
            if($val['soal_4'] == null){

            }else if($val['soal_4'] == 'benar'){
                $benar_4++;
            }else if($val['soal_4'] == 'salah'){
                $salah_4++;
            }
            $orang_jawab = $benar_4 + $salah_4;
        }
        $soal4 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_4 /$jumlahPeserta));

        foreach($query5 as $val){
            if($val['soal_5'] == null){

            }else if($val['soal_5'] == 'benar'){
                $benar_5++;
            }else if($val['soal_5'] == 'salah'){
                $salah_5++;
            }
            $orang_jawab = $benar_5 + $salah_5;
        }
        $soal5 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_5 /$jumlahPeserta));

        foreach($query6 as $val){
            if($val['soal_6'] == null){

            }else if($val['soal_6'] == 'benar'){
                $benar_6++;
            }else if($val['soal_6'] == 'salah'){
                $salah_6++;
            }
            $orang_jawab = $benar_6 + $salah_6;
        }
        $soal6 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_6 /$jumlahPeserta));

        foreach($query7 as $val){
            if($val['soal_7'] == null){

            }else if($val['soal_7'] == 'benar'){
                $benar_7++;
            }else if($val['soal_7'] == 'salah'){
                $salah_7++;
            }
            $orang_jawab = $benar_7 + $salah_7;
        }
        $soal7 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_7 /$jumlahPeserta));

        foreach($query8 as $val){
            if($val['soal_8'] == null){

            }else if($val['soal_8'] == 'benar'){
                $benar_8++;
            }else if($val['soal_8'] == 'salah'){
                $salah_8++;
            }
            $orang_jawab = $benar_8 + $salah_8;
        }
        $soal8 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_8 /$jumlahPeserta));

        foreach($query9 as $val){
            if($val['soal_9'] == null){

            }else if($val['soal_9'] == 'benar'){
                $benar_9++;
            }else if($val['soal_9'] == 'salah'){
                $salah_9++;
            }
            $orang_jawab = $benar_9 + $salah_9;
        }
        $soal9 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_9 /$jumlahPeserta));

        foreach($query10 as $val){
            if($val['soal_10'] == null){

            }else if($val['soal_10'] == 'benar'){
                $benar_10++;
            }else if($val['soal_10'] == 'salah'){
                $salah_10++;
            }
            $orang_jawab = $benar_10 + $salah_10;
        }
        $soal10 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_10 /$jumlahPeserta));

        foreach($query11 as $val){
            if($val['soal_11'] == null){

            }else if($val['soal_11'] == 'benar'){
                $benar_11++;
            }else if($val['soal_11'] == 'salah'){
                $salah_11++;
            }
            $orang_jawab = $benar_11 + $salah_11;
        }
        $soal11 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_11 /$jumlahPeserta));

        foreach($query12 as $val){
            if($val['soal_12'] == null){

            }else if($val['soal_12'] == 'benar'){
                $benar_12++;
            }else if($val['soal_12'] == 'salah'){
                $salah_12++;
            }
            $orang_jawab = $benar_12 + $salah_12;
        }
        $soal12 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_12 /$jumlahPeserta));

        foreach($query13 as $val){
            if($val['soal_13'] == null){

            }else if($val['soal_13'] == 'benar'){
                $benar_13++;
            }else if($val['soal_13'] == 'salah'){
                $salah_13++;
            }
            $orang_jawab = $benar_13 + $salah_13;
        }
        $soal13 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_13 /$jumlahPeserta));

        foreach($query14 as $val){
            if($val['soal_14'] == null){

            }else if($val['soal_14'] == 'benar'){
                $benar_14++;
            }else if($val['soal_14'] == 'salah'){
                $salah_14++;
            }
            $orang_jawab = $benar_14 + $salah_14;
        }
        $soal14 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_14 /$jumlahPeserta));

        foreach($query15 as $val){
            if($val['soal_15'] == null){

            }else if($val['soal_15'] == 'benar'){
                $benar_15++;
            }else if($val['soal_15'] == 'salah'){
                $salah_15++;
            }
            $orang_jawab = $benar_15 + $salah_15;
        }
        $soal15 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_15 /$jumlahPeserta));

        foreach($query16 as $val){
            if($val['soal_16'] == null){

            }else if($val['soal_16'] == 'benar'){
                $benar_16++;
            }else if($val['soal_16'] == 'salah'){
                $salah_16++;
            }
            $orang_jawab = $benar_16 + $salah_16;
        }
        $soal16 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_16 /$jumlahPeserta));

        foreach($query17 as $val){
            if($val['soal_17'] == null){

            }else if($val['soal_17'] == 'benar'){
                $benar_17++;
            }else if($val['soal_17'] == 'salah'){
                $salah_17++;
            }
            $orang_jawab = $benar_17 + $salah_17;
        }
        $soal17 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_17 /$jumlahPeserta));

        foreach($query18 as $val){
            if($val['soal_18'] == null){

            }else if($val['soal_18'] == 'benar'){
                $benar_18++;
            }else if($val['soal_18'] == 'salah'){
                $salah_18++;
            }
            $orang_jawab = $benar_18 + $salah_18;
        }
        $soal18 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_18 /$jumlahPeserta));

        foreach($query19 as $val){
            if($val['soal_19'] == null){

            }else if($val['soal_19'] == 'benar'){
                $benar_19++;
            }else if($val['soal_19'] == 'salah'){
                $salah_19++;
            }
            $orang_jawab = $benar_19 + $salah_19;
        }
        $soal19 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_19 /$jumlahPeserta));

        foreach($query20 as $val){
            if($val['soal_20'] == null){

            }else if($val['soal_20'] == 'benar'){
                $benar_20++;
            }else if($val['soal_20'] == 'salah'){
                $salah_20++;
            }
            $orang_jawab = $benar_20 + $salah_20;
        }
        $soal20 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_20 /$jumlahPeserta));

        foreach($query21 as $val){
            if($val['soal_21'] == null){

            }else if($val['soal_21'] == 'benar'){
                $benar_21++;
            }else if($val['soal_21'] == 'salah'){
                $salah_21++;
            }
            $orang_jawab = $benar_21 + $salah_21;
        }
        $soal21 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_21 /$jumlahPeserta));

        foreach($query22 as $val){
            if($val['soal_22'] == null){

            }else if($val['soal_22'] == 'benar'){
                $benar_22++;
            }else if($val['soal_22'] == 'salah'){
                $salah_22++;
            }
            $orang_jawab = $benar_22 + $salah_22;
        }
        $soal22 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_22 /$jumlahPeserta));

        foreach($query23 as $val){
            if($val['soal_23'] == null){

            }else if($val['soal_23'] == 'benar'){
                $benar_23++;
            }else if($val['soal_23'] == 'salah'){
                $salah_23++;
            }
            $orang_jawab = $benar_23 + $salah_23;
        }
        $soal23 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_23 /$jumlahPeserta));

        foreach($query24 as $val){
            if($val['soal_24'] == null){

            }else if($val['soal_24'] == 'benar'){
                $benar_24++;
            }else if($val['soal_24'] == 'salah'){
                $salah_24++;
            }
            $orang_jawab = $benar_24 + $salah_24;
        }
        $soal24 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_24 /$jumlahPeserta));

        foreach($query25 as $val){
            if($val['soal_25'] == null){

            }else if($val['soal_25'] == 'benar'){
                $benar_25++;
            }else if($val['soal_25'] == 'salah'){
                $salah_25++;
            }
            $orang_jawab = $benar_25 + $salah_25;
        }
        $soal25 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_25 /$jumlahPeserta));

        foreach($query26 as $val){
            if($val['soal_26'] == null){

            }else if($val['soal_26'] == 'benar'){
                $benar_26++;
            }else if($val['soal_26'] == 'salah'){
                $salah_26++;
            }
            $orang_jawab = $benar_26 + $salah_26;
        }
        $soal26 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_26 /$jumlahPeserta));

        foreach($query27 as $val){
            if($val['soal_27'] == null){

            }else if($val['soal_27'] == 'benar'){
                $benar_27++;
            }else if($val['soal_27'] == 'salah'){
                $salah_27++;
            }
            $orang_jawab = $benar_27 + $salah_27;
        }
        $soal27 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_27 /$jumlahPeserta));

        foreach($query28 as $val){
            if($val['soal_28'] == null){

            }else if($val['soal_28'] == 'benar'){
                $benar_28++;
            }else if($val['soal_28'] == 'salah'){
                $salah_28++;
            }
            $orang_jawab = $benar_28 + $salah_28;
        }
        $soal28 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_28 /$jumlahPeserta));

        foreach($query29 as $val){
            if($val['soal_29'] == null){

            }else if($val['soal_29'] == 'benar'){
                $benar_29++;
            }else if($val['soal_29'] == 'salah'){
                $salah_29++;
            }
            $orang_jawab = $benar_29 + $salah_29;
        }
        $soal29 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_29 /$jumlahPeserta));

        foreach($query30 as $val){
            if($val['soal_30'] == null){

            }else if($val['soal_30'] == 'benar'){
                $benar_30++;
            }else if($val['soal_30'] == 'salah'){
                $salah_30++;
            }
            $orang_jawab = $benar_30 + $salah_30;
        }
        $soal30 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_30 /$jumlahPeserta));

        foreach($query31 as $val){
            if($val['soal_31'] == null){

            }else if($val['soal_31'] == 'benar'){
                $benar_31++;
            }else if($val['soal_31'] == 'salah'){
                $salah_31++;
            }
            $orang_jawab = $benar_31 + $salah_31;
        }
        $soal31 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_31 /$jumlahPeserta));

        foreach($query32 as $val){
            if($val['soal_32'] == null){

            }else if($val['soal_32'] == 'benar'){
                $benar_32++;
            }else if($val['soal_32'] == 'salah'){
                $salah_32++;
            }
            $orang_jawab = $benar_32 + $salah_32;
        }
        $soal32 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_32 /$jumlahPeserta));

        foreach($query33 as $val){
            if($val['soal_33'] == null){

            }else if($val['soal_33'] == 'benar'){
                $benar_33++;
            }else if($val['soal_33'] == 'salah'){
                $salah_33++;
            }
            $orang_jawab = $benar_33 + $salah_33;
        }
        $soal33 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_33 /$jumlahPeserta));

        foreach($query34 as $val){
            if($val['soal_34'] == null){

            }else if($val['soal_34'] == 'benar'){
                $benar_34++;
            }else if($val['soal_34'] == 'salah'){
                $salah_34++;
            }
            $orang_jawab = $benar_34 + $salah_34;
        }
        $soal34 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_34 /$jumlahPeserta));

        foreach($query35 as $val){
            if($val['soal_35'] == null){

            }else if($val['soal_35'] == 'benar'){
                $benar_35++;
            }else if($val['soal_35'] == 'salah'){
                $salah_35++;
            }
            $orang_jawab = $benar_35 + $salah_35;
        }
        $soal35 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_35 /$jumlahPeserta));

        foreach($query36 as $val){
            if($val['soal_36'] == null){

            }else if($val['soal_36'] == 'benar'){
                $benar_36++;
            }else if($val['soal_36'] == 'salah'){
                $salah_36++;
            }
            $orang_jawab = $benar_36 + $salah_36;
        }
        $soal36 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_36 /$jumlahPeserta));

        foreach($query37 as $val){
            if($val['soal_37'] == null){

            }else if($val['soal_37'] == 'benar'){
                $benar_37++;
            }else if($val['soal_37'] == 'salah'){
                $salah_37++;
            }
            $orang_jawab = $benar_37 + $salah_37;
        }
        $soal37 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_37 /$jumlahPeserta));

        foreach($query38 as $val){
            if($val['soal_38'] == null){

            }else if($val['soal_38'] == 'benar'){
                $benar_38++;
            }else if($val['soal_38'] == 'salah'){
                $salah_38++;
            }
            $orang_jawab = $benar_33 + $salah_38;
        }
        $soal38 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_38 /$jumlahPeserta));

        foreach($query39 as $val){
            if($val['soal_39'] == null){

            }else if($val['soal_39'] == 'benar'){
                $benar_39++;
            }else if($val['soal_39'] == 'salah'){
                $salah_39++;
            }
            $orang_jawab = $benar_39 + $salah_39;
        }
        $soal39 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_39 /$jumlahPeserta));

        foreach($query40 as $val){
            if($val['soal_40'] == null){

            }else if($val['soal_40'] == 'benar'){
                $benar_40++;
            }else if($val['soal_40'] == 'salah'){
                $salah_40++;
            }
            $orang_jawab = $benar_40 + $salah_40;
        }
        $soal40 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_40 /$jumlahPeserta));

        foreach($query41 as $val){
            if($val['soal_41'] == null){

            }else if($val['soal_41'] == 'benar'){
                $benar_41++;
            }else if($val['soal_41'] == 'salah'){
                $salah_41++;
            }
            $orang_jawab = $benar_41 + $salah_41;
        }
        $soal41 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_41 /$jumlahPeserta));

        foreach($query42 as $val){
            if($val['soal_42'] == null){

            }else if($val['soal_42'] == 'benar'){
                $benar_42++;
            }else if($val['soal_42'] == 'salah'){
                $salah_42++;
            }
            $orang_jawab = $benar_42 + $salah_42;
        }
        $soal42 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_42 /$jumlahPeserta));

        foreach($query43 as $val){
            if($val['soal_43'] == null){

            }else if($val['soal_43'] == 'benar'){
                $benar_43++;
            }else if($val['soal_43'] == 'salah'){
                $salah_43++;
            }
            $orang_jawab = $benar_43 + $salah_43;
        }
        $soal43 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_43 /$jumlahPeserta));

        foreach($query44 as $val){
            if($val['soal_44'] == null){

            }else if($val['soal_44'] == 'benar'){
                $benar_44++;
            }else if($val['soal_44'] == 'salah'){
                $salah_44++;
            }
            $orang_jawab = $benar_44 + $salah_44;
        }
        $soal44 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_44 /$jumlahPeserta));

        foreach($query45 as $val){
            if($val['soal_45'] == null){

            }else if($val['soal_45'] == 'benar'){
                $benar_45++;
            }else if($val['soal_45'] == 'salah'){
                $salah_45++;
            }
            $orang_jawab = $benar_45 + $salah_45;
        }
        $soal45 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_45 /$jumlahPeserta));

        foreach($query46 as $val){
            if($val['soal_46'] == null){

            }else if($val['soal_46'] == 'benar'){
                $benar_46++;
            }else if($val['soal_46'] == 'salah'){
                $salah_46++;
            }
            $orang_jawab = $benar_46 + $salah_46;
        }
        $soal46 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_46 /$jumlahPeserta));

        foreach($query47 as $val){
            if($val['soal_47'] == null){

            }else if($val['soal_47'] == 'benar'){
                $benar_47++;
            }else if($val['soal_47'] == 'salah'){
                $salah_47++;
            }
            $orang_jawab = $benar_47 + $salah_47;
        }
        $soal47 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_47 /$jumlahPeserta));

        foreach($query48 as $val){
            if($val['soal_48'] == null){

            }else if($val['soal_48'] == 'benar'){
                $benar_48++;
            }else if($val['soal_48'] == 'salah'){
                $salah_48++;
            }
            $orang_jawab = $benar_48 + $salah_48;
        }
        $soal48 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_48 /$jumlahPeserta));

        foreach($query49 as $val){
            if($val['soal_49'] == null){

            }else if($val['soal_49'] == 'benar'){
                $benar_49++;
            }else if($val['soal_49'] == 'salah'){
                $salah_49++;
            }
            $orang_jawab = $benar_49 + $salah_49;
        }
        $soal49 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_49 /$jumlahPeserta));

        foreach($query50 as $val){
            if($val['soal_50'] == null){

            }else if($val['soal_50'] == 'benar'){
                $benar_50++;
            }else if($val['soal_50'] == 'salah'){
                $salah_50++;
            }
            $orang_jawab = $benar_50 + $salah_50;
        }
        $soal50 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_50 /$jumlahPeserta));

        foreach($query51 as $val){
            if($val['soal_51'] == null){

            }else if($val['soal_51'] == 'benar'){
                $benar_51++;
            }else if($val['soal_51'] == 'salah'){
                $salah_51++;
            }
            $orang_jawab = $benar_51 + $salah_51;
        }
        $soal51 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_51 /$jumlahPeserta));

        foreach($query52 as $val){
            if($val['soal_52'] == null){

            }else if($val['soal_52'] == 'benar'){
                $benar_52++;
            }else if($val['soal_52'] == 'salah'){
                $salah_52++;
            }
            $orang_jawab = $benar_52 + $salah_52;
        }
        $soal52 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_52 /$jumlahPeserta));

        foreach($query53 as $val){
            if($val['soal_53'] == null){

            }else if($val['soal_53'] == 'benar'){
                $benar_53++;
            }else if($val['soal_53'] == 'salah'){
                $salah_53++;
            }
            $orang_jawab = $benar_53 + $salah_53;
        }
        $soal53 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_53 /$jumlahPeserta));

        foreach($query54 as $val){
            if($val['soal_54'] == null){

            }else if($val['soal_54'] == 'benar'){
                $benar_54++;
            }else if($val['soal_54'] == 'salah'){
                $salah_54++;
            }
            $orang_jawab = $benar_54 + $salah_54;
        }
        $soal54 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_54 /$jumlahPeserta));

        foreach($query55 as $val){
            if($val['soal_55'] == null){

            }else if($val['soal_55'] == 'benar'){
                $benar_55++;
            }else if($val['soal_55'] == 'salah'){
                $salah_55++;
            }
            $orang_jawab = $benar_55 + $salah_55;
        }
        $soal55 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_55 /$jumlahPeserta));

        foreach($query56 as $val){
            if($val['soal_56'] == null){

            }else if($val['soal_56'] == 'benar'){
                $benar_56++;
            }else if($val['soal_56'] == 'salah'){
                $salah_56++;
            }
            $orang_jawab = $benar_51 + $salah_56;
        }
        $soal56 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_56 /$jumlahPeserta));

        foreach($query57 as $val){
            if($val['soal_57'] == null){

            }else if($val['soal_57'] == 'benar'){
                $benar_57++;
            }else if($val['soal_5'] == 'salah'){
                $salah_57++;
            }
            $orang_jawab = $benar_57 + $salah_57;
        }
        $soal57 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_57 /$jumlahPeserta));

        foreach($query58 as $val){
            if($val['soal_58'] == null){

            }else if($val['soal_58'] == 'benar'){
                $benar_58++;
            }else if($val['soal_58'] == 'salah'){
                $salah_58++;
            }
            $orang_jawab = $benar_58 + $salah_58;
        }
        $soal58 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_58 /$jumlahPeserta));

        foreach($query59 as $val){
            if($val['soal_59'] == null){

            }else if($val['soal_59'] == 'benar'){
                $benar_59++;
            }else if($val['soal_59'] == 'salah'){
                $salah_59++;
            }
            $orang_jawab = $benar_59 + $salah_59;
        }
        $soal59 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_59 /$jumlahPeserta));

        foreach($query60 as $val){
            if($val['soal_60'] == null){

            }else if($val['soal_60'] == 'benar'){
                $benar_60++;
            }else if($val['soal_60'] == 'salah'){
                $salah_60++;
            }
            $orang_jawab = $benar_60 + $salah_60;
        }
        $soal60 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_60 /$jumlahPeserta));

        foreach($query61 as $val){
            if($val['soal_61'] == null){

            }else if($val['soal_61'] == 'benar'){
                $benar_61++;
            }else if($val['soal_61'] == 'salah'){
                $salah_61++;
            }
            $orang_jawab = $benar_61 + $salah_61;
        }
        $soal61 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_61 /$jumlahPeserta));

        foreach($query62 as $val){
            if($val['soal_62'] == null){

            }else if($val['soal_62'] == 'benar'){
                $benar_62++;
            }else if($val['soal_62'] == 'salah'){
                $salah_62++;
            }
            $orang_jawab = $benar_62 + $salah_62;
        }
        $soal62 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_62 /$jumlahPeserta));

        foreach($query63 as $val){
            if($val['soal_63'] == null){

            }else if($val['soal_63'] == 'benar'){
                $benar_63++;
            }else if($val['soal_63'] == 'salah'){
                $salah_63++;
            }
            $orang_jawab = $benar_63 + $salah_63;
        }
        $soal63 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_63 /$jumlahPeserta));

        foreach($query64 as $val){
            if($val['soal_64'] == null){

            }else if($val['soal_64'] == 'benar'){
                $benar_64++;
            }else if($val['soal_64'] == 'salah'){
                $salah_64++;
            }
            $orang_jawab = $benar_64 + $salah_64;
        }
        $soal64 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_64 /$jumlahPeserta));

        foreach($query65 as $val){
            if($val['soal_65'] == null){

            }else if($val['soal_65'] == 'benar'){
                $benar_65++;
            }else if($val['soal_65'] == 'salah'){
                $salah_65++;
            }
            $orang_jawab = $benar_65 + $salah_65;
        }
        $soal65 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_65 /$jumlahPeserta));

        foreach($query66 as $val){
            if($val['soal_66'] == null){

            }else if($val['soal_66'] == 'benar'){
                $benar_66++;
            }else if($val['soal_66'] == 'salah'){
                $salah_66++;
            }
            $orang_jawab = $benar_66 + $salah_66;
        }
        $soal66 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_66 /$jumlahPeserta));

        foreach($query67 as $val){
            if($val['soal_67'] == null){

            }else if($val['soal_67'] == 'benar'){
                $benar_67++;
            }else if($val['soal_67'] == 'salah'){
                $salah_67++;
            }
            $orang_jawab = $benar_67 + $salah_67;
        }
        $soal67 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_67 /$jumlahPeserta));

        foreach($query68 as $val){
            if($val['soal_68'] == null){

            }else if($val['soal_68'] == 'benar'){
                $benar_68++;
            }else if($val['soal_68'] == 'salah'){
                $salah_68++;
            }
            $orang_jawab = $benar_61 + $salah_68;
        }
        $soal68 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_68 /$jumlahPeserta));

        foreach($query69 as $val){
            if($val['soal_69'] == null){

            }else if($val['soal_69'] == 'benar'){
                $benar_69++;
            }else if($val['soal_69'] == 'salah'){
                $salah_69++;
            }
            $orang_jawab = $benar_69 + $salah_69;
        }
        $soal69 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_69 /$jumlahPeserta));

        foreach($query70 as $val){
            if($val['soal_70'] == null){

            }else if($val['soal_70'] == 'benar'){
                $benar_70++;
            }else if($val['soal_70'] == 'salah'){
                $salah_70++;
            }
            $orang_jawab = $benar_70 + $salah_70;
        }
        $soal70 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_70 /$jumlahPeserta));

        foreach($query71 as $val){
            if($val['soal_71'] == null){

            }else if($val['soal_71'] == 'benar'){
                $benar_71++;
            }else if($val['soal_71'] == 'salah'){
                $salah_71++;
            }
            $orang_jawab = $benar_71 + $salah_71;
        }
        $soal71 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_71 /$jumlahPeserta));

        foreach($query72 as $val){
            if($val['soal_72'] == null){

            }else if($val['soal_72'] == 'benar'){
                $benar_72++;
            }else if($val['soal_72'] == 'salah'){
                $salah_72++;
            }
            $orang_jawab = $benar_72 + $salah_72;
        }
        $soal72 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_72 /$jumlahPeserta));

        foreach($query73 as $val){
            if($val['soal_73'] == null){

            }else if($val['soal_73'] == 'benar'){
                $benar_73++;
            }else if($val['soal_73'] == 'salah'){
                $salah_73++;
            }
            $orang_jawab = $benar_73 + $salah_73;
        }
        $soal73 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_73 /$jumlahPeserta));

        foreach($query74 as $val){
            if($val['soal_74'] == null){

            }else if($val['soal_74'] == 'benar'){
                $benar_74++;
            }else if($val['soal_74'] == 'salah'){
                $salah_74++;
            }
            $orang_jawab = $benar_74 + $salah_74;
        }
        $soal74 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_74 /$jumlahPeserta));

        foreach($query75 as $val){
            if($val['soal_75'] == null){

            }else if($val['soal_75'] == 'benar'){
                $benar_75++;
            }else if($val['soal_75'] == 'salah'){
                $salah_75++;
            }
            $orang_jawab = $benar_75 + $salah_75;
        }
        $soal75 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_75 /$jumlahPeserta));

        foreach($query76 as $val){
            if($val['soal_76'] == null){

            }else if($val['soal_76'] == 'benar'){
                $benar_76++;
            }else if($val['soal_76'] == 'salah'){
                $salah_76++;
            }
            $orang_jawab = $benar_76 + $salah_76;
        }
        $soal76 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_76 /$jumlahPeserta));

        foreach($query77 as $val){
            if($val['soal_77'] == null){

            }else if($val['soal_77'] == 'benar'){
                $benar_77++;
            }else if($val['soal_77'] == 'salah'){
                $salah_77++;
            }
            $orang_jawab = $benar_77 + $salah_77;
        }
        $soal77 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_77 /$jumlahPeserta));

        foreach($query78 as $val){
            if($val['soal_78'] == null){

            }else if($val['soal_78'] == 'benar'){
                $benar_78++;
            }else if($val['soal_78'] == 'salah'){
                $salah_78++;
            }
            $orang_jawab = $benar_78 + $salah_78;
        }
        $soal78 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_78 /$jumlahPeserta));

        foreach($query79 as $val){
            if($val['soal_79'] == null){

            }else if($val['soal_79'] == 'benar'){
                $benar_79++;
            }else if($val['soal_79'] == 'salah'){
                $salah_79++;
            }
            $orang_jawab = $benar_79 + $salah_79;
        }
        $soal79 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_79 /$jumlahPeserta));

        foreach($query80 as $val){
            if($val['soal_80'] == null){

            }else if($val['soal_80'] == 'benar'){
                $benar_80++;
            }else if($val['soal_80'] == 'salah'){
                $salah_80++;
            }
            $orang_jawab = $benar_80 + $salah_80;
        }
        $soal80 = 7 * ((1- $orang_jawab / $jumlahPeserta) + (1-$benar_80 /$jumlahPeserta));

        $Totalskor = $soal1+$soal2+$soal3+$soal4+$soal5+$soal6+$soal7+$soal8+$soal9+$soal10+$soal11+$soal12+$soal13+$soal14+$soal15+$soal16+$soal17+$soal18+$soal19
                        +$soal20+$soal21+$soal22+$soal23+$soal24+$soal25+$soal26+$soal27+$soal28+$soal29+$soal30+$soal31+$soal32+$soal33+$soal34+$soal35+$soal36+$soal37
                        +$soal38+$soal39+$soal40+$soal41+$soal42+$soal43+$soal44+$soal45+$soal46+$soal47+$soal48+$soal49+$soal50+$soal51+$soal52+$soal53+$soal54+$soal55
                        +$soal56+$soal57+$soal58+$soal59+$soal60+$soal61+$soal62+$soal63+$soal64+$soal65+$soal66+$soal67+$soal68+$soal69+$soal70+$soal71+$soal72+$soal73
                        +$soal74+$soal75+$soal76+$soal77+$soal78+$soal79+$soal80;

        return $Totalskor;
    }

    public static function updateskor($userid){
        $cektbsoal = TbPersoal::where('user_unique_id',$userid)->first();

        $ambilskorpernilai = TbSkor::all(); // ambil skor nilai dari tbskor per nomor
            // dd($cektbsoal);
            // 3 cek nomor benar atau salah
        $totalskor1 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_1=='benar'){
                if ($valskor['id_soal']==1){
                    //  print_r($valskor['id_soal']);
                $totalskor1 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_1=='salah'){
                $totalskor1 = 0;
            }
        }

        $totalskor2 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_2=='benar'){
                if ($valskor['id_soal']==2){
                    $totalskor2 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_2=='salah'){
                $totalskor2 = 0;
            }
        }

        $totalskor3 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_3=='benar'){
                if ($valskor['id_soal']==3){
                    $totalskor3 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_2=='salah'){
                $totalskor3 = 0;
            }
        }

        $totalskor4 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_4=='benar'){
                if ($valskor['id_soal']==4){
                    $totalskor4 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_4=='salah'){
                $totalskor4 = 0;
            }
        }

        $totalskor5 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_5=='benar'){
                if ($valskor['id_soal']==5){
                    $totalskor5 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_5=='salah'){
                $totalskor5 = 0;
            }
        }

        $totalskor6 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_6=='benar'){
                if ($valskor['id_soal']==6){
                    $totalskor6 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_6=='salah'){
                $totalskor6 = 0;
            }
        }

        $totalskor7 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_7=='benar'){
                if ($valskor['id_soal']==7){
                    $totalskor7 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_7=='salah'){
                $totalskor7 = 0;
            }
        }

        $totalskor8 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_8=='benar'){
                if ($valskor['id_soal']==8){
                    $totalskor8 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_8=='salah'){
                $totalskor8 = 0;
            }
        }

        $totalskor9 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_9=='benar'){
                if ($valskor['id_soal']==9){
                    $totalskor9 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_9=='salah'){
                $totalskor9 = 0;
            }
        }

        $totalskor10 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_10=='benar'){
                if ($valskor['id_soal']==10){
                    $totalskor10 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_10=='salah'){
                $totalskor10 = 0;
            }
        }

        $totalskor11 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_11=='benar'){
                if ($valskor['id_soal']==11){
                    $totalskor11 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_11=='salah'){
                $totalskor11 = 0;
            }
        }

        $totalskor12 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_12=='benar'){
                if ($valskor['id_soal']==12){
                    $totalskor12 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_12=='salah'){
                $totalskor12 = 0;
            }
        }

        $totalskor13 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_13=='benar'){
                if ($valskor['id_soal']==13){
                    $totalskor13 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_13=='salah'){
                $totalskor13 = 0;
            }
        }

        $totalskor14 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_14=='benar'){
                if ($valskor['id_soal']==14){
                    $totalskor14 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_14=='salah'){
                $totalskor14 = 0;
            }
        }

        $totalskor15 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_15=='benar'){
                if ($valskor['id_soal']==15){
                    $totalskor15 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_15=='salah'){
                $totalskor15 = 0;
            }
        }

        $totalskor16 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_16=='benar'){
                if ($valskor['id_soal']==16){
                    $totalskor16 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_16=='salah'){
                $totalskor16 = 0;
            }
        }

        $totalskor17 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_17=='benar'){
                if ($valskor['id_soal']==17){
                    $totalskor17 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_17=='salah'){
                $totalskor17 = 0;
            }
        }

        $totalskor18 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_18=='benar'){
                if ($valskor['id_soal']==18){
                    $totalskor18 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_18=='salah'){
                $totalskor18 = 0;
            }
        }

        $totalskor19 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_19=='benar'){
                if ($valskor['id_soal']==19){
                    $totalskor19 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_19=='salah'){
                $totalskor19 = 0;
            }
        }

        $totalskor20 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_20=='benar'){
                if ($valskor['id_soal']==20){
                    $totalskor20 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_20=='salah'){
                $totalskor20 = 0;
            }
        }

        $totalskor21 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_21=='benar'){
                if ($valskor['id_soal']==21){
                    $totalskor21 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_21=='salah'){
                $totalskor21 = 0;
            }
        }

        $totalskor22 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_22=='benar'){
                if ($valskor['id_soal']==22){
                    $totalskor22 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_22=='salah'){
                $totalskor22 = 0;
            }
        }

        $totalskor23 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_23=='benar'){
                if ($valskor['id_soal']==23){
                    $totalskor23 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_23=='salah'){
                $totalskor23 = 0;
            }
        }

        $totalskor24 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_24=='benar'){
                if ($valskor['id_soal']==24){
                    $totalskor24 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_24=='salah'){
                $totalskor24 = 0;
            }
        }

        $totalskor25 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_25=='benar'){
                if ($valskor['id_soal']==25){
                    $totalskor25 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_25=='salah'){
                $totalskor25 = 0;
            }
        }

        $totalskor26 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_26=='benar'){
                if ($valskor['id_soal']==26){
                    $totalskor26 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_26=='salah'){
                $totalskor26 = 0;
            }
        }

        $totalskor27 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_27=='benar'){
                if ($valskor['id_soal']==27){
                    $totalskor27 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_27=='salah'){
                $totalskor27 = 0;
            }
        }

        $totalskor28 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_28=='benar'){
                if ($valskor['id_soal']==28){
                    $totalskor28 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_28=='salah'){
                $totalskor28 = 0;
            }
        }

        $totalskor29 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_29=='benar'){
                if ($valskor['id_soal']==29){
                    $totalskor29 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_29=='salah'){
                $totalskor29 = 0;
            }
        }

        $totalskor30 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_30=='benar'){
                if ($valskor['id_soal']==30){
                    $totalskor30 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_30=='salah'){
                $totalskor30 = 0;
            }
        }

        $totalskor31 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_31=='benar'){
                if ($valskor['id_soal']==31){
                    $totalskor31 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_31=='salah'){
                $totalskor31 = 0;
            }
        }

        $totalskor32 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_32=='benar'){
                if ($valskor['id_soal']==32){
                    $totalskor32 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_32=='salah'){
                $totalskor32 = 0;
            }
        }

        $totalskor33 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_33=='benar'){
                if ($valskor['id_soal']==33){
                    $totalskor33 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_33=='salah'){
                $totalskor33 = 0;
            }
        }

        $totalskor34 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_34=='benar'){
                if ($valskor['id_soal']==34){
                    $totalskor34 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_34=='salah'){
                $totalskor34 = 0;
            }
        }

        $totalskor35 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_35=='benar'){
                if ($valskor['id_soal']==35){
                    $totalskor35 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_35=='salah'){
                $totalskor35 = 0;
            }
        }

        $totalskor36 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_36=='benar'){
                if ($valskor['id_soal']==36){
                    $totalskor36 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_36=='salah'){
                $totalskor36 = 0;
            }
        }

        $totalskor37 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_37=='benar'){
                if ($valskor['id_soal']==37){
                    $totalskor37 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_37=='salah'){
                $totalskor37 = 0;
            }
        }

        $totalskor38 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_38=='benar'){
                if ($valskor['id_soal']==3){
                    $totalskor38 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_38=='salah'){
                $totalskor38 = 0;
            }
        }

        $totalskor39 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_39=='benar'){
                if ($valskor['id_soal']==39){
                    $totalskor39 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_39=='salah'){
                $totalskor39 = 0;
            }
        }

        $totalskor40 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_40=='benar'){
                if ($valskor['id_soal']==40){
                    $totalskor40 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_40=='salah'){
                $totalskor40 = 0;
            }
        }

        $totalskor41 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_41=='benar'){
                if ($valskor['id_soal']==41){
                    $totalskor41 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_41=='salah'){
                $totalskor41 = 0;
            }
        }

        $totalskor42 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_42=='benar'){
                if ($valskor['id_soal']==42){
                    $totalskor42 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_42=='salah'){
                $totalskor42 = 0;
            }
        }

        $totalskor43 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_43=='benar'){
                if ($valskor['id_soal']==43){
                    $totalskor43 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_43=='salah'){
                $totalskor43 = 0;
            }
        }

        $totalskor44 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_44=='benar'){
                if ($valskor['id_soal']==44){
                    $totalskor44 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_44=='salah'){
                $totalskor44 = 0;
            }
        }

        $totalskor45 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_45=='benar'){
                if ($valskor['id_soal']==45){
                    $totalskor45 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_45=='salah'){
                $totalskor45 = 0;
            }
        }

        $totalskor46 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_46=='benar'){
                if ($valskor['id_soal']==46){
                    $totalskor46 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_46=='salah'){
                $totalskor46 = 0;
            }
        }

        $totalskor47 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_47=='benar'){
                if ($valskor['id_soal']==47){
                    $totalskor47 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_47=='salah'){
                $totalskor47 = 0;
            }
        }

        $totalskor48 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_48=='benar'){
                if ($valskor['id_soal']==48){
                    $totalskor48 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_48=='salah'){
                $totalskor48 = 0;
            }
        }

        $totalskor49 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_49=='benar'){
                if ($valskor['id_soal']==49){
                    $totalskor49 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_49=='salah'){
                $totalskor49 = 0;
            }
        }

        $totalskor50 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_50=='benar'){
                if ($valskor['id_soal']==50){
                    $totalskor50 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_50=='salah'){
                $totalskor50 = 0;
            }
        }

        $totalskor51 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_51=='benar'){
                if ($valskor['id_soal']==51){
                    $totalskor51 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_51=='salah'){
                $totalskor51 = 0;
            }
        }

        $totalskor52 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_52=='benar'){
                if ($valskor['id_soal']==52){
                    $totalskor52 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_52=='salah'){
                $totalskor52 = 0;
            }
        }

        $totalskor53 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_53=='benar'){
                if ($valskor['id_soal']==53){
                    $totalskor53 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_53=='salah'){
                $totalskor53 = 0;
            }
        }

        $totalskor54 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_54=='benar'){
                if ($valskor['id_soal']==54){
                    $totalskor54 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_54=='salah'){
                $totalskor54 = 0;
            }
        }

        $totalskor55 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_55=='benar'){
                if ($valskor['id_soal']==55){
                    $totalskor55 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_55=='salah'){
                $totalskor55 = 0;
            }
        }

        $totalskor56 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_56=='benar'){
                if ($valskor['id_soal']==56){
                    $totalskor56 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_56=='salah'){
                $totalskor56 = 0;
            }
        }

        $totalskor57 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_57=='benar'){
                if ($valskor['id_soal']==57){
                    $totalskor57 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_57=='salah'){
                $totalskor57 = 0;
            }
        }

        $totalskor58 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_58=='benar'){
                if ($valskor['id_soal']==58){
                    $totalskor58 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_58=='salah'){
                $totalskor58 = 0;
            }
        }

        $totalskor59 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_59=='benar'){
                if ($valskor['id_soal']==59){
                    $totalskor59 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_59=='salah'){
                $totalskor59 = 0;
            }
        }

        $totalskor60 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_60=='benar'){
                if ($valskor['id_soal']==60){
                    $totalskor60 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_60=='salah'){
                $totalskor60 = 0;
            }
        }

        $totalskor61 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_61=='benar'){
                if ($valskor['id_soal']==61){
                    $totalskor61 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_61=='salah'){
                $totalskor61 = 0;
            }
        }

        $totalskor62 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_62=='benar'){
                if ($valskor['id_soal']==62){
                    $totalskor62 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_62=='salah'){
                $totalskor62 = 0;
            }
        }

        $totalskor63 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_63=='benar'){
                if ($valskor['id_soal']==63){
                    $totalskor63 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_63=='salah'){
                $totalskor63 = 0;
            }
        }

        $totalskor64 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_64=='benar'){
                if ($valskor['id_soal']==64){
                    $totalskor64 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_64=='salah'){
                $totalskor64 = 0;
            }
        }

        $totalskor65 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_65=='benar'){
                if ($valskor['id_soal']==65){
                    $totalskor65 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_65=='salah'){
                $totalskor65 = 0;
            }
        }

        $totalskor66 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_66=='benar'){
                if ($valskor['id_soal']==66){
                    $totalskor66 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_66=='salah'){
                $totalskor66 = 0;
            }
        }

        $totalskor67 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_67=='benar'){
                if ($valskor['id_soal']==67){
                    $totalskor67 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_67=='salah'){
                $totalskor67 = 0;
            }
        }

        $totalskor68 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_68=='benar'){
                if ($valskor['id_soal']==68){
                    $totalskor68 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_68=='salah'){
                $totalskor68 = 0;
            }
        }

        $totalskor69 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_69=='benar'){
                if ($valskor['id_soal']==69){
                    $totalskor69 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_69=='salah'){
                $totalskor69 = 0;
            }
        }

        $totalskor70 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_70=='benar'){
                if ($valskor['id_soal']==70){
                    $totalskor70 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_70=='salah'){
                $totalskor70 = 0;
            }
        }

        $totalskor71 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_71=='benar'){
                if ($valskor['id_soal']==71){
                    $totalskor71 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_71=='salah'){
                $totalskor71 = 0;
            }
        }

        $totalskor72 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_72=='benar'){
                if ($valskor['id_soal']==72){
                    $totalskor72 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_72=='salah'){
                $totalskor72 = 0;
            }
        }

        $totalskor73 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_73=='benar'){
                if ($valskor['id_soal']==73){
                    $totalskor73 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_73=='salah'){
                $totalskor73 = 0;
            }
        }

        $totalskor74 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_74=='benar'){
                if ($valskor['id_soal']==74){
                    $totalskor74 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_74=='salah'){
                $totalskor74 = 0;
            }
        }

        $totalskor75 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_75=='benar'){
                if ($valskor['id_soal']==75){
                    $totalskor75 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_75=='salah'){
                $totalskor75 = 0;
            }
        }

        $totalskor76 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_76=='benar'){
                if ($valskor['id_soal']==76){
                    $totalskor76 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_76=='salah'){
                $totalskor76 = 0;
            }
        }

        $totalskor77 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_77=='benar'){
                if ($valskor['id_soal']==77){
                    $totalskor77 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_77=='salah'){
                $totalskor77 = 0;
            }
        }

        $totalskor78 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_78=='benar'){
                if ($valskor['id_soal']==78){
                    $totalskor78 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_78=='salah'){
                $totalskor78 = 0;
            }
        }

        $totalskor79 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_79=='benar'){
                if ($valskor['id_soal']==79){
                    $totalskor79 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_79=='salah'){
                $totalskor79 = 0;
            }
        }

        $totalskor80 = 1;
        foreach($ambilskorpernilai as $valskor){
            if($cektbsoal->soal_80=='benar'){
                if ($valskor['id_soal']==80){
                    $totalskor80 += $valskor['skor'];
                }
            } else if ($cektbsoal->soal_80=='salah'){
                $totalskor80 = 0;
            }
        }

        // jumlah skor dari 1 sampai 80 soal
        $total_skor = $totalskor1 + $totalskor2 + $totalskor3 + $totalskor4+ $totalskor5+ $totalskor6+ $totalskor7+ $totalskor8+ $totalskor9+ $totalskor10+ $totalskor11
        + $totalskor12+ $totalskor13+ $totalskor14+ $totalskor15+ $totalskor16+ $totalskor17+ $totalskor18+ $totalskor19+ $totalskor20 + $totalskor21+ $totalskor22
        + $totalskor23+ $totalskor24+ $totalskor25+ $totalskor26+ $totalskor27+ $totalskor28+ $totalskor29+ $totalskor30 + $totalskor31+ $totalskor32+ $totalskor33
        + $totalskor34+ $totalskor35+ $totalskor36+ $totalskor37+ $totalskor38+ $totalskor39+ $totalskor40+ $totalskor41 + $totalskor42+ $totalskor43+ $totalskor44
        + $totalskor45+ $totalskor46+ $totalskor47+ $totalskor48+ $totalskor49+ $totalskor50+ $totalskor51+ $totalskor52+ $totalskor53+ $totalskor54+ $totalskor55
        + $totalskor56+ $totalskor57+ $totalskor58+ $totalskor59+ $totalskor60+ $totalskor61+ $totalskor62+ $totalskor63+ $totalskor64+ $totalskor65+ $totalskor66
        + $totalskor67+ $totalskor68+ $totalskor69+ $totalskor70+ $totalskor71+ $totalskor72+ $totalskor73+ $totalskor74+ $totalskor75+ $totalskor76+ $totalskor77
        + $totalskor78+ $totalskor79+ $totalskor80;

        return $total_skor;
    }

    public static function updateStatus($datarespon,$pesanapi,$apiresponberhasil,$objectarray){
        $textApprove        = "Selamat dan Nikmati";
        $textBelumApprove   = "Mohon maaf gagal";

        if($datarespon !=null || $datarespon != ""){
            //   dd($datarespon->detail_data);
               // $resdatadetail = json_decode($datarespon->detail_data);
               // $drt =  $datarespon[0]['detail_data'];
                $qry[] = $datarespon;

                $updateStatus = response()->json(
                    [
                        'api_status'         => 1,
                        'api_response_code'  => 200,
                        'api_message'        => 'Api Successfully Processed',
                        'api_data'           => [
                            'response_code'     =>  $apiresponberhasil,
                            'response_message'   =>  $pesanapi,
                            'parameters' => [
                                $objectarray => $qry,
                                'textApprove' => $textApprove,
                                'textBelumAPprove' => $textBelumApprove,
                            ]
                        ]
                    ]
                );
            }else{
                $updateStatus = response()->json(
                    [
                        'api_status'         => '2',
                        'api_response_code'  => 500,
                        'api_message'        => 'Api Failed',
                    ]
                );
            }
            return $updateStatus;
    }
}
