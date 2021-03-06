<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class bidangModel extends Model
{
    protected $table            = 'bidang';
    protected $primaryKey       = 'id_bidang';
    protected $allowedFields    =
    [
        'nama_pengurus', 'jabatan_pengurus', 'nip', 'id_kategori',
        'image_pengurus', 'teks_bidang'
    ];
    protected $column_search = [
        'nama_pengurus', 'jabatan_pengurus', 'nip', 'bidang.id_kategori', 'nama_kategori'
    ];

    protected $column_order =
    [
        'id_bidang', 'id_bidang', 'nip', 'nama_pengurus', 'jabatan_pengurus', 'nama_kategori', 'id_bidang'
    ];


    protected $request;
    protected $order = ['id_bidang' => 'DESC'];
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
        $this->dt->join('kategori', 'kategori.id_kategori = bidang.id_kategori', 'left');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->select('kategori.nama_kategori', 'nama_kategori');
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


    public function datatablesBidang()
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


    public function del_bidang($id_bidang)
    {
        $this->dt->where('id_bidang', $id_bidang);
        return $this->dt->delete();
    }

    public function get_id($id_bidang)
    {
        $this->dt
            ->select('*')
            ->select('kategori.nama_kategori', 'nama_kategori')
            ->where('id_bidang', $id_bidang)
            ->join('kategori', 'kategori.id_kategori = bidang.id_kategori');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_title($id_bidang)
    {
        $this->dt
            ->select('nama_kategori')
            ->select('kategori.nama_kategori', 'nama_kategori')
            ->where('id_bidang', $id_bidang)
            ->join('kategori', 'kategori.id_kategori = bidang.id_kategori');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_kejaksaan()
    {
        $builder = $this->db->table('bidang');
        $builder->where('nama_kategori', 'Kepala Kejaksaan');
        $builder->join('kategori', 'kategori.id_kategori=bidang.id_kategori');
        $builder->limit(1);
        $builder->orderBy('id_bidang', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
