<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();
        $pegawai = Pegawai::join()->get();
        
        return view('pegawai.index',compact('pegawai', 'jabatan', 'unit_kerja'));
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
            'jabatan_pegawai' => 'required',
            'unit_kerja_pegawai' => 'required',
        ]);

        $nama_pegawai = $request->input('nama_pegawai');
        $jabatan_pegawai = $request->input('jabatan_pegawai');
        $unit_kerja_pegawai = $request->input('unit_kerja_pegawai');
    
        Pegawai::create([
            'nama_pegawai' => $nama_pegawai,
            'jabatan_pegawai' => $jabatan_pegawai,
            'unit_kerja_pegawai' => $unit_kerja_pegawai,
        ]);

        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai created successfully.');
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
            'jabatan_pegawai' => 'required',
            'unit_kerja_pegawai' => 'required',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai deleted successfully');
    }
}
