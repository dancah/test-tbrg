<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function getProduk(){
        $produks = Produk::all();
        return $produks;
    }

    public function get_produks($id){
        $produks = Produk::find($id);
        return response()->json($produks);
    }

    public function saveProduk(Request $request){
        $produk = new Produk;
        if($request->has('image') && !empty($request->image)){
            $imagename = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/galeri'),$imagename);
            $path = ('images/galeri/'.$imagename);
            $produk->image = $path;
        }
        $produk->nama       = $request->nama;
        $produk->jumlah       = $request->jumlah;
        $produk->harga       = $request->harga;
        if($produk->save()){
            return response()->json(['status'=>true,'message'=>'Berhasil Menambahkan Produk']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Menambahkan Produk']);
        }
    }
    public function UpdateProduk(Request $request, $id){
        $produk = Produk::where('id',$id)->first();
      
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/galeri'), $name);
            $path = ('images/galeri/'.$name);
            $produk->image = $path;
        }else{
            $produk->image       = $request->image2;
        }

        $produk->nama       = $request->nama;
        $produk->jumlah       = $request->jumlah;
        $produk->harga       = $request->harga;
        if($produk->save()){
            return response()->json(['status'=>true,'message'=>'Berhasil Mengubah Produk']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Mengubah Produk']);
        }
    }
    public function deleteProduk($id){
        $produks = Produk::find($id);
        if($produks->delete()){
            return response()->json(['status'=>true,'message'=>'Berhasil Menghapus Produk']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal Menghapus Produk']);
        }
    }
}
