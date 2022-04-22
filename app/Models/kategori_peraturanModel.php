<?php

namespace App\Models;

use CodeIgniter\Model;

class kategori_peraturanModel extends Model
{
    protected $table            = 'kategori_peraturan';
    protected $primaryKey       = 'id_kategori_peraturan';
    protected $allowedFields    =
    [
        'nama_kategori_peraturan',
    ];
    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function del_kategori_peraturan($id_kategori_peraturan)
    {
        $this->dt->where('id_kategori_peraturan', $id_kategori_peraturan);
        return $this->dt->delete();
    }

    public function get_peraturan()
    {
        $builder = $this->db->table('kategori_peraturan');
        $builder->select('*');
        $builder->select('kategori_peraturan.id_kategori_peraturan', 'id_kategori_peraturan');
        $builder->where('peraturan.id_kategori_peraturan', null, false);
        $builder->orderBy('kategori_peraturan.id_kategori_peraturan', 'DESC');
        $builder->join('peraturan', 'peraturan.id_kategori_peraturan=kategori_peraturan.id_kategori_peraturan', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_kategori_peraturan()
    {
        $not = ['Kepala kejaksaan'];
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->select('kategori.nama_kategori_peraturan', 'nama_kategori_peraturan');
        $builder->selectMax('bidang.id_bidang', 'id_bidang');
        $builder->orderBy('id_bidang', 'DESC');
        $builder->groupBy('bidang.id_kategori_peraturan');
        $builder->whereNotIn('nama_kategori_peraturan', $not);
        $builder->where('bidang.id_kategori_peraturan IS NOT NULL', null, false);
        $builder->join('bidang', 'bidang.id_kategori_peraturan = kategori.id_kategori_peraturan', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
