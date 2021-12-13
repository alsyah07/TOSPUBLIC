<?php

namespace App\Helpers;

class helpersmaster
{
    public static function titikkoordinat($lat,$long){
        $titik_koordinat = array([
            'lat'   => $lat,
            'long'  => $long
        ]);
        $jsontitikkoordinat = json_encode($titik_koordinat);
        return $jsontitikkoordinat;
    }

}
