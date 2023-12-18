<?php

namespace App\Http\Controllers;

use App\Models\Fasilitator;
use Illuminate\Http\Request;

class FasilitatorController extends Controller {
    public function index() {
        $fasilitators = Fasilitator::all();
        return view('fasilitators.index', compact('fasilitators'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'NIDN' => 'required',
            'nama_lengkap' => 'required',
            'prodi' => 'required',
        ]);
    
        $data = $request->except('_token');
    
        Fasilitator::create($data);
        return redirect()->route(
            'fasilitators.index')->with(
                'success', 'Data Fasilitator berhasil di simpan'
            );
    }
    
    public function update(Request $request, Fasilitator $fasilitator) {
        $this->validate($request, [
        'NIDN' => 'required',
        'nama_lengkap' => 'required',
        'prodi' => 'required',
        ]);

        $data = $request->except(
            ['_token', '_method']
        );

        $fasilitator->update($data);
        return redirect()->route(
            'fasilitators.index')->with(
                'success', 'Data Fasilitator Berhasil diubah'
            );
    }

    public function destroy(Fasilitator $fasilitator) {
        $fasilitator->delete();
        return redirect()->route(
            'fasilitators.index')->with(
                'success', 'Data Fasilitator berhasil dihapus'
            );
    }
}
