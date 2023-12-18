<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller {
    public function index(Request $request) {
        $tahun = $request->input('tahun');
        $level = $request->input('level');
        $query = Nilai::query();
    
        if ($tahun) {
            $query->where('tahun', $tahun);
        }
        
        if ($level) {
            $query->where('konversi_nilai', $level);
        }
    
        $nilaiList = $query->get();
    
        return view('nilai.index', compact('nilaiList'));
    }

    public function create(){
        return view('nilai.form');
    }

    public function store(Request $request) {
        $request->validate([
            'nim' => 'required',
            'nama_peserta' => 'required',
            'nama_fasilitator' => 'required',
            'nilai_akhir' => 'required|numeric',
            'presensi' => 'required|integer',
            'total_nilai' => 'required|numeric',
        ]);
    
        $dataToStore = $request->all();
        $dataToStore['konversi_nilai'] = $this->konversiNilai($request->input('nilai_akhir'));
    
        Nilai::create($dataToStore);
        return redirect()->route('nilai.index')->with('success', 'Data peserta berhasil ditambahkan!');
    }

    public function edit($id) {
        $nilai = Nilai::findOrFail($id);
        $nilaiList = Nilai::all();
        return view('nilai.index', compact('nilaiList', 'nilai'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required',
            'nama_peserta' => 'required',
            'nama_fasilitator' => 'required',
            'nilai_akhir' => 'required|numeric',
            'presensi' => 'required|integer',
            'total_nilai' => 'required|numeric',
        ]);

        $dataToUpdate = $request->all();
        $dataToUpdate['konversi_nilai'] = $this->konversiNilai($request->input('nilai_akhir'));

        $nilai = Nilai::findOrFail($id);
        $nilai->update($dataToUpdate);

        return redirect()->route('nilai.index')->with('success', 'Data peserta berhasil diperbarui!');
    }

    public function destroy($id) {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data peserta berhasil dihapus!');
    }

    private function konversiNilai($nilai_akhir) {
        if ($nilai_akhir >= 60 && $nilai_akhir < 70) {
            return 'C';
        } elseif ($nilai_akhir >= 70 && $nilai_akhir < 85) {
            return 'B';
        } elseif ($nilai_akhir >= 85 && $nilai_akhir <= 100) {
            return 'A';
        } else {
            return 'Tidak Valid';
        }
    }
}
