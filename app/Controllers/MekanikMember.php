<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\RoleModel;

use App\Models\MekanikMemberModel;

class MekanikMember extends BaseController
{
    public function __construct()
    {
        $this->rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->role_model = new RoleModel();

        $this->mekanikMemberModel = new MekanikMemberModel();
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

        return view('Dashboard/mekanik_member_view', $data);
    }

    public function getAllMekanikMember()
    {
        $mekanikMemberModel = $this->mekanikMemberModel;


        $rst['data'] = $mekanikMemberModel->findAll();

        // foreach ($rst['data'] as $data) {
        //     $fileFoto = ('/images/mekanik/' . $data['NIK'] . '.jpg');
        //     if (file_exists($fileFoto)) {
        //         array_push($rst['data'], array("foto" => $data['NIK'] . '.jpg'));
        //         // $rst['data']['foto'] = $data['NIK'] . '.jpg';
        //     } else {
        //         // $rst['data']['foto'] = 'noimage.jpg';
        //         array_push($rst['data'], array("foto" => "noimage.jpg"));
        //     }
        // }
        // print_r($rst);
        echo json_encode($rst);
    }

    public function getMekanikMember($id)
    {
        $mekanikMemberModel = $this->mekanikMemberModel;

        $rst = $mekanikMemberModel->find($id);

        echo json_encode($rst);
    }

    public function updateMekanikMember()
    {
        $mekanikMemberModel = $this->mekanikMemberModel;

        if (isset($_POST['dataEditMekanikMember'])) {
            $dataEditMM = $_POST['dataEditMekanikMember'];
            $id = $dataEditMM['id_mekanik_member'];
            $nik = $dataEditMM['NIK'];
            $nama = $dataEditMM['Nama'];
            $inisial = $dataEditMM['Inisial'];
            $bagian = $dataEditMM['Bagian'];
            $shift = $dataEditMM['Shift'];
            $isMachineBreakdown = $dataEditMM['isMachineBreakdown'];
            $isQCO = $dataEditMM['isQuickChange'];
            $isMaintenance = $dataEditMM['isMaintenance'];

            $dataForUpdate = [
                'id_mekanik_member' => $id,
                'NIK' => $nik,
                'Nama' => $nama,
                'Inisial' => $inisial,
                'Bagian' => $bagian,
                'Shift' => $shift,
                'isMachineBreakdown' => $isMachineBreakdown,
                'isQuickChange' => $isQCO,
                'isMaintenance' => $isMaintenance
            ];

            $rst = $mekanikMemberModel->save($dataForUpdate);
            echo json_encode($rst);
        }
    }
}
