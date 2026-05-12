<div class="p-10">
    <h1 class="text-3xl font-black mb-6">DAFTAR PESANAN BAR BAR ES DUREN</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-3">ID Pesanan</th>
                <th class="border p-3">Nama</th>
                <th class="border p-3">Menu</th>
                <th class="border p-3">Total</th>
                <th class="border p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $p)
            <tr>
                <td class="border p-3">{{ $p->number }}</td>
                <td class="border p-3">{{ $p->nama_pelanggan }}</td>
                <td class="border p-3">{{ $p->item_details }}</td>
                <td class="border p-3">Rp {{ number_format($p->total_price) }}</td>
                <td class="border p-3">
                    <span class="{{ $p->status == 'success' ? 'text-green-600' : 'text-yellow-600' }} font-bold">
                        {{ strtoupper($p->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>