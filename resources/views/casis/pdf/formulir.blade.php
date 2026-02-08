<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulir Pendaftaran - {{ $casis?->nama_lengkap ?? 'Siswa' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            color: #333;
            font-size: 13px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .data-table td {
            padding: 4px;
            vertical-align: top;
        }

        .gray-bg {
            background-color: #f5f5f5;
        }

        .section-title {
            background-color: #eee;
            padding: 5px 10px;
            font-weight: bold;
            margin: 15px 0 10px 0;
            border-left: 5px solid #333;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @include('casis.pdf.kop_lap')

    <h3 align="center" style="margin-top: 10px; text-decoration: underline;">FORMULIR PENDAFTARAN</h3>

    <div class="section-title">A. DATA CALON PESERTA DIDIK</div>
    <table class="data-table">
        <tr class="gray-bg">
            <td width="30%">1. No. Pendaftaran</td>
            <td width="2%">:</td>
            <td><strong>{{ $casis?->no_pendaftaran ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>2. Nama Lengkap</td>
            <td>:</td>
            <td><strong>{{ strtoupper($casis?->nama_lengkap ?? '-') }}</strong></td>
        </tr>
        <tr class="gray-bg">
            <td>3. NISN / NIK</td>
            <td>:</td>
            <td>{{ $casis?->nisn ?? '-' }} / {{ $casis?->nik ?? '-' }}</td>
        </tr>
        <tr>
            <td>4. No. Kartu Keluarga (KK)</td>
            <td>:</td>
            <td>{{ $casis?->no_kk ?? '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>5. Jenis Kelamin</td>
            <td>:</td>
            <td>{{ ($casis?->jk ?? '') == 'L' ? 'LAKI-LAKI' : (($casis?->jk ?? '') == 'P' ? 'PEREMPUAN' : '-') }}</td>
        </tr>
        <tr>
            <td>6. Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->tempat_lahir ?? '-') }}, {{ $casis?->tgl_lahir ?
                \Carbon\Carbon::parse($casis->tgl_lahir)->translatedFormat('d
                F Y') : '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>7. Agama</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->agama ?? '-') }}</td>
        </tr>
        <tr>
            <td>8. Status dalam Keluarga</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->status_keluarga ?? '-') }}</td>
        </tr>
        <tr class="gray-bg">
            <td>9. Anak ke / Jml Saudara</td>
            <td>:</td>
            <td>{{ $casis?->anak_ke ?? '-' }} / {{ $casis?->jml_saudara ?? '-' }}</td>
        </tr>
        <tr>
            <td>10. Alamat Tempat Tinggal</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->alamat_siswa ?? '-') }}</td>
        </tr>
        <tr class="gray-bg">
            <td>11. No. WhatsApp Siswa</td>
            <td>:</td>
            <td>{{ $casis?->no_hp_siswa ?? '-' }}</td>
        </tr>
        <tr>
            <td>12. Pilihan Program</td>
            <td>:</td>
            <td>{{ strtoupper(DB::table('master_ketrampilan')->where('id', $casis?->ketrampilan_id)->value('nama') ??
                '-') }}</td>
        </tr>
        <tr class="gray-bg">
            <td>13. Hobi / Cita-cita</td>
            <td>:</td>
            <td>{{ strtoupper(DB::table('master_hobi')->where('id', $casis?->hobi_id)->value('nama') ?? '-') }} / {{
                strtoupper(DB::table('master_cita')->where('id', $casis?->cita_id)->value('nama') ?? '-') }}</td>
        </tr>
    </table>

    <div class="section-title">B. DATA AYAH KANDUNG</div>
    <table class="data-table">
        <tr class="gray-bg">
            <td width="30%">1. Nama Ayah</td>
            <td width="2%">:</td>
            <td>{{ strtoupper($casis?->nama_ayah ?? '-') }} ({{ $casis?->status_ayah ?? '-' }})</td>
        </tr>
        <tr>
            <td>2. Pendidikan</td>
            <td>:</td>
            <td>{{ DB::table('master_pendidikan')->where('id', $casis?->pendidikan_ayah_id)->value('nama') ?? '-' }}
            </td>
        </tr>
        <tr class="gray-bg">
            <td>3. Pekerjaan</td>
            <td>:</td>
            <td>{{ strtoupper(DB::table('master_pekerjaan')->where('id', $casis?->pekerjaan_ayah_id)->value('nama') ??
                '-') }}</td>
        </tr>
        <tr>
            <td>4. Penghasilan</td>
            <td>:</td>
            <td>{{ DB::table('master_penghasilan')->where('id', $casis?->penghasilan_ayah_id)->value('nama') ?? '-' }}
            </td>
        </tr>
        <tr class="gray-bg">
            <td>5. No. WhatsApp Ayah</td>
            <td>:</td>
            <td>{{ $casis?->no_hp_ayah ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">C. DATA IBU KANDUNG</div>
    <table class="data-table">
        <tr class="gray-bg">
            <td width="30%">1. Nama Ibu</td>
            <td width="2%">:</td>
            <td>{{ strtoupper($casis?->nama_ibu ?? '-') }} ({{ $casis?->status_ibu ?? '-' }})</td>
        </tr>
        <tr>
            <td>2. Pendidikan</td>
            <td>:</td>
            <td>{{ DB::table('master_pendidikan')->where('id', $casis?->pendidikan_ibu_id)->value('nama') ?? '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>3. Pekerjaan</td>
            <td>:</td>
            <td>{{ strtoupper(DB::table('master_pekerjaan')->where('id', $casis?->pekerjaan_ibu_id)->value('nama') ??
                '-') }}</td>
        </tr>
        <tr>
            <td>4. Penghasilan</td>
            <td>:</td>
            <td>{{ DB::table('master_penghasilan')->where('id', $casis?->penghasilan_ibu_id)->value('nama') ?? '-' }}
            </td>
        </tr>
        <tr class="gray-bg">
            <td>5. No. WhatsApp Ibu</td>
            <td>:</td>
            <td>{{ $casis?->no_hp_ibu ?? '-' }}</td>
        </tr>
    </table>

    <div class="page-break"></div>
    @include('casis.pdf.kop_lap')

    <div class="section-title">D. DATA WALI (Jika Ada)</div>
    <table class="data-table">
        <tr class="gray-bg">
            <td width="30%">1. Nama Wali</td>
            <td width="2%">:</td>
            <td>{{ strtoupper($casis?->nama_wali ?: '-') }}</td>
        </tr>
        <tr>
            <td>2. Hubungan / Status</td>
            <td>:</td>
            <td>{{ $casis?->status_wali ?: '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>3. Pekerjaan</td>
            <td>:</td>
            <td>{{ strtoupper(DB::table('master_pekerjaan')->where('id', $casis?->pekerjaan_wali_id)->value('nama') ??
                '-') }}</td>
        </tr>
        <tr>
            <td>4. No. WhatsApp Wali</td>
            <td>:</td>
            <td>{{ $casis?->no_hp_wali ?: '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>5. Alamat Wali</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->alamat_wali ?: '-') }}</td>
        </tr>
    </table>

    <div class="section-title">E. DATA ASAL SEKOLAH</div>
    <table class="data-table">
        <tr class="gray-bg">
            <td width="30%">1. Nama Sekolah</td>
            <td width="2%">:</td>
            <td>{{ strtoupper($casis?->nama_sekolah ?? '-') }} ({{ $casis?->jenis_sekolah ?? '-' }})</td>
        </tr>
        <tr>
            <td>2. Status / NPSN Sekolah</td>
            <td>:</td>
            <td>{{ $casis?->status_sekolah ?? '-' }} / {{ $casis?->npsn_sekolah ?? '-' }}</td>
        </tr>
        <tr class="gray-bg">
            <td>3. Akreditasi Sekolah</td>
            <td>:</td>
            <td>{{ $casis?->akreditasi_sekolah ?? '-' }}</td>
        </tr>
        <tr>
            <td>4. Alamat Sekolah</td>
            <td>:</td>
            <td>{{ strtoupper($casis?->alamat_sekolah ?? '-') }}</td>
        </tr>
    </table>

    <div style="margin-left: 65%; margin-top: 50px;">
        Tegal, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
        Calon Peserta PMBM
        <br><br><br><br>
        <strong>{{ strtoupper($casis?->nama_lengkap ?? '-') }}</strong>
    </div>
</body>

</html>