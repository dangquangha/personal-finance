<?php

namespace App\Libraries;

class Common
{
    public static function getClientIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']) & !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) & !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED']) & !empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR']) & !empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED']) & !empty($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) & !empty($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);

        return $string;
    }

    public static function removeScripts($str)
    {
        $regex = '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|' .
            '<script[^>]*>.*?<\/script>|' .
            '<style[^>]*>.*?<\/style>|' .
            '<!--.*?-->/is';

        return preg_replace($regex, '', $str);
    }

    public static function replacePhone($phone)
    {
        if (empty($phone)) {
            return $phone;
        }
        if (!self::phoneStartsWith($phone, '+84') && !self::phoneStartsWith($phone, '84') && !self::phoneStartsWith($phone, '0')) {
            $phone = '0' . $phone;
            // dd($phone);
        }
        if ($phone == '') {
            return null;
        }
        $search  = array('(84)', '(+84)', '+84', ' ', '-');
        $replace = array('0', '0', '0', '', '');
        $phone   = str_replace($search, $replace, Ultilities::clearXSS($phone));
        $rest    = substr($phone, 0, 2);
        if ($rest == '84') {
            $rest_phone = substr($phone, 2);
            $phone      = '0' . $rest_phone;
        }
        return $phone;
    }

}