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
        'judul_berita', 'text', 'tanggal', 'img_berita'
    ];

    public function get_id($id_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('*');
        $builder->where('id_berita', $id_berita);
        $query = $builder->get();
        return $query->getRowArray();
    }

}
