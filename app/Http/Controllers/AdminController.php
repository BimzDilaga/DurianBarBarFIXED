<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // ================= KHUSUS MANAJEMEN PESANAN =================

    public function indexPesanan()
    {
        $orders = Order::latest()->get(); 
        return view('admin.pesanan', compact('orders'));
    }

    public function updateStatusPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menyiapkan,mengantar,selesai'
        ]);

        $pesanan = Order::where('order_id', $id)->firstOrFail(); 
        $pesanan->status_pesanan = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pengiriman produk berhasil diperbarui, bos!');
    }

    // ================= KHUSUS MANAJEMEN PRODUK =================
    
    public function index()
    {
        $menus = Product::all();
        return view('menu.admin_produk', compact('menus'));
    }

    public function simpanProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga_baru' => 'required|numeric',
            'harga_lama' => 'nullable|numeric',
            'deskripsi' => 'required|string',
            'warna_bg' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stock' => 'required|numeric|min:0', // Validasi input stok
        ]);

        $namaGambar = time() . '.' . $request->gambar->extension();  
        $request->gambar->move(public_path('image'), $namaGambar);

        // 1. PERBAIKAN: Menggunakan instansiasi objek agar terhindar dari block $fillable
        $product = new Product();
        $product->nama = $request->nama;
        $product->kategori = $request->kategori;
        $product->harga_baru = (string) $request->harga_baru;
        $product->harga_lama = (string) ($request->harga_lama ?? '0');
        $product->deskripsi = $request->deskripsi;
        $product->warna_bg = $request->warna_bg;
        $product->is_promo = 0;
        $product->gambar = $namaGambar;
        $product->stock = $request->stock; 
        $product->save();

        return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan bos!');
    }

    public function updateStok(Request $request, $id)
    {
        $menu = Product::findOrFail($id);
        
        // 2. PERBAIKAN: Simpan stok dengan mem-bypass Model $fillable
        $menu->stock = $request->stock;
        $menu->save();

        return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
    }

    public function updateStokMassal(Request $request)
    {
        if ($request->has('stocks')) {
            foreach ($request->stocks as $id => $stock) {
                $menu = Product::find($id);
                if ($menu) {
                    // 3. PERBAIKAN: Memastikan update massal juga aman
                    $menu->stock = $stock;
                    $menu->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Semua stok berhasil diupdate dengan cepat bos!');
    }
    
    // 4. PENAMBAHAN FUNGSI BARU: Untuk mengeksekusi tombol "Hapus" di panel admin
    public function hapusProduk($id)
    {
        $menu = Product::findOrFail($id);
        
        // Hapus file gambar asli dari folder public agar memori hosting tidak penuh
        $imagePath = public_path('image/' . $menu->gambar);
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus sepenuhnya!');
    }
}