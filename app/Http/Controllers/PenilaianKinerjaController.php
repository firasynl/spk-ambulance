<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Periode;
use App\Models\Jabatan;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
    
            if ($usertype == 'user') {
                $unitKerjaId = Auth::user()->unit_kerja_pegawai;
                $query = Pegawai::where('unit_kerja_pegawai', $unitKerjaId)->get();
            } else if ($usertype == 'admin') {
                $query = Pegawai::query()->get();
            }
        }
    
        $periodeAktif = Periode::where('status', '=', 'Aktif')->first();

        $pegawai = $query;
    
        $dateFilter = $request->date_filter;
        $periode = Periode::all();
        $penilaian_kinerja = PenilaianKinerja::where('periode_id', $periodeAktif->id)
            ->whereIn('pegawai', $pegawai->pluck('id'))
            ->get();

        return response()->view('penilaian_kinerja.index',compact('penilaian_kinerja', 'pegawai', 'dateFilter', 'periode', 'periodeAktif'));

    }

    public function exportPdf()
    {
        $data = Pegawai::with('jabatan')->get();

        // return view('pdf.export-penilaian',compact('data'));
        $pdf = Pdf::loadView('pdf.export-penilaian', ['data' => $data]);
        return $pdf->download('export-penilaian-pegawai.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pegawai = $request->input('pegawai');
        $position = Pegawai::findOrFail($pegawai)->jabatan_pegawai;
        $indikator = Indikator::where('jabatan_id', $position)->get();
        
        return view('penilaian_kinerja.create', compact('pegawai','indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pegawai' => 'required',
            'nilai' => 'required|array',
        ]);

        $periodeAktif = Periode::where('status', '=', 'Aktif')->first();
        $penilaian = new PenilaianKinerja();
        $penilaian->pegawai = $data['pegawai'];
        $penilaian->user = auth()->user()->id;
        $penilaian->periode_id = $periodeAktif->id;
        $penilaian->save();

        $nilaiData = [];
        foreach ($data['nilai'] as $indikatorId => $nilai) {
            $nilaiData[] = [
                'penilaian_kinerja_id' => $penilaian->id,
                'indikator_id' => $indikatorId,
                'nilai' => $nilai
            ];
        }

        Nilai::insert($nilaiData);

        return redirect()->route('penilaian_kinerja.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianKinerja $penilaianKinerja)
    {
        $periodeAktif = Periode::where('status', 'Aktif')->first();
        $pegawaiId = $penilaianKinerja->pegawai;

        $pegawai = Pegawai::findOrFail($pegawaiId);
        $position = $pegawai->jabatan_pegawai;

        $indikator = Indikator::where('jabatan_id', $pegawai->jabatan_pegawai)->get();

        $penilaian_kinerja = PenilaianKinerja::with(['nilai' => function($query) use ($penilaianKinerja, $periodeAktif) {
            $query->where('penilaian_kinerja_id', $penilaianKinerja->id);
        }])->findOrFail($penilaianKinerja->id);

        $pegawaiName = $pegawai->nama;

        return view('penilaian_kinerja.edit', compact('penilaianKinerja', 'penilaian_kinerja', 'pegawaiName', 'indikator'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianKinerja $penilaianKinerja)
    {
        $data = $request->validate([
            'nilai' => 'required|array',
        ]);

        // Update Penilaian Kinerja
        $penilaianKinerja->update([
            'user' => auth()->user()->id,
        ]);

        // Update Nilai
        foreach ($data['nilai'] as $indikatorId => $nilai) {
            $nilaiRecord = Nilai::where('penilaian_kinerja_id', $penilaianKinerja->id)
                ->where('indikator_id', $indikatorId)
                ->first();

            if ($nilaiRecord) {
                $nilaiRecord->update([
                    'nilai' => $nilai,
                ]);
            } else {
                Nilai::create([
                    'penilaian_kinerja_id' => $penilaianKinerja->id,
                    'indikator_id' => $indikatorId,
                    'nilai' => $nilai,
                ]);
            }
        }

        return redirect()->route('penilaian_kinerja.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianKinerja $penilaianKinerja)
    {
        //
    }
}
