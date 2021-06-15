<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'id_user', 'role',
        'user_name', 'password'
    ];

    public function getByUserName($userName)
    {
        $rst = $this->where('user_name', $userName)->first();

        return $rst;
    }

    public function getUser($id)
    {
        return $this->find($id);
    }

    public function getAll()
    {
        return $this->findAll();
    }

    public function addUser()
    {
        if (isset($_POST['dataAddUser'])) {
            $dataAddUser = $_POST['dataAddUser'];
            $dataForUpdate = [
                'user_name' => $dataAddUser['user_name'],
                'role' => $dataAddUser['role'],
                'password' => MD5($dataAddUser['password'])

            ];

            $rst = $this->save($dataForUpdate);
            if ($rst) {
                return TRUE;
            }
            return FALSE;
        }
    }

    public function updateUser()
    {
        if (isset($_POST['dataEditUser'])) {
            $dataEditUser = $_POST['dataEditUser'];
            $dataForUpdate = [
                'id_user' => $dataEditUser['id_user'],
                'user_name' => $dataEditUser['user_name'],
                'role' => $dataEditUser['role'],
            ];

            $rst = $this->save($dataForUpdate);
            if ($rst) {
                return TRUE;
            }
            return FALSE;
        }
    }
}
