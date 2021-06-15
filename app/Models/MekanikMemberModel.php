<?php

namespace App\Models;

use Codeigniter\Model;

class MekanikMemberModel extends Model
{
    protected $table = "mekanik_member";
    protected $primaryKey = "id_mekanik_member";
    protected $allowedFields = [
        'id_mekanik_member',
        'NIK',
        'Nama',
        'Inisial',
        'Bagian',
        'Shift',
        'nomor_telepon',
        'barcode',
        'isMachineBreakdown',
        'isQuickChange',
        'isMaintenance'
    ];

    public function getTokensByMachineBreakdown()
    {
        $rst = $this->where('isMachineBreakdown', 1);

        return $rst;
    }

    public function getTokensByQCO()
    {
        $rst = $this->where('isQuickChange', 1);

        return $rst->get()->getResult();
    }

    public function getTokensByMaintenance()
    {
        $rst = $this->where('isMaintenance', 1);

        return $rst->get()->getResult();
    }
}
