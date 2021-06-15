<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\RoleModel;

class Roles extends BaseController
{
    public function __construct()
    {

        $this->rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->role_model = new RoleModel();
    }

    public function app($id = null)
    {
        $ruleModel = $this->rule_model;
        $appModel = $this->app_model;
        $roleModel = $this->role_model;

        $session = session();
        $dataRule['userName'] = $session->get('user_name');

        $dataRule['role'] = $ruleModel->getRuleByRole($session->get('role'));

        $dataRule['appName'] = $appModel->getById($id);
        $data['breadCrumb'] = [
            'menu' => $dataRule['role'][0]['menu'],
            'subMenu' => $dataRule['appName']['sub_menu'],
        ];

        $data['idRole'] = $session->get('role');
        $data['roles'] = $roleModel->getAll();

        return view('Dashboard/roles_view', $data);
    }

    public function getAllRole(){
        $roleModel = $this->role_model;

        $rst['data'] = $roleModel->getAll();

        echo json_encode($rst);
    }

    public function listData()
    {

        $request = \Config\Services::request();
        $list_data = $this->rule_model;
        $where = ['id_role !=' => 0];
        $column_order = array('roles.id_role', 'roles.name', 'roles.description', 'roles.can_create_user', 'roles.can_create_role', 'roles.can_create_rule');
        $column_search = array('roles.id_role', 'roles.name', 'roles.description','roles.can_create_user', 'roles.can_create_role', 'roles.can_create_rule');
        $order = array('roles.id_role' => 'asc');
        $list = $list_data->get_datatables('roles', $column_order, $column_search, $order, $where);
        $data = array();
        $no = $request->getPost("start");
        foreach ($list as $l) {
            $no++;
            $row    = array();
            // $row[] = $no;
            $row[] = $l->id_role;
            $row[] = $l->name;
            $row[] = $l->description;
            $row[] = "<input type='checkbox' disabled name='create_role' data-bootstrap-switch" . ($l->can_create_role == 0 ? '' : ' checked') . " >";
            $row[] = "<input type='checkbox' disabled name='create_role' data-bootstrap-switch" . ($l->can_create_rule == 0 ? '' : ' checked') . " >";
            $row[] = "<input type='checkbox' disabled name='create_user' data-bootstrap-switch" . ($l->can_create_user == 0 ? '' : ' checked') . " >";
            $row[] = "<button class='btn btn-danger'>Embuh...</button>";
            // $row[] = "<div class='btn-group'>" +
            //             "<button type='button' class='btn btn-primary'>Action</button>" +
            //             "<button type='button' class='btn btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'></button>" +
            //             "<span class='sr-only'>Toggle Dropdown</span>" +
            //             "<div class='dropdown-menu' role='menu'>" +
            //                 "<a href='#' class='dropdown-item btn btn-sm btn-edit' data-id=" . $l->id_role . " data-name=" . $l->name . " data-description=" . $l->description . " data-can_create_role=" . $l->can_create_role . " data-can_create_rule=" . $l->can_create_rule . " data-can_create_user=" . $l->can_create_user . "><i class='fas fa-edit'></i>&nbsp;Edit</a>" +
            //                 "<a href='#' class='dropdown-item btn btn-sm btn-delete' data-id=" . $l->id_role . "><i class='fas fa-trash'></i>&nbsp;Delete</a>" +
            //             "</div>" +
            //         "</div>";
            $data[] = $row;
        }
        $output = array(
            "draw" => $request->getPost("draw"),
            "recordsTotal" => $list_data->count_all('roles', $where),
            "recordsFiltered" => $list_data->count_filtered('roles', $column_order, $column_search, $order, $where),
            "data" => $data,
        );

        return json_encode($output);
    }

    public function addDataRole(){
        $roleModel = $this->role_model;

        $rst = $roleModel->addRole();

        echo json_encode($rst);

    }    

    public function updateDataRole(){
        $roleModel = $this->role_model;

        $rst = $roleModel->updateRole();

        echo json_encode($rst);

    }

    public function getRole($id){
        $roleModel = $this->role_model;

        $rst = $roleModel->getRole($id);

        echo json_encode($rst);
    }

    public function deleteRole($id=0){
        $roleModel = $this->role_model;
        if($roleModel->find($id)){
            $roleModel->delete($id);

            $retVal = [
                'status' => TRUE,
                'msg' => 'Delete Role berhasil!'
            ];
        }else{
            $retVal = [
                'status' => FALSE,
                'msg' => 'Delete Role gagal, karena ID tidak ditemukan!'
            ];
        }
        echo json_encode($retVal);
    }
}
