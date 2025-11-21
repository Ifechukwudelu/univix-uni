<?php

function checkUrlProtocol($url){
$parsed = parse_url($url);
if (isset($parsed['scheme'] )) {
   return $parsed['scheme'] ;
}else{
    return "invalid";
}
}

$url = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ?   "https" : "http" . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

// http://localhost/about/php?id=12
$verified_url = checkUrlProtocol($url);



if($verified_url === "https") {

    $domain = "https://univix.gt.tc/";
    $host = "sql206.infinityfree.com";
    $user = "if0_40249063";
    $pass = "DsgJVwv6b7r";
    $db = "if0_40249063_univix";

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
 
}else{
    $domain = "univix/";
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "univix";
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
 
}
