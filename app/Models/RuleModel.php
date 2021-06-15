<?php

namespace App\Models;

use CodeIgniter\Model;

class RuleModel extends Model
{
    protected $table = 'rules';
    protected $primaryKey = 'id_rule';
    protected $allowedFileds = [
        'id_rule',
        'id_role',
        'menu',
        'icon'
    ];

    public function getRulesByRole($idRole)
    {
        $rst = $this->where('id_role', $idRole)->findAll();

        return $rst;
    }

    public function getRule($id)
    {
        return $this->find($id);
    }

    public function getAll()
    {
        return $this->findAll();
    }

    public function addRule()
    {
        if (isset($_POST['dataAddRule'])) {
            $dataAddRule = $_POST['dataAddRule'];
            $dataForUpdate = [
                'id_role' => $dataAddRule['id_rule'],
                'menu' => $dataAddRule['menu'],
                'icon' => MD5($dataAddRule['icon'])

            ];

            $rst = $this->save($dataForUpdate);
            if ($rst) {
                return TRUE;
            }
            return FALSE;
        }
    }

    public function updateRule()
    {
        if (isset($_POST['dataEditRule'])) {
            $dataEditRule = $_POST['dataEditRule'];
            $dataForUpdate = [
                'id_rule' => $dataEditRule['id_rule'],
                'id_role' => $dataEditRule['id_role'],
                'menu' => $dataEditRule['menu'],
                'icon' => $dataEditRule['icon'],
            ];

            $rst = $this->save($dataForUpdate);
            if ($rst) {
                return TRUE;
            }
            return FALSE;
        }
    }
}
