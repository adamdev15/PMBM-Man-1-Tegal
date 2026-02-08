<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMBM MAN 1 Tegal - Penerimaan Murid Baru Madrasah</title>
    <meta name="description" content="PMBM - Penerimaan Murid Baru Madrasah dari Kementerian Agama Republik Indonesia">
    <meta name="keywords" content="PMBM, Penerimaan Murid Baru Madrasah, PMBM, Kementerian Agama Republik Indonesia">
    <meta name="author" content="PMBM">
    <link rel="icon" href="{{ asset('images/logo_kemenag.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700|playfair-display:600,800&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans text-gray-800 bg-gray-50" x-data="landingPage()" x-init="init()">

    <!-- Navbar -->
    <nav x-data="{ open: false }"
        class="bg-white/80 backdrop-blur-md fixed w-full z-50 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                    @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-10 w-auto">
                    @endif
                    <h1 class="text-2xl font-bold text-green-700 tracking-tight font-playfair">PMBM <span
                            class="text-gray-600 font-sans text-lg">{{ $settings['nama_sekolah'] ?? 'PMBM MAN 1 Tegal' }}</span></h1>
                </div>
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#about" class="text-gray-600 hover:text-green-600 font-medium transition">Beranda</a>
                    <a href="#program" class="text-gray-600 hover:text-green-600 font-medium transition">Jadwal</a>
                    <a href="#procedure" class="text-gray-600 hover:text-green-600 font-medium transition">Alur Pendaftaran</a>
                    <a href="#contact" class="text-gray-600 hover:text-green-600 font-medium transition">Kontak</a>
                    <button @click="handleDaftarClick()"
                        class="px-6 py-2.5 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-0.5">Daftar
                        Sekarang</button>
                    <a href="{{ route('casis.login') }}"
                        class="text-green-600 font-medium hover:text-green-800 transition">Masuk</a>
                </div>
                <!-- Mobile Button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none ring-2 ring-inset ring-green-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" x-show="!open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" x-show="open" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#about"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50">Tentang</a>
                <a href="#program"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50">Program
                    Unggulan</a>
                    <button @click="handleDaftarClick()"
                        class="block w-full px-3 py-2 mt-4 text-center rounded-md text-base font-medium bg-green-600 text-white hover:bg-green-700">Daftar
                        Sekarang</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-24 pb-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div
                        class="inline-flex items-center px-3 py-1 rounded-full border border-green-100 bg-green-50 text-green-700 text-xs font-semibold mb-6 animate-fade-in-up">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span> Penerimaan Murid Baru
                        Madrasah Tahun Ajaran {{ $settings['tahun_ajaran'] ?? '2026/2027' }}
                    </div>
                    @php
                        $tagline = explode('|', $settings['tagline_sekolah'] ?? '');
                    @endphp

                    <h1
                        class="text-4xl tracking-tight font-extrabold text-gray-900 
                            sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl 
                            font-playfair leading-tight mb-6">

                        {{ $tagline[0] ?? '' }}
                        <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-500">
                            {{ $tagline[1] ?? '' }}
                        </span>

                    </h1>
                    <p
                        class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        {!! $settings['deskripsi_hero'] ?? 'Bergabunglah bersama kami di Madrasah unggulan yang memadukan kurikulum pendidikan modern dengan nilai-nilai keislaman yang kokoh.' !!}
                    </p>
                    <div
                        class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0 flex flex-col sm:flex-row gap-4">
                    <button @click="handleDaftarClick()"
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-green-600 hover:bg-green-700 md:text-lg md:px-10 shadow-xl shadow-green-500/20 transition transform hover:-translate-y-1">
                            Daftar Sekarang
                        </button>
                        <a href="#procedure"
                            class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 md:text-lg md:px-10 shadow-sm transition">
                            Lihat Prosedur
                        </a>
                    </div>
                    <div
                        class="mt-10 flex items-center gap-x-6 sm:justify-center lg:justify-start text-sm text-gray-500">
                        <div class="flex items-center gap-1">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Terakreditasi A
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Fasilitas Lengkap
                        </div>
                    </div>
                </div>
                <div
                    class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <div
                            class="relative block w-full bg-white rounded-lg overflow-hidden ring-1 ring-black ring-opacity-5">
                            <img class="w-full object-cover transform hover:scale-105 transition duration-700"
                                src="{{ !empty($settings['landing_hero']) ? asset('storage/' . $settings['landing_hero']) : asset('images/landing_hero.png') }}" 
                                alt="{{ $settings['nama_sekolah'] ?? 'Madrasah Students' }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-green-900/30 to-transparent"></div>
                        </div>
                    </div>
                    <!-- Decorative elements -->
                    <div
                        class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="absolute -bottom-8 -left-4 w-24 h-24 bg-green-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Jadwal Section -->
    <div id="program" class="py-16 bg-white from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-base font-bold text-green-600 tracking-wide uppercase">Jadwal Pendaftaran</h2>
                    <p
                        class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl font-playfair">
                        Ikuti jadwal kegiatan pendaftaran
                    </p>
            </div>

                    <div class="p-4 md:p-12 bg-white">
                            @php
                                use Carbon\Carbon;

                                $jadwalItems = [
                                    ['key' => 'jadwal_pendaftaran_mulai', 'label' => 'Pendaftaran Dibuka', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'step' => 1],
                                    ['key' => 'jadwal_pendaftaran_selesai', 'label' => 'Pendaftaran Ditutup', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'step' => 2],
                                    ['key' => 'jadwal_seleksi', 'label' => 'Tes Seleksi', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'step' => 3],
                                    ['key' => 'jadwal_pengumuman', 'label' => 'Pengumuman', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z', 'step' => 4],
                                    ['key' => 'jadwal_daftar_ulang', 'label' => 'Daftar Ulang', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'step' => 5],
                                ];
                            @endphp

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 relative">
                                    @foreach($jadwalItems as $item)
                                    @php
                                        $date = $settings[$item['key']] ?? null;
                                        $parsedDate = $date ? \Carbon\Carbon::parse($date) : null;
                                    @endphp

                                    <div class="relative group">

                                        <div class="rounded-xl p-5 bg-gradient-to-r from-green-500 via-emerald-500 to-green-600 shadow-xl hover:shadow-xl transition duration-300 h-full">

                                            <div class="flex justify-center mb-4 mt-5">
                                                <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-lg font-bold transition group-hover:bg-green-600 group-hover:text-white">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="{{ $item['icon'] }}">
                                                    </path>
                                                </svg>
                                                </div>
                                            </div>

                                            <h4 class="text-center font-bold text-gray-800 text-md mb-4">
                                                {{ $item['label'] }}
                                            </h4>

                                            @if($parsedDate)
                                                <div class="bg-green-50 rounded-lg p-2 text-center shadow-sm">
                                                    <div class="text-xl font-bold text-green-600">
                                                        {{ $parsedDate->format('d') }}
                                                    </div>

                                                    @php \Carbon\Carbon::setLocale('id'); @endphp

                                                    <div class="text-sm text-gray-600 font-semibold">
                                                        {{ $parsedDate->translatedFormat('l, d F Y') }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                                                    <p class="text-sm text-gray-400 italic">-</p>
                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>
                    </div>
        </div>
    </div>

    <!-- End Jadwal Section -->

    <!-- Flow Section -->
    <div id="procedure" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-bold text-green-600 tracking-wide uppercase">Alur Pendaftaran</h2>
                <p
                    class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl font-playfair">
                    Mudah dan Transparan
                </p>
            </div>
            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                    <!-- Step 1 -->
                    <div
                        class="relative p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition text-center group">
                        <div
                            class="w-12 h-12 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold group-hover:bg-green-600 group-hover:text-white transition">
                            1</div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Isi Formulir</h3>
                        <p class="mt-2 text-base text-gray-500">Lengkapi data diri dan orang tua secara online.</p>
                    </div>
                    <!-- Step 2 -->
                    <div
                        class="relative p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition text-center group">
                        <div
                            class="w-12 h-12 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold group-hover:bg-green-600 group-hover:text-white transition">
                            2</div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Upload Berkas</h3>
                        <p class="mt-2 text-base text-gray-500">Unggah dokumen persyaratan yang dibutuhkan.</p>
                    </div>
                    <!-- Step 3 -->
                    <div
                        class="relative p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition text-center group">
                        <div
                            class="w-12 h-12 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold group-hover:bg-green-600 group-hover:text-white transition">
                            3</div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Verifikasi</h3>
                        <p class="mt-2 text-base text-gray-500">Panitia akan memverifikasi data Anda.</p>
                    </div>
                    <!-- Step 4 -->
                    <div
                        class="relative p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-lg transition text-center group">
                        <div
                            class="w-12 h-12 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold group-hover:bg-green-600 group-hover:text-white transition">
                            4</div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Pengumuman</h3>
                        <p class="mt-2 text-base text-gray-500">Cek hasil seleksi dan daftar ulang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak Section -->
    <div id="contact" class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-3 font-playfair">Hubungi Panitia</h2>
                <p class="text-lg text-gray-600">Tim panitia siap membantu Anda</p>
            </div>

            <!-- Contact Card -->
            <div class="relative rounded-2xl p-[2px] bg-gradient-to-r from-green-500 via-emerald-500 to-green-600 shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for($i = 1; $i <= 4; $i++)
                    @php
                    $nama = $settings['kontak_nama_' . $i] ?? null;
                    $nomor = $settings['kontak_nomor_' . $i] ?? null;
                    @endphp
                    @if($nama && $nomor)
                    <div class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition-colors">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $nama }}</h3>
                        </div>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $nomor) }}" 
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            <span>{{ $nomor }}</span>
                        </a>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <!-- End Kontak Section -->

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold font-playfair mb-4">PMBM Madrasah</h3>
                <p class="text-gray-400 text-sm">Mewujudkan pendidikan berkualitas berlandaskan nilai-nilai keislaman
                    untuk masa depan yang gemilang.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold font-playfair mb-4">Kontak</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li>Jl. Pendidikan No. 123</li>
                    <li>Telp: (021) 12345678</li>
                    <li>Email: info@madrasah.sch.id</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold font-playfair mb-4">Social Media</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                    <a href="#" class="text-gray-400 hover:text-white">Instagram</a>
                    <a href="#" class="text-gray-400 hover:text-white">Youtube</a>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-300 text-sm">
                &copy; {{ date('Y') }} PMBM MAN 1 Tegal. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Modal Informasi Pendaftaran -->
    <div x-show="showModal" x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-1"
        @click.away="showModal = false"
        style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50" style="opacity:0.4" 
                @click="showModal = false"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl px-6 pt-5 pb-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                @click.stop
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-5 p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 font-playfair">Informasi Pendaftaran</h3>
                    </div>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div x-show="registrationStatus === 'not_started'">
                    <div class="bg-green-50 rounded-xl p-5 mb-5 border border-green-200 m-6">
                        <p class="text-gray-700 text-base font-semibold mb-3">Pendaftaran belum dibuka</p>
                        <p class="text-gray-600 text-sm mb-4">Tanggal Pendaftaran dibuka dalam:</p>
                        
                        <!-- Countdown Timer -->
                        <div class="flex justify-center items-center gap-2 mb-5">
                            <div class="bg-yellow-400 rounded-lg p-3 text-center shadow-sm border border-yellow-200">
                                <div class="text-2xl font-bold text-white mb-1" x-text="String(countdown.days || 0).padStart(2, '0')"></div>
                                <div class="text-xs font-semibold text-white uppercase">Hari</div>
                            </div>
                            <div class="bg-yellow-400 rounded-lg p-3 text-center shadow-sm border border-yellow-200">
                                <div class="text-2xl font-bold text-white mb-1" x-text="String(countdown.hours || 0).padStart(2, '0')"></div>
                                <div class="text-xs font-semibold text-white uppercase">Jam</div>
                            </div>
                            <div class="bg-yellow-400 rounded-lg p-3 text-center shadow-sm border border-yellow-200">
                                <div class="text-2xl font-bold text-white mb-1" x-text="String(countdown.minutes || 0).padStart(2, '0')"></div>
                                <div class="text-xs font-semibold text-white uppercase">Menit</div>
                            </div>
                            <div class="bg-yellow-400 rounded-lg p-3 text-center shadow-sm border border-yellow-200">
                                <div class="text-2xl font-bold text-white mb-1" x-text="String(countdown.seconds || 0).padStart(2, '0')"></div>
                                <div class="text-xs font-semibold text-white uppercase">Detik</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="registrationStatus === 'closed'">
                    <div class="bg-green-50 rounded-xl p-5 mb-5 border border-green-200">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-700 text-base font-semibold">Pendaftaran Telah Ditutup</p>
                        </div>
                        <p class="text-gray-600 text-sm">Maaf, periode pendaftaran telah berakhir. Silakan hubungi panitia untuk informasi lebih lanjut.</p>
                    </div>
                </div>

                <!-- Jadwal Info -->
                <div class=" rounded-xl p-4 m-6 mt-5">
                    <h4 class="font-bold text-gray-900 mb-3 text-sm">Jadwal PMBM</h4>
                    <div class="space-y-2 text-xs text-gray-600">
                    @php \Carbon\Carbon::setLocale('id'); @endphp
                        <div class="flex justify-between">
                                <span>Pembukaan:</span>
                                <span class="font-semibold text-gray-900">{{ $tanggalMulai ? $tanggalMulai->translatedFormat('l, d F Y') : '-' }} s.d. {{ $tanggalSelesai ? $tanggalSelesai->translatedFormat('l, d F Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Pengumuman:</span>
                            <span class="font-semibold text-gray-900">{{ $settings['jadwal_pengumuman'] ? \Carbon\Carbon::parse($settings['jadwal_pengumuman'])->translatedFormat('l, d F Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Daftar Ulang:</span>
                            <span class="font-semibold text-gray-900">{{ $settings['jadwal_daftar_ulang'] ? \Carbon\Carbon::parse($settings['jadwal_daftar_ulang'])->translatedFormat('l, d F Y') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function landingPage() {
            return {
                showModal: false,
                registrationStatus: @json($registrationStatus ?? 'open'),
                tanggalMulai: @json($tanggalMulai ? $tanggalMulai->toIso8601String() : null),
                countdown: {
                    days: 0,
                    hours: 0,
                    minutes: 0,
                    seconds: 0
                },
                countdownInterval: null,

                init() {
                    if (this.registrationStatus === 'not_started' && this.tanggalMulai) {
                        this.startCountdown();
                    }
                },

                startCountdown() {
                    if (!this.tanggalMulai) return;
                    const targetDate = new Date(this.tanggalMulai).getTime();
                    this.updateCountdown(targetDate);
                    this.countdownInterval = setInterval(() => {
                        this.updateCountdown(targetDate);
                    }, 1000);
                },

                updateCountdown(targetDate) {
                    const now = new Date().getTime();
                    const distance = targetDate - now;
                    if (distance < 0) {
                        this.countdown = { days: 0, hours: 0, minutes: 0, seconds: 0 };
                        if (this.countdownInterval) {
                            clearInterval(this.countdownInterval);
                        }
                        return;
                    }
                    this.countdown = {
                        days: Math.floor(distance / (1000 * 60 * 60 * 24)),
                        hours: Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                        minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                        seconds: Math.floor((distance % (1000 * 60)) / 1000)
                    };
                },

                handleDaftarClick() {
                    if (this.registrationStatus === 'not_started') {
                        this.showModal = true;
                        this.showHeroAlertToast('warning', 'Pendaftaran belum dibuka');
                    } else if (this.registrationStatus === 'closed') {
                        this.showModal = true;
                        this.showHeroAlertToast('error', 'Pendaftaran telah ditutup');
                    } else {
                        window.location.href = '{{ route("pendaftaran") }}';
                    }
                },

                showHeroAlertToast(type, message) {
                    let icon = '';
                    let title = '';
                    if (type === 'warning') {
                        icon = 'warning';
                        title = 'Pendaftaran Belum Dibuka';
                    } else if (type === 'error') {
                        icon = 'error';
                        title = 'Pendaftaran Ditutup';
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</body>

</html>