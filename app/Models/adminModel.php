<?php

namespace App\Models;

use CodeIgniter\Model;

class adminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'password'];


    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
    }

    public function get_id($id)
    {
        $builder = $this->db->table('admin');
        $builder->select('*');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
