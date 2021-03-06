<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class buronModel extends Model
{
    protected $table            = 'buron';
    protected $primaryKey       = 'id_buron';
    protected $allowedFields    =
    [
        'nama_buron', 'alamat_buron', 'usia', 'jenis_kelamin',
        'image'
    ];
    protected $column_search = [
        'nama_buron', 'alamat_buron', 'usia', 'jenis_kelamin',
    ];

    protected $column_order =
    [
        'id_buron', 'id_buron', 'nama_buron', 'usia', 'jenis_kelamin', 'alamat_buron', 'id_buron'
    ];

    protected $request;
    protected $order = ['id_buron' => 'DESC'];
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


        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $request->getPost('search')['value']);
                }
                if (count($this->column_search)  - 1 == $i) {
                    $this->dt->groupEnd();
                }
                $i++;
            }
            if ($request->getPost('jenis_kelamin') == '') {
                $request->getPost('jenis_kelamin') == '';
            } else {
                $this->dt->orLike($item, $request->getPost('jenis_kelamin'));
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

    public function datatablesBuron()
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

    public function get_id($id_buron)
    {
        $builder = $this->db->table('buron');
        $builder->select('*');
        $builder->where('id_buron', $id_buron);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function del_buron($id_buron)
    {
        $this->dt->where('id_buron', $id_buron);
        return $this->dt->delete();
    }

    public function get_buron()
    {
        $builder = $this->db->table('buron');
        $builder->select('*');
        $builder->limit(4);
        $builder->orderBy('id_buron', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_last()
    {
        $builder = $this->db->table('buron');
        $builder->select('*');
        $builder->limit(1);
        $builder->orderBy('id_buron', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
