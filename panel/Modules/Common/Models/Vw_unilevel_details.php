<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_unilevel_details extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_unilevel_details';
    protected $primaryKey   =   'node_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;
}