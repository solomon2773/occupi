<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 1/31/18
 * Time: 4:47 PM
 */



$servername = "localhost";
$username = "occupi";
$password = "OccuPi@2018";
$dbname = "occupi";
try {

    $post_data = json_encode($_POST);

    $post_data_timestamp = $_POST['timestamp'];
    $post_data_GPU_Temp = $_POST['GPU_Temp'];
    $post_data_CPU_Temp = $_POST['CPU_Temp'];
    $post_data_mac_address = $_POST['mac_address'];
    $post_data_sensor_data = json_encode($_POST['sensor_data']);
    $occupancy_counter = $_POST['occupancy_counter'];
    $return_result = array();
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id FROM sensors WHERE `mac_address`='$post_data_mac_address'";
    $result = $conn->query($sql);
    $last_id = '';
    if ($result->num_rows > 0) {
        $sql = "UPDATE sensors SET jsondata='$post_data' WHERE `mac_address`='$post_data_mac_address'";
        if ($conn->query($sql) === TRUE) {
            $return_result['Update_Sensor'] = "Record updated successfully => " .$post_data_mac_address;
        } else {
            $return_result['Update_Sensor'] =  "Record updated Error ";
        }
        $row = $result->fetch_assoc();
        $last_id = $row['id'];

    } else {
        $sql = "INSERT INTO sensors (mac_address, jsondata) VALUES ('$post_data_mac_address', '$post_data')";
        if ($conn->query($sql) === TRUE) {
            $return_result['Insert_Sensor_Data'] =  "New record created successfully";
        } else {
            $return_result['Insert_Sensor_Data'] =  "New record created Error";
        }
        $last_id = $conn->insert_id;

    }


    //////////////
        $sql = "INSERT INTO sensors_history (sensor_id,pi_timestamp, mac_address,cup_temp,gpu_temp,sensor_data,occupancy_counter) VALUES ('$last_id','$post_data_timestamp','$post_data_mac_address', '$post_data_CPU_Temp','$post_data_GPU_Temp','$post_data_sensor_data','$occupancy_counter')";
        if ($conn->query($sql) === TRUE) {
            $return_result['Insert_Sensor_History_Data'] =  "New sensor history created successfully";
        } else {
            $return_result['Insert_Sensor_History_Data'] =  "New sensor history created Error";
        }

        $result_encode =  json_encode($return_result);
       // print_r($result_encode);
    //print_r($return_result);
        echo $result_encode;
}
catch(PDOException $e)
{
    echo "DB Connection failed: " . $e->getMessage();
}

//$output = json_decode($post_data);
//print_r($post_data);