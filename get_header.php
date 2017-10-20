<?php
$url = "https://www.instagram.com/thawk4so/?__a=1";
//print_r(get_headers($url));

//print_r(get_headers($url, 1));
$headers = get_headers($url);
print_r($headers);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// get headers too with this line
curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);
print_r($result);
// get cookie
preg_match('/^Set-Cookie:\s*([^;]*)/mi', $result, $m);

parse_str($m[0], $cookies);
var_dump($cookies);
?>