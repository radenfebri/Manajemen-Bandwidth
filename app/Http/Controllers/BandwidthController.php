<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class BandwidthController extends Controller
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
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {
            $queues = $API->comm('/queue/simple/print', [
                '?dynamic' => 'no',
            ]);

            $data = [];
            foreach ($queues as $queue) {
                $id = isset($queue['.id']) ? str_replace('*', '', $queue['.id']) : null;
                $maxLimit = isset($queue['max-limit']) ? $this->convertToMegaBit($queue['max-limit']) : null;
                $burstLimit = isset($queue['burst-limit']) ? $this->convertToMegaBit($queue['burst-limit']) : null;
                $burstThreshold = isset($queue['burst-threshold']) ? $this->convertToMegaBit($queue['burst-threshold']) : null;
                $limitAt = isset($queue['limit-at']) ? $this->convertToMegaBit($queue['limit-at']) : null;
                $data[] = [
                    'id' => $id,
                    'name' => $queue['name'],
                    'target' => $queue['target'],
                    'priority' => $queue['priority'],
                    'queue' => $queue['queue'],
                    'max-limit' => $maxLimit,
                    'burst-limit' => $burstLimit,
                    'burst-threshold' => $burstThreshold,
                    'burst-time' => $queue['burst-time'],
                    'limit-at' => $limitAt,
                    // 'max-limit' => $queue['max-limit'],
                ];
            }

            // dd($data);

            return view('bandwidth.index', compact('data'));
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }

    public function create()
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
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {
            $interfaces = $API->comm('/interface/print');
            $queueTypes = $API->comm('/queue/simple/getall');
            $queuetype = $API->comm('/queue/type/print');
            $priorities = [0, 1, 2, 3, 4, 5, 6, 7, 8];

            return view('bandwidth.create', compact('interfaces', 'queueTypes', 'queuetype', 'priorities'));
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function store(Request $request)
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
        $API->debug = false;

        $request->validate([
            'name' => 'required',
            'target' => 'required',
        ]);

        if ($API->connect($ip, $user, $pass)) {

            $data = [
                'name' => $request['name'],
                'target' => $request['target'],
                'priority' => $request['priority'],
                'max-limit' => $request['max-limit'] == '' ? '0/0' : $request['max-limit'],
                'queue' => $request['queue']  == '' ? 'default-small/default-small' : $request['queue'],
                'burst-limit' => $request['burst-limit'] == '' ? '0/0' : $request['burst-limit'],
                'burst-threshold' => $request['burst-threshold'] == '' ? '0/0' : $request['burst-threshold'],
                'burst-time' => $request['burst-time']  == '' ? '0s/0s' : $request['burst-time'],
                'limit-at' => $request['limit-at']  == '' ? '0/0' : $request['limit-at'],
            ];

            // dd($data);

            $API->comm('/queue/simple/add', $data);

            toast('Data banwidth berhasil dibuat!', 'success');

            return redirect()->route('bandwidth');
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function edit($id)
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
        $API->debug = false;


        if ($API->connect($ip, $user, $pass)) {
            $queues = $API->comm('/queue/simple/print', [
                '?.id' => '*' . $id,
            ]);
            $dataqueuetype = $API->comm('/queue/type/print');

            $data =  $queues[0];
            $id =  $queues[0]['.id'];
            $queuetype = $data['queue'];
            $priority = $data['priority'];
            $priority_number = explode('/', $priority)[0];
            $queue_type = explode('/', $queuetype)[0];

            // dd($data);
            return view('bandwidth.edit', compact('data', 'queues', 'priority', 'id', 'priority_number', 'dataqueuetype', 'queue_type'));
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function updateBandwidth(Request $request)
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
        $API->debug = false;

        $request->validate([
            'name' => 'required',
            'target' => 'required',
        ]);

        if ($API->connect($ip, $user, $pass)) {
            $params = [
                '.id' => $request['id'],
                'name' => $request['name'],
                'target' => $request['target'],
                'max-limit' => $request['max-limit'] == '' ? '0/0' : $request['max-limit'],
                'priority' => $request['priority'] == '' ? '8/8' : $request['priority'],
                'queue' => $request['queue'] == '' ? 'default-small/default-small' : $request['queue'],
                'burst-limit' => $request['burst-limit'] == '' ? '0/0' : $request['burst-limit'],
                'burst-threshold' => $request['burst-threshold'] == '' ? '0/0' : $request['burst-threshold'],
                'burst-time' => $request['burst-time']  == '' ? '0s/0s' : $request['burst-time'],
                'limit-at' => $request['limit-at']  == '' ? '0/0' : $request['limit-at'],
            ];
            // dd($params);

            $API->comm('/queue/simple/set', $params);

            toast('Data banwidth berhasil diupdate!', 'info');

            return redirect()->route('bandwidth');
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function delete($id)
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
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {

            $API->comm('/queue/simple/remove', [
                '.id' => '*' . $id,
            ]);

            toast('Data banwidth berhasil dihapus!', 'success');

            return back();
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function convertToMegaBit($limit)
    {
        $parts = explode('/', $limit);
        $upload = $parts[0] / 1000000;
        $download = $parts[1] / 1000000;
        return $upload . 'M/' . $download . 'M';
    }
}
