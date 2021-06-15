<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewUsersModel extends Model
{
    public $db;
    public $builder;

    protected $table = "viewusers";
    protected $allowedFields = [
        'id_user', 'user_name', 'role', 'description'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getAll()
    {
        $rst = $this->findAll();

        return $rst;
    }
}
