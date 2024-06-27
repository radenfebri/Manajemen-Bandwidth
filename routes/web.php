<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BandwidthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('change-password', [SettingController::class, 'changePassword'])->name('changePassword');
Route::put('change-pasword/update', [SettingController::class, 'updatePassword'])->name('updatePassword');
Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::post('create-mikrotik', [MikrotikController::class, 'create'])->name('create-mikrotik');
Route::get('address', [AddressController::class, 'index'])->name('address');
Route::get('address/create', [AddressController::class, 'create'])->name('create-address');
Route::get('address/edit/{id}', [AddressController::class, 'edit'])->name('edit-address');
Route::post('address/update', [AddressController::class, 'updateAddress'])->name('update-address');
Route::post('address/create', [AddressController::class, 'store'])->name('store-address');
Route::get('address/delete/{id}', [AddressController::class, 'delete'])->name('delete-address');
Route::get('bandwidth', [BandwidthController::class, 'index'])->name('bandwidth');
Route::get('bandwidth/create', [BandwidthController::class, 'create'])->name('create-bandwidth');
Route::get('bandwidth/edit/{id}', [BandwidthController::class, 'edit'])->name('edit-bandwidth');
Route::post('bandwidth/update', [BandwidthController::class, 'updateBandwidth'])->name('update-bandwidth');
Route::post('bandwidth/create', [BandwidthController::class, 'store'])->name('store-bandwidth');
Route::get('bandwidth/delete/{id}', [BandwidthController::class, 'delete'])->name('delete-bandwidth');
Route::get('setting', [SettingController::class, 'index'])->name('setting');
Route::post('setting/update/{id}', [SettingController::class, 'update'])->name('update-mikrotik');
Route::post('disable-enable/register', [SettingController::class, 'register'])->name('disable-enable.register');
