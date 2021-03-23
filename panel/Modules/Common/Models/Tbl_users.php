<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
class Tbl_users extends Model
{ // protected $DBGroup      =   'default';
    protected $table        =   'tbl_users';
    protected $primaryKey   =   'user_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   ['user_id', 'fullname', 'username', 'password',
                                    'avatar', 'user_type', 'date_created',
                                    'user_status'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   null;
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}