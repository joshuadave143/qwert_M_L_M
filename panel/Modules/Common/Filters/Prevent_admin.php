<?php

namespace Modules\Common\Filters; 

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Prevent_admin implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
       
        if( !is_null(session()->get('isadmin')) && session()->get('isadmin') ){
            return redirect()->to('/admin/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }
}