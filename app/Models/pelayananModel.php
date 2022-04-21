<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class pelayananModel extends Model
{
    protected $table            = 'pelayanan';
    protected $primaryKey       = 'id_pelayanan';
    protected $allowedFields    =
    [
        'nama_pelayanan', 'url_pelayanan', 'img_pelayanan', 'warna_pelayanan', 'gradiasi_pelayanan'
    ];
    protected $column_search = [
        'nama_pelayanan', 'url_pelayanan'
    ];

    protected $column_order =
    [
        'id_pelayanan', 'nama_pelayanan', 'url_pelayanan', 'id_pelayanan', 'warna_pelayanan', 'gradiasi_pelayanan', 'id_pelayanan'
    ];


    protected $request;
    protected $order = ['id_pelayanan' => 'DESC'];
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


    public function datatablesPelayanan()
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


    public function del_pelayanan($id_pelayanan)
    {
        $this->dt->where('id_pelayanan', $id_pelayanan);
        return $this->dt->delete();
    }

    public function get_id($id_pelayanan)
    {
        $this->dt
            ->select('*')
            ->where('id_pelayanan', $id_pelayanan);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_data()
    {
        $builder = $this->db->table('pelayanan');
        $builder->select('*');
        $builder->limit(4);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
