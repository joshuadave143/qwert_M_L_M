<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_activation_codes extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_activation_codes';
    protected $primaryKey   =   'activation_code_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'package_id', 'activation_code',
                                    'activation_date', 'code_status'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   ['package_id'     => 'required'];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}