<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Casis;
use Illuminate\Support\Facades\Hash;

class CasisLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.casis-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        $casis = Casis::where('nisn', $request->nisn)->first();

        if ($casis && Hash::check($request->password, $casis->password)) {
            // Manual Auth for Casis (Simpler than custom Guard for this scope)
            session(['casis_id' => $casis->id]);
            return redirect()->route('casis.dashboard');
        }

        return back()->withErrors(['nisn' => 'NISN atau Password salah.']);
    }

    public function dashboard()
    {
        if (!session('casis_id')) {
            return redirect()->route('casis.login');
        }

        $casis = Casis::with(['nilaiRapor', 'berkas'])->find(session('casis_id'));
        return view('casis.dashboard', compact('casis'));
    }

    public function printKartu()
    {
        $casis = $this->getCasisOrRedirect();
        if (is_null($casis))
            return redirect()->route('casis.login');

        $tahun_ajaran = \App\Models\Setting::get('tahun_ajaran');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('casis.pdf.kartu', compact('casis', 'tahun_ajaran'));
        return $pdf->download('Kartu_Pendaftaran_' . $casis->nisn . '.pdf');
    }

    public function printRekap()
    {
        $casis = $this->getCasisOrRedirect();
        if (is_null($casis))
            return redirect()->route('casis.login');

        $tahun_ajaran = \App\Models\Setting::get('tahun_ajaran');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('casis.pdf.rekap_nilai', compact('casis', 'tahun_ajaran'));
        return $pdf->download('Rekap_Nilai_' . $casis->nisn . '.pdf');
    }

    public function printFormulir()
    {
        $casis = $this->getCasisOrRedirect();
        if (is_null($casis))
            return redirect()->route('casis.login');

        $tahun_ajaran = \App\Models\Setting::get('tahun_ajaran');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('casis.pdf.formulir', compact('casis', 'tahun_ajaran'));
        return $pdf->download('Formulir_Pendaftaran_' . $casis->nisn . '.pdf');
    }

    private function getCasisOrRedirect()
    {
        if (!session('casis_id'))
            return null;
        return Casis::with(['nilaiRapor', 'berkas'])->find(session('casis_id'));
    }

    public function logout()
    {
        session()->forget('casis_id');
        return redirect()->route('casis.login');
    }

    public function uploadBerkas(Request $request)
    {
        $casis_id = session('casis_id');
        if (!$casis_id)
            return redirect()->route('casis.login');

        $request->validate([
            'nama_berkas' => 'required|string',
            'file' => 'required|file|max:2048',
        ]);

        $nama_berkas = $request->nama_berkas;
        $file = $request->file('file');

        // Validation based on berkas type
        if ($nama_berkas === 'foto') {
            $request->validate(['file' => 'image|mimes:png,jpg,jpeg']);
        }
        else {
            $request->validate(['file' => 'mimes:pdf']);
        }

        $filename = $nama_berkas . '_' . $casis_id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('berkas', $filename, 'public');

        \App\Models\CasisBerkas::updateOrCreate(
        ['casis_id' => $casis_id, 'nama_berkas' => $nama_berkas],
        [
            'path' => $path,
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
        ]
        );

        return back()->with('success', 'Berkas ' . $nama_berkas . ' berhasil diunggah.')->with('activeTab', 'dokumen');
    }
}