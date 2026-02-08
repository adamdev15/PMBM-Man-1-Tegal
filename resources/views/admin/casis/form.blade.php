<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.casis.index') }}"
                    class="inline-flex items-center text-xs font-black uppercase tracking-widest text-gray-400 hover:text-green-600 transition-colors gap-2 mb-4">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight italic uppercase">
                    {{ isset($casis) ? 'Edit Data Pendaftar' : 'Tambah Pendaftar Baru' }}
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    {{ isset($casis) ? 'Perbarui informasi lengkap calon siswa.' : 'Tambahkan calon siswa baru ke sistem
                    PMBM.' }}
                </p>
            </div>

            <form action="{{ isset($casis) ? route('admin.casis.update', $casis->id) : route('admin.casis.store') }}"
                method="POST" id="casisForm">
                @csrf
                @if(isset($casis))
                @method('PUT')
                @endif

                <!-- Section 1: Data Pribadi Siswa -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 mb-8">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        Data Pribadi Siswa
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Nama
                                Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $casis->nama_lengkap ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nama Lengkap Siswa" required>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn', $casis->nisn ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nomor Induk Siswa Nasional" required>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $casis->nik ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nomor Induk Kependudukan">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Jenis
                                Kelamin</label>
                            <select name="jk"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer"
                                required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jk', $casis->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jk', $casis->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Tempat
                                Lahir</label>
                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $casis->tempat_lahir ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Kota/Kabupaten Lahir">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Tanggal
                                Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $casis->tgl_lahir ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">No.
                                HP Siswa</label>
                            <input type="text" name="no_hp_siswa"
                                value="{{ old('no_hp_siswa', $casis->no_hp_siswa ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Alamat
                                Siswa</label>
                            <input type="text" name="alamat_siswa"
                                value="{{ old('alamat_siswa', $casis->alamat_siswa ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Alamat Lengkap">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Ayah -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 mb-8">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        Data Ayah
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">NIK
                                Ayah</label>
                            <input type="text" name="nik_ayah" value="{{ old('nik_ayah', $casis->nik_ayah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="NIK Ayah">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Nama
                                Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $casis->nama_ayah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nama Lengkap Ayah">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Tanggal
                                Lahir Ayah</label>
                            <input type="date" name="tgl_lahir_ayah"
                                value="{{ old('tgl_lahir_ayah', $casis->tgl_lahir_ayah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Alamat
                                Ayah</label>
                            <input type="text" name="alamat_ayah"
                                value="{{ old('alamat_ayah', $casis->alamat_ayah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Alamat Lengkap Ayah">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Pendidikan
                                Ayah</label>
                            <select name="pendidikan_ayah_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Pendidikan</option>
                                @foreach($pendidikan as $p)
                                <option value="{{ $p->id }}" {{ old('pendidikan_ayah_id', $casis->pendidikan_ayah_id ??
                                    '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Pekerjaan
                                Ayah</label>
                            <select name="pekerjaan_ayah_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Pekerjaan</option>
                                @foreach($pekerjaan as $p)
                                <option value="{{ $p->id }}" {{ old('pekerjaan_ayah_id', $casis->pekerjaan_ayah_id ??
                                    '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Penghasilan
                                Ayah</label>
                            <select name="penghasilan_ayah_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Penghasilan</option>
                                @foreach($penghasilan as $p)
                                <option value="{{ $p->id }}" {{ old('penghasilan_ayah_id', $casis->penghasilan_ayah_id
                                    ?? '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">No.
                                HP Ayah</label>
                            <input type="text" name="no_hp_ayah"
                                value="{{ old('no_hp_ayah', $casis->no_hp_ayah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Status
                                Ayah</label>
                            <select name="status_ayah"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="Hidup" {{ old('status_ayah', $casis->status_ayah ?? 'Hidup') == 'Hidup' ?
                                    'selected' : '' }}>Hidup</option>
                                <option value="Meninggal" {{ old('status_ayah', $casis->status_ayah ?? '') ==
                                    'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Data Ibu -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 mb-8">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center text-pink-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        Data Ibu
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">NIK
                                Ibu</label>
                            <input type="text" name="nik_ibu" value="{{ old('nik_ibu', $casis->nik_ibu ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="NIK Ibu">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Nama
                                Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $casis->nama_ibu ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nama Lengkap Ibu">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Tanggal
                                Lahir Ibu</label>
                            <input type="date" name="tgl_lahir_ibu"
                                value="{{ old('tgl_lahir_ibu', $casis->tgl_lahir_ibu ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Alamat
                                Ibu</label>
                            <input type="text" name="alamat_ibu"
                                value="{{ old('alamat_ibu', $casis->alamat_ibu ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Alamat Lengkap Ibu">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Pendidikan
                                Ibu</label>
                            <select name="pendidikan_ibu_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Pendidikan</option>
                                @foreach($pendidikan as $p)
                                <option value="{{ $p->id }}" {{ old('pendidikan_ibu_id', $casis->pendidikan_ibu_id ??
                                    '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Pekerjaan
                                Ibu</label>
                            <select name="pekerjaan_ibu_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Pekerjaan</option>
                                @foreach($pekerjaan as $p)
                                <option value="{{ $p->id }}" {{ old('pekerjaan_ibu_id', $casis->pekerjaan_ibu_id ?? '')
                                    == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Penghasilan
                                Ibu</label>
                            <select name="penghasilan_ibu_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Penghasilan</option>
                                @foreach($penghasilan as $p)
                                <option value="{{ $p->id }}" {{ old('penghasilan_ibu_id', $casis->penghasilan_ibu_id ??
                                    '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">No.
                                HP Ibu</label>
                            <input type="text" name="no_hp_ibu" value="{{ old('no_hp_ibu', $casis->no_hp_ibu ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Status
                                Ibu</label>
                            <select name="status_ibu"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="Hidup" {{ old('status_ibu', $casis->status_ibu ?? 'Hidup') == 'Hidup' ?
                                    'selected' : '' }}>Hidup</option>
                                <option value="Meninggal" {{ old('status_ibu', $casis->status_ibu ?? '') == 'Meninggal'
                                    ? 'selected' : '' }}>Meninggal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Data Sekolah Asal -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 mb-8">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        Data Sekolah Asal
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">NPSN
                                Sekolah</label>
                            <input type="text" name="npsn_sekolah"
                                value="{{ old('npsn_sekolah', $casis->npsn_sekolah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nomor Pokok Sekolah Nasional">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Nama
                                Sekolah</label>
                            <input type="text" name="nama_sekolah"
                                value="{{ old('nama_sekolah', $casis->nama_sekolah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Nama Sekolah Asal">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Jenis
                                Sekolah</label>
                            <select name="jenis_sekolah"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Jenis Sekolah</option>
                                <option value="SMP" {{ old('jenis_sekolah', $casis->jenis_sekolah ?? '') == 'SMP' ?
                                    'selected' : '' }}>SMP</option>
                                <option value="MTS" {{ old('jenis_sekolah', $casis->jenis_sekolah ?? '') == 'MTS' ?
                                    'selected' : '' }}>MTS</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Status
                                Sekolah</label>
                            <select name="status_sekolah"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                                <option value="">Pilih Status Sekolah</option>
                                <option value="NEGERI" {{ old('status_sekolah', $casis->status_sekolah ?? '') ==
                                    'NEGERI' ? 'selected' : '' }}>NEGERI</option>
                                <option value="SWASTA" {{ old('status_sekolah', $casis->status_sekolah ?? '') ==
                                    'SWASTA' ? 'selected' : '' }}>SWASTA</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Alamat
                                Sekolah</label>
                            <input type="text" name="alamat_sekolah"
                                value="{{ old('alamat_sekolah', $casis->alamat_sekolah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Alamat Lengkap Sekolah">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Akreditasi
                                Sekolah</label>
                            <input type="text" name="akreditasi_sekolah"
                                value="{{ old('akreditasi_sekolah', $casis->akreditasi_sekolah ?? '') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="A/B/C">
                        </div>
                    </div>
                </div>

                <!-- Section 5: Password (Edit Only) -->
                @if(isset($casis))
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 mb-8">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        Ubah Password
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Password
                                Baru</label>
                            <input type="text" name="password"
                                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                            <p class="text-[9px] font-bold text-gray-400 mt-2 px-1 uppercase italic">Kosongkan jika
                                tidak ingin mengubah password</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.casis.index') }}"
                        class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-colors px-6">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white text-[10px] font-black uppercase tracking-widest px-10 py-4 rounded-2xl shadow-xl shadow-green-200 transition-all active:scale-95">
                        {{ isset($casis) ? 'Simpan Perubahan' : 'Tambah Siswa' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('casisForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: 'Konfirmasi',
                text: '{{ isset($casis) ? "Apakah Anda yakin ingin menyimpan perubahan data siswa ini?" : "Apakah Anda yakin ingin menambahkan siswa baru?" }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>