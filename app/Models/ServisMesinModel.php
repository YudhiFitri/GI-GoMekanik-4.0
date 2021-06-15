<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisMesinModel extends Model
{
    protected $table = 'servis_mesin';
    protected $primaryKey = 'id_servis_mesin';
    protected $allowedFields = [
        'id_servis_mesin', 'tgl', 'id_mesin', 'jenis',
        'merk', 'tipe', 'no_seri', 'lokasi', 'line', 'status'
    ];
}
