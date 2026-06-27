<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dosen/dashboard');
    }
}
