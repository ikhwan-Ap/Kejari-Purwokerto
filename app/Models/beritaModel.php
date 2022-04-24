<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class beritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id_berita';
    protected $allowedFields    =
    [
        'judul_berita', 'tanggal', 'img_berita', 'teks_berita'
    ];
    protected $order = ['id_berita' => 'DESC'];
    protected $column_search = [
        'judul_berita', 'tanggal',
    ];

    protected $column_order =
    [
        'id_berita', 'id_berita', 'judul_berita', 'tanggal', 'id_berita'
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

    public function del_berita($id_berita)
    {
        $this->dt->where('id_berita', $id_berita);
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

    public function datatablesBerita()
    {
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function get_id($id_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('*');
        $builder->where('id_berita', $id_berita);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getJudul($id_berita)
    {
        $this->dt
            ->select('judul_berita')
            ->where('id_berita', $id_berita);
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

    public function get_berita()
    {
        $builder = $this->db->table('berita');
        $builder->limit(4);
        $builder->orderBy('id_berita', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
