<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class profilModel extends Model
{
    protected $table            = 'profil';
    protected $primaryKey       = 'id_profil';
    protected $allowedFields    =
    [
        'id_kategori_profil', 'img_profil', 'teks_profil'
    ];
    protected $column_search = [
        'profil.id_kategori_profil',
    ];

    protected $column_order =
    [
        'id_profil', 'img_profil', 'nama_kategori_profil', 'id_profil'
    ];


    protected $request;
    protected $order = ['id_profil' => 'DESC'];
    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    private  function getDataTables()
    {
        $request = Services::request();
        $this->dt->select('*');
        $this->dt->join('kategori_profil', 'kategori_profil.id_kategori_profil = profil.id_kategori_profil', 'left');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->select('kategori_profil.nama_kategori_profil', 'nama_kategori_profil');
                    $this->dt->like($item, $request->getPost('search')['value']);
                } else {

                    $this->dt->orLike($item, $request->getPost('search')['value']);
                }
                if (count($this->column_search)  - 1 == $i) {
                    $this->dt->groupEnd();
                }
                $i++;
            }
            if ($request->getPost('order')) {
                $this->dt->orderBy(
                    $this->column_order[$request->getPost('order')['0']['column']],
                    $request->getPost('order')['0']['dir']
                );
            } else {
                $order = $this->order;
                $this->dt->orderBy(key($order), $order[key($order)]);
            }
        }
    }


    public function datatablesProfil()
    {
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDataTables();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }


    public function del_profil($id_profil)
    {
        $this->dt->where('id_profil', $id_profil);
        return $this->dt->delete();
    }

    public function get_id($id_profil)
    {
        $this->dt
            ->select('*')
            ->select('kategori_profil.nama_kategori_profil', 'nama_kategori_profil')
            ->where('id_profil', $id_profil)
            ->join('kategori_profil', 'kategori_profil.id_kategori_profil = profil.id_kategori_profil');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_title($id_profil)
    {
        $this->dt
            ->select('nama_kategori_profil')
            ->select('kategori_profil.nama_kategori_profil', 'nama_kategori_profil')
            ->where('id_profil', $id_profil)
            ->join('kategori', 'kategori.id_kategori_profil = profil.id_kategori_profil');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_kejaksaan()
    {
        $builder = $this->db->table('profil');
        $builder->where('nama_kategori_profil', 'Kepala Kejaksaan');
        $builder->join('kategori_profil', 'kategori_profil.id_kategori_profil=profil.id_kategori_profil');
        $builder->limit(1);
        $builder->orderBy('id_profil', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
