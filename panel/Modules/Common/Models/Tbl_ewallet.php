<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_ewallet extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_ewallet';
    protected $primaryKey   =   'ewallet_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'node_id', 'bonus_name','amount','status'];
    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}