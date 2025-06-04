<?php

function default_hook($url){
    // global $return_code_whitelist;
    if(!$url)
        return true;
    ini_set('default_socket_timeout', 3);
    $context = stream_context_create(['http' => array('method' => 'HEAD')]);
    $headers = @get_headers($url, true, $context);
    if($headers){
        $return_code = substr($headers[0], 9, 3);
        if (DEBUG)
            echo "$url : $return_code\n";
        // if (in_array($return_code, $return_code_whitelist))
        //     return true;
        if (400 <= $return_code && $return_code < 600)
            return false;
    } else {
        if (DEBUG)
            echo "@W: $url: No response\n";
        return false;
    }
    return true;
}




?>