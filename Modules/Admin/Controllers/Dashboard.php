<?php
namespace Modules\Admin\Controllers;

use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Modules\Admin\Models\Members as MembersModel;

use \App\Libraries\Oauth;
use \OAuth2\Request;

class Dashboard extends BaseController
{
	use ResponseTrait;
    public $parser;
    public function __construct(){
        $this->parser = \Config\Services::parser();
    }

    public function index(){
        echo "test";
        echo view('Modules/Template/Views/test');
        // echo $parser->render('Modules/Template/Views/test');
    }

    public function login(){
        $oauth = new Oauth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();
        return $this->respond(json_decode($body), $code);
    }

    public function show($id){
        $members = new MembersModel;
        $member = $members->find($id);
        // $sql = $members->getCompiledSelect();
        // echo $sql;
        return $this->respond($member);
    }

    public function create(){
        $data = $this->request->getPost();
        $member = new MembersModel;
        echo $id = $member->insert($data);
    }
}