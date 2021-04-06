<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_packages extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_packages';
    protected $primaryKey   =   'package_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'product_id', 'package_name', 'package_amt', 'direct_referral',
                                    'indirect_referral', 'developer_fee'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   ['package_name'     => 'required',
                                    'product_id'        => 'required',
                                    'package_amt'       => 'required',
                                    'direct_referral'   => 'required',
                                    'indirect_referral' => 'required',
                                    'developer_fee'     => 'required'];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}