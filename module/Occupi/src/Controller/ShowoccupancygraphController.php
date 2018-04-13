<?php
namespace Occupi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class ShowoccupancygraphController extends AbstractActionController
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





        }
        catch(PDOException $e)
        {
            echo "DB Connection failed: " . $e->getMessage();
        }
    }
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() 
    {
        return new ViewModel();
    }

    public function getOccupancyDataAction(){
        $sql_ctn = "SELECT `occupancy_counter`,`timestamp` FROM `sensors_history` WHERE `mac_address` = 'b8:27:eb:a7:c9:95' AND `timestamp` > '2018-02-24 10:00:02'";
        $result_cnt = $this->conn->query($sql_ctn);
        if ($result_cnt->num_rows > 0) {
            while($row_cnt = $result_cnt->fetch_assoc()) {
                $rows_cnt[]=$row_cnt;
            }
            //  $rows = $result->fetch_assoc();
            // print_r($row);
        } else {

        }
        $result_x_cnt = 0;
        foreach ($rows_cnt as $row){
            $result_x[] = $result_x_cnt;
            $result_y[] = $row['occupancy_counter'];
            $result_x_cnt++;
        }
        $result[] = $result_x;
        $result[] = $result_y;
        // print_r($rows);
        echo json_encode($result);




        die();
    }


}

