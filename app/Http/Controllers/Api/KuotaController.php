<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuota;
use Illuminate\Http\Request;

class KuotaController extends Controller
{
    // Mengambil nilai kuota maksimal saat ini
    public function index()
    {
        $kuota = Kuota::first();
        return response()->json($kuota);
    }

    // Mengubah nilai kuota maksimal
    public function update(Request $request)
    {
        $request->validate([
            'max_quota' => 'required|numeric|min:1'
        ]);

        $kuota = Kuota::first();
        $kuota->update([
            'max_quota' => $request->max_quota
        ]);

        return response()->json([
            'message' => 'Kuota maksimal berhasil diperbarui',
            'data' => $kuota
        ]);
    }
}