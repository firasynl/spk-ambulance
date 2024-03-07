<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Nilai;
use Carbon\Carbon;
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
        // $penilaian_kinerja = DB::table('pegawai')
            // ->join('jabatan', 'pegawai.jabatan_pegawai', '=', 'jabatan.id')
            // ->select(
            //     'pegawai.id',
        //     'pegawai.nama_pegawai as nama_pegawai',
            //     'jabatan.jabatan',
            // )
            // ->get();
    
        $penilaian_kinerja = Pegawai::get();
        
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
    public function create(Request $request)
    {
        $pegawai = $request -> pegawai;
        $position = Pegawai::findOrFail($pegawai)->jabatan_pegawai;
        // dd($position);
        // $id_position = Jabatan::where('jabatan', $position)->first()->id;
        // dd($id_position);
        $indikator = Indikator::where('jabatan_id', $position)->get();
        
        return view('penilaian_kinerja.create', compact('indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //yang diambil id pegawai, id user

        // $pegawai->id = $request->input('pegawai_id');
        // $user = $request->input('user');
        // $tanggal = $request->input('tanggal');

        $pk = PenilaianKinerja::create([
            'pegawai' => ,
            'user' => auth()->user()->id,
            'tanggal' => Carbon::now(),
        ]);
        dd($pk);
        //indikator yang diambil idnya, penilian kerja juga
        $tes = Nilai::create([
            // 'indikator' => Indikator::find($id),
            'penilaian_kinerja' => $pk->id,
            'nilai' => $request->nilai,
        ]);
        return redirect()->route('penilaian_kinerja.index');
        // dd($tes);
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
