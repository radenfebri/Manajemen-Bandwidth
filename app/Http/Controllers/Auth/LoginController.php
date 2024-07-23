<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mikroitk;
use App\Models\Mikrotik;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $register = Setting::pluck('register')->first();

        if (Mikrotik::count() === 0) {
            return view('mikrotik.create');
        } else {
            return view('auth.login', compact('register'));
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'account' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $loginField = filter_var($request->account, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($loginField, $request->account)->first();

        if (!$user) {
            toast('Data anda tidak ada di sistem kami!','error');
            
            return redirect()->route('login');
        }

        if (!Auth::attempt([$loginField => $request->account, 'password' => $request->password])) {
            toast('Periksa kembali data login anda!','error');

            return redirect()->route('login');
        }

        toast('Selamat anda berhasil Login!','success');
        
        return redirect()->route('dashboard');
    }


    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    }
}
