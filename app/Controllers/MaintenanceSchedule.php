<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\RoleModel;

use App\Models\MesinModel;
use App\Models\ServisMesinModel;
use App\Models\MekanikMemberModel;
use App\Models\DeviceTokensModel;

class MaintenanceSchedule extends BaseController
{
    public function __construct()
    {
        $this->rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->role_model = new RoleModel();

        $this->mesinModel = new MesinModel();
        $this->servisMesinModel = new ServisMesinModel();
        $this->mekanikMemberModel = new MekanikMemberModel();
        $this->tokensModel = new DeviceTokensModel();
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

        return view('Dashboard/jadwal_servis_mesin_view', $data);
    }

    public function getSewingMachine()
    {
        $mesinModel = $this->mesinModel;

        $rst['data'] = $mesinModel->getSewingMachine();

        echo json_encode($rst);
    }

    public function saveServisMesin()
    {
        if (isset($_POST['dataServisMesin'])) {
            $dataServisMesin = $_POST['dataServisMesin'];
            $dataForSave = [];
            foreach ($dataServisMesin as $dsm) {
                $dateNow = date('Y-m-d H:i:s');
                $idMesin = $dsm['id_mesin'];
                $jenis = $dsm['jenis'];
                $merk = $dsm['merk'];
                $tipe = $dsm['tipe'];
                $noSeri = $dsm['no_seri'];
                $lokasi = $dsm['lokasi'];
                $line = $dsm['line'];
                $status = 'Need Service...';

                $data = [
                    'tgl' => $dateNow,
                    'id_mesin' => $idMesin,
                    'jenis' => $jenis,
                    'merk' => $merk,
                    'tipe' => $tipe,
                    'no_seri' => $noSeri,
                    'lokasi' => $lokasi,
                    'line' => $line,
                    'status' => $status
                ];

                array_push($dataForSave, $data);
            }

            $servisMesinModel = $this->servisMesinModel;
            $rst = $servisMesinModel->insertBatch($dataForSave);

            echo json_encode($rst);
        }
    }

    public function sendPushNotification()
    {
        $apiKey = "AAAA8o0O1Wg:APA91bFVnYzfYuZ3OWu8uxrVoFW7Rk2SH7SDO5FnjhRpYFWex56uXPuk9E1SIA_iy3fnbTmh2kYk15jnon7kHcy6uMSjzlK1gbkx2PNUbkFe9yIepuMtDsqQxhEZvxH69lq-HRi-2x7t";
        $notification = array(
            "title" => "Machine Maintenance Available!"
            // "body" => $style . " - " . $type . " - " . $sn
        );

        // $data = [
        //     "Line" => "MERBABU",
        //     "Machine Brand" => "BROTHER",
        //     "Machine Type" => "BARTACK",
        //     "Machine SN" => "09887564"
        // ];

        $mekanikMemberModel = $this->mekanikMemberModel;
        $rstMekanikMember = $mekanikMemberModel->getTokensByMaintenance();
        $tokensModel = $this->tokensModel;
        $regIds = [];
        foreach ($rstMekanikMember as $rMM) {
            $rstToken = $tokensModel->getToken($rMM->id_mekanik_member);
            array_push($regIds, $rstToken['token']);
        }
        // echo json_encode($regIds);

        $fields = array("registration_ids" => $regIds, "notification" => $notification);
        $headers = array("Authorization: key=" . $apiKey, "Content-Type: application/json");

        $url = "https://fcm.googleapis.com/fcm/send";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        echo $result;
    }
}
