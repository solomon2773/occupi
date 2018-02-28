<?php
/**
 * Created by PhpStorm.
 * User: stgod_m6700
 * Date: 5/7/2015
 * Time: 1:51 PM
 */

namespace Application\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
 class FashiontrendguruTable
 {
    // protected $tableGateway = 'album';
  //   protected $table = 'core_users';
     private $tableGateway;
     public function __construct(TableGatewayInterface $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }


     public function fetchAll()
 {
   //  return $this->tableGateway->select();
     $resultSet = $this->tableGateway->select();
     foreach ($resultSet as $result){
         $output[] = $result;
     }
     return $output;

 }
     public function getCategory_twitter()
     {
         $output = array();
       //  $id = (int) $id;
         //SELECT *,COUNT(*) as total_count,SUM(sentiment_score) as total_sentiment_score FROM `stream_data`
       //  WHERE timestamp >= DATE_SUB(NOW(),INTERVAL 24 HOUR) and `brands_searching_result`!='' and `sentiment_score`!='0'
//GROUP BY `stream_data`.`brands_searching_result`
//ORDER BY `timestamp` DESC
         $sql_twitter = "SELECT `source`,`brands_searching_result`,COUNT(*) as total_count,SUM(sentiment_score) as total_sentiment_score FROM `stream_data`
WHERE timestamp >= DATE_SUB(NOW(),INTERVAL 1 HOUR) and `brands_searching_result`!='' and `sentiment_score`!='0' and `source` = 'Twitter'
GROUP BY `stream_data`.`brands_searching_result`
ORDER BY `total_count` DESC  Limit 10";

         $resultSet_twitter = $this->tableGateway->getAdapter()->driver->getConnection()->execute($sql_twitter);
         foreach ($resultSet_twitter as $result){
             $output[] = $result;
         }
         /*
         if (! $row) {
             throw new RuntimeException(sprintf(
                 'Could not find row with identifier %d',
                 $id
             ));
         }*/

         return $output;
     }

     public function getCategory_reddit()
     {
         $output = array();
         $sql_reddit = "SELECT `source`,`brands_searching_result`,COUNT(*) as total_count,SUM(sentiment_score) as total_sentiment_score FROM `stream_data`
                    WHERE timestamp >= DATE_SUB(NOW(),INTERVAL 1 HOUR) and `brands_searching_result`!='' and `sentiment_score`!='0' and `source` = 'Reddit'
                    GROUP BY `stream_data`.`brands_searching_result`
                    ORDER BY `total_count` DESC  Limit 10";
         $resultSet_reddit = $this->tableGateway->getAdapter()->driver->getConnection()->execute($sql_reddit);
         foreach ($resultSet_reddit as $result){
             $output[] = $result;
         }

         return $output;
     }



 }