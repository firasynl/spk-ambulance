<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\PenilaianKinerja;
use App\Models\Pegawai;
use App\Models\Users;
use App\Models\Periode;
use App\Models\Jabatan;
use App\Models\Nilai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
                $unitKerjaId = Auth::user()->unit_kerja;
                $query = Pegawai::where('unit_kerja_pegawai', $unitKerjaId);
            } else if ($usertype == 'admin') {
                $query = Pegawai::query();
            }
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('nama_pegawai', 'like', "%$searchTerm%")
                    ->orWhereHas('jabatan', function ($query) use ($searchTerm) {
                        $query->where('jabatan', 'like', "%$searchTerm%");
                    });
            });
        }

        $pegawai = $query->paginate(10);
        if ($request->filled('search')) {
            $pegawai->appends(['search' => $request->input('search')]);
        }
        $periode = Periode::all();
        $periodeAktif = Periode::where('status', '=', 'Aktif')->first();
        $periodeEmpty = $periode->isEmpty() ? 'No data in periode' : '';
        $dateFilter = null;

        // Jika ada filter periode yang dipilih
        if ($request->has('date_filter') && !$periodeEmpty) {
            $dateFilter = $request->date_filter;

            // Jika filter periode adalah periode tertentu
            $penilaian_kinerja = PenilaianKinerja::where('periode_id', $dateFilter)
                ->whereIn('pegawai', $pegawai->pluck('id'))
                ->get();
        } elseif ( !$periodeEmpty) {
            $dateFilter = $periodeAktif->id;
            // Jika tidak ada filter, tampilkan data periode aktif
            $penilaian_kinerja = PenilaianKinerja::where('periode_id', $periodeAktif->id)
                ->whereIn('pegawai', $pegawai->pluck('id'))
                ->get();
        } else {
            $penilaian_kinerja = PenilaianKinerja::whereIn('pegawai', $pegawai->pluck('id'))
                ->get();
        }

        return response()->view('penilaian_kinerja.index',compact('penilaian_kinerja', 'pegawai', 'dateFilter', 'periode', 'periodeAktif', 'periodeEmpty'));

    }

    public function exportPdf($id)
    {
        $penilaianKinerja = PenilaianKinerja::findOrFail($id);
        $pegawaiId = $penilaianKinerja->pegawai;
        $userId = $penilaianKinerja->user;

        $pegawai = Pegawai::findOrFail($pegawaiId);
        $users = Users::findOrFail($userId);
        $position = $pegawai->jabatan_id;
        $jabatanId = Jabatan::findOrFail($position);
        $jabatan = $jabatanId->jabatan;
        $unitKerjaId = UnitKerja::findOrFail($pegawai->unit_kerja_pegawai);
        $unitKerja = $unitKerjaId->unit_kerja;
        $uk_user_id = UnitKerja::findOrFail($users->unit_kerja);
        $unitKerjaUser = $uk_user_id->unit_kerja;
        $jabatan_user_id = Jabatan::findOrFail($users->jabatan_pegawai);
        $jabatanUser = $jabatan_user_id->jabatan;
        $periodeId = $penilaianKinerja->periode_id;
        $periodes = Periode::findOrFail($periodeId);
        $periode = $periodes->nama_periode;

        $indikator = Indikator::where('jabatan_id', $pegawai->jabatan_id)->get();

        $dateName = Carbon::now()->locale('id')->isoFormat('LL');

        $fileName = $pegawai->nama_pegawai . '_' . Carbon::now()->format('Ymd') . '.pdf';

        $pdf = PDF::loadView('pdf.export-penilaian', ['penilaianKinerja' => $penilaianKinerja, 'indikator' => $indikator, 'pegawai' => $pegawai, 'jabatan' => $jabatan, 'unitKerja' => $unitKerja, 'unitKerjaUser' => $unitKerjaUser, 'users' => $users, 'jabatanUser' => $jabatanUser, 'periode' => $periode, 'dateName' => $dateName])
                ->setPaper([0, 0, 612.2835, 935.433]);

        // return view('pdf.export-penilaian',compact('pdf', 'indikator', 'penilaianKinerja', 'pegawai', 'jabatan', 'unitKerja','unitKerjaUser', 'users', 'jabatanUser', 'periode', 'dateName'));
        return $pdf->download($fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pegawai = $request->input('pegawai');
        $position = Pegawai::findOrFail($pegawai)->jabatan_id;
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

        Alert::success('Success', 'Penilaian kinerja berhasil dibuat');

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
        $position = $pegawai->jabatan_id;

        $indikator = Indikator::where('jabatan_id', $pegawai->jabatan_id)->get();

        $penilaian_kinerja = PenilaianKinerja::with(['nilai' => function($query) use ($penilaianKinerja, $periodeAktif) {
            $query->where('penilaian_kinerja_id', $penilaianKinerja->id);
        }])->findOrFail($penilaianKinerja->id);

        $pegawaiName = $pegawai->nama_pegawai;

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

        Alert::success('Success', 'Penilaian kinerja berhasil diedit');

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
