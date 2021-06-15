<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $data['idRole'] = $session->get('role');
        return view('Dashboard/dashboard_view', $data);
    }
}
