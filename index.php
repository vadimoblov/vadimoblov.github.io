<?php
global $_CORE, $_CONF;
if(!function_exists('pr')){
   function pr($input){
        echo '<pre>';
        print_r($input, true);
        echo '</pre>';
    }
}
if(!function_exists('tlg_curl')) {
    function tlg_curl($message, $params = array()){
        $botToken = '6088117518:AAGkO16Bupo_WjuQZxxIn08R4uIWERB_5_A';
        $website ="https://api.telegram.org/bot".$botToken . '/';        
        $ch = curl_init($website . $message);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($params)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        }
        $result = curl_exec($ch); 
        curl_close($ch);
        return $result;
    }
}
$messageLog = __DIR__ . '/messages.txt';
// /var/www/html/modules/telegrambot/messages.txt
$whookExists = json_decode(tlg_curl('getWebhookInfo'), true);
if($whookExists['ok'] && empty($whookExists['result']['url'])){
    $params = array(
        'url' => 'https://vmcrm2.dev007.ru/telegrambot/response/',
    );
    $setWebhook = tlg_curl('setWebhook', $params);
    //pr($setWebhook);  
}
pr($whookExists);
exit;
$command = str_replace('/', '', $Cmd);

switch ($command){
    case 'response':
        $data = file_get_contents('php://input');
        //$data = json_decode($data, true);
        //DOCUMENT_ROOT $_SERVER[]
        Main::log_message($data, 'telegrambot', 'error');
        //Main::log_message();
        //file_put_contents($messageLog, print_r($_POST), FILE_APPEND);
        //file_put_contents($messageLog, print_r($_REQUEST), FILE_APPEND);
        die;
        ob_start();
        ob_end_clean();
        $j = array(
            'one' => 1, 
            'two' => 2);
        $json = json_encode($j);
        header('Content-Type: application/json; charset=utf-8');
        print_r($json );
    break;
    
    default:
        die('Unknown cmd');
}
exit;

/*
 * {"update_id":238319568,
    "message":{"message_id":26,"from":{"id":5119660074,"is_bot":false,"first_name":"Vadim","username":"vbo1966","language_code":"ru"},
 * "chat":{"id":5119660074,"first_name":"Vadim","username":"vbo1966","type":"private"},
 * "date":1682509465,
 * "text":"\u044b\u0432\u0430\u044b\u0432\u0430\u044b\u0432\u0430\u044b\u0432\u0430"}}
 * 
 * 
 * 
 * 
 * 
 */
