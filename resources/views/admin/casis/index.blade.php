<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight italic uppercase">Daftar Pendaftar
                    </h1>
                    <p class="text-gray-500 text-sm mt-1">Manajemen data calon siswa dan status verifikasi berkas.</p>
                </div>
            </div>

            <!-- Filter & Search Card -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 mb-8">
                <form action="{{ route('admin.casis.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center mb-10">
                    <div class="flex-1 w-full">
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Cari
                            Peserta</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all placeholder:text-gray-300"
                                placeholder="Masukkan Nama atau NISN...">
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 px-1">Status
                            Verifikasi</label>
                        <select name="status"
                            class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-500/20 transition-all cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="Belum Diverifikasi" {{ request('status')=='Belum Diverifikasi' ? 'selected'
                                : '' }}>Pending (Belum Cek)</option>
                            <option value="Diverifikasi" {{ request('status')=='Diverifikasi' ? 'selected' : '' }}>Sudah
                                Terverifikasi</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="bg-gray-900 hover:bg-black text-white text-[10px] font-black uppercase tracking-widest px-8 py-4 rounded-2xl transition-all active:scale-95 shadow-sm hover:shadow-lg shadow-gray-200">
                            Apply Filter
                        </button>
                        @if(request()->anyFilled(['search', 'status']))
                        <a href="{{ route('admin.casis.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-[10px] font-black uppercase tracking-widest px-6 py-4 rounded-2xl transition-all flex items-center">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-[11px] text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50 py-4 px-6 mb-5">
                            <tr>
                                <th class="px-8 py-5 font-black w-16">No</th>
                                <th class="px-6 py-5 font-black">No. Daftar</th>
                                <th class="px-6 py-5 font-black">Identitas Peserta</th>
                                <th class="px-6 py-5 font-black">Asal Sekolah</th>
                                <th class="px-6 py-5 font-black">Status Berkas</th>
                                <th class="px-8 py-5 font-black text-right">Navigasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 mb-5">
                            @forelse($casis as $index => $item)
                            <tr class="hover:bg-gray-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <span class="text-xs font-bold text-gray-400">{{ $casis->firstItem() + $index
                                        }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <span
                                        class="font-mono text-xs font-bold text-green-700 bg-green-50 px-2 py-1 rounded-lg">{{
                                        $item->no_pendaftaran }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-11 h-11 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 font-black group-hover:bg-green-100 group-hover:text-green-600 transition-colors shadow-sm">
                                            {{ strtoupper(substr($item->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-gray-900 uppercase tracking-tight group-hover:text-green-600 transition-colors">{{
                                                $item->nama_lengkap }}</span>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-[10px] text-gray-400 font-mono tracking-wider">NISN:
                                                    {{ $item->nisn }}</span>
                                                <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                                                <span
                                                    class="text-[9px] font-black uppercase tracking-widest {{ $item->jk == 'L' ? 'text-blue-400' : 'text-pink-400' }}">
                                                    {{ $item->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 font-medium text-gray-600 italic text-xs uppercase tracking-tight">
                                    {{ $item->nama_sekolah }}
                                </td>
                                <td class="px-6 py-6">
                                    @if($item->status_verifikasi == 'Diverifikasi')
                                    <div
                                        class="flex items-center gap-2 text-green-600 bg-green-50 px-3 py-2 rounded-xl border border-green-100 w-fit">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest">Terverifikasi</span>
                                    </div>
                                    @else
                                    <div
                                        class="flex items-center gap-2 text-amber-600 bg-amber-50 px-3 py-2 rounded-xl border border-amber-100 w-fit">
                                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Pending</span>
                                    </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.casis.show', $item->id) }}"
                                            class="bg-white hover:bg-gray-100 text-gray-600 text-[10px] font-black uppercase tracking-widest px-4 py-2.5 rounded-xl border border-gray-100 transition-all active:scale-95 shadow-sm">
                                            Lihat
                                        </a>
                                        <a href="{{ route('admin.casis.edit', $item->id) }}"
                                            class="bg-amber-400 hover:bg-amber-500 text-white text-[10px] font-black uppercase tracking-widest px-4 py-2.5 rounded-xl shadow-lg shadow-amber-200 transition-all active:scale-95">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.casis.destroy', $item->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Hapus data {{ $item->nama_lengkap }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-50 hover:bg-red-600 hover:text-white text-red-600 text-[10px] font-black uppercase tracking-widest px-4 py-2.5 rounded-xl border border-red-100 transition-all active:scale-95">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="mt-11">
                                <td colspan="6" class="mt-11 px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-200 mb-4">
                                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-400">Data Tidak Ditemukan</h4>
                                        <p
                                            class="text-sm text-gray-300 mt-1 uppercase tracking-widest font-black text-[10px]">
                                            Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-gray-50/30 border-t border-gray-50">
                    {{ $casis->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>