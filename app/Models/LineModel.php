<?php
namespace App\Models;

use CodeIgniter\Model;

class LineModel extends Model{

    public function getAllLines(){
        $db = \Config\Database::connect('db2', false);
        $builder = $db->table('line');

        $builder->select('name,floor');
        return $builder->get()->getResult();
    }
}