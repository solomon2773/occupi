<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 7/21/17
 * Time: 1:52 AM
 */
exit;
$servername = "192.168.1.21";
$username = "fashiontrendguru";
$password = "d5gtEW^5*ge!d45EDds";
$dbname = "fashiontrendguru";

while (true) {

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dir = "/opt/fashiontrendguru/streamfiles/output";

// Open a directory, and read its contents
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file_name = readdir($dh)) !== false) {
                $filetoberead = $dir . "/" . $file_name;//file_get_contents($dir."/".$file,"r");
                //  echo $dir."/".$file;
                //   print_r($filetoberead);
                $file = fopen($filetoberead, "r");

                $line = fgets($file);
                while (!feof($file)) {
                    // echo $line. "<br />";
                    $line = fgets($file);
                    $line_decode = json_decode($line, true);
                }

                fclose($file);
                //  print_r($line_decode);
                $sql = "INSERT INTO `stream_data`(`source`, `sentence`,`remaining_text`, `sentiment_score`, `brands_searching_result`, `product_type_model_searching_result`) VALUES ('" . $line_decode['source'] . "','" . $line_decode['sentence'] . "','" . $line_decode['remaining_text'] . "','" . $line_decode['sentiment_score'] . "','" . $line_decode['brands_searching_result'] . "','" . $line_decode['product_type_model_searching_result'] . "')";

                // echo $sql;
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";


                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                unlink($filetoberead);

            }
            closedir($dh);


        }
    }


    $conn->close();
    sleep(5);
}
?>