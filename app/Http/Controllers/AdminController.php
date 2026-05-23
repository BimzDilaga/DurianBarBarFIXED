<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Update status pengiriman
    public function updateStatusPesanan(Request $request, $id)
    {
        // Ambil data pesanan berdasarkan ID yang diklik
        // Pastikan Model-nya bernama Order. Jika namanya Pesanan, ubah menjadi \App\Models\Pesanan
        $pesanan = \App\Models\Order::findOrFail($id); 
        
        // Update kolom status_pesanan sesuai value dari tombol ('mengantar' atau 'selesai')
        $pesanan->status_pesanan = $request->status;
        $pesanan->save();

        // Kembalikan ke halaman tadi sambil bawa pesan sukses
        return redirect()->back()->with('success', 'Status pengiriman produk berhasil diperbarui, bos!');
    }

    // Menampilkan halaman management
    public function index()
    {
        // Mengambil semua data dari tabel products
        $menus = Product::all();
        return view('menu.admin_produk', compact('menus'));
    }

    public function simpanProduk(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga_baru' => 'required|numeric',
            'harga_lama' => 'nullable|numeric',
            'deskripsi' => 'required|string',
            'warna_bg' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Proses upload gambar ke folder public/image
        $namaGambar = time() . '.' . $request->gambar->extension();  
        $request->gambar->move(public_path('image'), $namaGambar);

        // Simpan ke database
        Product::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga_baru' => (string) $request->harga_baru,
            'harga_lama' => (string) ($request->harga_lama ?? '0'),
            'deskripsi' => $request->deskripsi,
            'warna_bg' => $request->warna_bg,
            'is_promo' => 0, // default promo mati
            'gambar' => $namaGambar,
        ]);

        // Kembali ke halaman admin
        return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan bos!');
    }

    // Update stok dengan instan
    public function updateStok(Request $request, $id)
    {
        $menu = Product::findOrFail($id);
        $menu->update([
            'stock' => $request->stock
        ]);

        return redirect()->back();
    }

    // Update semua stok sekaligus (Save All)
    public function updateStokMassal(Request $request)
    {
        if ($request->has('stocks')) {
            foreach ($request->stocks as $id => $stock) {
                // Update stok tiap produk berdasarkan ID yang dikirim
                \App\Models\Product::where('id', $id)->update(['stock' => $stock]);
            }
        }
        return redirect()->back()->with('success', 'Semua stok berhasil diupdate dengan cepat bos!');
    }
}