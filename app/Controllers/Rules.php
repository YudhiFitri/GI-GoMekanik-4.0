<?php

namespace App\Controllers;

use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\ViewRulesModel;
use App\Models\RuleModel;
use App\Models\RoleModel;

use App\Controllers\BaseController;

class Rules extends BaseController
{
    public function __construct()
    {
        $this->view_role_rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->view_rule_model = new ViewRulesModel();
        $this->rule_model = new RuleModel();
        $this->role_model = new RoleModel();
    }

    public function app($id)
    {
        $viewRoleRuleModel = $this->view_role_rule_model;
        $appModel = $this->app_model;

        $session = session();
        $dataRule['userName'] = $session->get('user_name');

        $dataRule['role'] = $viewRoleRuleModel->getRuleByRole($session->get('role'));

        $dataRule['appName'] = $appModel->getById($id);
        $data['breadCrumb'] = [
            'menu' => $dataRule['role'][0]['menu'],
            'subMenu' => $dataRule['appName']['sub_menu'],
        ];

        $data['idRole'] = $session->get('role');

        return view('Dashboard/rules_view', $data);
    }

    public function getAllRules()
    {
        $viewRuleModel = $this->view_rule_model;

        $rst['data'] = $viewRuleModel->getAll();

        echo json_encode($rst);
    }

    public function addDataRule()
    {
        $ruleModel = $this->rule_model;

        $rst = $ruleModel->addRule();

        echo json_encode($rst);
    }

    public function updateDataRule()
    {
        $ruleModel = $this->rule_model;

        $rst = $ruleModel->updateRule();

        echo json_encode($rst);
    }

    public function getRule($id)
    {
        $ruleModel = $this->rule_model;

        $rst = $ruleModel->getRule($id);

        echo json_encode($rst);
    }

    public function deleteRule($id = 0)
    {
        $ruleModel = $this->rule_model;
        if ($ruleModel->find($id)) {
            $ruleModel->delete($id);

            $retVal = [
                'status' => TRUE,
                'msg' => 'Delete Rule berhasil!'
            ];
        } else {
            $retVal = [
                'status' => FALSE,
                'msg' => 'Delete Rule gagal, karena ID tidak ditemukan!'
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
}
