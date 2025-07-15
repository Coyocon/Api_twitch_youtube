En el archivo Datos.php se modificaran los siguientes datos:
Clave API de Youtube en $clave_API
Token de Twtich en $token
Id de cliente de app de twitch en $client_id

En el archivo apiUse.php se modificaran los siguientes datos:
la Requiere_once que invocan a los archivos, esta ubicacion del archivo donde esta realziando la instacia hasta los archivos correspondientes

El uso es instaciar la clase ApiUse

include 'assest/APIs/apiUse.php';
$apiUse = new ApiUse();

Las funciones incluidas:
Youtube
listarCanalesYoutube(string o Array[])
se brinda el o los nombre de usuarios https://www.youtube.com/USUARIO
devuelve por cada usuario
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

listarPlaylistsYoutube(string)
listar_videos(string,INT)

Twitch
listarCanalTwitch(string o Array[])
ultimoContenidoTwitch(string)
