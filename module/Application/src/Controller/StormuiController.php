<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StormuiController extends AbstractActionController
{
    private $stormui_host = 'http://192.168.1.29:81';
    public function indexAction()
    {

        $response_stormui_api_cluster_configuration = file_get_contents($this->stormui_host.'/api/v1/cluster/configuration'); ///get
        $response_stormui_api_cluster_summary = file_get_contents($this->stormui_host.'/api/v1/cluster/summary'); ///get
        $response_stormui_api_supervisor_summary = file_get_contents($this->stormui_host.'/api/v1/supervisor/summary'); ///get
        $response_stormui_api_topology_summary = file_get_contents($this->stormui_host.'/api/v1/topology/summary'); ///get
       // print_r($response_stormui_api_topology_summary);
        /////////////////////api/v1/topology/:id (GET)/////////////////////////////////////
      //  $topology_id = '';
      //  $response_stormui_api_topology_summary = file_get_contents($this->stormui_host.'/api/v1/topology/'.$topology_id); ///get
        return new ViewModel(
            array(
                'storm_cluster_configuration' =>$response_stormui_api_cluster_configuration,
                'storm_cluster_summary' =>$response_stormui_api_cluster_summary,
                'storm_supervisor_summary' =>$response_stormui_api_supervisor_summary,
                'storm_topology_summary' =>$response_stormui_api_topology_summary,

            )
        );
    }
}
