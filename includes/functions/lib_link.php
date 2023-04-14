<?php

$httpcode = 0;


function web_request($url, $postdata = '', $header = 0) {
  global $httpcode;
  
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_NOBODY, $header);
    curl_setopt($ch, CURLOPT_POST, ($postdata<>''?1:0));
    if ($postdata <> '') curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, abs($header-1));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    
    $output = curl_exec($ch);      

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    
    return $output;
    
}
?>