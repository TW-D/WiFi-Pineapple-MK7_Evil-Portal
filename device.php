<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    include_once('./configuration.php');
    
    echo json_encode(
        array(
            "ssid" => $AP_SSID,
            "bssid" => $AP_BSSID,
            "encryption" => $AP_ENCRYPTION
        )
    );

}

?>
