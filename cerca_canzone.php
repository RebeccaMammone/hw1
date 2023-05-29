<?php

require_once 'auth.php';

if(checkAuth()) exit;

header('Content-Type: application/json');

spotify();

function spotify(){
    $client_id = "d4c860fba30d49e5ad6cce24a046379b";
    $client_secret = "5174c572bd624d8588ce342797b766a4";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret)));
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);

    $query = urlencode($_GET["q"]);
    $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token']));
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}

?>