<?php
namespace Occupi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class ShowcurrentoccupancyController extends AbstractActionController
{


    private $entityManager;
    private $conn;
    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager)
    {
       $this->entityManager = $entityManager;
        $servername = "localhost";
        $username = "occupi";
        $password = "OccuPi@2018";
        $dbname = "occupi";
        try {

            $this->conn = new \mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }


            /*
            $sql_ctn = "SELECT sum(`occupancy_counter`) as `occupancy_counter` FROM `sensors_history` WHERE `mac_address` = 'b8:27:eb:92:3a:ac' AND `timestamp` > '2018-02-24 10:00:02'";
            $result_cnt = $conn->query($sql_ctn);
            if ($result_cnt->num_rows > 0) {
                while($row_cnt = $result_cnt->fetch_assoc()) {
                    $rows_cnt[]=$row_cnt;
                }
                //  $rows = $result->fetch_assoc();
                // print_r($row);
            } else {

            }*/


        }
        catch(PDOException $e)
        {
            echo "DB Connection failed: " . $e->getMessage();
        }
    }
   // */
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() 
    {
        return new ViewModel();
    }

    public function getRealTimeDataAction(){


        $sql = "SELECT * FROM sensors LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($sql_row = $result->fetch_assoc()) {
                $rows[]=$sql_row;
            }
            //  $rows = $result->fetch_assoc();
            // print_r($row);
        } else {

        }

       // print_r($rows);

    
        ///heat map occupi
     $row = $rows['0'];

        $jsondata = json_decode($row['jsondata']);
        //print_r($row);
        $sensordata_array = json_decode($jsondata->sensor_data);
        echo '<div style="width: 400px;display: inline-block;margin-left: auto;margin-right: auto;">
            <div>Last Update : '.$row['lastupdate'].'</div>
            <div>Device Mac Address : '. $row['mac_address'].'</div>
            <div>Device Timestamp : '. $jsondata->timestamp.'</div>
            <div>CPU Temp. : '. $jsondata->CPU_Temp.'</div>
            <div>GPU Temp. : '. $jsondata->GPU_Temp.'</div>
                     
            <div>
                
                <table style="margin-top: 5px;padding: 5px;text-align: center;font-size: 16px;margin-left: auto;margin-right: auto;">
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">'. number_format($sensordata_array['63'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['62']).'">'. number_format($sensordata_array['62'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['61']).'">'. number_format($sensordata_array['61'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['60']).'">'. number_format($sensordata_array['60'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['59']).'">'. number_format($sensordata_array['59'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['58']).'">'. number_format($sensordata_array['58'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['57']).'">'. number_format($sensordata_array['57'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['56']).'">'. number_format($sensordata_array['56'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['55']).'">'. number_format($sensordata_array['55'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['54']).'">'. number_format($sensordata_array['54'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['53']).'">'. number_format($sensordata_array['53'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['52']).'">'. number_format($sensordata_array['52'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['51']).'">'. number_format($sensordata_array['51'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['50']).'">'. number_format($sensordata_array['50'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['49']).'">'. number_format($sensordata_array['49'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['48']).'">'. number_format($sensordata_array['48'],2).'</td>
                    </tr>                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['47']).'">'. number_format($sensordata_array['47'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['46']).'">'. number_format($sensordata_array['46'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['45']).'">'. number_format($sensordata_array['45'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['44']).'">'. number_format($sensordata_array['44'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['43']).'">'. number_format($sensordata_array['43'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['42']).'">'. number_format($sensordata_array['42'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['41']).'">'. number_format($sensordata_array['41'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['40']).'">'. number_format($sensordata_array['40'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['39']).'">'. number_format($sensordata_array['39'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['38']).'">'. number_format($sensordata_array['38'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['37']).'">'. number_format($sensordata_array['37'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['36']).'">'. number_format($sensordata_array['36'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['35']).'">'. number_format($sensordata_array['35'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['34']).'">'. number_format($sensordata_array['34'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['33']).'">'. number_format($sensordata_array['33'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['32']).'">'. number_format($sensordata_array['32'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['31']).'">'. number_format($sensordata_array['31'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['30']).'">'. number_format($sensordata_array['30'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['29']).'">'. number_format($sensordata_array['29'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['28']).'">'. number_format($sensordata_array['28'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['27']).'">'. number_format($sensordata_array['27'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['26']).'">'. number_format($sensordata_array['26'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['25']).'">'. number_format($sensordata_array['25'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['24']).'">'. number_format($sensordata_array['24'],2).'</td>
                    </tr>
                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['23']).'">'. number_format($sensordata_array['23'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['22']).'">'. number_format($sensordata_array['22'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['21']).'">'. number_format($sensordata_array['21'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['20']).'">'. number_format($sensordata_array['20'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['19']).'">'. number_format($sensordata_array['19'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['18']).'">'. number_format($sensordata_array['18'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['17']).'">'. number_format($sensordata_array['17'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['16']).'">'. number_format($sensordata_array['16'],2).'</td>
                    </tr>

                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['15']).'">'. number_format($sensordata_array['15'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['14']).'">'. number_format($sensordata_array['14'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['13']).'">'. number_format($sensordata_array['13'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['12']).'">'. number_format($sensordata_array['12'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['11']).'">'. number_format($sensordata_array['11'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['10']).'">'. number_format($sensordata_array['10'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['9']).'">'. number_format($sensordata_array['9'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['8']).'">'. number_format($sensordata_array['8'],2).'</td>
                    </tr>
                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['7']).'">'. number_format($sensordata_array['7'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['6']).'">'. number_format($sensordata_array['6'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['5']).'">'. number_format($sensordata_array['5'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['4']).'">'. number_format($sensordata_array['4'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['3']).'">'. number_format($sensordata_array['3'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['2']).'">'. number_format($sensordata_array['2'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['1']).'">'. number_format($sensordata_array['1'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['0']).'">'. number_format($sensordata_array['0'],2).'</td>
                    </tr>
                </table>


            </div>
        </div>';




    die();
    }
    public function getRealTimeDataDoorCountAction(){


        $sql = "SELECT * FROM sensors ORDER BY `sensors`.`id` ASC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($sql_row = $result->fetch_assoc()) {
                $rows[]=$sql_row;
            }
            //  $rows = $result->fetch_assoc();
            // print_r($row);
        } else {

        }

        // print_r($rows);


        ///heat map occupi
        $row = $rows['0'];

        $jsondata = json_decode($row['jsondata']);
        //print_r($row);
        $sensordata_array = json_decode($jsondata->sensor_data);
        echo '<div style="width: 400px;display: inline-block;margin-left: auto;margin-right: auto;">
            <div>Last Update : '.$row['lastupdate'].'</div>
            <div>Device Mac Address : '. $row['mac_address'].'</div>
            <div>Device Timestamp : '. $jsondata->timestamp.'</div>
            <div>CPU Temp. : '. $jsondata->CPU_Temp.'</div>
            <div>GPU Temp. : '. $jsondata->GPU_Temp.'</div>
                     
            <div>
                
                <table style="margin-top: 5px;padding: 5px;text-align: center;font-size: 16px;margin-left: auto;margin-right: auto;">
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">'. number_format($sensordata_array['63'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['62']).'">'. number_format($sensordata_array['62'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['61']).'">'. number_format($sensordata_array['61'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['60']).'">'. number_format($sensordata_array['60'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['59']).'">'. number_format($sensordata_array['59'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['58']).'">'. number_format($sensordata_array['58'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['57']).'">'. number_format($sensordata_array['57'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['56']).'">'. number_format($sensordata_array['56'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['55']).'">'. number_format($sensordata_array['55'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['54']).'">'. number_format($sensordata_array['54'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['53']).'">'. number_format($sensordata_array['53'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['52']).'">'. number_format($sensordata_array['52'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['51']).'">'. number_format($sensordata_array['51'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['50']).'">'. number_format($sensordata_array['50'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['49']).'">'. number_format($sensordata_array['49'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['48']).'">'. number_format($sensordata_array['48'],2).'</td>
                    </tr>                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['47']).'">'. number_format($sensordata_array['47'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['46']).'">'. number_format($sensordata_array['46'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['45']).'">'. number_format($sensordata_array['45'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['44']).'">'. number_format($sensordata_array['44'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['43']).'">'. number_format($sensordata_array['43'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['42']).'">'. number_format($sensordata_array['42'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['41']).'">'. number_format($sensordata_array['41'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['40']).'">'. number_format($sensordata_array['40'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['39']).'">'. number_format($sensordata_array['39'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['38']).'">'. number_format($sensordata_array['38'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['37']).'">'. number_format($sensordata_array['37'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['36']).'">'. number_format($sensordata_array['36'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['35']).'">'. number_format($sensordata_array['35'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['34']).'">'. number_format($sensordata_array['34'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['33']).'">'. number_format($sensordata_array['33'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['32']).'">'. number_format($sensordata_array['32'],2).'</td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['31']).'">'. number_format($sensordata_array['31'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['30']).'">'. number_format($sensordata_array['30'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['29']).'">'. number_format($sensordata_array['29'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['28']).'">'. number_format($sensordata_array['28'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['27']).'">'. number_format($sensordata_array['27'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['26']).'">'. number_format($sensordata_array['26'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['25']).'">'. number_format($sensordata_array['25'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['24']).'">'. number_format($sensordata_array['24'],2).'</td>
                    </tr>
                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['23']).'">'. number_format($sensordata_array['23'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['22']).'">'. number_format($sensordata_array['22'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['21']).'">'. number_format($sensordata_array['21'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['20']).'">'. number_format($sensordata_array['20'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['19']).'">'. number_format($sensordata_array['19'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['18']).'">'. number_format($sensordata_array['18'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['17']).'">'. number_format($sensordata_array['17'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['16']).'">'. number_format($sensordata_array['16'],2).'</td>
                    </tr>

                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['15']).'">'. number_format($sensordata_array['15'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['14']).'">'. number_format($sensordata_array['14'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['13']).'">'. number_format($sensordata_array['13'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['12']).'">'. number_format($sensordata_array['12'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['11']).'">'. number_format($sensordata_array['11'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['10']).'">'. number_format($sensordata_array['10'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['9']).'">'. number_format($sensordata_array['9'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['8']).'">'. number_format($sensordata_array['8'],2).'</td>
                    </tr>
                    <tr style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['63']).'">
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['7']).'">'. number_format($sensordata_array['7'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['6']).'">'. number_format($sensordata_array['6'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['5']).'">'. number_format($sensordata_array['5'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['4']).'">'. number_format($sensordata_array['4'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['3']).'">'. number_format($sensordata_array['3'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['2']).'">'. number_format($sensordata_array['2'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['1']).'">'. number_format($sensordata_array['1'],2).'</td>
                        <td style="padding: 5px;'. $this->heatmapcolorcssconverter($sensordata_array['0']).'">'. number_format($sensordata_array['0'],2).'</td>
                    </tr>
                </table>


            </div>
        </div>';




        die();
    }
    private function heatmapcolorcssconverter($temp){
        $temp_buf = (int)number_format($temp,2);
        $temp_hsl = 200-(($temp_buf*5)+5);
        if ($temp_hsl <= 0){
            $temp_hsl = '0';
        }
      //  echo 'background-color: hsl('.$temp_hsl.', 50%, 50%);';
        return 'background-color: hsl('.$temp_hsl.', 50%, 50%);';
    }




}

