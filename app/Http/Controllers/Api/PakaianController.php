<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use Illuminate\Http\Request;

class PakaianController extends Controller
{
    public function index()
    {
        $pakaian = Pakaian::all();
        return response()->json($pakaian);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $pakaian = Pakaian::create($request->all());
        return response()->json(['message' => 'Pakaian berhasil ditambahkan!', 'data' => $pakaian], 201);
    }

    public function update(Request $request, $id)
    {
        $pakaian = Pakaian::find($id);
        if (!$pakaian) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $pakaian->update($request->all());
        return response()->json(['message' => 'Pakaian berhasil diupdate!', 'data' => $pakaian]);
    }

    public function destroy($id)
    {
        $pakaian = Pakaian::find($id);
        if (!$pakaian) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $pakaian->delete();
        return response()->json(['message' => 'Pakaian berhasil dihapus!']);
    }
}