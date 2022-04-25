<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class videoModel extends Model
{
    protected $table            = 'video';
    protected $primaryKey       = 'id_video';
    protected $allowedFields    =
    [
        'judul_video', 'url'
    ];
    protected $order = ['id_video' => 'DESC'];
    protected $column_search = [
        'judul_video', 'url',
    ];

    protected $column_order =
    [
        'id_video', 'judul_video', 'url'
    ];
    protected $request;
    protected $db;
    protected $dt;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    public function del_video($id_video)
    {
        $this->dt->where('id_video', $id_video);
        return $this->dt->delete();
    }

    private  function getDataTables()
    {
        $request = Services::request();
        $i = 0;
        $this->dt;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->select('*');
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

    public function datatablesVideo()
    {
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function get_id($id_video)
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->where('id_video', $id_video);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function get_video()
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->limit(4);
        $builder->orderBy('id_video', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_video_cover()
    {
        $this->dt
            ->select('*')
            ->orderBy('id_video', 'DESC')
            ->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function getJudul($id_video)
    {
        $this->dt
            ->select('judul_video')
            ->where('id_video', $id_video);
        $query = $this->dt->get();
        return $query->getRowArray();
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
}
