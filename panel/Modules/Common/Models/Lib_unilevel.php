<?php
namespace Modules\Common\Models;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Lib_unilevel extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'lib_unilevel';
    protected $primaryKey   =   'libuni_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'level', 'amount'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}