<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class peraturanModel extends Model
{
    protected $table            = 'peraturan';
    protected $primaryKey       = 'id_peraturan';
    protected $allowedFields    =
    [
        'id_kategori_peraturan', 'file_peraturan', 'nama_peraturan'
    ];
    protected $column_search = [
        'peraturan.id_kategori_peraturan', 'file_peraturan', 'nama_peraturan'
    ];

    protected $column_order =
    [
        'id_peraturan', 'file_peraturan', 'nama_kategori_peraturan', 'id_peraturan'
    ];


    protected $request;
    protected $order = ['id_peraturan' => 'DESC'];
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
        $this->dt->join('kategori_peraturan', 'kategori_peraturan.id_kategori_peraturan = peraturan.id_kategori_peraturan', 'left');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->select('kategori_peraturan.nama_kategori_peraturan', 'nama_kategori_peraturan');
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


    public function datatablesPeraturan()
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


    public function del_peraturan($id_peraturan)
    {
        $this->dt->where('id_peraturan', $id_peraturan);
        return $this->dt->delete();
    }

    public function get_id($id_peraturan)
    {
        $this->dt
            ->select('*')
            ->select('kategori_peraturan.nama_kategori_peraturan', 'nama_kategori_peraturan')
            ->where('id_peraturan', $id_peraturan)
            ->join('kategori_peraturan', 'kategori_peraturan.id_kategori_peraturan = peraturan.id_kategori_peraturan');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_title($id_peraturan)
    {
        $this->dt
            ->select('nama_kategori_peraturan')
            ->select('kategori_peraturan.nama_kategori_peraturan', 'nama_kategori_peraturan')
            ->where('id_peraturan', $id_peraturan)
            ->join('kategori', 'kategori.id_kategori_peraturan = peraturan.id_kategori_peraturan');
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
