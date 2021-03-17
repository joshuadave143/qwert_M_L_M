<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_product_codes extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_product_codes';
    protected $primaryKey   =   'activation_code_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'procode_id', 'code', 'product_name',
                                    'node_id'];
}