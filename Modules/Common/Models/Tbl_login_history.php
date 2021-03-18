<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_login_history extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_login_history';
    protected $primaryKey   =   'login_history_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'member_id'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'last_login';
    protected $updatedField     =   null;
    protected $deletedField     =   null;

    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}