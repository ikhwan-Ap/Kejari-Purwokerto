<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class navbarModel extends Model
{
    protected $table            = 'navbar';
    protected $primaryKey       = 'id_navbar';
    protected $allowedFields    =
    [
        'img_navbar',
    ];

    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function get_header()
    {
        $this->dt
            ->select('*')
            ->orderBy('id_navbar', 'DESC')
            ->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_id($id_navbar)
    {
        $this->dt
            ->select('*')
            ->where('id_navbar', $id_navbar);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
