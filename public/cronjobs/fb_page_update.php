<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 11/3/17
 * Time: 12:57 AM
 */
define("SITE_URL_SSL", "https://www.yottatrend.com/");
define("ROOT_PATH", "/home/yottatrend/public_html/yottatrend");
set_time_limit ( 180);
//$folder_path = ROOT_PATH.'/customers/users_1/';
//$folders = scandir($folder_path);

echo '<pre>';
//print_r($files);
$core_user_id = $_GET['core_user_id'];
if (empty ($core_user_id)){
    echo 'Core User Error !!!!';
    exit;
}

//foreach($folders as $customer_id_folder){
   // if ($customer_id_folder == '.' || $customer_id_folder == '..'){
     //   continue;
   // }
    $time_start = time();
    $fb_page_folders_path = ROOT_PATH.'/customers/users_1/'.$core_user_id.'/facebook/pages/';

    $fb_pages_folders = scandir($fb_page_folders_path);
    foreach($fb_pages_folders as $fb_pages_folder){
        if ($fb_pages_folder == '.' || $fb_pages_folder == '..')  {
            continue;
        }
        $fb_page_folder_path = $fb_page_folders_path.$fb_pages_folder.'/';
        if (!is_dir($fb_page_folder_path)){
            continue;
        }
        echo '<br/><br/>Scan Facebook Page Folder : '.$fb_page_folder_path.'<br/>';


        $fb_page_folder = scandir($fb_page_folder_path);
        foreach($fb_page_folder as $fb_pages_file) {
            if ($fb_pages_file == '.' || $fb_pages_file == '..') {
                continue;
            }
            /// if file ends with .json
            // echo $customer_id_folder.".json";
            if (preg_match("/^[0-9]+-0.json/",$fb_pages_file)){
                try {
                    echo 'Scan Facebook Page File : '.$fb_pages_file . '<br/>';
                    $facebook_user_feed_file = file_get_contents($fb_page_folder_path . $fb_pages_file);
                    $facebook_user_feed_file_decode = json_decode(json_decode($facebook_user_feed_file));
                     // echo '<pre>';
                     // print_r($facebook_user_feed_file_decode);
                    $facebook_user_feed_page_data = $facebook_user_feed_file_decode->data;
                    $facebook_user_feed_page_paging = $facebook_user_feed_file_decode->paging;
                    $facebook_user_feed_page_previous = $facebook_user_feed_page_paging->previous;
                   echo  'Next : '.$facebook_user_feed_page_next = $facebook_user_feed_page_paging->next;
                    ///// start to look for previous page to make sure the current one is upto date.
                    $facebook_user_feed_page_get_content = file_get_contents($facebook_user_feed_page_previous);
                    $facebook_user_feed_page_get_content_decode = json_decode($facebook_user_feed_page_get_content);
                    /*
                    $facebook_user_feed_recent_page_checki = '1';
                    while (!empty($facebook_user_feed_page_get_content_decode->data)) {
                        echo "Facebook Feed NewUpdate Check : $facebook_user_feed_recent_page_checki <br>";
                        $facebook_user_feed_page_previous = $facebook_user_feed_page_get_content_decode->paging->previous;
                        $facebook_user_feed_page_get_content = file_get_contents($facebook_user_feed_page_previous);
                        $facebook_user_feed_page_get_content_decode = json_decode($facebook_user_feed_page_get_content);
                        $facebook_user_feed_page_data = $facebook_user_feed_page_get_content_decode->data;
                        $facebook_user_feed_page_paging = $facebook_user_feed_page_get_content_decode->paging;
                        $facebook_user_feed_page_previous = $facebook_user_feed_page_paging->previous;
                        $facebook_user_feed_page_next = $facebook_user_feed_page_paging->next;

                        $facebook_user_feed_recent_page_checki++;
                    }*/

                    $fb_page_feed_pulli = '1';
                    while (!empty($facebook_user_feed_page_next)) {
                        $facebook_user_feed_file = file_get_contents($facebook_user_feed_page_next);
                        $facebook_user_feed_file_decode = json_decode($facebook_user_feed_file);
                        // echo '<pre>';
                        // echo 'Next url : '.$facebook_user_feed_page_next.'<br/>';
                        echo 'Facebook Page I : '.$fb_page_feed_pulli.'<br/>';
                        // print_r($facebook_user_feed_file_decode);
                        $facebook_user_feed_page_data = $facebook_user_feed_file_decode->data;
                        $facebook_user_feed_page_paging = $facebook_user_feed_file_decode->paging;

                        $facebook_user_feed_page_previous = $facebook_user_feed_page_paging->previous;
                        $facebook_user_feed_page_next = $facebook_user_feed_page_paging->next;
                        if (!empty($facebook_user_feed_page_data)){
                            $file_location = $fb_page_folder_path.str_replace('-0.json','',$fb_pages_file).'-'.$fb_page_feed_pulli.'.json';
                          //  $file_location_jsonencode = $fb_feed_folder_path.'encoded/'.str_replace('.json','',$fb_feeds_file).'-'.$fb_page_feed_pulli.'-jsonencode.json';
                            $file_put_contents = file_put_contents($file_location, $facebook_user_feed_file);
                          //  $file_put_contents_jsonencode = file_put_contents($file_location_jsonencode, json_encode($facebook_user_feed_file));
                            echo 'Facebook Page New File : '.$file_location.'<br/>';
                            echo 'Facebook Page New File (Encoded) : '.$file_location_jsonencode.'<br/>';
                        }
                        $fb_page_feed_pulli++;
                    }

                } catch (Exception $e){
                    print_r($e);
                }

            }
        }
    }


    $time_end = time();
    $time_spend = $time_end-$time_start;
    echo 'Time Spend : '.$time_spend.' s<br/>';
//}
