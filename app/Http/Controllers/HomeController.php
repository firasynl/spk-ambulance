<?php

namespace App\Http\Controllers;

use App\Charts\NilaiPegawaiChart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(NilaiPegawaiChart $chart){
        
        return view('admin.dashboard', ['chart' => $chart->build()]);
    }
}
