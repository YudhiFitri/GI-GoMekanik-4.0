<?php
namespace App\Models;

use CodeIgniter\Model;

class QCOModel extends Model{
    protected $table = 'qco';
    protected $primaryKey = 'id_qco';
    protected $allowedFields = [
        'id_qco', 'tgl', 'style', 'line', 'location'
    ];

    public function saveQCO($data){
        $this->insert($data);
        return $this->getInsertID();
    }
}