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
        'nama_terdakwa', 'nama_jaksa', 'nama_hakim', 'panitia_pengganti',
        'keterangan', 'no_perkara', 'agenda', 'kategori', 'tanggal'
    ];
    protected $column_search = [
        'nama_terdakwa', 'nama_jaksa', 'nama_hakim',
        'keterangan', 'no_perkara', 'tanggal', 'kategori'
    ];

    protected $column_order =
    [
        'id_kasus', 'tanggal', 'no_perkara', 'nama_terdakwa', 'nama_hakim', 'nama_jaksa',
        'keterangan', 'id_kasus',
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
            if ($request->getPost('kategori') == '') {
                $request->getPost('kategori') == '';
            } else {
                $this->dt->orLike($item, $request->getPost('kategori'));
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
        $ket = ['Incraht'];
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->whereNotIn('keterangan', $ket)
                ->limit(10)
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function datatablesIncraht()
    {
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->where('keterangan', 'Incraht')
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDataTables();
        $this->dt->where('keterangan', 'Incraht');
        return $this->dt->countAllResults();
    }

    public function countExcept()
    {
        $ket = ['Incraht'];
        $this->getDataTables();
        $this->dt->whereNotIn('keterangan', $ket);
        return $this->dt->countAllResults();
    }

    public function countKet()
    {
        $ket = ['Incraht'];
        $tbl_storage = $this->db->table($this->table);
        $tbl_storage->whereNotIn('keterangan', $ket);
        return $tbl_storage->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        $tbl_storage->where('keterangan', 'Incraht');
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
        $builder->where('kategori', 'Pidana Umum');
        $builder->where('keterangan', 'Incraht');
        $builder->limit(6);
        $builder->orderBy('id_kasus', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_khusus()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('kategori', 'Pidana Khusus');
        $builder->where('keterangan', 'Incraht');
        $builder->limit(6);
        $builder->orderBy('id_kasus', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_perdata()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('kategori', 'Perdata Dan Tata Usaha Negara');
        $builder->where('keterangan', 'Incraht');
        $builder->limit(6);
        $builder->orderBy('id_kasus', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_jadwal()
    {
        $builder = $this->db->table('kasus');
        $builder->select('*');
        $builder->where('keterangan', '-');
        $builder->limit(6);
        $builder->orderBy('id_kasus', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function del_kasus($id_kasus)
    {
        $this->dt->where('id_kasus', $id_kasus);
        return $this->dt->delete();
    }

    public function add_excel($import)
    {
        $this->db->table('kasus')->insert($import);
    }

    public function get_pidum()
    {
        $umum = $this->db->table('kasus');
        $umum->where('kategori', 'Pidana Umum');
        $umum->where('keterangan', 'Incraht');
        $umum->orderBy('id_kasus', 'DESC');
        return $umum;
    }
}
