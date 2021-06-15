<?php

namespace App\Models;

use Codeigniter\Model;

class ViewRulesModel extends Model
{
    protected $table = "viewrules";
    protected $allowedFields = [
        "id_rule", "role", "menu", "icon", "id_role"
    ];

    public function getAll()
    {
        return $this->findAll();
    }
}
