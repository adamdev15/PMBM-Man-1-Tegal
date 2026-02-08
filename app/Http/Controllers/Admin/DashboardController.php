<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Casis;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Casis::count(),
            'verified' => Casis::where('status_verifikasi', 'Diverifikasi')->count(),
            'pending' => Casis::where('status_verifikasi', 'Belum Diverifikasi')->count(),
        ];

        $casis = Casis::latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'casis'));
    }

    public function verify(Request $request, $id)
    {
        $casis = Casis::findOrFail($id);
        $casis->update(['status_verifikasi' => 'Diverifikasi']);

        // Optional: Send WA notification "Data Verified"

        return back()->with('success', 'Data siswa berhasil diverifikasi.');
    }

    public function unverify(Request $request, $id)
    {
        $casis = Casis::findOrFail($id);
        $casis->update(['status_verifikasi' => 'Belum Diverifikasi']);

        return back()->with('success', 'Verifikasi data siswa berhasil dibatalkan.');
    }
}