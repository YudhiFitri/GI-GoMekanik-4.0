<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Controllers\MyController;

use App\Models\ViewRoleRuleModel;
use App\Models\AppModel;
use App\Models\RoleModel;

use App\Models\MesinModel;
use App\Models\StyleModel;
use App\Models\LineModel;

use App\Models\QCOModel;
use App\Models\QCODetailModel;
use App\Models\QCOViewModel;
use App\Models\MachineBreakdownModel;
use App\Models\DeviceTokensModel;

class QuickChangeOver extends BaseController
// class QuickChangeOver extends MyController
{
    public function __construct()
    {
        // parent::__construct();
        $this->rule_model = new ViewRoleRuleModel();
        $this->app_model = new AppModel();
        $this->role_model = new RoleModel();

        $this->mesinModel = new MesinModel();
        $this->styleModel = new StyleModel();
        $this->qcoViewModel = new QCOViewModel();
        $this->lineModel = new LineModel();
        $this->machineBreakdownModel = new MachineBreakdownModel();
        $this->qcoModel = new QCOModel();
        $this->qcoDetailModel = new QCODetailModel();

        $this->tokenModel = new DeviceTokensModel();
    }

    // public function index()
    // {
    //     $data = parent::app($id = null);

    //     return view('Dashboard/qco_view', $data);
    // }

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

        return view('Dashboard/qco_view', $data);
    }

    public function getAllQCO()
    {
        // $qcoViewModel = $this->qcoViewModel;
        $qcoModel = $this->qcoModel;

        // $rst['data'] = $qcoViewModel->findAll();
        $qcoModel->orderBy('id_qco', 'DESC');
        $rst['data'] = $qcoModel->findAll();

        echo json_encode($rst);
    }

    public function getAllStyles()
    {
        $styleModel = $this->styleModel;

        $rst = $styleModel->getAllStyles();

        echo json_encode($rst);
    }

    public function getAllLines()
    {
        $lineModel = $this->lineModel;

        $rst = $lineModel->getAllLines();

        echo json_encode($rst);
    }

    public function getQCOByStyle()
    {
        $qcoViewModel = $this->qcoViewModel;

        $rst = $qcoViewModel->getQCOByStyle();

        echo json_encode($rst);
    }

    public function getMesinAtAMS($barcode)
    {
        $mesinModel = $this->mesinModel;

        return $mesinModel->getByBarcode($barcode);
    }

    public function getMesinAtMachineBreakdown($barcode)
    {
        $mbModel = $this->machineBreakdownModel;

        return $mbModel->getByBarcode($barcode);
    }

    public function addMesin($barcode)
    {
        $rstMesin = $this->getMesinAtAMS($barcode);
        // print_r($rstMesin);
        if ($rstMesin != null) {
            $mbResult = $this->getMesinAtMachineBreakdown($barcode);
            // var_dump($mbResult);

            if ($mbResult == null) {
                $data['status'] = true;
                $data['result'] = $rstMesin;
                $data['msg'] = null;
            } else if ($mbResult != null && $mbResult['status'] == 'Settled') {
                $data['status'] = true;
                $data['result'] = $mbResult;
                $data['msg'] = null;
            } else if ($mbResult['status'] != 'Settled') {
                $data['status'] = false;
                $data['result'] = null;
                $data['msg'] = 'Mesin rusak atau sedang diperbaiki!';
            }
        } else {
            $data['status'] = false;
            $data['result'] = null;
            $data['msg'] = 'Barcode mesin tidak ada!';
        }

        echo json_encode($data);
    }

    public function saveQCO()
    {
        if (isset($_POST['dataQCO'])) {
            date_default_timezone_set('Asia/Jakarta');

            $dataQCO = $_POST['dataQCO'];
            $line = $dataQCO['line'];
            $style = $dataQCO['style'];
            $tgl = date('Y-m-d H:i:s');
            $location = $dataQCO['location'];
            $qcoModel = $this->qcoModel;

            $data = [
                'tgl' => $tgl,
                'style' => $style,
                'line' => $line,
                'location' => $location
            ];

            $rst = $qcoModel->saveQCO($data);

            echo json_encode($rst);
        }
    }

    public function saveDetailQCO()
    {
        // if(isset($_POST['dataDetailQCO'])){
        //     $dataDetailQCO = $_POST['dataDetailQCO'];
        //     $dataForDetailQCO = [];
        //     foreach($dataDetailQCO as $det){
        //         $data = [
        //             'qco' => $det['qco'],
        //             'barcode' => $det['barcode'],
        //             'jenis_barang' => $det['jenis_barang'],
        //             'merk' => $det['merk'],
        //             'no_seri' => $det['no_seri']
        //         ];
        //         array_push($dataForDetailQCO, $data);
        //     };
        //     $detailQCOModel = $this->qcoDetailModel;
        //     $rst = $detailQCOModel->saveDetailQCO($dataForDetailQCO);

        //     echo json_encode($rst);

        // }

        if (isset($_POST['dataDetailQCO'])) {
            $det = $_POST['dataDetailQCO'];
            $data = [
                'qco' => $det['qco'],
                'barcode' => $det['barcode'],
                'jenis_barang' => $det['jenis_barang'],
                'merk' => $det['merk'],
                'no_seri' => $det['no_seri'],
                'status' => 'QCO...'
            ];
            // array_push($dataForDetailQCO, $data);
            $detailQCOModel = $this->qcoDetailModel;
            $rst = $detailQCOModel->saveDetailQCO($data);

            echo json_encode($rst);
        }
    }

    public function sendNotification()
    {
        if (isset($_POST['dataNotif'])) {
            $tokenModel = $this->tokenModel;

            $dataNotif = $_POST['dataNotif'];

            // $title = $dataNotif['title'];
            $title = "TES KIRIM NOTIFASI UNTUK QCO...";
            $message = "TES 1 2 3...";
            $data = [
                "Line" => $dataNotif['line'],
                "Style" => $dataNotif['style'],
                "Merk" => $dataNotif['merk'],
                "Type" => $dataNotif['jenis_barang'],
                "Serial Number" => $dataNotif['no_seri']
            ];

            // $line = $dataNotif['line'];
            // $style = $dataNotif['style'];
            // $merk = $dataNotif['merk'];
            // $jenis = $dataNotif['jenis_barang'];
            // $sn = $dataNotif['no_seri'];

            // $message = $title;

            // $tokens = $this->DeviceIdsModel->getAllTokens();
            $tokens = $tokenModel->getAllTokens();

            $regIds = [];
            foreach ($tokens as $t) {
                array_push($regIds, $t['token']);
            }

            // echo print_r($regIds);

            $curl = curl_init();

            // $token = "cOv6H1zJTQWnf9yYjNmzyP:APA91bGFlM8N_z1NYt9NH-dDBxx496e4sfFIDDddXdJAZFKT16VozEOkwJ6qnd5o3qC-394Qxb6W8tZtoZZa8etYwttKZuxwb9BGzfrY9MqCbJgiHUG_v2KtMI-lHXR5wiliyZJPMsr7";
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "registration_ids": ' . json_encode($regIds) . ',
				"notification": {
					"title": "' . $title . '",
					"body": "' . $message . '",
                    "channel_id": "channel_id_1"
				},
				"data": {
					"Line": "' . $data['Line'] . '",
					"Machine Brand": "' . $data['Merk'] . '",
					"Machine Type": "' . $data['Type'] . '",
					"Machine SN": "' . $data['Serial Number'] . '",
                    "click_action": "FLUTTER_NOTIFICATION_CLICK"
				} 
			}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key=AAAA8o0O1Wg:APA91bFVnYzfYuZ3OWu8uxrVoFW7Rk2SH7SDO5FnjhRpYFWex56uXPuk9E1SIA_iy3fnbTmh2kYk15jnon7kHcy6uMSjzlK1gbkx2PNUbkFe9yIepuMtDsqQxhEZvxH69lq-HRi-2x7t',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            // echo json_decode($response);
        }
    }

    public function sendPushNotification()
    {
        if (isset($_POST['dataNotif'])) {
            $dataNotif = $_POST['dataNotif'];
            $location = $dataNotif['location'];
            $line = $dataNotif['line'];
            $style = $dataNotif['style'];
            $type = $dataNotif['jenis_barang'];
            $sn = $dataNotif['no_seri'];
            $merk = $dataNotif['merk'];
        }

        $apiKey = "AAAA8o0O1Wg:APA91bFVnYzfYuZ3OWu8uxrVoFW7Rk2SH7SDO5FnjhRpYFWex56uXPuk9E1SIA_iy3fnbTmh2kYk15jnon7kHcy6uMSjzlK1gbkx2PNUbkFe9yIepuMtDsqQxhEZvxH69lq-HRi-2x7t";
        $notification = array(
            "title" => "NEW Quick Change Over Available! (" . $location . ")"
            // "body" => $style . " - " . $type . " - " . $sn
        );
        $data = array(
            "Line" => $line,
            "Machine Brand" => $merk,
            "Machine Type" => $type,
            "Machine SN" => $sn,
            "Style" => $style
        );
        $tokenModel = $this->tokenModel;
        $tokens = $tokenModel->getAllTokens();
        $regIds = [];
        foreach ($tokens as $t) {
            array_push($regIds, $t['token']);
        }

        $fields = array("registration_ids" => $regIds, "notification" => $notification, "data" => $data);
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

    public function getDetailByIdQCO($id)
    {
        $qcoDetailModel = $this->qcoDetailModel;

        $rst['data'] = $qcoDetailModel->getByIdQCO($id);

        echo json_encode($rst);
    }

    public function deleteDetailQCO($idDetail)
    {
        $qcoDetailModel = $this->qcoDetailModel;

        $qcoDetailModel->deleteDetail($idDetail);

        $data['msg'] = 'Hapus data detail QCO berhasil';
        echo json_encode($data);
    }
}
