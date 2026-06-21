<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('created_at', 'desc')->get();
        return response()->json($pelanggan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'hp' => 'required|string',
        ]);

        $pelanggan = Pelanggan::create($request->all());
        return response()->json(['message' => 'Pelanggan berhasil ditambahkan!', 'data' => $pelanggan], 201);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $pelanggan->update($request->all());
        return response()->json(['message' => 'Pelanggan berhasil diupdate!', 'data' => $pelanggan]);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $pelanggan->delete();
        return response()->json(['message' => 'Pelanggan berhasil dihapus!']);
    }
}