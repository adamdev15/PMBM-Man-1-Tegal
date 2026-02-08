<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Header -->
            <div
                class="mb-8 p-8 bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-green-50 rounded-full opacity-50 blur-3xl">
                </div>
                <div class="relative flex items-center gap-5">
                    <div
                        class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-200">
                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Panel Panitia PMBM</h1>
                        <p class="text-gray-500 text-sm mt-1 flex items-center gap-2">
                            Selamat datang, <span class="font-bold text-green-600">{{ Auth::user()->name }}</span> •
                            <span
                                class="bg-gray-100 px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest text-gray-500">{{
                                Auth::user()->role ?? 'Admin' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Card -->
                <div
                    class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div
                        class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-4 shadow-sm">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Total Pendaftar</p>
                        <h3 class="text-4xl font-black text-gray-900 mt-1">{{ number_format($stats['total']) }}</h3>
                    </div>
                </div>

                <!-- Pending Card -->
                <div
                    class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div
                        class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 mb-4 shadow-sm">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Belum Diverifikasi</p>
                        <h3 class="text-4xl font-black text-gray-900 mt-1 uppercase">{{ number_format($stats['pending'])
                            }}</h3>
                    </div>
                </div>

                <!-- Verified Card -->
                <div
                    class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div
                        class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50 rounded-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4 shadow-sm">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Sudah Diverifikasi</p>
                        <h3 class="text-4xl font-black text-gray-900 mt-1">{{ number_format($stats['verified']) }}</h3>
                    </div>
                </div>
            </div>

            <!-- List Section -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden"
                x-data="{ showModal: false, selectedCasis: null }">
                <div
                    class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Data Calon Peserta Terbaru</h3>
                        <p class="text-sm text-gray-500 mt-1">Daftar pendaftar yang masuk ke sistem PMBM.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Cari Nama/NISN..."
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-xs rounded-xl focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5 transition-all">
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-[10px] text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 font-black">No. Daftar</th>
                                <th class="px-6 py-4 font-black">Peserta</th>
                                <th class="px-6 py-4 font-black">Sekolah Asal</th>
                                <th class="px-6 py-4 font-black">Status Verifikasi</th>
                                <th class="px-8 py-4 font-black text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($casis as $c)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <span
                                        class="font-mono text-xs font-bold text-green-700 bg-green-50 px-2 py-1 rounded-lg">{{
                                        $c->no_pendaftaran }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-gray-900 group-hover:text-green-600 transition-colors uppercase">{{
                                            $c->nama_lengkap }}</span>
                                        <span class="text-[10px] text-gray-400 mt-0.5 tracking-wider">NISN: {{ $c->nisn
                                            }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-xs font-medium text-gray-600 uppercase italic">{{ $c->nama_sekolah
                                        }}</span>
                                </td>
                                <td class="px-6 py-6 text-sm">
                                    @if($c->status_verifikasi == 'Diverifikasi')
                                    <div
                                        class="flex items-center gap-2 text-green-600 bg-green-50 px-3 py-1.5 rounded-xl w-fit border border-green-100">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest">Diverifikasi</span>
                                    </div>
                                    @else
                                    <div
                                        class="flex items-center gap-2 text-amber-600 bg-amber-50 px-3 py-1.5 rounded-xl w-fit border border-amber-100">
                                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Pending</span>
                                    </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($c->status_verifikasi != 'Diverifikasi')
                                        <button
                                            @click="showModal = true; selectedCasis = { id: {{ $c->id }}, nama: '{{ $c->nama_lengkap }}' }"
                                            class="bg-green-600 hover:bg-green-700 text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-xl shadow-lg shadow-green-200 transition-all active:scale-95">
                                            Verifikasi
                                        </button>
                                        @elseif(Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.unverify', $c->id) }}" method="POST"
                                            onsubmit="return confirm('Batalkan verifikasi untuk {{ $c->nama_lengkap }}?') shadow-sm">
                                            @csrf
                                            <button type="submit"
                                                class="bg-white hover:bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-xl border border-red-100 transition-all active:scale-95">
                                                Unverify
                                            </button>
                                        </form>
                                        @endif
                                        <a href="{{ route('admin.casis.show', $c->id) }}"
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-xl transition-all">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-gray-50/30 border-t border-gray-50">
                    {{ $casis->links() }}
                </div>

                <!-- Modal Verifikasi -->
                <div x-show="showModal" class="fixed inset-0 z-[60] overflow-y-auto" x-cloak>
                    <div class="flex items-center justify-center min-h-screen p-4 text-center">
                        <div x-show="showModal" @click="showModal = false" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>

                        <div x-show="showModal" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                            class="relative bg-white rounded-[2.5rem] p-8 overflow-hidden shadow-2xl transform transition-all sm:max-w-lg w-full">

                            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-green-50 rounded-full"></div>

                            <div class="relative">
                                <div
                                    class="mx-auto flex items-center justify-center h-20 w-20 rounded-3xl bg-green-100 text-green-600 shadow-inner mb-6">
                                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-2">Konfirmasi Verifikasi</h3>
                                <p class="text-gray-500 text-sm leading-relaxed px-4 mb-8">
                                    Tindakan ini akan memverifikasi berkas pendaftaran atas nama <span
                                        class="font-bold text-green-600 underline decoration-green-200 decoration-4 underline-offset-4"
                                        x-text="selectedCasis ? selectedCasis.nama : ''"></span>. Siswa akan mendapatkan
                                    akses cetak kartu.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <form :action="'/admin/verify/' + (selectedCasis ? selectedCasis.id : '')" method="POST"
                                    class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-black uppercase tracking-widest text-xs py-4 rounded-2xl shadow-lg shadow-green-200 transition-all active:scale-95">
                                        Ya, Verifikasi Sekarang
                                    </button>
                                </form>
                                <button type="button" @click="showModal = false"
                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-black uppercase tracking-widest text-xs py-4 rounded-2xl transition-all">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>