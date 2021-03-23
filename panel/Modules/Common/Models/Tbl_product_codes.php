<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Tbl_product_codes extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'tbl_product_codes';
    protected $primaryKey   =   'procode_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'code', 'product_id'];
}