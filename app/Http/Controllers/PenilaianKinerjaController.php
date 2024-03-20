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
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            
            if($usertype=='user')
            {
                $unitKerjaId = Auth::user()->unit_kerja_pegawai;
                $query= Pegawai::where('unit_kerja_pegawai', $unitKerjaId)->get();
            }
            else if($usertype=='admin')
            {
                $query = Pegawai::query()->get();
            }
        }

        // $penilaian_kinerja = $query;
        $periodeAktif = Periode::where('status', '=', 'Aktif')->first();

        // $pegawai = Pegawai::where('unit_kerja_pegawai', $unitKerjaId)->get();
        
        $dateFilter = $request->date_filter;
        $periode = Periode::all();
        $penilaian_kinerja = $query;
        $penilaianKinerja = PenilaianKinerja::all();

        // switch ($dateFilter) {
        //     case 'today':
        //         $query->whereDate('updated_at', Carbon::today());
        //         break;
        //     case 'nama_periode':
        //         // Ambil periode yang sesuai dari tabel Periode
        //         foreach ($periode as $periode) {
        //             $query->orWhereBetween('updated_at', [$periode->tanggal_mulai, $periode->tanggal_selesai]);
        //         }
        //         break;
        //     // Tambahkan case untuk opsi lain jika diperlukan
        //     default:
        //         // Tidak ada filter yang dipilih, tidak perlu operasi tambahan
        //         break;
        // }

        return response()->view('penilaian_kinerja.index',compact('penilaian_kinerja','penilaianKinerja','dateFilter', 'periode', 'periodeAktif'));

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
                'penilaian_kinerja' => $penilaian->id,
                'indikator_id' => $indikatorId,
                'nilai' => $nilai
            ];
        }

        Nilai::insert($nilaiData);

        return redirect()->route('penilaian_kinerja.index');
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
        $pegawai = $penilaianKinerja->pegawai;
        $position = Pegawai::findOrFail($pegawai)->jabatan_pegawai;
        $indikator = Indikator::where('jabatan_id', $position)->get();
        
        return view('penilaian_kinerja.edit', compact('penilaianKinerja', 'pegawai','indikator'));
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
