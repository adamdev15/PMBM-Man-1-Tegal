<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        
        // Cek status pendaftaran
        $tanggalMulai = $settings['jadwal_pendaftaran_mulai'] ? Carbon::parse($settings['jadwal_pendaftaran_mulai']) : null;
        $tanggalSelesai = $settings['jadwal_pendaftaran_selesai'] ? Carbon::parse($settings['jadwal_pendaftaran_selesai']) : null;
        $now = Carbon::now();
        
        $registrationStatus = 'open'; // default
        if ($tanggalMulai && $now->lt($tanggalMulai)) {
            $registrationStatus = 'not_started';
        } elseif ($tanggalSelesai && $now->gt($tanggalSelesai)) {
            $registrationStatus = 'closed';
        }
        
        return view('landing', compact('settings', 'registrationStatus', 'tanggalMulai', 'tanggalSelesai'));
    }
}