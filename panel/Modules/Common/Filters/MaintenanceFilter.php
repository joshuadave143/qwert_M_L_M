<?php

namespace Modules\Common\Filters; 

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Common\Libraries\Maintenance_mode;

class MaintenanceFilter implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
        // $maintenance_mode = false; 
        // $_SERVER['REMOTE_ADDR'];
        $maintenance_mode = new maintenance_mode;
        $maintenance_mode->set(true, '127.0.0.1');
        $maintenance_mode->check();
        // if(  false ){
        //     return redirect()->to('/maintenance');
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }
}