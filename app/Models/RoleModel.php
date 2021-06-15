<?php
namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model{
    protected $table = "roles";
    protected $primaryKey = "id_role";
    protected $allowedFields = [
        'id_role', 'name',
        'description',
        'can_create_user',
        'can_create_role',
        'can_create_user'
    ];

    public function getRole($id){
        return $this->find($id);
    }

    public function getAll(){
        return $this->findAll();
    }

    public function addRole(){
        if(isset($_POST['dataAddRole'])){
            $dataAddRole = $_POST['dataAddRole'];
            $dataForUpdate = [
                'name' => $dataAddRole['name'],
                'description' => $dataAddRole['description'],
                'can_create_role' => $dataAddRole['can_create_role'],
                'can_create_rule' => $dataAddRole['can_create_rule'],
                'can_create_user' => $dataAddRole['can_create_user'],
            ];

            $rst = $this->save($dataForUpdate);
            if($rst){
                return TRUE;
            }
            return FALSE;
        }
    }

    public function updateRole(){
        if(isset($_POST['dataEditRole'])){
            $dataEditRole = $_POST['dataEditRole'];
            $dataForUpdate = [
                'id_role' => $dataEditRole['id_role'],
                'name' => $dataEditRole['name'],
                'description' => $dataEditRole['description'],
                'can_create_role' => $dataEditRole['can_create_role'],
                'can_create_rule' => $dataEditRole['can_create_rule'],
                'can_create_user' => $dataEditRole['can_create_user'],
            ];

            $rst = $this->save($dataForUpdate);
            if($rst){
                return TRUE;
            }
            return FALSE;
        }
    }    

}