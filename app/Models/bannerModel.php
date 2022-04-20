<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class bannerModel extends Model
{
    protected $table            = 'banner';
    protected $primaryKey       = 'id_banner';
    protected $allowedFields    =
    [
        'nama_banner', 'url_banner', 'img_banner'
    ];
    protected $column_search = [
        'nama_banner', 'url_banner'
    ];

    protected $column_order =
    [
        'nama_banner', 'url_banner'
    ];


    protected $request;
    protected $order = ['id_banner' => 'DESC'];
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


    public function datatablesBanner()
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


    public function del_banner($id_banner)
    {
        $this->dt->where('id_banner', $id_banner);
        return $this->dt->delete();
    }

    public function get_id($id_banner)
    {
        $this->dt
            ->select('*')
            ->where('id_banner', $id_banner);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_banner()
    {
        $builder = $this->db->table('banner');
        $builder->select('*');
        $builder->limit(4);
        $builder->orderBy('id_banner', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
