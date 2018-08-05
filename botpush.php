<?php



require "vendor/autoload.php";

$access_token = 'Lo0ZKi0j1xhwfuE5Rp99uhTzLW3gkyZzZ3CYu8CEJ7aYu9jb2QvOiOjIlwL5p0H5efK7PD8dE/HY3k0P8e4sXsOrBLMuqf0jw9juz1szA9VV1pdfv8Db43mSNyYiclDKkLGfrr/dCgty2vRXprn2EQdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'dfc31bd1338a741ed86ecbf798b0bf73';

$pushID = 'U11a10836211ed00c4c5b7785f3c817c5';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







