<?php

function is_online($url){
    if(!$url)
        return true;
    ini_set('default_socket_timeout', 3);
    $context = stream_context_create(['http' => array('method' => 'HEAD')]);
    $headers = @get_headers($url, true, $context);
    if($headers){
        $return_code = substr($headers[0], 9, 3);
        if (400 <= $return_code && $return_code < 600)
            return false;
    } else {
        echo "@W: $url: No response\n";
        return false;
    }
    return true;
}

$json = file_get_contents('config.json'); 
$json = json_decode($json);
$services = $json->{'services'};

$data = [];
foreach ($services as $element){
    $data[$element->label] = is_online($element->link);
}

echo json_encode($data);

?>