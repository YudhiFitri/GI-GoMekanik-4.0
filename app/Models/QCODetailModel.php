<?php

namespace App\Models;

use CodeIgniter\Model;

class QCODetailModel extends Model
{
    protected $table = 'qco_detail';
    protected $primaryKey = 'id_qco_detail';
    protected $allowedFields = [
        'id_qco_detail', 'qco', 'barcode',
        'jenis_barang', 'merk', 'no_seri', 'status'
    ];

    public function saveDetailQCO($data)
    {
        // return $this->insertBatch($data);
        return $this->insert($data);
    }

    public function getByIdQCO($id)
    {
        $this->where('qco', $id);

        return $this->get()->getResult();
    }

    public function deleteDetail($id)
    {
        $rst = $this->where('id_qco_detail', $id)->delete();
        return $rst;
    }
}
