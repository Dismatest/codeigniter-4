<?php

namespace App\Models;

use CodeIgniter\Model;

class SaccoMembership extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sacco_membership';
    protected $primaryKey       = 'membership_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'sacco_id', 'id_number'];

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function sacco()
    {
        return $this->belongsTo('App\Models\Sacco', 'sacco_id');
    }
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
