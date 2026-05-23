<div class="p-10">
    <h1 class="text-3xl font-black mb-6">DAFTAR PESANAN BAR BAR ES DUREN</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border p-3 uppercase text-sm">ID Pesanan</th>
                    <th class="border p-3 uppercase text-sm">Nama</th>
                    <th class="border p-3 uppercase text-sm">Menu</th>
                    <th class="border p-3 uppercase text-sm">Total</th>
                    <th class="border p-3 uppercase text-sm">Status (Bayar & Kirim)</th>
                    <th class="border p-3 uppercase text-sm text-center">Aksi Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $p)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border p-3 font-bold text-gray-700">{{ $p->number }}</td>
                    <td class="border p-3 font-semibold">{{ $p->nama_pelanggan }}</td>
                    <td class="border p-3 text-sm text-gray-600">{{ $p->item_details }}</td>
                    <td class="border p-3 font-bold text-[#39AE1F]">Rp {{ number_format($p->total_price, 0, ',', '.') }}</td>
                    
                    <td class="border p-3">
                        <div class="mb-2 flex items-center justify-between border-b pb-1">
                            <span class="text-xs text-gray-500 font-bold uppercase">Bayar:</span>
                            <span class="{{ $p->status == 'success' ? 'text-green-600' : 'text-yellow-600' }} font-black text-sm">
                                {{ strtoupper($p->status) }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-xs text-gray-500 font-bold uppercase">Kirim:</span>
                            @if(($p->status_pesanan ?? 'menyiapkan') == 'menyiapkan')
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[11px] font-black uppercase">Menyiapkan</span>
                            @elseif($p->status_pesanan == 'mengantar')
                                <span class="bg-orange-100 text-orange-600 px-2 py-0.5 rounded text-[11px] font-black uppercase">Mengantar</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[11px] font-black uppercase">Selesai</span>
                            @endif
                        </div>
                    </td>
                    
                    <td class="border p-3">
                        <div class="flex flex-col gap-2 items-center">
                            {{-- Tombol Kirim / Antar --}}
                            <form action="{{ url('/admin/pesanan/update-status/'.$p->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="mengantar">
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-2 py-1.5 rounded-lg text-xs font-bold transition shadow-sm" {{ ($p->status_pesanan ?? 'menyiapkan') != 'menyiapkan' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                    <i class="fas fa-motorcycle mr-1"></i> Antar
                                </button>
                            </form>

                            {{-- Tombol Sampai / Selesai --}}
                            <form action="{{ url('/admin/pesanan/update-status/'.$p->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="selesai">
                                <button type="submit" class="w-full bg-[#39AE1F] hover:bg-green-700 text-white px-2 py-1.5 rounded-lg text-xs font-bold transition shadow-sm" {{ ($p->status_pesanan ?? 'menyiapkan') == 'selesai' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                    <i class="fas fa-check-circle mr-1"></i> Sampai
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>