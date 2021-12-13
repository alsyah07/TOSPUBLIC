<?php

namespace App\Http\Middleware;
use App\models\dipass;
use Closure;
use App\Helpers\helperAPI;

class AuthKey
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
            $cek = dipass::where('kode_terminal',$request->kode_terminal)->count();
            if($cek >= 0){
                $simpangetdipass = new dipass();
                $simpangetdipass->kode_terminal = $request->kode_terminal;
                $simpangetdipass->kode_booking = $request->kode_booking;
                $simpangetdipass->nama_terminal = $request->nama_terminal;
                $simpangetdipass->nama_penumpang = $request->nama_penumpang;
                $simpangetdipass->nomor_identitas = $request->nomor_identitas;
                $simpangetdipass->tgl_berangkat = $request->tgl_berangkat;
                $simpangetdipass->terminal_asal = $request->terminal_asal;
                $simpangetdipass->terminal_tujuan = $request->terminal_tujuan;
                $simpangetdipass->jam_berangkat = $request->jam_berangkat;
                $simpangetdipass->save();
            } else {
                $simpangetdipass = dipass::where('kode_terminal',$request->kode_terminal)->first();
                $simpangetdipass->kode_terminal = $request->kode_terminal;
                $simpangetdipass->kode_booking = $request->kode_booking;
                $simpangetdipass->nama_terminal = $request->nama_terminal;
                $simpangetdipass->nama_penumpang = $request->nama_penumpang;
                $simpangetdipass->nomor_identitas = $request->nomor_identitas;
                $simpangetdipass->tgl_berangkat = $request->tgl_berangkat;
                $simpangetdipass->terminal_asal = $request->terminal_asal;
                $simpangetdipass->terminal_tujuan = $request->terminal_tujuan;
                $simpangetdipass->jam_berangkat = $request->jam_berangkat;
                $simpangetdipass->save();
            }
            return helperAPI::responAll($simpangetdipass);

           // return $next($request);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }
}
