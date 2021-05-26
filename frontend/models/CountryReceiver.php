<?php
/**
 * Date: 6/28/18
 */

namespace frontend\models;

use stdClass;

class CountryReceiver {

    public static function getByRemoteAddress($ip = false)
    {
        if($ip === false){
            $ip = self::_getIp();
        }
        if($country = self::_ipinfoAPI($ip)) {
            return $country;
        }
        if($country = self::_freegeoipAPI($ip)) {
            return $country;
        }
        return false;
    }

    private static function _ipinfoAPI($ip)
    {
        $APIAddress = "http://ipinfo.io/";
        $details = json_decode(@file_get_contents($APIAddress.$ip));
        if(isset($details) && $details instanceof stdClass && isset($details->country))
        {
            return $details->country;
        }
        return false;
    }
    private static function _freegeoipAPI($ip)
    {
        $APIAddress = "http://freegeoip.net/json/";
        $details = json_decode(@file_get_contents($APIAddress.$ip));
        if(isset($details) && $details instanceof stdClass && isset($details->country_code))
        {
            return $details->country_code;
        }
        return false;
    }

    private static function _getIp()
    {
        if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = false;
        }
        return $ip;
    }
}