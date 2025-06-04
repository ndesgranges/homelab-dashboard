<?php

function immich_hook($url){
    ##
    # Your code goes here
    ##
        
    $status = true;

    $ch = curl_init();

    $options = array(
        // CURLOPT_URL => "http://immich.home/api/server/about",
        CURLOPT_URL => $url."/api/server/ping",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Accept: application/json')
    ); 

    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "$url : ".curl_error($ch)."\n";
        $status = false;
    }
    if (! $response) // empty
        $status = false;
    curl_close($ch);

    ##
    # Must return true (alive) or false (down)
    ##
    return $status;
}

?>