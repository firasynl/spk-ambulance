<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $jabatan = Jabatan::select('id', 'jabatan');
        $unit_kerja = UnitKerja::select('id', 'unit_kerja');
        $pegawaiQuery = Pegawai::query();

        if ($searchQuery) {
            $pegawaiQuery->where('nama_pegawai', 'LIKE', "%$searchQuery%")
            ->orWhereHas('jabatan', function ($query) use ($searchQuery) {
                $query->where('jabatan', 'LIKE', "%$searchQuery%");
                })
            ->orWhereHas('unit_kerja', function ($query) use ($searchQuery) {
                $query->where('unit_kerja', 'LIKE', "%$searchQuery%");
                });
        }
        $pegawai = $pegawaiQuery->paginate(10);
        if ($request->filled('search')) {
            $pegawai->appends(['search' => $request->input('search')]);
        }

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pegawai.index',compact('pegawai', 'jabatan', 'unit_kerja'))->with('pagination', $pegawai);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();

        return view('pegawai.create',compact('jabatan', 'unit_kerja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required',
            'jabatan_id' => 'required',
            'unit_kerja_pegawai' => 'required',
        ]);

        $nama_pegawai = $request->input('nama_pegawai');
        $nik = $request->input('nik');
        $jabatan_id = $request->input('jabatan_id');
        $unit_kerja_pegawai = $request->input('unit_kerja_pegawai');
    
        Pegawai::create([
            'nama_pegawai' => $nama_pegawai,
            'nik' => $nik,
            'jabatan_id' => $jabatan_id,
            'unit_kerja_pegawai' => $unit_kerja_pegawai,
        ]);

        Alert::success('Success', 'Data berhasil dibuat');

        return redirect()->route('pegawai.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();

        return view('pegawai.edit',compact('pegawai', 'jabatan', 'unit_kerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai): RedirectResponse
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required',
            'jabatan_id' => 'required',
            'unit_kerja_pegawai' => 'required',
        ]);

        $pegawai->update($request->all());

        Alert::success('Success', 'Data berhasil diupdate');

        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {   
        if ($pegawai->delete()){ 
            Alert::success('Deleted', 'Data berhasil dihapus');
        }

        return redirect()->route('pegawai.index');
    }
}
