<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use App\Models\RouterosAPI;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mikrotik = Mikrotik::first();
        $register = Setting::pluck('register')->first();
        if ($mikrotik) {
            $ip = $mikrotik->ip;
            $user = $mikrotik->user;
            $pass = $mikrotik->password;
            $id = $mikrotik->id;
        } else {
            Mikrotik::truncate();
            return view('error');
        }

        $API = new RouterosAPI();
        $API->debug('false');

        if ($API->connect($ip, $user, $pass)) {
            $identity = $API->comm('/system/identity/print');

            $data = [
                'name' => $identity[0]['name'],
            ];

            // dd($data);

            return view('setting.index', compact('ip', 'user', 'pass', 'id', 'register'));
        } else {
            Mikrotik::truncate();
            return view('error');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'ip' => 'required|string',
            'user' => 'required|string',
        ]);

        $data = Mikrotik::findOrFail($id);
        $data->update($request->all());

        toast('Data Mikrotik berhasil diupdate!', 'success');

        return back();
    }


    public function register(Request $request)
    {
        $value = $request->input('registerCheckbox');

        $setting = Setting::first();
        $setting->register = $value;
        $setting->save();

        return response()->json(['message' => 'Perubahan berhasil']);
    }


    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password does not match']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();

        toast('Password anda berhasil diupdate!', 'success');
        return redirect()->route('login');
    }
}
