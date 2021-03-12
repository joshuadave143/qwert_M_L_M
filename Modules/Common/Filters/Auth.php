<?php

namespace Modules\Common\Filters; 

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
       
        if( empty(session()->get('logged_in'))){
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }
}