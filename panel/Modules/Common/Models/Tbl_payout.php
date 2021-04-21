<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_payout extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_payout';
    protected $primaryKey   =   'payout_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'node_id', 'amount','status'];
    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   null;
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}