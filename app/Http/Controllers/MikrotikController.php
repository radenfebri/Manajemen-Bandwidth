<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
            'password' => 'required',
        ]);

        Mikrotik::create($request->all());

        toast('Data Mikrotik berhasil dibuat!','success');
        return redirect()->route('login');
    }
}
