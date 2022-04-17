<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class iconModel extends Model
{
    protected $table            = 'icon';
    protected $primaryKey       = 'id_icon';
    protected $allowedFields    =
    [
        'img_icon', 'keterangan'
    ];

    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function get_icon_beranda()
    {
        $this->dt
            ->select('*')
            ->orderBy('id_icon', 'DESC')
            ->where('keterangan', 'beranda')
            ->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_icon()
    {
        $this->dt
            ->select('*')
            ->orderBy('id_icon', 'DESC')
            ->where('keterangan', 'informasi')
            ->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_id($id_icon)
    {
        $this->dt
            ->select('*')
            ->where('id_icon', $id_icon);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
