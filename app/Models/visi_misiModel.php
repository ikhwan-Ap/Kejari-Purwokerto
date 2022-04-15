<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class visi_misiModel extends Model
{
    protected $table            = 'visi_misi';
    protected $primaryKey       = 'id';
    protected $allowedFields    =
    [
        'visi', 'misi'
    ];

    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function get_id($id)
    {
        $this->dt
            ->select('*')
            ->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
