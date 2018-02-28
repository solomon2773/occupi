<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 7/21/17
 * Time: 1:52 AM
 */
exit;
$url_streetwear='https://www.reddit.com/r/streetwear/comments/.json?limit=500';
$url_fashion='https://www.reddit.com/r/fashion/comments/.json?limit=500';
$url_malefashion='https://www.reddit.com/r/malefashion/comments/.json?limit=500';
$url_femalefashionadvice='https://www.reddit.com/r/femalefashionadvice/comments/.json?limit=500';
$urls = array(
    "streetwear"=>"https://www.reddit.com/r/streetwear/comments/.json?limit=500",
    "fashion"=>"https://www.reddit.com/r/fashion/comments/.json?limit=500",
    "malefashion"=>"https://www.reddit.com/r/malefashion/comments/.json?limit=500",
    "femalefashionadvice"=>"https://www.reddit.com/r/femalefashionadvice/comments/.json?limit=500",
);

foreach ($urls as $url_key=>$url_value){
    $ch=curl_init();
    $timeout=5;
  //  echo $url_key."=>".$url_value."<br/>";
    curl_setopt($ch, CURLOPT_URL, $url_value);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch,CURLOPT_USERAGENT,'webbots:com.fashiontrendguru.streaming.reddit:v1.0.0 (by /Solomon)');

// Get URL content
    $lines_string=curl_exec($ch);
// close handle to release resources
    curl_close($ch);


    $file = fopen("/home/fashiontrendguru/public_html/www/application/public/cronjobs/data/".$url_key."-".time().".txt","w");
    fwrite($file,$lines_string);
    fclose($file);
  //  sleep(2);
}
