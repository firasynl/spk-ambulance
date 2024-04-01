<?php

namespace App\Charts;

use App\Models\Jabatan;
use App\Models\Nilai;
use App\Models\Pegawai;
use App\Models\PenilaianKinerja;
use App\Models\Periode;
use App\Models\UnitKerja;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class NilaiPegawaiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {   
        $pegawaiAll = null;
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                $unitKerjaId = Auth::user()->unit_kerja;
                // Memuat penilaian kinerja hanya untuk unit kerja pengguna yang sedang login
                $penilaianKinerjas = PenilaianKinerja::whereHas('pegawai', function ($query) use ($unitKerjaId) {
                    $query->where('unit_kerja_pegawai', $unitKerjaId);
                })->get();
                // Memuat semua pegawai hanya untuk unit kerja pengguna yang sedang login
                $pegawaiAll = Pegawai::where('unit_kerja_pegawai', $unitKerjaId)->get();
            } else if ($usertype == 'admin') {
                $penilaianKinerjas = PenilaianKinerja::all();
                $pegawaiAll = Pegawai::all();
            }
        }

        // Pastikan penilaian kinerja dimuat
        if (!isset($penilaianKinerjas)) {
            $penilaianKinerjas = collect();
        }

    $periodeAktif = Periode::where('status', 'Aktif')->first();

    // Mengambil ID periode aktif
    $periodeId = $periodeAktif ? $periodeAktif->id : null;

    $nilai_pegawai = [];
    $nama_pegawai = [];

    // Memuat nama pegawai dan nilai
    foreach ($penilaianKinerjas as $penilaianKinerja) {
        if ($penilaianKinerja->periode_id == $periodeId){
        $pegawaiId = $penilaianKinerja->pegawai;
        $pegawai = Pegawai::findOrFail($pegawaiId);
        $nama_pegawai[] = $pegawai->nama_pegawai;

        $nilai = round($penilaianKinerja->nilai->avg('nilai')); 
        $nilai_pegawai[] = $nilai;
        }
    }

    // Memastikan nama pegawai yang belum memiliki nilai juga dimuat
    if ($pegawaiAll) {
        foreach ($pegawaiAll as $pegawai) {
            if (!in_array($pegawai->nama_pegawai, $nama_pegawai)) {
                $nama_pegawai[] = $pegawai->nama_pegawai;
                $nilai_pegawai[] = 0; 
            }
        }
    }

    // dd($nilai_pegawai);

    return $this->chart->barChart()
        ->setTitle('Data Nilai Pegawai')
        ->setSubtitle($periodeAktif ? $periodeAktif->nama_periode : '')
        ->addData('Total nilai', $nilai_pegawai) //nilai
        ->setXAxis($nama_pegawai); //nama pegawai
}
}