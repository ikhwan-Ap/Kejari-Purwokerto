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
        $builder = $this->db->table('kategori_peraturan');
        $builder->select('kategori_peraturan.id_kategori_peraturan');
        $builder->select('kategori_peraturan.nama_kategori_peraturan', 'nama_kategori_peraturan');
        $builder->orderBy('id_peraturan', 'DESC');
        $builder->groupBy('peraturan.id_kategori_peraturan');
        $builder->where('peraturan.id_kategori_peraturan IS NOT NULL', null, false);
        $builder->join('peraturan', 'peraturan.id_kategori_peraturan = kategori_peraturan.id_kategori_peraturan', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_data($id_kategori_peraturan)
    {
        $builder = $this->db->table('kategori_peraturan');
        $builder->select('*');
        $builder->where('peraturan.id_kategori_peraturan', $id_kategori_peraturan);
        $builder->join('peraturan', 'peraturan.id_kategori_peraturan = kategori_peraturan.id_kategori_peraturan', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_title($id_kategori_peraturan)
    {
        $builder = $this->db->table('kategori_peraturan');
        $builder->select('nama_kategori_peraturan', 'nama_kategori_peraturan');
        $builder->where('id_kategori_peraturan', $id_kategori_peraturan);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
