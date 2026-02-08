<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Casis;
use App\Models\NilaiRapor;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function index()
    {
        $ketrampilan = DB::table('master_ketrampilan')->get();
        $hobi = DB::table('master_hobi')->get();
        $cita = DB::table('master_cita')->get();
        $pendidikan = DB::table('master_pendidikan')->get();
        $pekerjaan = DB::table('master_pekerjaan')->get();
        // Filter jobs
        $pekerjaan_ayah = $pekerjaan->filter(fn($p) => in_array($p->target, ['ayah', 'semua']));
        $pekerjaan_ibu = $pekerjaan->filter(fn($p) => in_array($p->target, ['ibu', 'semua']));
        $pekerjaan_wali = $pekerjaan->filter(fn($p) => in_array($p->target, ['wali', 'semua']));

        $penghasilan = DB::table('master_penghasilan')->get();
        $orientasi = DB::table('master_orientasi_ortu')->get();

        // Settings
        $settings = \App\Models\Setting::all()->pluck('value', 'key');

        return view('registration.wizard', compact('ketrampilan', 'hobi', 'cita', 'pendidikan', 'pekerjaan_ayah', 'pekerjaan_ibu', 'pekerjaan_wali', 'penghasilan', 'orientasi', 'settings'));
    }

    public function store(Request $request)
    {
        // Cek status pendaftaran
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $tanggalMulai = $settings['jadwal_pendaftaran_mulai'] ? Carbon::parse($settings['jadwal_pendaftaran_mulai']) : null;
        $tanggalSelesai = $settings['jadwal_pendaftaran_selesai'] ? Carbon::parse($settings['jadwal_pendaftaran_selesai']) : null;
        $now = Carbon::now();
        
        if ($tanggalMulai && $now->lt($tanggalMulai)) {
            return response()->json([
                'success' => false,
                'status' => 'not_started',
                'message' => 'Pendaftaran belum dibuka. Tanggal pendaftaran dibuka: ' . $tanggalMulai->format('d F Y'),
                'tanggal_mulai' => $tanggalMulai->toIso8601String()
            ], 403);
        }
        
        if ($tanggalSelesai && $now->gt($tanggalSelesai)) {
            return response()->json([
                'success' => false,
                'status' => 'closed',
                'message' => 'Pendaftaran telah ditutup. Periode pendaftaran berakhir pada: ' . $tanggalSelesai->format('d F Y')
            ], 403);
        }

        $msg = [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar.'
        ];
        // Validate required fields (customize as needed)
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => 'required|unique:casis,nisn',
            'nik' => 'required|unique:casis,nik',
            'no_hp_siswa' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ], $msg);

        // Convert inputs to uppercase
        $input = $request->all();
        array_walk_recursive($input, function (&$item) {
            if (is_string($item)) {
                $item = strtoupper($item);
            }
        });
        $request->merge($input);

        DB::beginTransaction();
        try {
            $year = date('Y');
            $dd = date('d');
            $rawPassword = $request->nisn . $dd;

            // Generate Sequential No Pendaftaran: PMBM-2026-0001
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

            // Map input to database columns
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'anak_ke' => $request->anak_ke,
                'jml_saudara' => $request->jml_saudara,
                'agama' => $request->agama,
                'status_keluarga' => $request->status_keluarga,
                'alamat_siswa' => $request->alamat_siswa,
                'no_hp_siswa' => $request->no_hp_siswa,
                'ketrampilan_id' => $request->ketrampilan_id,
                'hobi_id' => $request->hobi_id,
                'cita_id' => $request->cita_id,

                // Ayah
                'nama_ayah' => $request->nama_ayah,
                'nik_ayah' => $request->nik_ayah,
                'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                'alamat_ayah' => $request->alamat_ayah,
                'pendidikan_ayah_id' => $request->pendidikan_ayah_id,
                'pekerjaan_ayah_id' => $request->pekerjaan_ayah_id,
                'penghasilan_ayah_id' => $request->penghasilan_ayah_id,
                'no_hp_ayah' => $request->no_hp_ayah,
                'status_ayah' => $request->status_ayah,

                // Ibu
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'pendidikan_ibu_id' => $request->pendidikan_ibu_id,
                'pekerjaan_ibu_id' => $request->pekerjaan_ibu_id,
                'penghasilan_ibu_id' => $request->penghasilan_ibu_id,
                'no_hp_ibu' => $request->no_hp_ibu,
                'status_ibu' => $request->status_ibu,

                // Wali
                'nama_wali' => $request->nama_wali,
                'nik_wali' => $request->nik_wali,
                'tgl_lahir_wali' => $request->tgl_lahir_wali,
                'alamat_wali' => $request->alamat_wali,
                'pendidikan_wali_id' => $request->pendidikan_wali_id,
                'pekerjaan_wali_id' => $request->pekerjaan_wali_id,
                'penghasilan_wali_id' => $request->penghasilan_wali_id,
                'no_hp_wali' => $request->no_hp_wali,
                'status_wali' => $request->status_wali,
                'orientasi_ortu_id' => $request->orientasi_ortu_id,

                // Sekolah
                'nama_sekolah' => $request->nama_sekolah,
                'npsn_sekolah' => $request->npsn_sekolah,
                'jenis_sekolah' => $request->jenis_sekolah,
                'status_sekolah' => $request->status_sekolah,
                'alamat_sekolah' => $request->alamat_sekolah,
                'akreditasi_sekolah' => $request->akreditasi_sekolah,

                // System
                'password' => Hash::make($rawPassword),
                'no_pendaftaran' => $noPendaftaran,
                'status_pendaftaran' => 'Submitted',
                'status_verifikasi' => 'Belum Diverifikasi'
            ];

            $casis = Casis::create($data);

            // Save Nilai for Semester 3, 4, 5
            $semesters = [3, 4, 5];
            foreach ($semesters as $sem) {
                NilaiRapor::create([
                    'casis_id' => $casis->id,
                    'semester' => (string)$sem,
                    'ipa' => $request->input("nilai_{$sem}_ipa", 0),
                    'ips' => $request->input("nilai_{$sem}_ips", 0),
                    'matematika' => $request->input("nilai_{$sem}_mtk", 0),
                    'bind' => $request->input("nilai_{$sem}_bind", 0),
                    'bing' => $request->input("nilai_{$sem}_bing", 0),
                ]);
            }

            // Send Whatsapp using dynamic template
            $template = \App\Models\Setting::get('template_pesan', "Selamat, pendaftaran berhasil!\nNama: [NAMA]\nNISN: [NISN]\nNomor Daftar: [NOMOR_DAFTAR]\nPassword: [PASSWORD]\nTanggal: [TANGGAL]\n\nSimpan data ini untuk login.");

            $waMessage = str_replace(
            ['[NAMA]', '[NISN]', '[NOMOR_DAFTAR]', '[PASSWORD]', '[TANGGAL]'],
            [$casis->nama_lengkap, $casis->nisn, $casis->no_pendaftaran, $rawPassword, date('d-m-Y')],
                $template
            );

            $this->sendWhatsapp($casis->no_hp_siswa, $waMessage);

            DB::commit();

            // Auto-login
            session(['casis_id' => $casis->id]);

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'redirect' => route('casis.dashboard')
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::warning("Validation Error: " . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', \Illuminate\Support\Arr::flatten($e->errors()))
            ], 422);
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error("Registration Error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function sendWhatsapp($target, $message)
    {
        try {
            // Clean target number (remove spaces, dashes, dots, and +)
            $target = preg_replace('/[^0-9]/', '', $target);

            // Get token from DB Settings, fallback to env
            $token = \App\Models\Setting::get('fonnte_token', env('FONNTE_TOKEN'));

            if (!$token) {
                Log::warning("WA Warning: Token Fonnte belum diatur di Settings.");
                return;
            }

            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);

            if (!$response->successful()) {
                Log::error("WA Send Failed: " . $response->body());
            }
            else {
                Log::info("WA Sent Successfully to $target: " . $response->body());
            }
        }
        catch (\Exception $e) {
            Log::error("WA Error Exception: " . $e->getMessage());
        }
    }
}