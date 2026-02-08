<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta Pendaftaran - PMBM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen font-inter" x-data="{ activeTab: '{{ session('activeTab', 'overview') }}' }">

    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <div
                        class="bg-green-600 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-green-200">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18.5a6 6 0 1 0 1.838-4.162L12 12l2.162-2.338A6 6 0 1 0 12 3.5M12 18.5l1.5 1.5M12 18.5l-1.5 1.5M12 3.5l1.5-1.5m-1.5 1.5l-1.5-1.5M6.023 11.977l-1.53 1.53m1.53-1.53l-1.53-1.53m11.954 1.53l1.53 1.53m-1.53-1.53l1.53-1.53" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold text-gray-900 tracking-tight">MAN 1 TEGAL</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col items-end">
                        <span class="text-sm font-bold text-gray-900 leading-none">{{ $casis->nama_lengkap }}</span>
                        <span
                            class="text-[10px] text-gray-500 mt-1 bg-gray-100 px-2 py-0.5 rounded uppercase font-bold tracking-wider">NISN:
                            {{ $casis->nisn }}</span>
                    </div>
                    <form action="{{ route('casis.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <!-- Welcome Header -->
        <div
            class="mb-8 p-8 bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-green-50 rounded-full opacity-50 blur-3xl">
            </div>
            <div class="relative flex items-center gap-5">
                <div
                    class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 shadow-sm">
                    <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang, {{ explode(' ',
                        $casis->nama_lengkap)[0] }}!</h1>
                    <p class="text-gray-500 text-sm mt-1 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                        </svg>
                        Nomor Pendaftaran: <span class="font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded">{{
                            $casis->no_pendaftaran }}</span>
                    </p>
                </div>
            </div>
            <div class="relative flex items-center gap-3 bg-gray-50 p-3 rounded-2xl border border-gray-100">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Verifikasi</span>
                <span
                    class="px-4 py-1.5 rounded-xl text-xs font-bold shadow-sm {{ $casis->status_verifikasi == 'Diverifikasi' ? 'bg-green-500 text-white' : 'bg-amber-400 text-white' }}">
                    {{ strtoupper($casis->status_verifikasi) }}
                </span>
            </div>
        </div>

        <!-- Info Cards Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm cursor-pointer hover:shadow-xl hover:shadow-blue-100 hover:-translate-y-1 transition-all duration-300 group"
                @click="activeTab = 'biodata'">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-3 bg-blue-50 rounded-2xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Biodata</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Informasi</p>
                <p class="text-xl font-black text-gray-900">Diri Siswa</p>
            </div>

            <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm cursor-pointer hover:shadow-xl hover:shadow-emerald-100 hover:-translate-y-1 transition-all duration-300 group"
                @click="activeTab = 'ortu'">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2h4a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h4Zm0 0V5h6v12M9 17h6M9 13h6" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Keluarga</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Data Ayah &</p>
                <p class="text-xl font-black text-gray-900">Ibu Kandung</p>
            </div>

            <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm cursor-pointer hover:shadow-xl hover:shadow-amber-100 hover:-translate-y-1 transition-all duration-300 group"
                @click="activeTab = 'wali'">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-3 bg-amber-50 rounded-2xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Wali</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Data</p>
                <p class="text-xl font-black text-gray-900">Wali Siswa</p>
            </div>

            <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm cursor-pointer hover:shadow-xl hover:shadow-indigo-100 hover:-translate-y-1 transition-all duration-300 group"
                @click="activeTab = 'nilai'">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-3 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2Zm0 0h14M9 7h6m-6 4h6m-6 4h3" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Akademik</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Rekap Nilai</p>
                <p class="text-xl font-black text-gray-900">Rapor Sekolah</p>
            </div>
        </div>

        <!-- Main Content Area with Navigation Menu -->
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Side Navigation -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-4 border-b bg-gray-50/50">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Menu Informasi</span>
                    </div>
                    <div class="p-2 space-y-1">
                        <button @click="activeTab = 'overview'"
                            :class="activeTab === 'overview' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            Status Pendaftaran
                        </button>
                        <button @click="activeTab = 'biodata'"
                            :class="activeTab === 'biodata' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Biodata Siswa
                        </button>
                        <button @click="activeTab = 'ortu'"
                            :class="activeTab === 'ortu' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2h4a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h4Zm0 0V5h6v12M9 17h6M9 13h6" />
                            </svg>
                            Data Ayah & Ibu
                        </button>
                        <button @click="activeTab = 'wali'"
                            :class="activeTab === 'wali' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Data Wali
                        </button>
                        <button @click="activeTab = 'nilai'"
                            :class="activeTab === 'nilai' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2Zm0 0h14M9 7h6m-6 4h6m-6 4h3" />
                            </svg>
                            Nilai Rapor
                        </button>
                        <button @click="activeTab = 'dokumen'"
                            :class="activeTab === 'dokumen' ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-bold transition flex items-center gap-3">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2" />
                            </svg>
                            Dokumen
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Panel -->
            <div class="lg:w-3/4">
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" x-transition>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Status Pendaftaran</h2>

                        @php
                        $required_berkas = [
                        'ijazah' => 'Ijazah SMP/MTs',
                        'raport' => 'Raport Semester 3-5',
                        'foto' => 'Pas Foto 3x4',
                        'akta' => 'Akta Kelahiran',
                        'kk' => 'Kartu Keluarga',
                        'nisn' => 'Kartu NISN'
                        ];
                        $missing_berkas = [];
                        foreach ($required_berkas as $key => $label) {
                        if (!$casis->berkas->where('nama_berkas', $key)->first()) {
                        $missing_berkas[] = $label;
                        }
                        }
                        $is_dokumen_lengkap = empty($missing_berkas);
                        @endphp

                        @if(!$is_dokumen_lengkap)
                        <div class="mb-6 p-5 rounded-2xl bg-amber-50 border border-amber-200 flex items-start gap-4">
                            <div class="p-2 bg-amber-100 rounded-xl text-amber-600">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-bold text-amber-900 mb-1">Dokumen Wajib Belum Lengkap</h3>
                                <p class="text-xs text-amber-700 leading-relaxed">
                                    Mohon segera lengkapi dokumen berikut untuk memproses verifikasi dan mengaktifkan
                                    tombol cetak kartu:
                                </p>
                                <ul class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-1">
                                    @foreach($missing_berkas as $missing)
                                    <li class="flex items-center gap-2 text-xs font-bold text-amber-800">
                                        <svg class="w-3 h-3 text-amber-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        {{ $missing }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <button @click="activeTab = 'dokumen'"
                                class="text-xs font-black text-amber-600 hover:text-amber-700 underline uppercase tracking-widest whitespace-nowrap pt-1">Lengkapi</button>
                        </div>
                        @endif

                        <div
                            class="p-6 rounded-2xl border-2 border-dashed {{ $casis->status_verifikasi == 'Diverifikasi' ? 'border-green-200 bg-green-50/30' : 'border-yellow-200 bg-yellow-50/30' }}">
                            <div class="flex items-start gap-4">
                                @if($casis->status_verifikasi == 'Diverifikasi')
                                <svg class="w-8 h-8 text-green-500 flex-shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                                @else
                                <svg class="w-8 h-8 text-amber-500 animate-pulse flex-shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @endif
                                <div>
                                    <p class="font-bold text-gray-900 mb-2">
                                        @if($casis->status_verifikasi == 'Diverifikasi')
                                        Data Anda Telah Diverifikasi
                                        @else
                                        Pendaftaran Menunggu Verifikasi
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        @if($casis->status_verifikasi == 'Diverifikasi')
                                        Selamat! Panitia telah memproses data Anda. Silakan unduh dan cetak Kartu Bukti
                                        Pendaftaran Anda sebagai syarat daftar ulang.
                                        @else
                                        Terima kasih telah melakukan pendaftaran. Saat ini data Anda sedang dalam
                                        antrian verifikasi petugas. Mohon cek halaman ini secara berkala.
                                        @endif
                                    </p>

                                    <!-- Tombol Cetak (Hanya jika Diverifikasi) -->
                                    @if($casis->status_verifikasi == 'Diverifikasi')
                                    @if($is_dokumen_lengkap)
                                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                                        <a href="{{ route('casis.print.kartu') }}" target="_blank"
                                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-black uppercase tracking-widest text-xs py-4 rounded-2xl shadow-xl shadow-green-200 transition-all active:scale-95 flex items-center justify-center gap-3">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Cetak Kartu Peserta
                                        </a>
                                        <a href="{{ route('casis.print.formulir') }}" target="_blank"
                                            class="flex-1 bg-white hover:bg-gray-50 text-gray-600 font-bold uppercase tracking-widest text-[10px] py-4 rounded-2xl border border-gray-100 transition-all flex items-center justify-center gap-2">
                                            Cetak Formulir
                                        </a>
                                    </div>

                                    <!-- Hasil Seleksi Section (Muncul jika status bukan 'Proses') -->
                                    @if($casis->status_kelulusan != 'Proses')
                                    <div
                                        class="mt-8 p-8 bg-gray-900 rounded-[2.5rem] text-white relative overflow-hidden shadow-2xl">
                                        <div
                                            class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl">
                                        </div>

                                        <div
                                            class="relative flex flex-col md:flex-row items-center justify-between gap-8">
                                            <div class="flex items-center gap-6">
                                                <div
                                                    class="w-20 h-20 {{ $casis->status_kelulusan == 'Lulus' ? 'bg-green-500' : ($casis->status_kelulusan == 'Cadangan' ? 'bg-amber-500' : 'bg-red-500') }} rounded-[2rem] flex items-center justify-center shadow-2xl">
                                                    @if($casis->status_kelulusan == 'Lulus')
                                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    @else
                                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40 mb-1">
                                                        Hasil Seleksi Akhir</p>
                                                    <h3 class="text-3xl font-black uppercase tracking-tight">
                                                        @if($casis->status_kelulusan == 'Lulus')
                                                        Selamat, Anda LULUS!
                                                        @elseif($casis->status_kelulusan == 'Cadangan')
                                                        Status: CADANGAN
                                                        @else
                                                        Mohon Maaf, TIDAK LULUS
                                                        @endif
                                                    </h3>
                                                    <div class="flex gap-4 mt-3">
                                                        <div
                                                            class="bg-white/10 px-3 py-1 rounded-xl border border-white/5">
                                                            <span
                                                                class="text-[9px] text-white/50 uppercase block font-bold">Nilai
                                                                TPA</span>
                                                            <span class="text-sm font-black">{{ $casis->nilai_tpa ??
                                                                '0.00' }}</span>
                                                        </div>
                                                        <div
                                                            class="bg-white/10 px-3 py-1 rounded-xl border border-white/5">
                                                            <span
                                                                class="text-[9px] text-white/50 uppercase block font-bold">Wawancara</span>
                                                            <span class="text-sm font-black">{{ $casis->nilai_wawancara
                                                                ?? '0.00' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($casis->status_kelulusan == 'Lulus')
                                            <div
                                                class="flex flex-col items-center md:items-end text-center md:text-right">
                                                <p class="text-xs text-white/70 leading-relaxed mb-4">Silakan lakukan
                                                    pendaftaran ulang sesuai jadwal yang ditentukan.</p>
                                                <a href="#"
                                                    class="bg-white text-gray-900 px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-transform shadow-xl">
                                                    Panduan Daftar Ulang
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    @else
                                    <div
                                        class="mt-4 inline-flex items-center gap-2 bg-gray-100 text-gray-400 px-6 py-2.5 rounded-xl font-bold cursor-not-allowed">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                                        </svg>
                                        Cetak Kartu (Dokumen Belum Lengkap)
                                    </div>
                                    @endif
                                    @else
                                    <div
                                        class="mt-8 p-6 bg-amber-50 rounded-2xl border border-amber-100 flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-amber-400 text-white rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-amber-900">Akun Belum Diverifikasi</p>
                                            <p class="text-xs text-amber-700">Silakan tunggu petugas memverifikasi
                                                berkas Anda.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biodata Tab -->
                <div x-show="activeTab === 'biodata'" x-cloak x-transition>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b bg-gray-50/50 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-900">Biodata Lengkap</h2>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('casis.print.formulir') }}"
                                    class="text-xs bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg font-bold transition flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                            d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                                    </svg>
                                    Cetak Formulir
                                </a>
                                <span class="text-xs font-bold text-gray-400">ID: #{{ $casis->id }}</span>
                            </div>
                        </div>
                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Nama Lengkap</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->nama_lengkap }}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">NISN</span><span
                                        class="col-span-2 font-bold text-gray-900 text-blue-600">{{ $casis->nisn
                                        }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">NIK / No. KK</span><span
                                        class="col-span-2 font-bold text-gray-900 text-gray-600">{{ $casis->nik }} / {{
                                        $casis->no_kk }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Jenis
                                        Kelamin</span><span class="col-span-2 font-bold text-gray-900">{{ $casis->jk ==
                                        'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Tempat, Tgl
                                        Lahir</span><span class="col-span-2 font-bold text-gray-900">{{
                                        $casis->tempat_lahir }}, {{ \Carbon\Carbon::parse($casis->tgl_lahir)->format('d
                                        F Y') }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Agama</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->agama }}</span></div>
                            </div>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Anak Ke-</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->anak_ke }} dari {{
                                        $casis->jml_saudara }} Saudara</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">WA Siswa</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->no_hp_siswa }}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Program</span><span
                                        class="col-span-2 font-bold text-gray-900">{{
                                        DB::table('master_ketrampilan')->find($casis->ketrampilan_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Hobi / Cita</span><span
                                        class="col-span-2 font-bold text-gray-900">{{
                                        DB::table('master_hobi')->find($casis->hobi_id)->nama ?? '-' }} / {{
                                        DB::table('master_cita')->find($casis->cita_id)->nama ?? '-' }}</span></div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Alamat</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->alamat_siswa }}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2"><span class="text-gray-500">Sekolah Asal</span><span
                                        class="col-span-2 font-bold text-gray-900">{{ $casis->nama_sekolah }} ({{
                                        $casis->npsn_sekolah }})</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ortu Tab -->
                <div x-show="activeTab === 'ortu'" x-cloak x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Data Ayah -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b bg-blue-50/50">
                                <h2 class="text-lg font-bold text-blue-900">Data Ayah Kandung</h2>
                            </div>
                            <div class="p-6 space-y-4 text-sm">
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Nama Ayah</span><span
                                        class="font-bold text-gray-900">{{ $casis->nama_ayah }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Status</span><span
                                        class="font-bold text-gray-900">{{ $casis->status_ayah }}</span></div>
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Pendidikan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pendidikan')->find($casis->pendidikan_ayah_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Pekerjaan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pekerjaan')->find($casis->pekerjaan_ayah_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Penghasilan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_penghasilan')->find($casis->penghasilan_ayah_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">WhatsApp</span><span
                                        class="font-bold text-blue-600">{{ $casis->no_hp_ayah }}</span></div>
                            </div>
                        </div>
                        <!-- Data Ibu -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b bg-pink-50/50">
                                <h2 class="text-lg font-bold text-pink-900">Data Ibu Kandung</h2>
                            </div>
                            <div class="p-6 space-y-4 text-sm">
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Nama Ibu</span><span
                                        class="font-bold text-gray-900">{{ $casis->nama_ibu }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Status</span><span
                                        class="font-bold text-gray-900">{{ $casis->status_ibu }}</span></div>
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Pendidikan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pendidikan')->find($casis->pendidikan_ibu_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Pekerjaan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pekerjaan')->find($casis->pekerjaan_ibu_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Penghasilan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_penghasilan')->find($casis->penghasilan_ibu_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">WhatsApp</span><span
                                        class="font-bold text-pink-600">{{ $casis->no_hp_ibu }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wali Tab -->
                <div x-show="activeTab === 'wali'" x-cloak x-transition>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b bg-amber-50/50">
                            <h2 class="text-xl font-bold text-amber-900">Data Wali Siswa</h2>
                        </div>
                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                            <div class="space-y-4">
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Nama Wali</span><span
                                        class="font-bold text-gray-900">{{ $casis->nama_wali ?: '-' }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Hubungan /
                                        Status</span><span class="font-bold text-gray-900">{{ $casis->status_wali ?: '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">NIK Wali</span><span
                                        class="font-bold text-gray-900">{{ $casis->nik_wali ?: '-' }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">WhatsApp
                                        Wali</span><span class="font-bold text-amber-600">{{ $casis->no_hp_wali ?: '-'
                                        }}</span></div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Pendidikan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pendidikan')->find($casis->pendidikan_wali_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Pekerjaan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_pekerjaan')->find($casis->pekerjaan_wali_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span
                                        class="text-gray-500 font-medium">Penghasilan</span><span
                                        class="font-bold text-gray-900">{{
                                        DB::table('master_penghasilan')->find($casis->penghasilan_wali_id)->nama ?? '-'
                                        }}</span></div>
                                <div class="flex flex-col"><span class="text-gray-500 font-medium">Alamat
                                        Wali</span><span class="font-bold text-gray-900">{{ $casis->alamat_wali ?: '-'
                                        }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nilai Tab -->
                <div x-show="activeTab === 'nilai'" x-cloak x-transition>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b bg-indigo-50/50 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-indigo-900">Rekap Nilai Rapor (Semester 3-5)</h2>
                            <a href="{{ route('casis.print.rekap') }}"
                                class="text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                                </svg>
                                Cetak Rekap Nilai
                            </a>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead class="text-xs text-gray-400 uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3">Semester</th>
                                            <th class="px-6 py-3 text-center">IPA</th>
                                            <th class="px-6 py-3 text-center">IPS</th>
                                            <th class="px-6 py-3 text-center">MTK</th>
                                            <th class="px-6 py-3 text-center">B. IND</th>
                                            <th class="px-6 py-3 text-center">B. ING</th>
                                            <th class="px-6 py-3 text-center font-bold">AVG</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($casis->nilaiRapor as $nilai)
                                        @php $avg = ($nilai->ipa + $nilai->ips + $nilai->matematika + $nilai->bind
                                        +$nilai->bing) / 5; @endphp
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 font-bold text-gray-900">Semester {{ $nilai->semester
                                                }}</td>
                                            <td class="px-6 py-4 text-center">{{ $nilai->ipa }}</td>
                                            <td class="px-6 py-4 text-center">{{ $nilai->ips }}</td>
                                            <td class="px-6 py-4 text-center">{{ $nilai->matematika }}</td>
                                            <td class="px-6 py-4 text-center">{{ $nilai->bind }}</td>
                                            <td class="px-6 py-4 text-center">{{ $nilai->bing }}</td>
                                            <td class="px-6 py-4 text-center font-bold text-green-600">{{
                                                number_format($avg, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Tab -->
                <div x-show="activeTab === 'dokumen'" x-cloak x-transition>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-900">Upload Dokumen Scan Asli</h2>
                            <p class="text-xs text-gray-500 mt-1">Format PDF (maks 2MB) kecuali Foto (PNG/JPG) maks 2MB
                            </p>
                        </div>
                        <div class="p-6">
                            @php
                            $daftar_berkas = [
                            ['id' => 'ijazah', 'label' => '1. Ijazah SMP/MTs (2023/2024 atau 2024/2025)', 'required' =>
                            true],
                            ['id' => 'raport', 'label' => '2. Raport Semester 3, 4, dan 5', 'required' => true],
                            ['id' => 'foto', 'label' => '3. Foto Setengah Badan (Background Merah, Seragam Asal)',
                            'required' => true, 'type' => 'image'],
                            ['id' => 'akta', 'label' => '4. Akta Kelahiran', 'required' => true],
                            ['id' => 'kk', 'label' => '5. Kartu Keluarga', 'required' => true],
                            ['id' => 'nisn', 'label' => '6. Kartu NISN', 'required' => true],
                            ['id' => 'mda', 'label' => '7. Ijazah MDA/MDW', 'required' => false],
                            ['id' => 'kip', 'label' => '8. Kartu PKH, KIP, KKS', 'required' => false],
                            ['id' => 'peringkat', 'label' => '9. Surat Keterangan Peringkat Paralel/Kelas', 'required'
                            => false],
                            ['id' => 'piagam', 'label' => '10. Sertifikat/Piagam Kejuaraan (Minimal Kab)', 'required' =>
                            false],
                            ['id' => 'tahfidz', 'label' => '11. Surat Keterangan / Ijazah Tahfidz', 'required' =>
                            false],
                            ];
                            @endphp

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($daftar_berkas as $item)
                                @php
                                $berkas_saved = $casis->berkas->where('nama_berkas', $item['id'])->first();
                                @endphp
                                <div
                                    class="p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:border-green-200 transition-colors">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900">{{ $item['label'] }}</h3>
                                            @if($item['required'])
                                            <span
                                                class="text-[10px] text-red-500 font-bold uppercase tracking-wider">Wajib</span>
                                            @else
                                            <span
                                                class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Opsional</span>
                                            @endif
                                        </div>
                                        @if($berkas_saved)
                                        <span
                                            class="bg-green-100 text-green-700 text-[10px] font-black px-2 py-1 rounded-lg uppercase">Tersimpan</span>
                                        @else
                                        <span
                                            class="bg-gray-100 text-gray-400 text-[10px] font-black px-2 py-1 rounded-lg uppercase">Belum
                                            Ada</span>
                                        @endif
                                    </div>

                                    <form action="{{ route('casis.upload.berkas') }}" method="POST"
                                        enctype="multipart/form-data" class="space-y-3">
                                        @csrf
                                        <input type="hidden" name="nama_berkas" value="{{ $item['id'] }}">

                                        <div class="flex items-center gap-2">
                                            <input type="file" name="file" required
                                                class="block w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all cursor-pointer"
                                                accept="{{ isset($item['type']) && $item['type'] == 'image' ? 'image/*' : 'application/pdf' }}">
                                            <button type="submit"
                                                class="bg-green-600 text-white p-2 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>

                                        @if($berkas_saved)
                                        <div class="flex items-center gap-2 pt-2 border-t border-gray-50">
                                            <a href="{{ asset('storage/' . $berkas_saved->path) }}" target="_blank"
                                                class="text-[10px] font-bold text-blue-600 hover:underline flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat File
                                            </a>
                                            <span class="text-[10px] text-gray-300">|</span>
                                            <span class="text-[10px] text-gray-400 capitalize">{{
                                                number_format($berkas_saved->size / 1024, 0) }} KB</span>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Ok!',
            confirmButtonColor: '#16a34a',
            customClass: {
                confirmButton: 'px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-green-500/30 bg-green-600 text-white hover:bg-green-700'
            },
            buttonsStyling: false
        });
    </script>
    @endif


    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Opps!',
            text: "{{ $errors->first() }}",
            confirmButtonText: 'Tutup',
            customClass: {
                confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-white bg-red-600 hover:bg-red-700 transition-all shadow-lg hover:shadow-red-500/30'
            },
            buttonsStyling: false
        });
    </script>
    @endif

</body>

</html>