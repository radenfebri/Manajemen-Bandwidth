<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $mikrotik = Mikrotik::first();
        if ($mikrotik) {
            $ip = $mikrotik->ip;
            $user = $mikrotik->user;
            $pass = $mikrotik->password;
        } else {
            Mikrotik::truncate();
            return view('error');
        }
        
        $API = new RouterosAPI();
        $API->debug('false');
        
        if ($API->connect($ip, $user, $pass)) {
            $resource = $API->comm('/system/resource/print');
            $identity = $API->comm('/system/identity/print');
            
            $data = [
                'cpu' => $resource[0]['cpu-load'],
                'uptime' => $resource[0]['uptime'],
                'version' => $resource[0]['version'],
                'boardname' => $resource[0]['board-name'],
                'totalmemory' => $resource[0]['total-memory'],
                'totalhdd' => $resource[0]['total-hdd-space'],
                'name' => $identity[0]['name'],
            ];
            
            // dd($data);
            return view('dashboard.dashboard', $data);
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }
}
