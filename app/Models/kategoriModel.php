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

    public function cek_kategori()
    {
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->where('bidang.id_kategori', null, false);
        $builder->orderBy('kategori.id_kategori', 'DESC');
        $builder->join('bidang', 'bidang.id_kategori=kategori.id_kategori', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_kategori()
    {
        $not = ['Kepala kejaksaan'];
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->select('kategori.nama_kategori', 'nama_kategori');
        $builder->selectMax('bidang.id_bidang', 'id_bidang');
        $builder->orderBy('id_bidang', 'DESC');
        $builder->groupBy('bidang.id_kategori');
        $builder->whereNotIn('nama_kategori', $not);
        $builder->where('bidang.id_kategori IS NOT NULL', null, false);
        $builder->join('bidang', 'bidang.id_kategori = kategori.id_kategori', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
