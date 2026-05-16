<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin() { return view('dashboards.admin'); }
    public function author() { return view('dashboards.author'); }
    public function reader() { return view('dashboards.reader'); }
    public function publisher() { return view('dashboards.publisher'); }
    public function buyer() { return view('dashboards.buyer'); }
}