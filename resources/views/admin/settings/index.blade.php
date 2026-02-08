<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight italic">
            {{ __('Pengaturan Sistem') }}
        </h2>
        <p class="text-gray-500 text-sm mt-1">Pengaturan sistem untuk menampilkan informasi pada halaman landing dan sistem.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Landing Page Settings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($groupedSettings['Landing Page'] as $setting)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $setting->name }}
                                    @if(in_array($setting->key, ['logo', 'nama_sekolah', 'tagline_sekolah', 'landing_hero', 'deskripsi_hero', 'tahun_ajaran']))
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                {{-- FILE INPUT --}}
                                @if($setting->type == 'file')
                                    <div class="space-y-3">
                                        @if($setting->value)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $setting->value) }}" 
                                                    alt="{{ $setting->name }}" 
                                                    class="w-24 h-auto rounded-lg border border-gray-200 shadow-sm">
                                            </div>
                                        @endif

                                        <input type="file" 
                                            name="{{ $setting->key }}" 
                                            accept="image/png,image/jpeg,image/jpg"
                                            class="block w-full text-sm text-gray-500
                                                    file:mr-4 file:py-2 file:px-4 file:rounded-md
                                                    file:border-0 file:text-sm file:font-semibold
                                                    file:bg-green-50 file:text-green-700
                                                    hover:file:bg-green-100">

                                        <p class="text-xs text-gray-500">
                                            Format: PNG, JPG, JPEG (Max 2MB)
                                        </p>
                                    </div>

                                {{-- TEXTAREA --}}
                                @elseif($setting->type == 'longtext')
                                    <textarea name="{{ $setting->key }}" rows="5"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ $setting->value }}</textarea>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Mendukung HTML tags
                                    </p>

                                {{-- DATE --}}
                                @elseif($setting->type == 'date')
                                    <input type="date" 
                                        name="{{ $setting->key }}" 
                                        value="{{ $setting->value }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">

                                {{-- TEXT --}}
                                @else
                                    <input type="text" 
                                        name="{{ $setting->key }}" 
                                        value="{{ $setting->value }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">

                                    {{-- Keterangan khusus untuk tagline --}}
                                    @if($setting->key === 'tagline_sekolah')
                                        <p class="text-xs text-gray-500 mt-2">
                                            Gunakan tanda <span class="font-semibold text-green-600">|</span> untuk bagian tengah (warna hijau). <br>
                                            Contoh: <br>
                                            <span class="italic text-gray-600">
                                                Membangun Generasi|Cerdas & Berakhlak
                                            </span>
                                        </p>
                                    @endif

                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Jadwal Settings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal Pendaftaran</h3>
                        <p class="text-sm text-gray-500 mt-1">Atur jadwal kegiatan pendaftaran</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($groupedSettings['Jadwal'] as $setting)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $setting->name }}
                                </label>
                                <input type="date" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kontak Settings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Kontak Panitia</h3>
                        <p class="text-sm text-gray-500 mt-1">Data kontak yang akan ditampilkan di halaman landing</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @for($i = 1; $i <= 4; $i++)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-4">Kontak {{ $i }}</h4>
                                <div class="space-y-4">
                                    @php
                                    $namaSetting = $groupedSettings['Kontak']->firstWhere('key', 'kontak_nama_' . $i);
                                    $nomorSetting = $groupedSettings['Kontak']->firstWhere('key', 'kontak_nomor_' . $i);
                                    @endphp
                                    
                                    @if($namaSetting)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                                        <input type="text" name="kontak_nama_{{ $i }}" value="{{ $namaSetting->value }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                    </div>
                                    @endif
                                    
                                    @if($nomorSetting)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                                        <input type="text" name="kontak_nomor_{{ $i }}" value="{{ $nomorSetting->value }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                            placeholder="08xxxxxxxxxx">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Other Settings -->
                @if($groupedSettings['Lainnya']->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Pengaturan Lainnya</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($groupedSettings['Lainnya'] as $setting)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $setting->name }}
                                </label>

                                @if($setting->type == 'longtext')
                                <textarea name="{{ $setting->key }}" rows="5"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ $setting->value }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Mendukung HTML tags</p>
                                @elseif($setting->type == 'date')
                                <input type="date" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex justify-end gap-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-green-600 text-white rounded-md hover:bg-green-700 transition shadow-lg">
                            Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
