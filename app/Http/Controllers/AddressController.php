<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class AddressController extends Controller
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
            $addresses = $API->comm('/ip/address/print', [
                '?dynamic' => 'no',
            ]);

            $data = [];
            foreach ($addresses as $address) {
                $id = isset($address['.id']) ? str_replace('*', '', $address['.id']) : null;
                $data[] = [
                    'id' => $id,
                    'address' => $address['address'],
                    'network' => $address['network'],
                    'interface' => $address['interface'],
                ];
            }

            return view('address.index', compact('data'));
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

            return view('address.create', compact('interfaces'));
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
            'address' => 'required',
            'interface' => 'required',
        ]);

        if ($API->connect($ip, $user, $pass)) {

            $address = $request['address'];
            $ipParts = explode('/', $address);
            $ip = $ipParts[0];
            $subnet = isset($ipParts[1]) ? $ipParts[1] : 32;

            $network = long2ip(ip2long($ip) & (4294967295 << (32 - $subnet)));
            $networkmask = $network;

            $data = [
                'address' => $request['address'],
                'interface' => $request['interface'],
                'network' => $networkmask,
            ];

            $API->comm('/ip/address/add', $data);

            // dd($data);

            toast('IP Address berhasil ditambahkan!', 'success');

            return redirect()->route('address');
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function updateAddress(Request $request)
    {
        $mikrotik = Mikrotik::first();
        if (!$mikrotik) {
            Mikrotik::truncate();
            return view('error');
        }

        $ip = $mikrotik->ip;
        $user = $mikrotik->user;
        $pass = $mikrotik->password;

        $API = new RouterosAPI();
        $API->debug = false;

        $request->validate([
            'address' => 'required',
            'interface' => 'required',
        ]);

        if ($API->connect($ip, $user, $pass)) {
            $address = $request->input('address');
            $ipParts = explode('/', $address);
            $ip = $ipParts[0];
            $subnet = isset($ipParts[1]) ? $ipParts[1] : 32;

            $network = long2ip(ip2long($ip) & (4294967295 << (32 - $subnet)));
            $networkmask = $network;

            $data = [
                'address' => $address,
                'interface' => $request->input('interface'),
                'network' => $networkmask,
            ];

            // dd($data);

            $API->comm("/ip/address/set", [
                '.id' => $request['id'],
                'address' => $data['address'],
                'interface' => $data['interface'],
                'network' => $data['network']
            ]);

            toast('IP Address berhasil diperbarui!', 'success');

            return redirect()->route('address');
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
            $interfaces = $API->comm('/interface/print');
            $address = $API->comm('/ip/address/print', [
                '?.id' => '*' . $id,
            ]);
            $data = $address[0];
            $id = $data['.id'];
            $address = $data['address'];
            $network = $data['network'];
            $interface = $data['interface'];

            return view('address.edit', compact('id', 'address', 'network', 'interface', 'interfaces'));
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

            $API->comm('/ip/address/remove', [
                '.id' => '*' . $id,
            ]);

            toast('Data Address berhasil dihapus!', 'success');

            return back();
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }
}
