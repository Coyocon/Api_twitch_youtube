<?php


class ApiTwitch {

    public function __construct() {
        // Constructor code if needed
    }

    /**
     * Function to list videos from Twitch API
     */

    public function listarCanal($datos, $token, $client_id) {
        foreach ($datos as $key) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitch.tv/helix/users?login=' . $key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Client-Id: ' . $client_id
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, true);
            $datosTwitch[$response['data'][0]['login']]['id'] = $response['data'][0]['id'];
            $datosTwitch[$response['data'][0]['login']]['name'] = $response['data'][0]['display_name'];
            $datosTwitch[$response['data'][0]['login']]['username'] = $response['data'][0]['login'];
            $datosTwitch[$response['data'][0]['login']]['profile_image_url'] = $response['data'][0]['profile_image_url'];
            $datosTwitch[$response['data'][0]['login']]['description'] = $response['data'][0]['description'];
            $datosTwitch[$response['data'][0]['login']]['view_count'] = $response['data'][0]['view_count'];
            $datosTwitch[$response['data'][0]['login']]['created_at'] = $response['data'][0]['created_at'];
        }


        return $datosTwitch;

    }

    public function ultimoStream($id_user, $token, $client_id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.twitch.tv/helix/videos?user_id=' . $id_user . '&type=archive&first=1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Client-Id: ' . $client_id
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);

        if (isset($response['data'][0])) {
            $ultimoStream = [
                'id' => $response['data'][0]['id'],
                'title' => $response['data'][0]['title'],
                'description' => $response['data'][0]['description'],
                'published_at' => $response['data'][0]['published_at'],
                'url' => $response['data'][0]['url'],
                'thumbnail_url' => $response['data'][0]['thumbnail_url'],
                'view_count' => $response['data'][0]['view_count'],
                'duration' => $response['data'][0]['duration']
            ];
        }else {
            $ultimoStream = [];
        }

        return $ultimoStream;

    }

    public function enVivo($user, $token, $client_id) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.twitch.tv/helix/streams?user_login=' . $user,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Client-Id: ' . $client_id
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['data'][0])) {
            $streamData = [
                'id' => $response['data'][0]['id'],
                'user_id' => $response['data'][0]['user_id'],
                'user_name' => $response['data'][0]['user_name'],
                'game_id' => $response['data'][0]['game_id'],
                'type' => $response['data'][0]['type'],
                'title' => $response['data'][0]['title'],
                'viewer_count' => $response['data'][0]['viewer_count'],
                'started_at' => $response['data'][0]['started_at'],
                'language' => $response['data'][0]['language']
            ];
        } else {
            $streamData['type'] = 'No';
        }
        return $streamData;
        
    }
    
}




