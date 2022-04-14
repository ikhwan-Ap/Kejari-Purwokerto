<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class kategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    =
    [
        'nama_kategori',
    ];
    protected $column_search = [
        'nama_kategori',
    ];

    protected $column_order =
    [
        'nama_kategori'
    ];

    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function del_kategori($id_kategori)
    {
        $this->dt->where('id_kategori', $id_kategori);
        return $this->dt->delete();
    }
}
