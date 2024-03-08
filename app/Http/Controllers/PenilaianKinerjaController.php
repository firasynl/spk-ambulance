<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use function Laravel\Prompts\select;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $query = Pegawai::query();
        $dateFilter = $request->date_filter;

        switch($dateFilter){
            case 'today':
                $query->whereDate('created_at',Carbon::today());
                break;
            case 'last_three_months':
                $startDate = Carbon::now()->subMonths(2)->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $intervalMonths = 3;
                break;
            // default:
            //     // Default untuk periode bulan paling baru
            //     $query->whereYear('created_at', Carbon::now()->year)
            //             ->whereMonth('created_at', Carbon::now()->month);
            //     break;                       
        }
            
        $penilaian_kinerja = $query->get();
        // $penilaian_kinerja = Pegawai::get();
        
        // return view('penilaian_kinerja.index',compact('penilaian_kinerja'));
        return response()->view('penilaian_kinerja.index',compact('penilaian_kinerja','dateFilter'));
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
    
        $penilaian = new PenilaianKinerja();
        $penilaian->pegawai = $data['pegawai'];
        $penilaian->user = auth()->user()->id;
        $penilaian->tanggal = Carbon::now();
        $penilaian->save();
    
        $nilaiData = [];
        foreach ($data['nilai'] as $indikatorId => $nilai) {
            $nilaiData[] = [
                'penilaian_kinerja' => $penilaian->id,
                'indikator' => $indikatorId,
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
