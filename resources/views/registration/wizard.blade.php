<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penerimaan Murid Baru Madrasah - PMBM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/logo_kemenag.png') }}" type="image/png">
    <link
        href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:400,600,700,800&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        .fade-enter-active,
        .fade-leave-active {
            transition: opacity 0.3s ease;
        }

        .fade-enter-from,
        .fade-leave-to {
            opacity: 0;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gray-50 font-inter text-gray-800 antialiased min-h-screen flex flex-col" x-data="registrationWizard()">

    <header
        class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 transform transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="bg-gradient-to-tr from-green-600 to-emerald-500 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold font-playfair text-xl shadow-lg shadow-green-600/20">
                    P</div>
                <div>
                    <h1 class="text-xl font-bold font-playfair text-gray-900 leading-none">PMBM</h1>
                    <p class="text-[10px] tracking-widest uppercase text-gray-500 font-semibold mt-0.5">Penerimaan Murid
                        Baru Madrasah</p>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full border border-green-100">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-xs font-semibold text-green-700 uppercase tracking-wide">Tahun Ajaran {{
                        $settings['tahun_ajaran'] ?? '2026/2027' }}</span>
                </div>
            </div>
            <a href="{{ route('landing') }}"
                class="text-sm font-medium text-gray-500 hover:text-red-500 transition">Batal</a>
        </div>
    </header>

    <main class="flex-grow py-10 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            <div class="mb-10 px-4">
                <div class="relative flex items-center justify-between max-w-4xl mx-auto">
                    <div
                        class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -z-10 rounded-full transform -translate-y-1/2">
                    </div>
                    <div class="absolute top-1/2 left-0 h-1 bg-green-500 -z-10 rounded-full transition-all duration-700 ease-in-out transform -translate-y-1/2"
                        :style="'width: ' + ((step - 1) / 4 * 100) + '%'"></div>

                    <template x-for="(label, index) in ['Ketentuan', 'Siswa', 'Orang Tua', 'Sekolah', 'Selesai']">
                        <div class="flex flex-col items-center group cursor-pointer"
                            @click="step > index + 1 ? goToStep(index + 1) : null">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold border-[3px] transition-all duration-300 transform bg-white"
                                :class="{
                                      'border-green-500 bg-green-500 text-white shadow-lg shadow-green-500/30 scale-110': step > index + 1,
                                      'border-green-500 text-green-600 bg-white ring-4 ring-green-100 scale-110': step === index + 1,
                                      'border-gray-200 text-gray-400': step < index + 1
                                  }">
                                <span x-show="step <= index + 1" x-text="index + 1"></span>
                                <svg x-show="step > index + 1" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="mt-3 text-xs font-bold uppercase tracking-wider transition-colors duration-300"
                                :class="step >= index + 1 ? 'text-green-700' : 'text-gray-400'" x-text="label"></span>
                        </div>
                    </template>
                </div>
            </div>

            <form @submit.prevent="submitForm"
                class="bg-white rounded-3xl shadow-xl shadow-gray-200/60 border border-gray-100 overflow-hidden relative">

                <div x-show="submitting"
                    class="absolute inset-0 bg-white/90 z-50 flex flex-col items-center justify-center backdrop-blur-sm"
                    x-transition>
                    <div class="w-16 h-16 border-4 border-green-200 border-t-green-600 rounded-full animate-spin"></div>
                    <p class="mt-4 text-green-800 font-bold animate-pulse">Sedang Mengirim Data...</p>
                </div>

                <div class="p-8 sm:p-10 min-h-[500px]">

                    <!-- Step 1 -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-x-8">
                        <div class="text-center mb-10">
                            <h2 class="text-2xl font-bold font-playfair text-gray-900">Syarat & Ketentuan</h2>
                            <p class="text-gray-500 mt-2">Mohon baca dan pahami ketentuan sebelum mendaftar.</p>
                        </div>

                        <div
                            class="bg-gray-50 rounded-2xl p-6 border border-gray-100 prose prose-green max-w-none text-sm text-gray-600 mb-8 max-h-96 overflow-y-auto custom-scroll shadow-inner">
                            {!! $settings['ketentuan_psbm'] ?? '<ul>
                                <li>Data harus valid.</li>
                            </ul>' !!}
                        </div>

                        <label
                            class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                            :class="formData.agreed ? 'border-green-500 bg-green-50/50' : 'border-gray-200 hover:border-green-200'">
                            <input type="checkbox" x-model="formData.agreed"
                                class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="font-semibold text-gray-700">Saya menyetujui seluruh persyaratan di
                                atas.</span>
                        </label>
                    </div>

                    <!-- Step 2 -->
                    <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300">
                        <div class="border-b border-gray-100 pb-4 mb-8">
                            <h2 class="text-xl font-bold text-gray-900 font-playfair flex items-center gap-2">
                                <span
                                    class="bg-green-100 text-green-600 w-8 h-8 rounded-lg flex items-center justify-center text-lg">👤</span>
                                Identitas Siswa
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" x-model="formData.nama_lengkap"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"
                                    placeholder="Sesuai Akta Kelahiran">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NISN <span class="text-red-500">*</span></label>
                                <input type="text" x-model="formData.nisn"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"
                                    placeholder="10 Digit Angka">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK (No. KTP Anak)</label>
                                <input type="text" x-model="formData.nik"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor KK <span class="text-red-500">*</span></label>
                                <input type="text" x-model="formData.no_kk"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" x-model="formData.tempat_lahir"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" x-model="formData.tgl_lahir"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select x-model="formData.jk"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih Jenis Kelamin...</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp
                                    Aktif <span class="text-red-500">*</span></label>
                                <input type="text" x-model="formData.no_hp_siswa"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"
                                    placeholder="Contoh: 08123456789">
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Anak Ke- <span class="text-red-500">*</span></label>
                                <input type="number" x-model="formData.anak_ke"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jml Saudara <span class="text-red-500">*</span></label>
                                <input type="number" x-model="formData.jml_saudara"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Program /
                                    Ketrampilan <span class="text-red-500">*</span></label>
                                <select x-model="formData.ketrampilan_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"
                                    :disabled="!formData.jk">
                                    <option value="">Pilih...</option>
                                    <template x-for="k in ketrampilanList.filter(item => item.jk === formData.jk)"
                                        :key="k.id">
                                        <option :value="k.id" x-text="k.nama"></option>
                                    </template>
                                </select>
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
                                <select x-model="formData.agama"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Hobi</label>
                                <select x-model="formData.hobi_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($hobi as $h)
                                    <option value="{{ $h->id }}">{{ $h->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Cita-cita</label>
                                <select x-model="formData.cita_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($cita as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Keluarga</label>
                                <select x-model="formData.status_keluarga"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="Anak Kandung">Anak Kandung</option>
                                    <option value="Anak Angkat">Anak Angkat</option>
                                    <option value="Anak Tiri">Anak Tiri</option>
                                </select>
                            </div>

                            <div class="block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilihan Orientasi <span class="text-red-500">*</span></label>
                                <select x-model="formData.orientasi_ortu_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($orientasi as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="md:col-span-2 block">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap
                                    (Domisili) <span class="text-red-500">*</span></label>
                                <textarea x-model="formData.alamat_siswa" rows="3"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"
                                    placeholder="Jalan, RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Parents Data -->
                    <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300">
                        <div class="border-b border-gray-100 pb-4 mb-8">
                            <h2 class="text-xl font-bold text-gray-900 font-playfair flex items-center gap-2">
                                <span
                                    class="bg-green-100 text-green-600 w-8 h-8 rounded-lg flex items-center justify-center text-lg">👨‍👩‍👧</span>
                                Data Orang Tua
                            </h2>
                        </div>

                        <!-- Tabs -->
                        <div class="flex p-1.5 bg-gray-100 rounded-xl mb-8">
                            <button type="button" @click="ortuTab = 'ayah'"
                                class="flex-1 py-2 rounded-lg text-sm font-bold transition-all duration-200"
                                :class="ortuTab === 'ayah' ? 'bg-white text-green-700 shadow-sm' : 'text-gray-500 hover:text-gray-700'">Ayah</button>
                            <button type="button" @click="ortuTab = 'ibu'"
                                class="flex-1 py-2 rounded-lg text-sm font-bold transition-all duration-200"
                                :class="ortuTab === 'ibu' ? 'bg-white text-green-700 shadow-sm' : 'text-gray-500 hover:text-gray-700'">Ibu</button>
                            <button type="button" @click="ortuTab = 'wali'"
                                class="flex-1 py-2 rounded-lg text-sm font-bold transition-all duration-200"
                                :class="ortuTab === 'wali' ? 'bg-white text-green-700 shadow-sm' : 'text-gray-500 hover:text-gray-700'">Wali</button>
                        </div>

                        <!-- Ayah Form -->
                        <div x-show="ortuTab === 'ayah'" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                    Ayah <span class="text-red-500">*</span></label><input type="text" x-model="formData.nama_ayah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">NIK
                                    Ayah</label><input type="text" x-model="formData.nik_ayah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Status
                                    Ayah <span class="text-red-500">*</span></label>
                                <select x-model="formData.status_ayah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="Hidup">Hidup</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Tgl
                                    Lahir <span class="text-red-500">*</span></label><input type="date" x-model="formData.tgl_lahir_ayah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label><select
                                    x-model="formData.pekerjaan_ayah_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>@foreach($pekerjaan_ayah as $p)<option
                                        value="{{ $p->id }}">{{ $p->nama }}</option>@endforeach
                                </select></div>
                            <div class="block"><label
                                        class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan</label><select
                                    x-model="formData.penghasilan_ayah_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>@foreach($penghasilan as $p)<option
                                        value="{{ $p->id }}">{{ $p->nama }}</option>@endforeach
                                </select></div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">No HP<span class="text-red-500">*</span></label>
                                    <input type="text" x-model="formData.no_hp_ayah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan Terakhir</label>
                                <select x-model="formData.pendidikan_ayah_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($pendidikan as $p)<option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2 block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Alamat Ayah <span class="text-red-500">*</span></label>
                                <textarea x-model="formData.alamat_ayah" rows="2"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>
                        </div>

                        <!-- Ibu Form -->
                        <div x-show="ortuTab === 'ibu'" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="formData.nama_ibu"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">NIK Ibu</label>
                                    <input type="text" x-model="formData.nik_ibu"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                                    Ibu</label>
                                <select x-model="formData.status_ibu"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="Hidup">Hidup</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Lahir Ibu <span class="text-red-500">*</span></label>
                                    <input type="date" x-model="formData.tgl_lahir_ibu"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Ibu</label><select
                                    x-model="formData.pekerjaan_ibu_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>@foreach($pekerjaan_ibu as $p)<option
                                        value="{{ $p->id }}">{{ $p->nama }}</option>@endforeach
                                </select></div>
                                <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">No HP</label>
                                        <input type="text" x-model="formData.no_hp_ibu"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan Terakhir Ibu</label>
                                <select x-model="formData.pendidikan_ibu_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($pendidikan as $p)<option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan Ibu</label>
                                <select x-model="formData.penghasilan_ibu_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($penghasilan as $p)<option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2 block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Alamat Ibu <span class="text-red-500">*</span></label><textarea
                                    x-model="formData.alamat_ibu" rows="2"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>
                        </div>

                        <!-- Wali Form -->
                        <div x-show="ortuTab === 'wali'">
                            <div class="flex items-center mb-6 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                                <input id="copyAyah" type="checkbox" x-model="copyData" @change="syncWali()"
                                    class="w-5 h-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500 cursor-pointer">
                                <label for="copyAyah"
                                    class="ml-3 block text-sm font-bold text-yellow-800 cursor-pointer">
                                    Samakan dengan data Ayah
                                </label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Nama Wali <span class="text-red-500">*</span></label>
                                        <input type="text" x-model="formData.nama_wali"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                </div>
                                <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">NIK Wali <span class="text-red-500">*</span></label>
                                        <input type="text" x-model="formData.nik_wali"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                </div>
                                <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Lahir Wali <span class="text-red-500">*</span></label>
                                <input type="date" x-model="formData.tgl_lahir_wali"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                </div>
                                <div class="block">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Wali</label>
                                    <select x-model="formData.status_wali"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                        <option value="Hidup">Hidup</option>
                                        <option value="Meninggal">Meninggal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">No HP
                                    Wali</label><input type="text" x-model="formData.no_hp_wali"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan
                                    Terakhir</label>
                                <select x-model="formData.pendidikan_wali_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($pendidikan as $p)<option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label>
                                <select x-model="formData.pekerjaan_wali_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($pekerjaan_ayah as $p)<option value="{{ $p->id }}">{{ $p->nama }}
                                    </option>@endforeach
                                </select>
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan</label>
                                <select x-model="formData.penghasilan_wali_id"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    @foreach($penghasilan as $p)<option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2 block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Alamat Wali</label>
                                <span class="text-red-500">*</span>
                                <textarea x-model="formData.alamat_wali" rows="2"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300">
                        <div class="border-b border-gray-100 pb-4 mb-8">
                            <h2 class="text-xl font-bold text-gray-900 font-playfair flex items-center gap-2">
                                <span class="bg-green-100 text-green-600 w-8 h-8 rounded-lg flex items-center justify-center text-lg">🏫</span>
                                Asal Sekolah & Nilai <span class="text-red-500">*</span>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-10">
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Jenjang <span class="text-red-500">*</span></label><select
                                    x-model="formData.jenis_sekolah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    <option value="SMP">SMP</option>
                                    <option value="MTS">MTS</option>
                                </select></div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Status
                                    Sekolah <span class="text-red-500">*</span></label><select x-model="formData.status_sekolah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    <option value="NEGERI">NEGERI</option>
                                    <option value="SWASTA">SWASTA</option>
                                </select></div>
                            <div class="block"><label class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                    Sekolah <span class="text-red-500">*</span></label><input type="text" x-model="formData.nama_sekolah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">NPSN</label>
                                    <input
                                    type="text" x-model="formData.npsn_sekolah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                            </div>
                            <div class="block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Akreditasi <span class="text-red-500">*</span></label><select
                                    x-model="formData.akreditasi_sekolah"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition">
                                    <option value="">Pilih...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="Tidak Terakreditasi">Tidak Terakreditasi</option>
                                </select>
                            </div>
                            <div class="md:col-span-2 block"><label
                                    class="block text-sm font-semibold text-gray-700 mb-2">Alamat Sekolah <span class="text-red-500">*</span></label>
                                <textarea x-model="formData.alamat_sekolah" rows="2"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mb-4">Input Nilai Rapor</h3>
                        <div class="space-y-6">
                            <template x-for="sem in [3, 4, 5]" :key="sem">
                                <div
                                    class="bg-gray-50/80 rounded-xl p-5 border border-gray-200 hover:border-green-200 transition">
                                    <div
                                        class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold mb-4">
                                        Semester <span x-text="sem"></span></div>
                                    <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
                                        <div class="block"><label
                                                class="block text-xs font-semibold text-gray-500 mb-1 text-center">IPA</label><span class="text-red-500">*</span><input
                                                type="number" step="0.01" x-model="formData['nilai_' + sem + '_ipa']"
                                                class="w-full rounded-lg border-gray-300 text-center font-bold focus:border-green-500 focus:ring-green-500"
                                                placeholder="00.00"></div>
                                        <div class="block"><label
                                                class="block text-xs font-semibold text-gray-500 mb-1 text-center">IPS</label><span class="text-red-500">*</span><input
                                                type="number" step="0.01" x-model="formData['nilai_' + sem + '_ips']"
                                                class="w-full rounded-lg border-gray-300 text-center font-bold focus:border-green-500 focus:ring-green-500"
                                                placeholder="00.00"></div>
                                        <div class="block"><label
                                                class="block text-xs font-semibold text-gray-500 mb-1 text-center">MTK</label><span class="text-red-500">*</span><input
                                                type="number" step="0.01" x-model="formData['nilai_' + sem + '_mtk']"
                                                class="w-full rounded-lg border-gray-300 text-center font-bold focus:border-green-500 focus:ring-green-500"
                                                placeholder="00.00"></div>
                                        <div class="block"><label
                                                class="block text-xs font-semibold text-gray-500 mb-1 text-center">BIN</label><span class="text-red-500">*</span><input
                                                type="number" step="0.01" x-model="formData['nilai_' + sem + '_bind']"
                                                class="w-full rounded-lg border-gray-300 text-center font-bold focus:border-green-500 focus:ring-green-500"
                                                placeholder="00.00"></div>
                                        <div class="block"><label
                                                class="block text-xs font-semibold text-gray-500 mb-1 text-center">BIG</label><span class="text-red-500">*</span><input
                                                type="number" step="0.01" x-model="formData['nilai_' + sem + '_bing']"
                                                class="w-full rounded-lg border-gray-300 text-center font-bold focus:border-green-500 focus:ring-green-500"
                                                placeholder="00.00"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div x-show="step === 5" x-cloak x-transition:enter="transition ease-out duration-300">
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div
                                class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
                                <svg class="w-12 h-12 text-green-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 font-playfair mb-4">Siap Mendaftar?</h2>
                            <p class="text-gray-500 max-w-lg mb-8">Pastikan seluruh data yang Anda isi sudah benar.
                                Kartu Bukti Pendaftaran akan tersedia setelah Anda menekan tombol Kirim.</p>

                            <dl class="bg-gray-50 rounded-2xl p-6 border border-gray-200 text-left w-full max-w-md">
                                <div class="flex justify-between py-2 border-b border-gray-200 border-dashed">
                                    <dt class="text-gray-500">Nama Lengkap</dt>
                                    <dd class="font-bold text-gray-900" x-text="formData.nama_lengkap"></dd>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200 border-dashed">
                                    <dt class="text-gray-500">NISN</dt>
                                    <dd class="font-bold text-gray-900" x-text="formData.nisn"></dd>
                                </div>
                                <div class="flex justify-between py-2">
                                    <dt class="text-gray-500">Asal Sekolah</dt>
                                    <dd class="font-bold text-gray-900" x-text="formData.nama_sekolah"></dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                </div>

                <!-- Footer Navigation -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <button type="button" @click="prevStep" x-show="step > 1"
                        class="text-gray-500 hover:text-green-600 font-bold px-4 py-2 rounded-lg hover:bg-green-50 transition">Kembali</button>
                    <div class="flex-grow"></div>
                    <button type="button" @click="nextStep" x-show="step < 5" :disabled="step===1 && !formData.agreed"
                        :class="{'opacity-50 cursor-not-allowed': step===1 && !formData.agreed}"
                        class="px-8 py-3 bg-green-600 text-white rounded-xl font-bold shadow-lg shadow-green-600/30 hover:bg-green-700 hover:shadow-green-600/50 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        Lanjut <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                    <button type="submit" x-show="step === 5"
                        class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-bold shadow-xl shadow-green-600/40 hover:scale-[1.02] active:scale-95 transition-all">
                        Kirim Pendaftaran 🚀
                    </button>
                </div>
            </form>

        </div>
    </main>

    <script>
        const ketrampilanList = @json($ketrampilan);
        function registrationWizard() {
            return {
                step: 1,
                ortuTab: 'ayah',
                submitting: false,
                copyData: false,
                formData: {
                    agreed: false,
                    nama_lengkap: '', nisn: '', nik: '', no_kk: '', jk: '', tempat_lahir: '', tgl_lahir: '',
                    anak_ke: '', jml_saudara: '', agama: 'Islam', status_keluarga: '', alamat_siswa: '', no_hp_siswa: '',
                    ketrampilan_id: '', hobi_id: '', cita_id: '', orientasi_ortu_id: '',

                    nama_ayah: '', nik_ayah: '', tgl_lahir_ayah: '', pendidikan_ayah_id: '', pekerjaan_ayah_id: '', penghasilan_ayah_id: '', no_hp_ayah: '', status_ayah: 'Hidup', alamat_ayah: '',
                    nama_ibu: '', nik_ibu: '', tgl_lahir_ibu: '', pendidikan_ibu_id: '', pekerjaan_ibu_id: '', penghasilan_ibu_id: '', no_hp_ibu: '', status_ibu: 'Hidup', alamat_ibu: '',
                    nama_wali: '', nik_wali: '', tgl_lahir_wali: '', pendidikan_wali_id: '', pekerjaan_wali_id: '', penghasilan_wali_id: '', no_hp_wali: '', status_wali: '', alamat_wali: '',

                    jenis_sekolah: '', status_sekolah: '', nama_sekolah: '', npsn_sekolah: '', akreditasi_sekolah: '', alamat_sekolah: '',

                    nilai_3_ipa: '', nilai_3_ips: '', nilai_3_mtk: '', nilai_3_bind: '', nilai_3_bing: '',
                    nilai_4_ipa: '', nilai_4_ips: '', nilai_4_mtk: '', nilai_4_bind: '', nilai_4_bing: '',
                    nilai_5_ipa: '', nilai_5_ips: '', nilai_5_mtk: '', nilai_5_bind: '', nilai_5_bing: ''
                },

                validateStep() {
                    if (this.step === 1) {
                        if (!this.formData.agreed) {
                            Swal.fire('Perhatian', 'Anda harus menyetujui syarat dan ketentuan terlebih dahulu.', 'warning');
                            return false;
                        }
                        return true;
                    }
                    if (this.step === 2) {
                        const required = ['nama_lengkap', 'nisn', 'nik', 'no_hp_siswa', 'jk', 'tempat_lahir', 'tgl_lahir', 'agama', 'alamat_siswa'];
                        const missing = required.filter(field => !this.formData[field] || this.formData[field].toString().trim() === '');
                        if (missing.length > 0) {
                            Swal.fire('Perhatian', 'Mohon lengkapi semua field yang wajib diisi (ditandai dengan *).', 'warning');
                            return false;
                        }
                        return true;
                    }
                    if (this.step === 3) {
                        // Validasi berdasarkan tab aktif
                        if (this.ortuTab === 'ayah') {
                            const required = ['nama_ayah'];
                            const missing = required.filter(field => !this.formData[field] || this.formData[field].toString().trim() === '');
                            if (missing.length > 0) {
                                Swal.fire('Perhatian', 'Mohon lengkapi data Ayah yang wajib diisi (ditandai dengan *).', 'warning');
                                return false;
                            }
                            // Pindah ke tab Ibu
                            this.ortuTab = 'ibu';
                            return false; // Jangan lanjut ke step berikutnya, hanya ganti tab
                        }
                        if (this.ortuTab === 'ibu') {
                            const required = ['nama_ibu'];
                            const missing = required.filter(field => !this.formData[field] || this.formData[field].toString().trim() === '');
                            if (missing.length > 0) {
                                Swal.fire('Perhatian', 'Mohon lengkapi data Ibu yang wajib diisi (ditandai dengan *).', 'warning');
                                return false;
                            }
                            // Setelah Ibu selesai, lanjut ke step berikutnya
                            return true;
                        }
                        return true;
                    }
                    if (this.step === 4) {
                        const required = ['nama_sekolah', 'jenis_sekolah', 'status_sekolah'];
                        const missing = required.filter(field => !this.formData[field] || this.formData[field].toString().trim() === '');
                        if (missing.length > 0) {
                            Swal.fire('Perhatian', 'Mohon lengkapi data Sekolah yang wajib diisi (ditandai dengan *).', 'warning');
                            return false;
                        }
                        return true;
                    }
                    return true;
                },
                nextStep() {
                    if (!this.validateStep()) {
                        return;
                    }
                    if (this.step < 5) {
                        this.step++;
                        // Reset tab ke ayah jika masuk ke step 3
                        if (this.step === 3) {
                            this.ortuTab = 'ayah';
                        }
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },
                prevStep() {
                    if (this.step > 1) {
                        // Jika kembali dari step 3 dan sedang di tab ibu, kembali ke ayah
                        if (this.step === 3 && this.ortuTab === 'ibu') {
                            this.ortuTab = 'ayah';
                            return;
                        }
                        this.step--;
                        // Reset tab ke ayah jika masuk ke step 3
                        if (this.step === 3) {
                            this.ortuTab = 'ayah';
                        }
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },
                goToStep(i) { 
                    if (i < this.step) {
                        this.step = i;
                        // Reset tab ke ayah jika kembali ke step 3
                        if (i === 3) {
                            this.ortuTab = 'ayah';
                        }
                    }
                },

                syncWali() {
                    if (this.copyData) {
                        this.formData.nama_wali = this.formData.nama_ayah;
                        this.formData.nik_wali = this.formData.nik_ayah;
                        this.formData.tgl_lahir_wali = this.formData.tgl_lahir_ayah;
                        this.formData.pendidikan_wali_id = this.formData.pendidikan_ayah_id;
                        this.formData.pekerjaan_wali_id = this.formData.pekerjaan_ayah_id;
                        this.formData.penghasilan_wali_id = this.formData.penghasilan_ayah_id;
                        this.formData.no_hp_wali = this.formData.no_hp_ayah;
                        this.formData.alamat_wali = this.formData.alamat_ayah;
                        this.formData.status_wali = 'Kakek';
                    }
                },

                submitForm() {
                    this.submitting = true;
                    fetch('/pendaftaran', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.formData)
                    })
                        .then(async response => {
                            const data = await response.json();
                            return { status: response.status, data: data };
                        })
                        .then(({ status, data }) => {
                            this.submitting = false;
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Pendaftaran berhasil! Cek WhatsApp Anda untuk login.',
                                    icon: 'success',
                                    confirmButtonColor: '#16a34a'
                                }).then(() => {
                                    window.location.href = data.redirect || '/siswa/dashboard';
                                });
                            } else {
                                // Handle status pendaftaran
                                if (status === 403 && (data.status === 'not_started' || data.status === 'closed')) {
                                    let icon = 'warning';
                                    let title = 'Pendaftaran Belum Dibuka';
                                    if (data.status === 'closed') {
                                        icon = 'error';
                                        title = 'Pendaftaran Telah Ditutup';
                                    }
                                    Swal.fire({
                                        title: title,
                                        text: data.message || 'Periode pendaftaran tidak tersedia saat ini.',
                                        icon: icon,
                                        confirmButtonColor: '#16a34a',
                                        confirmButtonText: 'Mengerti'
                                    });
                                } else {
                                    Swal.fire('Gagal', data.message || 'Periksa kembali inputan Anda.', 'error');
                                }
                            }
                        })
                        .catch(error => {
                            this.submitting = false;
                            console.error(error);
                            Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                        });
                }
            }
        }
    </script>
</body>

</html>