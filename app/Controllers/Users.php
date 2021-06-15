<?php

namespace App\Controllers;

use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\ViewUsersModel;
use App\Models\UserModel;
use App\Models\RoleModel;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function __construct()
    {
        $this->rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->user_model = new UserModel();
        $this->view_user_model = new ViewUsersModel();
        $this->role_model = new RoleModel();
    }

    public function app($id)
    {
        $ruleModel = $this->rule_model;
        $appModel = $this->app_model;

        $session = session();
        $dataRule['userName'] = $session->get('user_name');

        $dataRule['role'] = $ruleModel->getRuleByRole($session->get('role'));

        $dataRule['appName'] = $appModel->getById($id);
        $data['breadCrumb'] = [
            'menu' => $dataRule['role'][0]['menu'],
            'subMenu' => $dataRule['appName']['sub_menu'],
        ];

        $data['idRole'] = $session->get('role');

        return view('Dashboard/users_view', $data);
    }

    public function getAllUsers()
    {
        $viewUserModel = $this->view_user_model;

        $rst['data'] = $viewUserModel->getAll();

        echo json_encode($rst);
    }

    public function addDataUser()
    {
        $userModel = $this->user_model;

        $rst = $userModel->addUser();

        echo json_encode($rst);
    }

    public function updateDataUser()
    {
        $userModel = $this->user_model;

        $rst = $userModel->updateUser();

        echo json_encode($rst);
    }

    public function getUser($id)
    {
        $userModel = $this->user_model;

        $rst = $userModel->getUser($id);

        echo json_encode($rst);
    }

    public function deleteUser($id = 0)
    {
        $userModel = $this->user_model;
        if ($userModel->find($id)) {
            $userModel->delete($id);

            $retVal = [
                'status' => TRUE,
                'msg' => 'Delete User berhasil!'
            ];
        } else {
            $retVal = [
                'status' => FALSE,
                'msg' => 'Delete User gagal, karena ID tidak ditemukan!'
            ];
        }
        echo json_encode($retVal);
    }

    public function getAllRoles()
    {
        $roleModel = $this->role_model;

        $rst = $roleModel->getAll();

        echo json_encode($rst);
    }

    public function getRole($id)
    {
        $roleModel = $this->role_model;
        $rst = $roleModel->getRole($id);

        echo json_encode($rst);
    }
}
