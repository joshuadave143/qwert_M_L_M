<?php
namespace Modules\Admin\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;

class Members extends Model{
    // protected $DBGroup      =   'default';
    protected $table        =   'tbl_members';
    protected $primaryKey   =   'member_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   ['member_id', 'sponsor_id', 'firstname', 'middlename',
                                    'lastname', 'gender', 'birthdate',
                                    'age', 'tin', 'civil_status',
                                    'address', 'city', 'province',
                                    'country', 'email', 'mobile_no',
                                    'avatar', 'member_type', 'member_status'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   'date_modified';

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}