<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_ewallet_total extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_ewallet_total';
    protected $primaryKey   =   'node_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

}