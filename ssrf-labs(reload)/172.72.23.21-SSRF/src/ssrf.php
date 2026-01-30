<?php
error_reporting(0);
function curl($url){
     $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_FILE | CURLPROTO_HTTP | CURLPROTO_HTTPS | CURLPROTO_GOPHER | CURLPROTO_DICT);
     $result = curl_exec($ch);
    curl_close($ch);
    return  $result;
}
 $url =  $_POST['url'];
echo "<pre>" . curl($url) . "</pre>";
?>




