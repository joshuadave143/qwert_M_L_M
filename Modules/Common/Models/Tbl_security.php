<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
class Tbl_security extends Model
{ // protected $DBGroup      =   'default';
    protected $table        =   'tbl_security';
    protected $primaryKey   =   'security_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   ['security_id', 'member_id', 'username', 'login_pass',
                                    'secur_pass', 'last_update'];

    protected $useTimestamps    =   true;
    protected $createdField     =   null;
    protected $updatedField     =   null;
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}