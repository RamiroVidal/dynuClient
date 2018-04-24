#!/usr/bin/php 
<?php
// Add domains as an array ej. array('domain1.com','domain2.com','sub.domain.com');
$domains = array( 'example.com' ); 

// Enter your dynu.com password 
// Password will be md5 encrypted before submitting.
$password = 'password'; 

//----------------------------------------------------------
$password = md5($password); 
// Get our Public IP 
$ipUrl = "http://checkip.dynu.com"; 

$ch = curl_init(); 
curl_setopt($ch,CURLOPT_URL, $ipUrl); 
curl_setopt($ch,CURLOPT_HEADER, 0); 
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
$ip = curl_exec($ch); 
$ip = trim(str_replace("Current IP Address:",'',$ip)); 

$result =''; 

foreach($domains as $value ){ 
        $url = "https://api.dynu.com/nic/update?hostname=$value&password=$password&myip=$ip"; 
        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_HEADER, 0); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        $result = date("j-M-Y G:i") ."\n" .curl_exec($ch). "\n\n"; 
        print "$value \n$result";
} 

print "-------------------------------------------------\n";

?>
