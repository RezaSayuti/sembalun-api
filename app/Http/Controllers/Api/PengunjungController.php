<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        return response()->json(Pengunjung::all());
    }

    public function show($id)
    {
        $data = Pengunjung::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:100|unique:pengunjung,no_identitas',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $pengunjung = Pengunjung::create($validated);
        return response()->json($pengunjung, 201);
    }

    public function update(Request $request, $id)
    {
        $pengunjung = Pengunjung::find($id);
        if (!$pengunjung) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'no_identitas' => 'sometimes|required|string|max:100|unique:pengunjung,no_identitas,' . $id,
            'jenis_kelamin' => 'sometimes|required|in:L,P',
            'no_hp' => 'sometimes|required|string|max:20',
            'alamat' => 'sometimes|required|string',
        ]);

        $pengunjung->update($validated);
        return response()->json($pengunjung);
    }

    public function destroy($id)
    {
        $pengunjung = Pengunjung::find($id);
        if (!$pengunjung) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $pengunjung->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
