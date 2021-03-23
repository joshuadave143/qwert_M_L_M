<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_income_summary_not_collected extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_income_summary_not_collected';
    protected $primaryKey   =   'member_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'node_id', 'reftotal', 'indreftotal'];
}