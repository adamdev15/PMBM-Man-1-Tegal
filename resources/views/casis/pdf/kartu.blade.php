<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu Pendaftaran - {{ $casis?->nama_lengkap ?? 'Siswa' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.4;
            color: #333;
            font-size: 14px;
        }

        table {
            border-collapse: collapse;
        }

        .content-table td {
            padding: 2px;
        }

        .photo-box {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 95px;
            height: 120px;
            border: 1px solid #000;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-box img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    @php
    $foto_berkas = $casis->berkas->where('nama_berkas', 'foto')->first();
    @endphp
    @include('casis.pdf.kop_lap')

    <h3 align="center" style="margin-top: 5px; text-decoration: underline;">KARTU PENDAFTARAN</h3>

    <div style="position: relative; min-height: 160px;">
        <table class="content-table" width="100%" border="0">
            <tr>
                <td width="200">NO. PENDAFTARAN</td>
                <td width="10">:</td>
                <td><strong>{{ $casis?->no_pendaftaran ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>NAMA LENGKAP/NISN</td>
                <td>:</td>
                <td><strong>{{ strtoupper($casis?->nama_lengkap ?? '-') }}/{{ $casis?->nisn ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>JENIS KELAMIN</td>
                <td>:</td>
                <td>{{ ($casis?->jk ?? '') == 'L' ? 'LAKI-LAKI' : (($casis?->jk ?? '') == 'P' ? 'PEREMPUAN' : '-') }}
                </td>
            </tr>
            <tr>
                <td>TEMPAT, TANGGAL LAHIR</td>
                <td>:</td>
                <td>{{ strtoupper($casis?->tempat_lahir ?? '-') }}, {{
                    $casis?->tgl_lahir ? \Carbon\Carbon::parse($casis->tgl_lahir)->translatedFormat('d F Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td>ASAL SEKOLAH/PROGRAM</td>
                <td>:</td>
                <td>{{ strtoupper($casis?->nama_sekolah ?? '-') }}/{{
                    $casis?->ketrampilan_id ? strtoupper(DB::table('master_ketrampilan')->where('id',
                    $casis->ketrampilan_id)->value('nama') ?? '-') : '-'
                    }}</td>
            </tr>
        </table>

        <div class="photo-box">
            @if($foto_berkas)
            <img src="{{ public_path('storage/' . $foto_berkas->path) }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
            <span style="font-size: 10px; color: #999;">PAS FOTO 3X4</span>
            @endif
        </div>
    </div>

    <div style="margin-left: 65%; margin-top: 2px;">
        Tegal, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
        <strong>Panitia PMBM MAN 1 Tegal</strong>
        <br><br><br><br>
        ( ......................................... )
    </div>

    <div style="margin-top: 30px; border-top: 1px dashed #000; padding-top: 30px;">
        @include('casis.pdf.kop_lap')
        <h3 align="center" style="margin-top: 5px; text-decoration: underline;">KARTU PENDAFTARAN</h3>

        <div style="position: relative; min-height: 160px;">
            <table class="content-table" width="100%" border="0">
                <tr>
                    <td width="200">NO. PENDAFTARAN</td>
                    <td width="10">:</td>
                    <td><strong>{{ $casis?->no_pendaftaran ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td>NAMA LENGKAP/NISN</td>
                    <td>:</td>
                    <td><strong>{{ strtoupper($casis?->nama_lengkap ?? '-') }}/{{ $casis?->nisn ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td>JENIS KELAMIN</td>
                    <td>:</td>
                    <td>{{ ($casis?->jk ?? '') == 'L' ? 'LAKI-LAKI' : (($casis?->jk ?? '') == 'P' ? 'PEREMPUAN' : '-')
                        }}</td>
                </tr>
                <tr>
                    <td>TEMPAT, TANGGAL LAHIR</td>
                    <td>:</td>
                    <td>{{ strtoupper($casis?->tempat_lahir ?? '-') }}, {{
                        $casis?->tgl_lahir ? \Carbon\Carbon::parse($casis->tgl_lahir)->translatedFormat('d F Y') : '-'
                        }}</td>
                </tr>
                <tr>
                    <td>ASAL SEKOLAH/PROGRAM</td>
                    <td>:</td>
                    <td>{{ strtoupper($casis?->nama_sekolah ?? '-') }}/{{
                        $casis?->ketrampilan_id ? strtoupper(DB::table('master_ketrampilan')->where('id',
                        $casis->ketrampilan_id)->value('nama') ?? '-') : '-'
                        }}</td>
                </tr>
            </table>

            <div class="photo-box">
                @if($foto_berkas)
                <img src="{{ public_path('storage/' . $foto_berkas->path) }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
                @else
                <span style="font-size: 10px; color: #999;">PAS FOTO 3X4</span>
                @endif
            </div>
        </div>

        <div style="margin-left: 65%; margin-top: 2px;">
            Tegal, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
            <strong>Panitia PMBM MAN 1 Tegal</strong>
            <br><br><br><br>
            ( ......................................... )
        </div>
    </div>
</body>

</html>