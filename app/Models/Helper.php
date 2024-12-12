<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Helper
{
    public static function clean_phone($phone)
    {
        return str_replace([' ', '+', '-', '(', ')'], '', $phone);
    }

    public static function send_sms($phone, $text)
    {
        $phone = Helper::clean_phone($phone);
        $response = Http::get("https://smsc.kz/sys/send.php?login=111111&psw=2222222&phones=$phone&mes=$text");
        return [
            'response' => $response->body()
        ];
    }

    public static function route_is_active($route_name = ''){
        if ($route_name == request()->route()->getName()){
            return 'active';
        } else {
            return '';
        }
        
    }

    public static function number_to_word($number, $titles)
    { // год, года, лет
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }

    public static function parseFloat($ptString)
    {
        if (strlen($ptString) == 0) {
            return false;
        }

        $pString = str_replace(" ", "", $ptString);

        if (substr_count($pString, ",") > 1)
            $pString = str_replace(",", "", $pString);

        if (substr_count($pString, ".") > 1)
            $pString = str_replace(".", "", $pString);

        $pregResult = array();

        $commaset = strpos($pString, ',');
        if ($commaset === false) {
            $commaset = -1;
        }

        $pointset = strpos($pString, '.');
        if ($pointset === false) {
            $pointset = -1;
        }

        $pregResultA = array();
        $pregResultB = array();

        if ($pointset < $commaset) {
            preg_match('#(([-]?[0-9]+(\.[0-9])?)+(,[0-9]+)?)#', $pString, $pregResultA);
        }
        preg_match('#(([-]?[0-9]+(,[0-9])?)+(\.[0-9]+)?)#', $pString, $pregResultB);
        if ((isset($pregResultA[0]) && (!isset($pregResultB[0])
            || strstr($pregResultA[0], $pregResultB[0]) == 0
            || !$pointset))) {
            $numberString = $pregResultA[0];
            $numberString = str_replace('.', '', $numberString);
            $numberString = str_replace(',', '.', $numberString);
        } elseif (isset($pregResultB[0]) && (!isset($pregResultA[0])
            || strstr($pregResultB[0], $pregResultA[0]) == 0
            || !$commaset)) {
            $numberString = $pregResultB[0];
            $numberString = str_replace(',', '', $numberString);
        } else {
            return false;
        }
        $result = (float)$numberString;
        return $result;
    }
}
