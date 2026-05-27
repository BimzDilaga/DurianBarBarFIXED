<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    // FUNGSI INI YANG DICARI OLEH web.php di rute /sync-cart
    public function syncCart(Request $request)
    {
        $displayItems = [];

        if ($request->has('cart_data')) {
            $parsedCart = json_decode($request->cart_data, true);
            
            if(is_array($parsedCart) && count($parsedCart) > 0) {
                foreach($parsedCart as $item) {
                    $itemId = $item['id'] ?? $item['product_id'] ?? null;
                    
                    if ($itemId) {
                        $product = Product::find($itemId);
                        
                        if ($product) {
                            $displayItems[$product->id] = [
                                'id'         => $product->id,
                                'nama'       => $product->nama,
                                'harga_baru' => $product->harga_baru ?? $product->harga,
                                'quantity'   => $item['qty'] ?? $item['quantity'] ?? 1,
                                'gambar'     => $product->gambar
                            ];
                        } else {
                            $rawImg = $item['gambar'] ?? $item['image'] ?? $item['img'] ?? 'Logo.png';
                            $gambarFile = basename(parse_url($rawImg, PHP_URL_PATH));
                            
                            $displayItems[$itemId] = [
                                'id'         => $itemId,
                                'nama'       => $item['name'] ?? $item['nama'] ?? 'Produk Bar Bar',
                                'harga_baru' => $item['price'] ?? $item['harga'] ?? 0,
                                'quantity'   => $item['qty'] ?? $item['quantity'] ?? 1,
                                'gambar'     => $gambarFile
                            ];
                        }
                    }
                }
                
                // Simpan ke session dengan nama 'cart'
                session(['cart' => $displayItems]);
                return redirect('/checkout'); // Langsung lempar ke halaman checkout
            }
        } 
        
        return redirect('/menu')->with('error', 'Keranjang kosong, jajan dulu yuk!');
    }
}