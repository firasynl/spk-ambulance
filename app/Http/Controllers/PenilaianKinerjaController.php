<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use function Laravel\Prompts\select;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaian_kinerja = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan_pegawai', '=', 'jabatan.id')
            ->select(
                'pegawai.nama_pegawai as nama_pegawai',
                'jabatan.jabatan'
            )
            ->get();
            
        return view('penilaian_kinerja.index',compact('penilaian_kinerja'));
    }

    public function exportPdf()
    {
        $data = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan_pegawai', '=', 'jabatan.id')
            ->join('indikator', 'jabatan.id', '=', 'indikator.jabatan')
            ->select(
                'pegawai.nama_pegawai as nama_pegawai',
                'jabatan.jabatan',
                'indikator.indikator'
            )
            ->get();

        // return view('pdf.export-penilaian',compact('data'));
        $pdf = Pdf::loadView('pdf.export-penilaian', ['data' => $data]);
        return $pdf->download('export-penilaian-pegawai.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penilaian_kinerja = PenilaianKinerja::select('id', 'pegawai')->first();
        // $jabatan = Jabatan::join('id', 'jabatan')->get();

        $indikator = Indikator::select('id', 'indikator')->get();
        // $nilai
        return view('penilaian_kinerja.create', compact('indikator', 'penilaian_kinerja'));
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
