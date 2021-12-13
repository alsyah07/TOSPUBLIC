<?php

namespace App\Http\Middleware;
use Closure;
use App\Helpers\helperAPI;
use App\models\vw_api_tos_spionam_blue;

class apispionam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        $user = \App\User::where('api_token', $token)->first();
     //   dd($user->api_token);
        if (!empty($user) && $user->api_token !=null) {
             auth()->login($user);
            $cek = vw_api_tos_spionam_blue::where('noken',$request->noken)->count();
           // dd($cek);
        if($cek >= 0){
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
            // dd($simpangetdipass);
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

           // return $next($request);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }
}
