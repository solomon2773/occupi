<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 1/31/18
 * Time: 4:25 PM
 */





$servername = "localhost";
$username = "occupi";
$password = "OccuPi@2018";
$dbname = "occupi";
try {

    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM sensors ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
      //  print_r($row);
    } else {

    }

}
catch(PDOException $e)
{
    echo "DB Connection failed: " . $e->getMessage();
}
?>

<html>

<head></head>
<script type="text/javascript">
    window.setTimeout(function(){ document.location.reload(true); }, 1000);
</script>
<body>

<div>
    <?php
   // foreach ($rows as $row){

    $jsondata = json_decode($rows['jsondata']);
//print_r($jsondata);
    ?>

    <div>Last Update : <?php echo $rows['lastupdate']?></div>
    <div>Device Mac Address : <?php echo $rows['mac_address']?></div>
    <div>Device Timestamp : <?php echo $jsondata->timestamp?></div>
    <div>CPU Temp. : <?php echo $jsondata->CPU_Temp?></div>
    <div>GPU Temp. : <?php echo $jsondata->GPU_Temp?></div>
    <div>Sensor Data : <?php echo $jsondata->sensor_data?></div>
    <div>
        <?php
        $sensordata_array = json_decode($jsondata->sensor_data);
       // print_r($sensordata_array);

        ?>
        <table style="margin-top: 50px;padding: 10px;text-align: center;font-size: 30px;">
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['63'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['62'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['61'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['60'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['59'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['58'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['57'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['56'],2);;?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['55'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['54'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['53'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['52'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['51'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['50'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['49'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['48'],2);;?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['48'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['46'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['45'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['44'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['43'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['42'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['41'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['40'],2);;?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['39'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['38'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['37'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['36'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['35'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['34'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['33'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['32'],2);;?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['31'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['30'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['29'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['28'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['27'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['26'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['25'],2);;?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['24'],2);;?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['23'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['22'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['21'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['20'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['19'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['18'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['17'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['16'],2);?></td>
            </tr>

            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['15'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['14'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['13'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['12'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['11'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['10'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['9'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['8'],2);?></td>
            </tr>
            <tr style="padding: 15px">
                <td style="padding: 15px"><?php echo number_format($sensordata_array['7'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['6'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['5'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['4'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['3'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['2'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['1'],2);?></td>
                <td style="padding: 15px"><?php echo number_format($sensordata_array['0'],2);?></td>
            </tr>
        </table>


    </div>

    <?php
   // }
    ?>



</div>


</body>
</html>
