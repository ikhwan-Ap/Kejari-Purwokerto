<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class kasusModel extends Model
{
    protected $table            = 'kasus';
    protected $primaryKey       = 'id_kasus';
    protected $allowedFields    =
    [
        'nama_terdakwa', 'alamat_terdakwa', 'nama_jaksa', 'nama_hakim', 'nama_saksi',
        'keterangan', 'no_perkara', 'jenis_perkara', 'kategori', 'tanggal'
    ];
    protected $column_search = [
        'nama_terdakwa', 'nama_jaksa', 'nama_hakim',
        'keterangan', 'no_perkara',  'keterangan', 'tanggal'
    ];

    protected $column_order =
    [
        'nama_terdakwa', 'alamat_terdakwa', 'nama_jaksa', 'nama_hakim', 'nama_saksi',
        'keterangan', 'no_perkara', 'jenis_perkara', 'kategori', 'tanggal'
    ];

    protected $request;
    protected $order = ['id_kasus' => 'DESC'];
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

    public function datatablesKasus()
    {
        $ket = ['inchraft'];
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->whereNotIn('keterangan', $ket)
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

    public function get_id($id_kasus)
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('id_kasus', $id_kasus);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function get_keterangan()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('keterangan', 'Incraht');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_umum()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('kategori', 'umum');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_khusus()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('kategori', 'khusus');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_datun()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('kategori', 'datun');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function del_kasus($id_kasus)
    {
        $this->dt->where('id_kasus', $id_kasus);
        return $this->dt->delete();
    }
}
