<?php

namespace App\Models;

use CodeIgniter\Model;

class kategori_saranaModel extends Model
{
    protected $table            = 'kategori_sarana';
    protected $primaryKey       = 'id_kategori_sarana';
    protected $allowedFields    =
    [
        'nama_kategori_sarana',
    ];
    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function del_kategori_sarana($id_kategori_sarana)
    {
        $this->dt->where('id_kategori_sarana', $id_kategori_sarana);
        return $this->dt->delete();
    }

    public function get_sarana()
    {
        $builder = $this->db->table('kategori_sarana');
        $builder->select('*');
        $builder->select('kategori_sarana.id_kategori_sarana', 'id_kategori_sarana');
        $builder->where('sarana.id_kategori_sarana', null, false);
        $builder->orderBy('kategori_sarana.id_kategori_sarana', 'DESC');
        $builder->join('sarana', 'sarana.id_kategori_sarana=kategori_sarana.id_kategori_sarana', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_kategori_sarana()
    {
        $builder = $this->db->table('kategori_sarana');
        $builder->select('sarana.id_sarana');
        $builder->select('kategori_sarana.nama_kategori_sarana', 'nama_kategori_sarana');
        $builder->orderBy('id_sarana', 'DESC');
        $builder->groupBy('sarana.id_kategori_sarana');
        $builder->where('sarana.id_kategori_sarana IS NOT NULL', null, false);
        $builder->join('sarana', 'sarana.id_kategori_sarana = kategori_sarana.id_kategori_sarana', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_data($id_kategori_sarana)
    {
        $builder = $this->db->table('kategori_sarana');
        $builder->select('*');
        $builder->where('sarana.id_kategori_sarana', $id_kategori_sarana);
        $builder->join('sarana', 'sarana.id_kategori_sarana = kategori_sarana.id_kategori_sarana', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_title($id_kategori_sarana)
    {
        $builder = $this->db->table('kategori_sarana');
        $builder->select('nama_kategori_sarana', 'nama_kategori_sarana');
        $builder->where('id_kategori_sarana', $id_kategori_sarana);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
