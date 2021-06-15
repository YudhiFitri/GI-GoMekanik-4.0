<?php

namespace App\Models;

use CodeIgniter\Model;

class QCOViewModel extends Model
{
    protected $table = 'viewqco';
    protected $allowedFields = [
        'id_qco',
        'id_qco_detail',
        'barcode', 'id_qco',
        'tgl', 'style', 'line',
        'jenis_barang', 'merk',
        'no_seri',
        'status', 'location'
    ];

    public function getQCOByStyle()
    {
        if (isset($_POST['style'])) {
            $style = $_POST['style'];

            $this->where(['style' => $style]);
            $rst = $this->get()->getResult();

            return $rst;
        }
    }
}
