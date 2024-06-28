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
            $interface = $API->comm('/interface/ethernet/print');

            $data = [
                'cpu' => $resource[0]['cpu-load'],
                'uptime' => $resource[0]['uptime'],
                'version' => $resource[0]['version'],
                'boardname' => $resource[0]['board-name'],
                'totalmemory' => $resource[0]['total-memory'],
                'totalhdd' => $resource[0]['total-hdd-space'],
                'name' => $identity[0]['name'],
                'interface' => $interface,
            ];

            // dd($interfaces);
            return view('dashboard.dashboard', $data);
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function traffic($traffic)
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
            $traffic = $API->comm('/interface/monitor-traffic', array(
                'interface' => $traffic,
                'once' => '',
            ));

            $rx = $traffic[0]['rx-bits-per-second'];
            $tx = $traffic[0]['tx-bits-per-second'];
        } else {
            return 'Koneksi Gagal';
        }

        $data = [
            'rx' => $rx,
            'tx' => $tx,
        ];

        return view('realtime.traffic', $data);
    }
}
