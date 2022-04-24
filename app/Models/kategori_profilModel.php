<?php

namespace App\Models;

use CodeIgniter\Model;

class kategori_profilModel extends Model
{
    protected $table            = 'kategori_profil';
    protected $primaryKey       = 'id_kategori_profil';
    protected $allowedFields    =
    [
        'nama_kategori_profil',
    ];
    protected $column_search = [
        'nama_kategori_profil',
    ];

    protected $column_order =
    [
        'nama_kategori_profil'
    ];

    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function del_kategori_profil($id_kategori_profil)
    {
        $this->dt->where('id_kategori_profil', $id_kategori_profil);
        return $this->dt->delete();
    }

    public function get_profil()
    {
        $builder = $this->db->table('kategori_profil');
        $builder->select('*');
        $builder->select('kategori_profil.id_kategori_profil', 'id_kategori_profil');
        $builder->where('profil.id_kategori_profil', null, false);
        $builder->orderBy('kategori_profil.id_kategori_profil', 'DESC');
        $builder->join('profil', 'profil.id_kategori_profil=kategori_profil.id_kategori_profil', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_kategori_profil()
    {
        $builder = $this->db->table('kategori_profil');
        $builder->select('*');
        $builder->select('kategori_profil.nama_kategori_profil', 'nama_kategori_profil');
        $builder->selectMax('profil.id_profil', 'id_profil');
        $builder->orderBy('id_profil', 'DESC');
        $builder->groupBy('profil.id_kategori_profil');
        $builder->where('profil.id_kategori_profil IS NOT NULL', null, false);
        $builder->join('profil', 'profil.id_kategori_profil = kategori_profil.id_kategori_profil', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
