### WiFi Pineapple - Web UI

PineAP Suite > Filtering : Client Filter "Deny List" and SSID Filter "Deny List"

Recon > Scanning : [Scan]

__Note :__ *Identify a secure network with at least one client to be disconnected afterwards.*

### Hacker - Evil Portal

Edit the values of these constants in the "./configuration.php" file
```php

/**
 * Payload
 */
$PAYLOAD_PATH = (string) './payloads/phishing/wifi_security-key.html';

/**
 * WiFi Pineapple Mark VII
 */
$MK7_USERNAME = (string) 'root';
$MK7_PASSWORD = (string) '<REDACTED>';

/**
 * Target Access Point
 */
$AP_SSID = (string) 'Home-Network';
$AP_BSSID = (string) '0A:1B:2C:3D:4E:5F';
$AP_ENCRYPTION = (string) 'WPA2 PSK (CCMP)';

```

### WiFi Pineapple - Web UI

PineAP Suite > Impersonation > Spoofed AP Pool : SSID "Home-Network " [Add]

PineAP Suite > PineAP : [Toggle] Impersonate all networks, [Check] Advertise AP Impersonation Pool and [Save]

__Note :__ *The SSID "Home-Network " is an example.*

### Hacker - Evil Portal

If, after automatic verification, the security key provided by the target is valid, you will find this information in the file "./logs/evil-portal.log".
