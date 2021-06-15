<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ViewRoleRuleModel;

class Login extends BaseController
{
    /**
     * @var HTTP\IncomingRequest
     */
    protected $request;

    public function index()
    {
        helper(['form']);
        return view('login_view');
    }

    public function auth()
    {
        $session = session();

        $userModel = new UserModel();
        $ruleModel = new ViewRoleRuleModel();

        $userName = $this->request->getVar('user_name');
        $password = $this->request->getVar('pass');

        $dataUser = $userModel->getByUserName($userName);
        if ($dataUser) {
            // $psw = $dataUser['password'];
            // print_r(MD5($password) == $dataUser['password']);
            if (MD5($password) == $dataUser['password']) {
                $sesData = [
                    'user_name' => $dataUser['user_name'],
                    'role' => $dataUser['role'],
                    'logged_in' => TRUE
                ];
                $session->set($sesData);

                // $data['idRole'] = $session->get('role');
                // return view('Dashboard/dashboard_view', $data);
                return redirect()->to(site_url() . '/Dashboard');
            } else {
                $session->setFlashdata('msg', 'Wrong Passwrod');
                return redirect()->to(site_url() . '/Login');
            }
        } else {
            $session->setFlashdata('User name not found!');
            return redirect()->to(site_url() . '/Login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(site_url() . '/Login');
    }
}
