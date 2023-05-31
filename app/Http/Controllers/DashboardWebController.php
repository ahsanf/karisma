<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardWebController extends Controller
{
    public function index()
    {

        $data['action'] = ['dashboard_1'];
        $data['page_title'] = 'Dashboard';
        $data['card_title'] = 'Dashboard';

        return view('admin.dashboard.index', compact('data'));
    }
}
