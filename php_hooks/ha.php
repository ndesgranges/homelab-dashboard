<?php

function ha_hook($url){
    ##
    # Your code goes here
    ##
    ini_set('default_socket_timeout', 3);
    $context = stream_context_create(['http' => array('method' => 'HEAD')]);
    $headers = @get_headers($url, true, $context);
    $status = true;
    if($headers){
        $return_code = substr($headers[0], 9, 3);
        if (DEBUG)
            echo "$url : $return_code\n";
        if ( 405 != $return_code && 400 <= $return_code && $return_code < 600)
            $status = false;
    } else {
        if (DEBUG)
            echo "@W: $url: No response\n";
        $status = false;
    }
    ##
    # Must return true (alive) or false (down)
    ##
    return $status;
}

?>