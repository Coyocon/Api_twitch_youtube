<?php
class ApiYoutube {

    public function __construct() {
        // Constructor code if needed
    }

    /**
     * Function to list categories from YouTube API
     */

    public function listar_canales($username, $clave_API) {
        $info_youtube = [];
        foreach ($username as $user) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=brandingSettings&part=contentDetails&part=statistics&forHandle=' . $user . '&key=' . $clave_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json'
            ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            $info_youtube[$user]['id'] = $response['items'][0]['id'];
            $info_youtube[$user]['url'] = $response['items'][0]['snippet']['customUrl'];
            $info_youtube[$user]['user'] = $response['items'][0]['snippet']['title'];
            $info_youtube[$user]['country'] = $response['items'][0]['snippet']['country'];
            $info_youtube[$user]['thumbnails'] = $response['items'][0]['snippet']['thumbnails']['high']['url'];
            $info_youtube[$user]['playlist_ID'] = $response['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
            $info_youtube[$user]['statistics'] = $response['items'][0]['statistics'];
            $info_youtube[$user]['brandingSettings'] = $response['items'][0]['brandingSettings']['image']['bannerExternalUrl'];
        }
        return $info_youtube; 

    }
    public function listar_playlists($userId, $clave_API) {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://youtube.googleapis.com/youtube/v3/playlists?part=snippet%2CcontentDetails&channelId=' . $userId . '&maxResults=25&key=' . $clave_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response =json_decode($response, true);

        foreach ($response['items'] as $item) {
            $playlists[] = [
                'id' => $item['id'],
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'thumbnails' => $item['snippet']['thumbnails']['high']['url'],
                'videoCount' => $item['contentDetails']['itemCount']
            ];
        }
        return $playlists;
    }

    public function listar_videos($playlist_ID, $maxResults, $clave_API) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $playlist_ID . '&maxResults=' . $maxResults . '&key=' . $clave_API,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);
        foreach ($response['items'] as $item) {
            $videos[] = [
                'title' => $item['snippet']['title'],
                'url' => 'https://www.youtube.com/watch?v=' . $item['snippet']['resourceId']['videoId'],
                'description' => $item['snippet']['description'],
                'thumbnails' => $item['snippet']['thumbnails']['standard']['url']
            ];
        }


        return $videos;

    }
         

}



?>

