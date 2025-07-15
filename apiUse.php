<?php
include_once 'assest/APIs/youtube/api_Youtube.php';//Cambia la ubicacion si es necesario
include_once 'assest/APIs/twitch/api_Twitch.php';//Cambia la ubicacion si es necesario
include_once 'assest/APIs/datos.php';//Cambia la ubicacion si es necesario



class ApiUse {

    public function __construct() {
        // Constructor code if needed
    }

    public function listarCanalesYoutube($username) {
        $apiYoutube = new ApiYoutube();
        global $clave_API;
        return $apiYoutube->listar_canales($username, $clave_API);
    }

    public function listarPlaylistsYoutube($userId) {
        $apiYoutube = new ApiYoutube();
        global $clave_API;
        return $apiYoutube->listar_playlists($userId, $clave_API);
    }
    public function listar_videos($playlist_ID, $maxResults) {
        $apiYoutube = new ApiYoutube();
        global $clave_API;
        return $apiYoutube->listar_videos($playlist_ID, $maxResults, $clave_API);
    }

    public function listarCanalTwitch($datos) {
        $apiTwitch = new ApiTwitch();
        global $token, $client_id;
        return $apiTwitch->listarCanal($datos, $token, $client_id);
    }  
    
    public function ultimoContenidoTwitch($user, $id_user) {
    
        $datos = $this->liveStreamTwitch($user);
        if ($datos['type'] == 'live') {
            $datos['src'] ='https://player.twitch.tv/?channel=' . $datos['user_name'] . '&parent=localhost' ; // Add id to the data
            $datos['status']= 'true';
            return $datos;
        } else {
            $datos=$this->ultimoStreamTwitch($id_user);
            if(isset($datos['type']) && $datos['type'] == 'archive') {
                $datos['src'] ='https://player.twitch.tv/?video=' . $datos['id'] . '&parent=localhost' ; // Add id to the data
                $datos['status']= 'true';
                return $datos;
            } else {
                $datos['status']= 'false'; // Add id to the data
                return $datos;
            }
            
            
        }

    }
    public function ultimoStreamTwitch($id_user) {
        $apiTwitch = new ApiTwitch();
        global $token, $client_id;
        return $apiTwitch->ultimoStream($id_user, $token, $client_id);
    }
    public function liveStreamTwitch($user) {
        $apiTwitch = new ApiTwitch();
        global $token, $client_id;
        return $apiTwitch->enVivo($user, $token, $client_id);
    }

}
