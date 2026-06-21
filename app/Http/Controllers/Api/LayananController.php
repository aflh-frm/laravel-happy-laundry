<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Mengambil semua data layanan
    public function index()
    {
        $layanan = Layanan::all();
        return response()->json($layanan);
    }

    // Menyimpan data layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'satuan' => 'required|in:Kg,Pcs,Meter',
            'estimasi' => 'required|numeric',
        ]);

        $layanan = Layanan::create($request->all());
        return response()->json(['message' => 'Layanan berhasil ditambahkan!', 'data' => $layanan], 201);
    }

    // Memperbarui data layanan
    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        
        if (!$layanan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $layanan->update($request->all());
        return response()->json(['message' => 'Layanan berhasil diupdate!', 'data' => $layanan]);
    }

    // Menghapus data layanan
    public function destroy($id)
    {
        $layanan = Layanan::find($id);
        
        if (!$layanan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $layanan->delete();
        return response()->json(['message' => 'Layanan berhasil dihapus!']);
    }
}