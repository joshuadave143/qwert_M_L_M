<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Vw_active_account extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'vw_active_account';
    protected $primaryKey   =   'node_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'is_unilevel', 'unileveldate', 'member_id',
                                    'activationdate', 'date_activated'];
}