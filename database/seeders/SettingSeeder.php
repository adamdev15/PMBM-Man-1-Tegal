<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Landing Page Settings
            [
                'key' => 'logo',
                'name' => 'Logo Sekolah',
                'value' => null,
                'type' => 'file'
            ],
            [
                'key' => 'nama_sekolah',
                'name' => 'Nama Sekolah',
                'value' => 'MTs Ma\'hadut Tholabah',
                'type' => 'text'
            ],
            [
                'key' => 'tagline_sekolah',
                'name' => 'Tagline Sekolah',
                'value' => 'Membangun Generasi Cerdas & Berakhlak',
                'type' => 'text'
            ],
            [
                'key' => 'landing_hero',
                'name' => 'Gambar Hero Landing Page',
                'value' => null,
                'type' => 'file'
            ],
            [
                'key' => 'deskripsi_hero',
                'name' => 'Deskripsi Hero',
                'value' => 'Bergabunglah bersama kami di Madrasah unggulan yang memadukan kurikulum pendidikan modern dengan nilai-nilai keislaman yang kokoh.',
                'type' => 'longtext'
            ],
            [
                'key' => 'tahun_ajaran',
                'name' => 'Tahun Ajaran',
                'value' => '2026/2027',
                'type' => 'text'
            ],
            // Jadwal Settings
            [
                'key' => 'jadwal_pendaftaran_mulai',
                'name' => 'Jadwal Pendaftaran (Mulai)',
                'value' => '2026-03-01',
                'type' => 'date'
            ],
            [
                'key' => 'jadwal_pendaftaran_selesai',
                'name' => 'Jadwal Pendaftaran (Selesai)',
                'value' => '2026-05-31',
                'type' => 'date'
            ],
            [
                'key' => 'jadwal_seleksi',
                'name' => 'Jadwal Seleksi',
                'value' => '2026-06-05',
                'type' => 'date'
            ],
            [
                'key' => 'jadwal_pengumuman',
                'name' => 'Jadwal Pengumuman',
                'value' => '2026-06-10',
                'type' => 'date'
            ],
            [
                'key' => 'jadwal_daftar_ulang',
                'name' => 'Jadwal Daftar Ulang',
                'value' => '2026-06-12',
                'type' => 'date'
            ],
            // Kontak Settings
            [
                'key' => 'kontak_nama_1',
                'name' => 'Kontak - Nama 1',
                'value' => 'Witri Anah Sari',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nomor_1',
                'name' => 'Kontak - Nomor 1',
                'value' => '085866918641',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nama_2',
                'name' => 'Kontak - Nama 2',
                'value' => 'Nasher Sholahuddin',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nomor_2',
                'name' => 'Kontak - Nomor 2',
                'value' => '085640503744',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nama_3',
                'name' => 'Kontak - Nama 3',
                'value' => 'M.Wildan Maulana',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nomor_3',
                'name' => 'Kontak - Nomor 3',
                'value' => '085703583815',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nama_4',
                'name' => 'Kontak - Nama 4',
                'value' => 'Taufiq Aziz',
                'type' => 'text'
            ],
            [
                'key' => 'kontak_nomor_4',
                'name' => 'Kontak - Nomor 4',
                'value' => '08888188869',
                'type' => 'text'
            ],
            // Other Settings
            [
                'key' => 'ketentuan_psbm',
                'name' => 'Ketentuan & Persyaratan',
                'value' => '<ul><li>Calon santri wajib mengisi data dengan sebenar-benarnya.</li><li>Mempersiapkan berkas scan KK, Akta Kelahiran, dan Foto terbaru.</li><li>Mengikuti tes seleksi sesuai jadwal yang ditentukan.</li><li>Mematuhi segala peraturan yang berlaku di Madrasah.</li></ul>',
                'type' => 'longtext'
            ],
            [
                'key' => 'fonnte_token',
                'name' => 'Fonnte Token (WhatsApp)',
                'value' => env('FONNTE_TOKEN', ''),
                'type' => 'text'
            ],
            [
                'key' => 'template_pesan',
                'name' => 'Template Pesan WhatsApp',
                'value' => "Selamat, pendaftaran berhasil!\nNama: [NAMA]\nNISN: [NISN]\nNomor Daftar: [NOMOR_DAFTAR]\nPassword: [PASSWORD]\nTanggal: [TANGGAL]\n\nSimpan data ini untuk login.",
                'type' => 'longtext'
            ]
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}