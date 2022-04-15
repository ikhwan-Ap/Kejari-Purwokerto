<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class carouselModel extends Model
{
    protected $table            = 'carousel';
    protected $primaryKey       = 'id_carousel';
    protected $allowedFields    =
    [
        'image', 'nama_carousel'
    ];

    protected $column_search = [
        'nama_carousel',
    ];

    protected $column_order =
    [
        'nama_carousel', 'image'
    ];


    protected $request;
    protected $order = ['id_carousel' => 'DESC'];
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


    public function datatablesCarousel()
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


    public function del_carousel($id_carousel)
    {
        $this->dt->where('id_carousel', $id_carousel);
        return $this->dt->delete();
    }
    public function get_id($id_carousel)
    {
        $this->dt
            ->select('*')
            ->where('id_carousel', $id_carousel);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_img()
    {
        $this->dt
            ->select('*')
            ->orderBy('id_carousel', 'DESC')
            ->limit(4);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
