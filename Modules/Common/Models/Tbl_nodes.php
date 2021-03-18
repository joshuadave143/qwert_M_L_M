<?php
namespace Modules\Common\Models;
// use CodeIgniter\Model;
use \CodeIgniter\Model;
class Tbl_nodes extends Model
{ // protected $DBGroup      =   'default';
    protected $table        =   'tbl_nodes';
    protected $primaryKey   =   'node_id';

    protected $returnType       =   'array';
    protected $useSoftDeletes   =   false;

    protected $allowedFields    =   ['member_id', 'sponsor_id', 'upline_id', 'placement',
                                    'tot_dlines', 'tot_referrals', 'activation_code_id',
                                    'status'];

    protected $useTimestamps    =   true;
    protected $createdField     =   'date_created';
    protected $updatedField     =   'date_modified';
    protected $deletedField     =   null;

    protected $validationRules  =   [];
    // protected $validationRules  =   ['sponsor_id'=>'required'];
    protected $validationMessages  =   [];
    protected $skipValidation   =   false;
}