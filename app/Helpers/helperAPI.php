<?php

namespace App\Helpers;
use App\models\log_api_gate;
use App\models\terminal;
use App\models\kendaraan;
use App\models\log_response_gate;
use App\models\sdm;
use App\models\penumpang_tiba;
use App\models\penumpang_keluar;
use App\models\kendaraan_tiba;
use App\models\kendaraan_keluar;
use App\models\log_status_kendaraan;
use App\models\typefids;

class helperAPI
{
    public static function responAll($data){
        if($data != null || $data != ""){
            $response = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => 210,
                        'response_message' => "Api Successfully",
                        'parameters' => [
                            'data' => $data,
                        ]
                    ]
                ]
            );
        } else{
            $response = response()->json(
            [
                'api_status'         => '2',
                'api_response_code'  => 100,
                'api_message'        => 'Api Failed',
            ]);
        }
            return $response;
    }

    public static function responAllnew($data){
        if($data != null || $data != ""){
            $response = response()->json(
                [
                    'api_status'         => 1,
                    'api_response_code'  => 200,
                    'api_message'        => 'Api Successfully Processed',
                    'api_data'           => [
                        'response_code' => 210,
                        'response_message' => "Api Successfully",
                        'parameters' => [
                            'data' => $data,
                        ]
                    ]
                ]
            );
        } else{
            $response = response()->json(
            [
                'api_status'         => '2',
                'api_response_code'  => 100,
                'api_message'        => 'Api Failed',
            ]);
        }
            return $response;
    }

  public static function api_bagren($nokend){
    $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://api.hubdat.dephub.go.id/ehubdat/v1/tos-spionam-blue?noken='.$nokend,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwidXNlcl9uYW1lIjoidG9zIiwiZXhwIjoxNjY2NDM0MjQzfQ.bwfAL48ZoCI2OEiFMQmhhU5ca8kj0botWpXvwneNBWQ'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $databagjsontoarray = json_decode($response,TRUE);
            return $databagjsontoarray;
  }


   public static function cekkendaraan($no_kendaraan,$kode_terminal,$tanggal,$jam,$statusbus){
    // $date = date("Y-m-d");
    // dd($date);
    // $tz_object = new DateTimeZone('Asia/Jakarta');
    // $datetime = new DateTime();
    // $datetime->setTimezone($tz_object);
    // dd($datetime->format('Y-m-d h:i:s'));

  // $apibag = helperAPI::api_bagren($no_kendaraan);
  //  $databag = $apibag['api_response_code'];
    // $databagjsontoarray = json_decode($apibag,TRUE);
          //  dd($databagjsontoarray['data'][0]);
           // return $databagjsontoarray;
            $cekkendaraan = kendaraan::where('no_kendaraan',$no_kendaraan)->first();
                $datenow = date('Y-m-d');
                if(!is_null($cekkendaraan) && !is_null($cekkendaraan->id_perusahaan_otobus) && $datenow <= $cekkendaraan->tgl_kadaluarsa && $datenow <= $cekkendaraan->tgl_kadaluarsa_kps) {
                    $savelog = new log_api_gate();
                    $savelog->nomor_kendaraan = $no_kendaraan;
                    $savelog->kode_terminal  = $kode_terminal;
                    $savelog->tanggal      = $tanggal;
                    $savelog->jam          = $jam;
                    $savelog->status       = 1;
                    $savelog->status_bus   = $statusbus;
                    $savelog->save();
                    
                    $cekkendaraan = log_status_kendaraan::where('no_kendaraan',$no_kendaraan)->orderby('id','DESC')->first();
                    if(empty($cekkendaraan) || $cekkendaraan==null){
                        $data = array([
                        "nomor_kendaraan"   => $no_kendaraan,
                        "jam"               => $jam,
                        "tanggal"           => $tanggal,
                        "status"            => true,
                        "status_kendaraan"  => 'OUT'
                        ]);   
                    } else {
                        $data = array([
                        "nomor_kendaraan"   => $no_kendaraan,
                        "jam"               => $jam,
                        "tanggal"           => $tanggal,
                        "status"            => true,
                        "status_kendaraan"  => $cekkendaraan->status
                        ]);
                    }
                    return $data;
                } else {
                  $cekkendaraan = log_status_kendaraan::where('no_kendaraan',$no_kendaraan)->orderby('id','DESC')->first();
                  if($cekkendaraan==null || empty($cekkendaraan)){
                        $ceklagi = log_status_kendaraan::where('no_kendaraan',$no_kendaraan)->count();
                         if($ceklagi !=1){
                           $simpanstatus = new log_status_kendaraan();
                           $simpanstatus->no_kendaraan = $no_kendaraan;
                           $simpanstatus->jam = $jam;
                           $simpanstatus->status = 'IN';
                           $simpanstatus->save();

                           $data = array([
                            "status"            => false,
                            "status_kendaraan"            => 'OUT'
                            ]);
                        }
                  } else {
                        $savelog = new log_api_gate();
                        $savelog->nomor_kendaraan = $no_kendaraan;
                        $savelog->kode_terminal  = $kode_terminal;
                        $savelog->tanggal      = $tanggal;
                        $savelog->jam          = $jam;
                        $savelog->status       = 0;
                        $savelog->status_bus   = $statusbus;
                        $savelog->save();
                        $data = array([
                            "status"            => false,
                            "status_kendaraan"  => $cekkendaraan->status
                        ]);
                    }
                    return $data;

                }
    }

    public static function SaveLoggate($no_kendaraan,$kode_terminal,$tanggal,$jam,$type,$statusbus){
        $cekjumlahgate = terminal::where('kode_terminal',$kode_terminal)->first();
        if($type=="all"){
               return helperAPI::cekkendaraan($no_kendaraan,$kode_terminal,$tanggal,$jam,$statusbus);
        } else {
            $cekjumlahlog =  log_api_gate::where('kode_terminal',$kode_terminal)
                            ->select('tanggal')
                            ->distinct('tanggal')
                            ->where('status',0)
                            ->where('nomor_kendaraan',$no_kendaraan)
                            ->count();
            if($cekjumlahlog < $cekjumlahgate->max_open_gate ){
                return helperAPI::cekkendaraan($no_kendaraan,$kode_terminal,$tanggal,$jam,$statusbus);
            } else {
                $data = array([
                    "status"           => false,
                    "notif"            => "Maaf sudah melebihi kapasitas"
                ]);
                return $data;
            }
        }

    }

    public static function SaveResponseGate($request){
         $cekdatakekndaraan = kendaraan::where('no_kendaraan',$request['nomor_kendaraan'])->count();
               // dd($cekdatakekndaraan);
                   if($cekdatakekndaraan !=1){
                    $simpankendaraan = new kendaraan();
                    $simpankendaraan->no_kendaraan = $request['nomor_kendaraan'];
                    $simpankendaraan->save();
                }
              //  
        $cekterminal = terminal::where('kode_terminal',$request['kode_terminal'])
                                ->count();
        $ceksdm      = sdm::where('nip',$request['id_petugas'])->count();
        if($cekterminal == 1 && $ceksdm==1){
           $formatfileimage = rand(100000, 1001238912).'-'.$request['nomor_kendaraan'].'-'.'masuk';
            $urlfoto = $formatfileimage.'.png';
            $output_filename = 'upload/filegate/'.$formatfileimage.'.png';
            $host = $request['url_foto']; // <-- Source image url (FIX THIS)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- don't forget this
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- and this

            $result = curl_exec($ch);
            curl_close($ch);
            $fp = fopen($output_filename, 'wb');
            fwrite($fp, $result);
            fclose($fp);
          $savelogresponsegate = [];
          $cekn = kendaraan_tiba::where('no_kendaraan',$request['nomor_kendaraan'])->where('jam',$request['jam'])->count();
           if($cekn !=1){
             $savelogresponsegate = new log_response_gate();
             $savelogresponsegate->nomor_kendaraan = $request['nomor_kendaraan'];
             $savelogresponsegate->id_petugas      = $request['id_petugas'];
             $savelogresponsegate->kode_terminal   = $request['kode_terminal'];
             $savelogresponsegate->tanggal         = $request['tanggal'];
             $savelogresponsegate->flag            = $request['flag'];
             $savelogresponsegate->jam            = $request['jam'];
             $savelogresponsegate->url_foto        = $urlfoto;
           //  $savelogresponsegate->status_kendaraan = "IN";
             $savelogresponsegate->save();
          
             $getdataterminal = kendaraan::where('no_kendaraan',$request['nomor_kendaraan'])->first();
             $getdatasdm = sdm::where('nip',$request['id_petugas'])->first();
             $savekendaraantiba = new kendaraan_tiba();
             $savekendaraantiba->nip = $getdatasdm->nip;
             $savekendaraantiba->no_kendaraan = $request['nomor_kendaraan'];
             $savekendaraantiba->tgl  = $request['tanggal'];
             $savekendaraantiba->jam  = $request['jam'];
             $savekendaraantiba->status_spinoam  = 1;
             $savekendaraantiba->status_eblue  = 1;
             $savekendaraantiba->save();

             // simpan typefids
             $cekdatakendtibaforpo = kendaraan_tiba::select('*')->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                                                                ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                                                                ->where('kendaraan_tiba.no_kendaraan',$request['nomor_kendaraan'])
                                                                ->first();
            $cekterminal = terminal::where('kode_terminal',$request['kode_terminal'])->first();
             $simpantypefids = new typefids();
             $simpantypefids->schedule_date = $request['tanggal'];
             $simpantypefids->type = 'KEBERANGKATAN';
             $simpantypefids->airlines = $cekdatakendtibaforpo->nama_po;
             $simpantypefids->flightno = $request['nomor_kendaraan'];
             $simpantypefids->from_to = $cekterminal->nama_terminal;
             $simpantypefids->schedule_time = $request['jam'];
             $simpantypefids->status = 'Sudah Tersedia';
             $simpantypefids->save();


             $ceklagi = log_status_kendaraan::where('no_kendaraan',$request['nomor_kendaraan'])->count();
             if($ceklagi !=1){
               $simpanstatus = new log_status_kendaraan();
               $simpanstatus->no_kendaraan = $request['nomor_kendaraan'];
               $simpanstatus->jam = $request['jam'];
               $simpanstatus->status = 'IN';
               $simpanstatus->save();
                           //
            }
          }

           $data = array($savelogresponsegate);
           } else if($cekterminal != 1) {
                $data = array([
                            "status"           => false,
                            "notif"            => "Silahkan cek kembali id terminal"
                        ]);
           } else if($ceksdm != 1){
                $data = array([
                            "status"           => false,
                            "notif"            => "Silahkan cek kembali id petugas"
                        ]);
           } 
            return $data;


    }

    public static function SaveResponseGateOut($request){
        $cekterminal = terminal::where('kode_terminal',$request['kode_terminal'])
                                ->count();
        $ceksdm      = sdm::where('nip',$request['id_petugas'])->count();
        if($cekterminal == 1 && $ceksdm==1){
           $savelogresponsegate = new log_response_gate();
           $formatfileimage = rand(100000, 1001238912).'-'.$request['nomor_kendaraan'].'-'.'keluar';
            $output_filename = 'upload/filegate/'.$formatfileimage.'.png';
            $urlfoto = $formatfileimage.'.png';
            $host = $request['url_foto']; // <-- Source image url (FIX THIS)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- don't forget this
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- and this

            $result = curl_exec($ch);
            curl_close($ch);
            $fp = fopen($output_filename, 'wb');
            fwrite($fp, $result);
            fclose($fp);
           $cekn = kendaraan_keluar::where('no_kendaraan',$request['nomor_kendaraan'])->where('jam',$request['jam'])->count();
           if($cekn !=1 || $cekn==null){
             $savelogresponsegate = new log_response_gate();
             $savelogresponsegate->nomor_kendaraan = $request['nomor_kendaraan'];
             $savelogresponsegate->id_petugas      = $request['id_petugas'];
             $savelogresponsegate->kode_terminal   = $request['kode_terminal'];
             $savelogresponsegate->tanggal         = $request['tanggal'];
             $savelogresponsegate->flag            = $request['flag'];
             $savelogresponsegate->jam            = $request['jam'];
             $savelogresponsegate->url_foto        = $urlfoto;
           //  $savelogresponsegate->status_kendaraan = "OUT";
             $savelogresponsegate->save();

             $getdataterminal = kendaraan::where('no_kendaraan',$request['nomor_kendaraan'])->first();
             $getdatasdm = sdm::where('nip',$request['id_petugas'])->first();
             $savekendaraantiba = new kendaraan_keluar();
             $savekendaraantiba->nip = $getdatasdm->nip;
             $savekendaraantiba->no_kendaraan = $request['nomor_kendaraan'];
             $savekendaraantiba->tgl  = $request['tanggal'];
             $savekendaraantiba->jam  = $request['jam'];
             $savekendaraantiba->status_spinoam  = 1;
             $savekendaraantiba->status_eblue  = 1;
             $savekendaraantiba->save();

             $simpanstatus = new log_status_kendaraan();
             $simpanstatus->no_kendaraan = $request['nomor_kendaraan'];
             $simpanstatus->jam = $request['jam'];
             $simpanstatus->status = 'OUT';
             $simpanstatus->save();

             // simpan typefids
             $cekdatakendtibaforpo = kendaraan_tiba::select('*')->leftjoin('kendaraan','kendaraan.no_kendaraan','kendaraan_tiba.no_kendaraan')
                                                                ->leftjoin('perusahaan_otobus','perusahaan_otobus.kode_po','kendaraan.id_perusahaan_otobus')
                                                                ->where('kendaraan_tiba.no_kendaraan',$request['nomor_kendaraan'])
                                                                ->first();
            $cekterminal = terminal::where('kode_terminal',$request['kode_terminal'])->first();
             $simpantypefids = typefids::where('flightno',$request['nomor_kendaraan'])->first();
             $simpantypefids->schedule_date = $request['tanggal'];
             $simpantypefids->type = 'KEBERANGKATAN';
             $simpantypefids->airlines = $cekdatakendtibaforpo->nama_po;
             $simpantypefids->flightno = $request['nomor_kendaraan'];
             $simpantypefids->from_to = $cekterminal->nama_terminal;
             $simpantypefids->schedule_time = $request['jam'];
             $simpantypefids->status = 'Sudah Berangkat';
             $simpantypefids->update();


             $dataupdatekendaraantiba = \DB::connection()->getpdo()->exec("DROP PROCEDURE kendaraan_keluar_checking_ticket; CREATE PROCEDURE kendaraan_keluar_checking_ticket(IN v_id_kendaraan_keluar INT)
BEGIN
    DROP TEMPORARY TABLE IF EXISTS temp_kendaraan_keluar;
    CREATE TEMPORARY TABLE temp_kendaraan_keluar AS (
    SELECT * 
    FROM (  SELECT @row := @row+1 as rownum, X.*
            FROM    (SELECT B.id_kendaraan, A.no_kendaraan, A.tgl, A.jam, A.terminal_tujuan,
                            B.id_perusahaan_otobus kode_po, B.kapasitas, B.id_trayek,
                            C.id, C.tgl_masuk_tiket, C.jam_masuk_tiket 
                    FROM    kendaraan_keluar A
                            INNER JOIN kendaraan B
                            ON A.no_kendaraan = B.no_kendaraan
                            INNER JOIN log_tiket_users C
                            ON  A.tgl = C.tgl_masuk_tiket
                                AND A.jam >= C.jam_masuk_tiket
                                AND B.id_perusahaan_otobus = C.kode_po
                                AND A.terminal_tujuan = C.kode_terminal
                    WHERE   A.id_kendaraan_keluar = v_id_kendaraan_keluar
                            AND C.status_tiket = 'OPEN'
                    ORDER BY C.jam_masuk_tiket) X,
                    (SELECT @row:=0) Y) SUB
    WHERE SUB.rownum <= CASE WHEN SUB.kapasitas = 0 THEN 0 ELSE COALESCE(SUB.kapasitas, 50) END);

    UPDATE  log_tiket_users A,
            temp_kendaraan_keluar B
    SET     A.no_kendaraan = B.no_kendaraan,
            A.tgl = B.tgl,
            A.jam = B.jam,
            A.status_tiket = 'RUN'
    WHERE   A.id = B.id;

    UPDATE  kendaraan_tiba A,
            (select no_kendaraan, COUNT(rownum) tot_tiket from temp_kendaraan_keluar) B
    SET     A.jumlah_penumpang_naik = B.tot_tiket,
            A.jumlah = A.jumlah_penumpang_tiba - A.jumlah_penumpang_turun + B.tot_tiket
    WHERE   A.no_kendaraan = B.no_kendaraan;

END");
           }

           $data = array($savelogresponsegate);
       } else if($cekterminal != 1) {
            $data = array([
                        "status"           => false,
                        "notif"            => "Silahkan cek kembali id terminal"
                    ]);
       } else if($ceksdm != 1){
            $data = array([
                        "status"           => false,
                        "notif"            => "Silahkan cek kembali id petugas"
                    ]);
       } 
            return $data;


    }

}



















