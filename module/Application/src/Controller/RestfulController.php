<?php
/**
 * Created by IntelliJ IDEA.
 * User: solomontsao
 * Date: 7/21/17
 * Time: 3:13 PM
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
//use Zend\Db\Adapter\Pdo;
use Application\Model\FashiontrendguruTable;

class RestfulController extends AbstractRestfulController
{
///hello.....
    private $servername = "192.168.1.21";
    private $username = "fashiontrendguru";
    private $password = "d5gtEW^5*ge!d45EDds";
    private $dbname = "fashiontrendguru";
    private $table;


    public function __construct(FashiontrendguruTable $table)
    {
        $this->table = $table;
    }
    public function indexAction()
    {
        return new JsonModel([
            'status' => 'Index',
        ]);
    }
    public function dashboardAction()
    {

        $data_twitter = array(
            'data_source'=>'Twitter',
            'men_shoes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_shoes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'men_clothes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_clothes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'men_bags'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_bags'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),


        );
        $data_reddit = array(
            'data_source'=>'Twitter',
            'men_shoes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_shoes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'men_clothes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_clothes'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'men_bags'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),
            'women_bags'=>array(
                '0'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '1'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '2'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '3'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '4'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '5'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '6'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '7'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '8'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
                '9'=>array(
                    'label_name'=>'nike',
                    'unit'=>'M',
                    'ranking_value'=>'56'),
            ),

        );

        return new JsonModel([
            'status'=>'success',
            'data_type'=>'top 10 list',
            'data_twitter' => $data_twitter,
            'data_reddit' => $data_reddit,
        ]);
        die();
    }
    public function refreshListAction(){
       // $fc = Zend_Controller_Front::getInstance();
       // $requestParams = $fc->getRequest()->getParams();
        $catId = '';///catId
      //  print_r($requestParams);
        // Create connection

        return new JsonModel([
            'refresh'=>'true',

        ]);

        die();
    }
    public function CategoriesAction(){
       // $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
      //  $sql = "SELECT * FROM `stream_data` WHERE timestamp >= DATE_SUB(NOW(), interval 1 hour) and `brands_searching_result`!='' and `sentiment_score`!='0' ORDER BY `brands_searching_result` DESC ";
      //  $result = $conn->query($sql);
        // echo $sql;
      //  if ($result) {
           // echo "New record created successfully";
        //    print_r($result);

            $data =
                array(
                    array(
                        'id'=>'shoe',
                        'name'=>'Shoe',
                    ),
                    array(
                        'id'=>'bags',
                        'name'=>'Bags',
                    ),
                    array(
                        'id'=>'accessories',
                        'name'=>'Accessories',
                    ),
                );

      //  }

        return new JsonModel(
            $data

        );

        die();
    }
    public function getCategoryAction(){
     //   $catId = $_POST['catId'];
        $score_reddit = array();
        $score_twitter = array();
        $result_twitter = $this->table->getCategory_twitter();
        $result_reddit = $this->table->getCategory_reddit();
        foreach ($result_twitter as $result_twitter_each){
            $product[] = str_replace(',',' ',$result_twitter_each['brands_searching_result'])." ( DataSize : ".$result_twitter_each['total_count'].")";
        }

        foreach ($result_twitter as $result_twitter_each_score){
            $score_twitter[] = $result_twitter_each_score['total_sentiment_score'];
        }
        foreach ($result_reddit as $result_twitter_each_score){
            $score_reddit[] = $result_twitter_each_score['total_sentiment_score'];
        }
        if (!$score_reddit){
            for ($i=0;$i<10;$i++){
                $score_reddit[] = rand(-5,200);
            }

        }
        $data =
            array(
                'products'=>
                    $product,
                'reddit'=>
                    $score_reddit,
                'twitter'=>
                    $score_twitter,
            );
        return new JsonModel(
            $data

        );

        die();

    }

}