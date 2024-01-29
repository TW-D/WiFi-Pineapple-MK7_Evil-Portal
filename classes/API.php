<?php

require_once(__DIR__ . '/CURL.php');

abstract class API extends CURL {

    private const URL = 'http://172.16.42.1:1471/api';
    private static string $token;

    public static function login(string $username, string $password) : bool {
        $output = (array) CURL::post_request(
            (self::URL . '/login'),
            array(
                'Content-Type: application/json'
            ),
            array(
                "username" => $username,
                "password" => $password
            )
        );

        if (isset($output['token'])) {
            self::$token = (string) $output['token'];
            return (bool) true;
        } else {
            return (bool) false;
        }
    }

    public static function scan() : array {
        $output = (array) CURL::post_request(
            (self::URL . '/settings/networking/clientmode/scan'),
            array(
                ('Authorization: Bearer ' . self::$token),
                'Content-Type: application/json'
            ),
            array(
                "interface" => "wlan2"
            )
        );
        return (array) (isset($output['results']) and !empty($output['results'])) ? $output['results'] : array();
    }

    public static function connect(array $access_point, string $password) : bool {
        $access_point['password'] = (string) $password;
        $access_point['interface'] = (string) 'wlan2';
        CURL::post_request(
            (self::URL . '/settings/networking/clientmode/connect'),
            array(
                ('Authorization: Bearer ' . self::$token),
                'Content-Type: application/json'
            ),
            $access_point
        );
        return (bool) self::online();
    }

    private static function online() : bool {
        $online = (bool) false;
        foreach (range(1, 10) as $poll) {
            $output = (array) CURL::get_request(
                (self::URL . '/settings/networking/clientmode/status'),
                array(
                    ('Authorization: Bearer ' . self::$token),
                    'Content-Type: application/json'
                )
            );
            if (
                isset($output['connected']) and isset($output['ip']) and
                $output['connected'] and !empty($output['ip'])
            ) {
                $online = (bool) true;
                break;
            } else {
                sleep(2);
            }
        }
        return (bool) $online;
    }

    public static function disconnect() : void {
        $output = (array) CURL::post_request(
            (self::URL . '/settings/networking/clientmode/disconnect'),
            array(
                ('Authorization: Bearer ' . self::$token),
                'Content-Type: application/json'
            ),
            array(
                "interface" => "wlan2"
            )
        );
    }

}

?>
