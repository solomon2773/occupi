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

    /*
    private $entityManager;
    
    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
  //  public function __construct($entityManager)
  //  {
  //     $this->entityManager = $entityManager;
  //  }
   // */
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() 
    {
        return new ViewModel();
    }

    public function getrRealTimeData(){


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
            while($row = $result->fetch_assoc()) {
                $rows[]=$row;
            }
            //  $rows = $result->fetch_assoc();
            // print_r($row);
        } else {

        }
        $sql_ctn = "SELECT sum(`occupancy_counter`) as `occupancy_counter` FROM `sensors_history` WHERE `mac_address` = 'b8:27:eb:92:3a:ac' AND `timestamp` > '2018-02-24 10:00:02'";
        $result_cnt = $conn->query($sql_ctn);
        if ($result_cnt->num_rows > 0) {
            while($row_cnt = $result_cnt->fetch_assoc()) {
                $rows_cnt[]=$row_cnt;
            }
            //  $rows = $result->fetch_assoc();
             print_r($row);
        } else {

        }


    }
    catch(PDOException $e)
    {
        echo "DB Connection failed: " . $e->getMessage();
    }

    }


}

