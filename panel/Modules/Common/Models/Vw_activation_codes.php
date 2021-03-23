<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_activation_codes extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_activation_codes';
    protected $primaryKey   =   'activation_code_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'package_name', 'package_amt', 'direct_referral',
                                    'indirect_referral', 'developer_fee'];
}