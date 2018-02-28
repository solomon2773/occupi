<?php
/**
 * Created by PhpStorm.
 * User: stgod_m6700
 * Date: 5/7/2015
 * Time: 1:49 PM
 */

namespace Application\Model;


 class Fashiontrendguru
 {
     public $id;
     public $timestamp;
     public $source;
     public $remaining_text;
     public $sentiment_score;
     public $brands_searching_result;
     public $product_type_model_searching_result;


 public function exchangeArray($data)
 {
     $this->id     = (isset($data['id'])) ? $data['id'] : null;
     $this->timestamp = (isset($data['timestamp'])) ? $data['timestamp'] : null;
     $this->source  = (isset($data['source'])) ? $data['source'] : null;
     $this->remaining_text  = (isset($data['remaining_text'])) ? $data['remaining_text'] : null;
     $this->sentiment_score  = (isset($data['sentiment_score'])) ? $data['sentiment_score'] : null;
     $this->brands_searching_result  = (isset($data['brands_searching_result'])) ? $data['brands_searching_result'] : null;
     $this->product_type_model_searching_result  = (isset($data['product_type_model_searching_result'])) ? $data['product_type_model_searching_result'] : null;

 }
 }