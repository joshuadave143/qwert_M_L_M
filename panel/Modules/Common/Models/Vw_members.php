<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
class Vw_members extends Model
{ // protected $DBGroup      =   'default';
    protected $table        =   'vw_members';
    protected $primaryKey   =   'security_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;


}