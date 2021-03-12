<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_products extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_products';
    protected $primaryKey   =   'product_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'product_name', 'amount', 'pts',
                                     'developer_fee'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   ['product_name'     => 'required',
                                    'amount'            => 'required',
                                    'pts'               => 'required',
                                    'developer_fee'     => 'required'];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}