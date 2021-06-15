<?php
namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model{
    protected $table='app';
    protected $primaryKey = 'id_app';

    protected $allowedFields = [
        'id_app', 'rule', 'sub_menu', 'controller'
    ];

    public function getById($id){
        $rst = $this->find($id);

        return $rst;
    }
}