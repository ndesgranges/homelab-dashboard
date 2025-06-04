<?php

foreach (glob("php_hooks/*.php") as $filename)
{
    include $filename;
}

const DEBUG = false;
// const DEBUG = true;

function check_online_status($hook, $link) {
    $hook_file = "php_hooks/$hook.php";
    $hook_function = $hook."_hook";
    if (!file_exists($hook_file)){
        if (DEBUG)
            echo "File not found : php_hooks/$hook.php";
        return false;
    }
    return $hook_function($link);
}


function get_config($config_file) {
    $json = file_get_contents($config_file); 
    $json = json_decode($json);
    return $json;
}

function query_status($config) {
    $data = [];
    foreach ($config->services as $element){
        $hook_name = $element->hook;
        $url = rtrim($element->link,"/");
        $data[$element->label] = check_online_status($hook_name, $url);
    }
    return $data;
}


$config = get_config('config.json');
$status = query_status($config);

# Return
echo json_encode($status);

?>