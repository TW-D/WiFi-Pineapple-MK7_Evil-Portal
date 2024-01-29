<?php

abstract class CURL {

    private static $curl_init;

    private static function curl_initialize() : void {
        $curl_init = curl_init();
        curl_setopt($curl_init, CURLOPT_HEADER, 0);
        curl_setopt($curl_init, CURLOPT_VERBOSE, 0);
        curl_setopt($curl_init, CURLOPT_REFERER, '');
        curl_setopt($curl_init, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl_init, CURLOPT_USERAGENT, '');
        curl_setopt($curl_init, CURLOPT_COOKIESESSION, 0);
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_init, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($curl_init, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_init, CURLOPT_SSL_VERIFYPEER, 0);
        self::$curl_init = $curl_init;
    }

    private static function curl_output() : array {
        $curl_exec = curl_exec(self::$curl_init);
        $curl_getinfo = curl_getinfo(self::$curl_init);
        curl_close(self::$curl_init);
        if ($curl_exec !== false) {
            return (array) json_decode($curl_exec, true);
        } else {
            die($curl_getinfo);
        }
    }

    protected static function get_request(string $curlopt_url, array $curlopt_httpheader) : array {
        self::curl_initialize();
        curl_setopt(self::$curl_init, CURLOPT_URL, $curlopt_url);
        curl_setopt(self::$curl_init, CURLOPT_HTTPHEADER, $curlopt_httpheader);
        return (array) self::curl_output();
    }

    protected static function post_request(string $curlopt_url, array $curlopt_httpheader, array $curlopt_postfields) : array {
        self::curl_initialize();
        curl_setopt(self::$curl_init, CURLOPT_POST, 1);
        curl_setopt(self::$curl_init, CURLOPT_URL, $curlopt_url);
        curl_setopt(self::$curl_init, CURLOPT_HTTPHEADER, $curlopt_httpheader);
        curl_setopt(self::$curl_init, CURLOPT_POSTFIELDS, json_encode($curlopt_postfields));
        return (array) self::curl_output();
    }

}

?>
