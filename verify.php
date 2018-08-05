<?php
$access_token = 'Lo0ZKi0j1xhwfuE5Rp99uhTzLW3gkyZzZ3CYu8CEJ7aYu9jb2QvOiOjIlwL5p0H5efK7PD8dE/HY3k0P8e4sXsOrBLMuqf0jw9juz1szA9VV1pdfv8Db43mSNyYiclDKkLGfrr/dCgty2vRXprn2EQdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
