<?php
namespace APP\Models;

use CodeIgniter\Model;

class MachineBreakdownModel extends Model{
    protected $table='machine_breakdown';
    protected $allowedFields = [
        'barcode_machine',
        'tgl',
        'machine_brand',
        'machine_type',
        'type',
        'machine_sn',
        'status'
    ];

    public function getByBarcode($barcode){
        $this->orderBy('tgl', 'DESC');
        $rst = $this->where('barcode_machine', $barcode)->first();

        return $rst;

    }
}