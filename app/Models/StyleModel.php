<?php

namespace App\Models;

use CodeIgniter\Model;

class StyleModel extends Model
{

    public function getAllStyles()
    {
        // if (isset($_POST['search'])) {
            // $style = $_POST['search'];

            $db1 = \Config\Database::connect('db2', false);
            $builder1 = $db1->table('master_sam');
            // $builder1->distinct();
            $builder1->select('distinct(style) as style');
            // $builder1->like('style', $style);

            return $builder1->get()->getResult();
        // }
    }
}
