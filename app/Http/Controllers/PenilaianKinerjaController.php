<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pegawai = Pegawai::select('id', 'nama_pegawai')->get();
        // $user = Users::select('id', 'nama_user')->get();
        // $jabatan = Jabatan::select('id', 'jabatan')->get();
        $penilaian_kinerja = PenilaianKinerja::join()->get();
        
        return view('penilaian_kinerja.index',compact('penilaian_kinerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PenilaianKinerja $penilaianKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianKinerja $penilaianKinerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianKinerja $penilaianKinerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianKinerja $penilaianKinerja)
    {
        //
    }
}
