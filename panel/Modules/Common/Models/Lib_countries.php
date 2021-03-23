<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
date_default_timezone_set("Asia/Manila");
class Lib_countries extends Model
{   
    protected $DBGroup      =   'default';
    protected $table        =   'lib_countries';
    protected $primaryKey   =   'country_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   [ 'cname', 'ccc'];
}