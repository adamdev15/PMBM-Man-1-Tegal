<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CasisController extends Controller
{
    public function index(Request $request)
    {
        $query = Casis::query();

        // Search Filter (Name/NISN)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        $casis = $query->latest()->paginate(10)->withQueryString();

        return view('admin.casis.index', compact('casis'));
    }

    public function create()
    {
        $ketrampilan = DB::table('master_ketrampilan')->get();
        $hobi = DB::table('master_hobi')->get();
        $cita = DB::table('master_cita')->get();
        $orientasi = DB::table('master_orientasi_ortu')->get();

        return view('admin.casis.form', compact('ketrampilan', 'hobi', 'cita', 'orientasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|unique:casis,nisn',
            'jk' => 'required|in:L,P',
            'no_hp_siswa' => 'required|string',
            'no_hp_ayah' => 'nullable|string',
            'no_hp_ibu' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        // Merge default password if not provided
        if (!$request->filled('password')) {
            $request->merge(['password' => $request->nisn]);
        }

        // Generate Sequential No Pendaftaran: PMBM-2026-0001
        $year = date('Y');
        $lastCasis = Casis::where('no_pendaftaran', 'LIKE', "PMBM-$year-%")
            ->latest()
            ->first();

        $nextId = 1;
        if ($lastCasis) {
            $parts = explode('-', $lastCasis->no_pendaftaran);
            $lastSeq = (int)end($parts);
            $nextId = $lastSeq + 1;
        }
        $noPendaftaran = "PMBM-$year-" . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        $data['no_pendaftaran'] = $noPendaftaran;
        $data['agama'] = 'ISLAM'; // Default or based on form
        $data['tempat_lahir'] = $request->tempat_lahir ?? '-';
        $data['tgl_lahir'] = $request->tgl_lahir ?? date('Y-m-d');
        $data['alamat_siswa'] = $request->alamat_siswa ?? '-';

        // Convert all string fields to Uppercase
        foreach ($data as $key => $value) {
            if (is_string($value) && $key !== 'password') {
                $data[$key] = strtoupper($value);
            }
        }

        Casis::create($data);

        return redirect()->route('admin.casis.index')->with('success', 'Data Calon Siswa berhasil ditambahkan.');
    }

    public function show(Casis $casis)
    {
        $casis->load('berkas', 'nilaiRapor');
        return view('admin.casis.show', compact('casis'));
    }

    public function updateSelection(Request $request, $id)
    {
        $casis = Casis::findOrFail($id);

        $validated = $request->validate([
            'nilai_tpa' => 'nullable|numeric|min:0|max:100',
            'nilai_wawancara' => 'nullable|numeric|min:0|max:100',
            'status_kelulusan' => 'required|in:Proses,Lulus,Tidak Lulus,Cadangan',
        ]);

        $casis->update($validated);

        return back()->with('success', 'Hasil seleksi berhasil diperbarui.');
    }

    public function edit(Casis $casis)
    {
        $ketrampilan = DB::table('master_ketrampilan')->get();
        $hobi = DB::table('master_hobi')->get();
        $cita = DB::table('master_cita')->get();
        $orientasi = DB::table('master_orientasi_ortu')->get();
        $pendidikan = DB::table('master_pendidikan')->get();
        $pekerjaan = DB::table('master_pekerjaan')->get();
        $penghasilan = DB::table('master_penghasilan')->get();

        return view('admin.casis.form', compact('casis', 'ketrampilan', 'hobi', 'cita', 'orientasi', 'pendidikan', 'pekerjaan', 'penghasilan'));
    }

    public function update(Request $request, Casis $casis)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => ['required', 'string', Rule::unique('casis')->ignore($casis->id)],
            'jk' => 'required|in:L,P',
            'no_hp_siswa' => 'required|string',
        ]);

        $data = $request->except(['_token', '_method', 'password']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Convert all string fields to Uppercase
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = strtoupper($value);
            }
        }

        $casis->update($data);

        return redirect()->route('admin.casis.index')->with('success', 'Data Calon Siswa berhasil diperbarui.');
    }

    public function destroy(Casis $casis)
    {
        $casis->delete();
        return redirect()->route('admin.casis.index')->with('success', 'Data Calon Siswa berhasil dihapus.');
    }
}