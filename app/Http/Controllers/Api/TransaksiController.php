<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    // MENGAMBIL SEMUA TRANSAKSI (Dengan Data Pelanggan & Layanan)
    public function index()
    {
        // Fungsi with() akan otomatis menarik nama pelanggan dan layanan berdasarkan ID
        $transaksi = Transaksi::with(['pelanggan', 'layanan'])
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return response()->json($transaksi);
    }

    // MENYIMPAN TRANSAKSI BARU DARI KASIR
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id' => 'nullable|exists:layanans,id',
            'berat' => 'nullable|numeric|min:0',
            'total_harga' => 'required|numeric'
        ]);

        // Generate ID Nota Otomatis (Contoh: TRX-A8F9B)
        $id_nota = 'TRX-' . strtoupper(Str::random(5));

        $transaksi = Transaksi::create([
            'id_nota' => $id_nota,
            'pelanggan_id' => $request->pelanggan_id,
            'layanan_id' => $request->layanan_id,
            'berat' => $request->berat,
            'rincian_pakaian' => $request->rincian_pakaian, // Array otomatis jadi JSON
            'total_harga' => $request->total_harga,
            'status' => 'Proses' // Status awal pasti Proses
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil disimpan!', 
            'data' => $transaksi
        ], 201);
    }

    // MENAMPILKAN DETAIL 1 TRANSAKSI (Untuk Halaman Detail Nota Karyawan)
    public function show($id)
    {
        // Kita bisa mencari berdasarkan id biasa, atau id_nota (TRX-...)
        $transaksi = Transaksi::with(['pelanggan', 'layanan'])
                        ->where('id_nota', $id)
                        ->orWhere('id', $id)
                        ->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Nota tidak ditemukan'], 404);
        }

        return response()->json($transaksi);
    }

    // UPDATE TRANSAKSI (Untuk Ubah Status Selesai / Edit Rincian)
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::where('id_nota', $id)->orWhere('id', $id)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Nota tidak ditemukan'], 404);
        }

        $transaksi->update($request->all());
        
        return response()->json([
            'message' => 'Transaksi berhasil diperbarui!', 
            'data' => $transaksi
        ]);
    }

    // HAPUS TRANSAKSI (Opsional, jika Owner ingin menghapus riwayat)
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id_nota', $id)->orWhere('id', $id)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Nota tidak ditemukan'], 404);
        }

        $transaksi->delete();
        
        return response()->json(['message' => 'Transaksi berhasil dihapus!']);
    }
}