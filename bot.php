<?php

function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_COOKIE,TRUE);
/*        curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt"); */
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }


function get($url,$host){
  return curl($url,'',head($host))[1];
}

function post($url,$data,$host){
  return curl($url,$data,head($host))[1];
}

function head($host){
$user=json_decode(file_get_contents("data.json"),true)["User"];
$cookie=json_decode(file_get_contents("data.json"),true)["Cookie"];
  $h[]="Host: $host";
  $h[]="content-type: application/x-www-form-urlencoded";
  $h[]="user-agent: $user";
  $h[]="cookie: $cookie";
  return $h;
}

if(!file_exists("data.json")){
while("true"){
system("clear");
//ban();
$api["Cookie"]=readline("\033[1;97mInput Your Cookie : \033[1;92m");
if($api["Cookie"]!=""){
break;
}
}
while("true"){
system("clear");
//ban();
$api["User"]=readline("\033[1;97mInput Your User-agent : \033[1;92m");
if($api["User"]!=""){
break;
}
}

  save("data.json",$api);
//$a=next($ran);
}


function save($data,$data_post){
    if(!file_get_contents($data)){
      file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));
}


function timer($t){
     $timr=time()+$t;
      while(true):
      echo "\r                                                    \r";
      $res=$timr-time();
      if($res < 1){break;}
if($res==$res){
//  $str= str_repeat("\033[1;92m◼",$res)."              \r";
}
      echo " \033[1;97mPlease Wait \033[1;91m".date('i:s',$res)." ";
      sleep(1);
      endwhile;
}

function slow($str,$t){
$arr = str_split($str);
foreach ($arr as $az){
echo $az;
usleep($t);
}
}

system("clear");

$host="earnbitmoon.club";
$url="https://earnbitmoon.club/";
$res= get($url,$host);
$user=explode(" <",explode("siteUserFullName: '",$res)[1])[0];
$balance=explode('<',explode('id="sidebarCoins">',$res)[1])[0];
// TOKEN //
$token=explode("';",explode("var token = '",$res)[1])[0];

if($user!=null){
echo "# Username=> $user\n";
echo "# Balance => $balance\n\n";
}
a:
$url="https://earnbitmoon.club/";
$res= get($url,$host);
$token=explode("';",explode("var token = '",$res)[1])[0];



// CHALLENGE //
$hostsol="api-secure.solvemedia.com";
$urlsol="https://api-secure.solvemedia.com/papi/_challenge.js?k=5TuPjHOPoHvCPuSfsUohIl19kOkG2877;f=_ACPuzzleUtil.callbacks%5B0%5D;l=en;t=img;s=standard;c=js,h5c,h5ct,svg,h5v,v/h264,v/webm,h5a,a/mp3,a/ogg,ua/chrome,ua/chrome106,os/android,os/android7.1,fwv/BxfhVQ.mjzv24,jslib/jquery,htmlplus;am=Ykvar79mUCFlXDjXv2ZQIQ;ca=ajax;ts=1667401008;ct=1667401245;th=white;r=0.4165453326344679";
$res= get($urlsol,$hostsol);
$cha=explode('"',explode('"challenge":"',$res)[1])[0];
$media="https://api-secure.solvemedia.com/papi/media?c=$cha;w=300;h=150;fg=000000;bg=f8f8f8";
$res= get($media,$hostsol);

$apikey="6a84f1979088957";
file_put_contents("img.jpg",$res);
system('convert img.jpg -gravity North -chop x15 captcha.png 2>/dev/null');
$hasil=json_decode(shell_exec('curl --silent -H "apikey:'.$apikey.'" --form "file=@captcha.png" --form "language=eng" --form "ocrengine=2" --form "isOverlayRequired=false" --form "iscreatesearchablepdf=false" https://api.ocr.space/Parse/Image'))->ParsedResults[0]->ParsedText;
$hasilcaptcha = preg_replace("/[^a-zA-Z]/","", $hasil);
$cap=$hasilcaptcha;

//echo slow(" \033[1;97mPlease Wait Bypass Captcha ...!!!                 \r",3000);
if($cap!=null){
echo " # Captcha •> $cap \n";
}else{
goto a;
}


