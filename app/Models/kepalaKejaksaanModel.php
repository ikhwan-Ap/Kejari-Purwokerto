<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class kepalaKejaksaanModel extends Model
{
    protected $table            = 'kepala_kejaksaan';
    protected $primaryKey       = 'id_kepala_kejaksaan';
    protected $allowedFields    =
    [
        'nama_kepala_kejaksaan', 'img_kepala_kejaksaan'
    ];
    protected $column_search = [
        'nama_kepala_kejaksaan'
    ];

    protected $column_order =
    [
        'id_kepala_kejaksaan', 'id_kepala_kejaksaan', 'nama_kepala_kejaksaan', 'id_kepala_kejaksaan'
    ];


    protected $request;
    protected $order = ['id_kepala_kejaksaan' => 'DESC'];
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


    public function dataTablesKejaksaan()
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


    public function del_kepala_kejaksaan($id_kepala_kejaksaan)
    {
        $this->dt->where('id_kepala_kejaksaan', $id_kepala_kejaksaan);
        return $this->dt->delete();
    }

    public function get_id($id_kepala_kejaksaan)
    {
        $this->dt
            ->select('*')
            ->where('id_kepala_kejaksaan', $id_kepala_kejaksaan);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_kepala_kejaksaan()
    {
        $builder = $this->db->table('kepala_kejaksaan');
        $builder->select('*');
        $builder->limit(3);
        $builder->orderBy('id_kepala_kejaksaan', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_nama()
    {
        $builder = $this->db->table('kepala_kejaksaan');
        $builder->select('nama_kepala_kejaksaan');
        $builder->limit(1);
        $builder->orderBy('id_kepala_kejaksaan', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
