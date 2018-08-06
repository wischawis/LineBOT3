<?php
    $accessToken = "nzWgZ+roovjnh4gQnbqRwGSIbyfPLV1JnqXShFM8a+ffcbWTUh5nZj/Qy9eoIR06efK7PD8dE/HY3k0P8e4sXsOrBLMuqf0jw9juz1szA9WCZaQBhcV1o2I15B4QMz+z28iL4lGARRXuXAFtHqF+SgdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $channelSecret = "dfc31bd1338a741ed86ecbf798b0bf73";    

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    //============
/*
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv($accessToken));
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv($channelSecret)]);
    $signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
    $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
    replyMsg($event->getReplyToken(),new \LINE\LINEBot\MessageBuilder\TextMessageBuilder(createNewRichmenu(getenv($accessToken))));
 */
   //============

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }

    //if($message == "Click A"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
/*
        $arrayPostData['messages'][0]['type'] = "flex";
        $arrayPostData['messages'][0]['altText'] = "this is a flex message";
        $arrayPostData['messages'][0]['contents']['type'] = "bubble";
        $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
        $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
        $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
        $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "hello";
        $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] = "text";
        $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] = "WIIS";
*/
	$arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ABC";
        replyMsg($arrayHeader,$arrayPostData);
   // }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
