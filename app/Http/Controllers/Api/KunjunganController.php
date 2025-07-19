<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    // Tampilkan semua data kunjungan
    public function index()
    {
        return response()->json(Kunjungan::with('pengunjung')->get());
    }

    // Tampilkan detail kunjungan berdasarkan ID
    public function show($id)
    {
        $kunjungan = Kunjungan::with('pengunjung')->find($id);
        if (!$kunjungan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($kunjungan);
    }

    // Simpan data kunjungan baru
    public function store(Request $request)
    {
        $request->validate([
            'pengunjung_id' => 'required|exists:pengunjung,id',
            'tanggal_kunjungan' => 'required|date',
            'tujuan' => 'required|string|max:255',
        ]);

        $kunjungan = Kunjungan::create($request->all());

        return response()->json($kunjungan, 201);
    }

    // Perbarui data kunjungan
    public function update(Request $request, $id)
    {
        $kunjungan = Kunjungan::find($id);
        if (!$kunjungan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'pengunjung_id' => 'sometimes|exists:pengunjung,id',
            'tanggal_kunjungan' => 'sometimes|date',
            'tujuan' => 'sometimes|string|max:255',
        ]);

        $kunjungan->update($request->all());

        return response()->json($kunjungan);
    }

    // Hapus data kunjungan
    public function destroy($id)
    {
        $kunjungan = Kunjungan::find($id);
        if (!$kunjungan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $kunjungan->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
