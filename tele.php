<?php
if(!function_exists('pr')){
   function pr($input){
        echo '<pre>';
        print_r($input, true);
        echo '</pre>';
    }
}
curl_init();
curl_close();
echo 'Hello World';