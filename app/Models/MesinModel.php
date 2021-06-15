<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinModel extends Model
{
    protected $DBGroup = 'db1';
    protected $table = 'viewbaranglokasiterakhir';
    // protected $table = 'barang';
    protected $allowedFields = [
        'id_barang', 'kategori_barang', 'jenis',
        'merk', 'type', 'no_seri', 'lokasi_akhir', 'nama_line',
        'barcode'
    ];

    public function countByBarcode($barcode)
    {
        $this->where('barcode', $barcode);

        return $this->countAllResults();
    }

    public function getByBarcode($barcode)
    {
        $rst = $this->where('barcode', $barcode)->first();
        return $rst;
    }

    public function getSewingMachine()
    {
        $rst = $this->where('kategori_barang', "Sewing Machine")->findAll();

        return $rst;
    }
}
