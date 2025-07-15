# Configuración y Uso de la API
Este documento detalla cómo configurar y utilizar las clases Datos.php y ApiUse.php para interactuar con las APIs de YouTube y Twitch.

---
## Configuración Inicial
Datos.php
En el archivo Datos.php, deberás modificar las siguientes variables con tus credenciales:

* Clave API de YouTube: $clave_API

* Token de Twitch: $token

* ID de Cliente de Aplicación de Twitch: $client_id

apiUse.php
* En el archivo apiUse.php, es necesario ajustar la ruta de require_once para que apunte correctamente a los archivos necesarios desde la ubicación donde se instancia la clase.

### Uso de la Clase ApiUse
Para utilizar las funcionalidades de la API, primero debes instanciar la clase ApiUse.


#### PHP
```
include_once 'assest/APIs/apiUse.php';
$apiUse = new ApiUse();
```

---
## Funciones Incluidas


### YouTube
* listarCanalesYoutube(string o Array[])

Descripción: Recibe el nombre o un array de nombres de usuario de YouTube.

Ejemplo de retorno por cada usuario:
```
(
    [id] => UCdSKXUxxr6XIJ3Wswesad
    [url] => USUARIO
    [user] => prueba
    [country] => MX
    [thumbnails] => https://yt3.ggpht.com/exgRznDK7nu38IFcw6pSV8QxYSB0emzWdRNC-LpT_etge-euMNLzUdsdsdasd7WALFp0M=s800-c-k-c0x00ffffff-no-rj
    [playlist_ID] => UUdSKXUxxr6Xsdsdsaa-WTQ
    [statistics] => Array
        (
            [viewCount] => 1542
            [subscriberCount] => 35
            [hiddenSubscriberCount] => 2
            [videoCount] => 95
        )
    [brandingSettings] => https://yt3.googleusercontent.com/ZFlmqT2xu28Xlf0CLXR95k89jwXwsdsdsdsddsdsYxPKqn9cKC-4aC8MSzTU7tDJEdbYqrocc1HBQdTubg
)
```
* listarPlaylistsYoutube(string)

* listar_videos(string, INT)

### Twitch
* listarCanalTwitch(string o Array[])

* ultimoContenidoTwitch(string)
