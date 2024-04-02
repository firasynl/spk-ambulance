<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Penilaian Kinerja Pegawai</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin-left: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-right: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000000;
                text-align: left;
                padding: 3px;
                font-size: 11px; 
            }
            th {
                background-color: #f2f2f2;
            }
            p {
                font-size: 12px; 
            }

            td.no-l-border{
                border-left: none;
            }

            td.no-r-border{
                border-right: none;
            }

            td.no-b-border{
                border-bottom: none;
            }

            td.no-top-border{
                border-top: none;
            }

            td.no-border, th.no-border {
                border: none;
                background-color: #ffffff;
            }

            .center {
                text-align: center;
            }

            .bold {
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <h2 style="text-align: center;">Penilaian Kinerja Pegawai</h2>
        <p>Periode Penilaian: {{ $periode }}</p> 
        <table>
            <tr>
                <th width="50%" colspan="3" class="center"> PEGAWAI YANG DINILAI</th>
                <th width="50%" colspan="3" class="center">PEJABAT PENILAI KINERJA</th>
            </tr>
            <tr>
                <td width="10%" class="no-r-border no-b-border">NAMA</td>
                <td width="2%" class="no-l-border no-r-border no-b-border">:</td>
                <td width="38%" class="no-l-border no-b-border">{{ $pegawai->nama_pegawai }}</td>
                <td width="10%" class="no-r-border no-b-border">NAMA</td>
                <td width="2%" class="no-l-border no-r-border no-b-border">:</td>
                <td width="38%" class="no-l-border no-b-border">{{ $user }}</td>
            </tr>
            <tr>
                <td class="no-r-border no-b-border no-top-border">NIK</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border">{{ $pegawai->nik }}</td>
                <td class="no-r-border no-b-border no-top-border">NIP</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border"></td>
            </tr>
            <tr>
                <td class="no-r-border no-b-border no-top-border">JABATAN</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border">{{ $jabatan}}</td>
                <td class="no-r-border no-b-border no-top-border">PANGKAT/GOL.RUANG</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border"></td>
            </tr>
            <tr>
                <td class="no-r-border no-b-border no-top-border">UNIT KERJA</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border">{{ $unitKerja }}</td>
                <td class="no-r-border no-b-border no-top-border">JABATAN</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border"></td>
            </tr>
            <tr>
                <td class="no-r-border no-b-border no-top-border"></td>
                <td class="no-border"></td>
                <td class="no-l-border no-b-border no-top-border"></td>
                <td class="no-r-border no-b-border no-top-border">UNIT KERJA</td>
                <td class="no-border">:</td>
                <td class="no-l-border no-b-border no-top-border">{{ $unitKerja }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th class="center" width="5%">NO</th>
                <th class="center" width="75%">KOMPONEN PENILAIAN KINERJA</th>
                <th class="center" width="7%">NILAI</th>
                <th class="center" width="13%">KETERANGAN</th>
            </tr>
            <tr>
                <th class="center">I</th>
                <th colspan="3">PENILAIAN KINERJA</th>
            </tr>
            @php
                $totalNilai = 0;
                $countNilai = 0;
            @endphp
            @foreach ($indikator as $index => $value)
                @if ($value->kategori == 'Penilaian Kinerja')
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $value->indikator }}</td>
                        <td class="center">
                            <span>{{ $penilaianKinerja->nilai->where('indikator_id', $value->id)->first()->nilai ?? '' }}</span>
                        </td>
                        <td>
                            @php
                                $nilaiIndikator = $penilaianKinerja->nilai->where('indikator_id', $value->id)->first();
                                if ($nilaiIndikator) {
                                    $totalNilai += $nilaiIndikator->nilai;
                                    $countNilai++;
                                    switch ($nilaiIndikator->nilai) {
                                        case 1:
                                            echo 'Sangat Kurang';
                                            break;
                                        case 2:
                                            echo 'Kurang';
                                            break;
                                        case 3:
                                            echo 'Cukup';
                                            break;
                                        case 4:
                                            echo 'Baik';
                                            break;
                                        case 5:
                                            echo 'Sangat Baik';
                                            break;
                                        default:
                                            echo '';
                                            break;
                                    }
                                }
                            @endphp
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" class="center bold">CAPAIAN PENILAIAN KINERJA</td>
                <td class="center">
                    @if ($countNilai > 0)
                        {{ round($totalNilai / $countNilai) }}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @php
                        if ($countNilai > 0) {
                            switch (round($totalNilai / $countNilai)) {
                                case 1:
                                    echo 'Sangat Kurang';
                                    break;
                                case 2:
                                    echo 'Kurang';
                                    break;
                                case 3:
                                    echo 'Cukup';
                                    break;
                                case 4:
                                    echo 'Baik';
                                    break;
                                case 5:
                                    echo 'Sangat Baik';
                                    break;
                                default:
                                    echo '';
                                    break;
                            }
                        } else {
                            echo '';
                        }   
                    @endphp
                </td>
                    
            </tr>
            <tr>
                <th class="center">II</th>
                <th colspan="3">PERILAKU KERJA</th>
            </tr>
            @php
                $totalNilai2 = 0;
                $countNilai2 = 0;
            @endphp
            @foreach ($indikator as $index => $value)
                @if ($value->kategori == 'Perilaku Kerja')
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $value->indikator }}</td>
                        <td class="center">
                            <span>{{ $penilaianKinerja->nilai->where('indikator_id', $value->id)->first()->nilai ?? '' }}</span>
                        </td>
                        <td>
                            @php
                                $nilaiIndikator = $penilaianKinerja->nilai->where('indikator_id', $value->id)->first();
                                if ($nilaiIndikator) {
                                    $totalNilai2 += $nilaiIndikator->nilai;
                                    $countNilai2++;
                                    switch ($nilaiIndikator->nilai) {
                                        case 1:
                                            echo 'Sangat Kurang';
                                            break;
                                        case 2:
                                            echo 'Kurang';
                                            break;
                                        case 3:
                                            echo 'Cukup';
                                            break;
                                        case 4:
                                            echo 'Baik';
                                            break;
                                        case 5:
                                            echo 'Sangat Baik';
                                            break;
                                        default:
                                            echo '';
                                            break;
                                    }
                                }
                            @endphp
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" class="center bold">NILAI PERILAKU</td>
                <td class="center">
                    @if ($countNilai2 > 0)
                        {{ round($totalNilai2 / $countNilai2) }}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @php
                    if ($countNilai2 > 0) {
                        switch (round($totalNilai2 / $countNilai2)) {
                            case 1:
                                echo 'Sangat Kurang';
                                break;
                            case 2:
                                echo 'Kurang';
                                break;
                            case 3:
                                echo 'Cukup';
                                break;
                            case 4:
                                echo 'Baik';
                                break;
                            case 5:
                                echo 'Sangat Baik';
                                break;
                            default:
                                echo '';
                                break;
                        }
                    } else {
                        echo '';
                    }   
                    @endphp
                </td>
            </tr>

            <tr>
                <td colspan="2" class="center bold">NILAI AKHIR PENILAIAN</td>
                <td class="center">
                    @if ($countNilai > 0 and $countNilai2 > 0)
                        {{ round(($totalNilai + $totalNilai2)/($countNilai + $countNilai2))  }}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @php
                    if ($countNilai > 0 && $countNilai2 > 0) {
                        switch (round(($totalNilai + $totalNilai2)/($countNilai + $countNilai2))) {
                            case 1:
                                echo 'Sangat Kurang';
                                break;
                            case 2:
                                echo 'Kurang';
                                break;
                            case 3:
                                echo 'Cukup';
                                break;
                            case 4:
                                echo 'Baik';
                                break;
                            case 5:
                                echo 'Sangat Baik';
                                break;
                            default:
                                echo '';
                                break;
                        }
                    } else {
                        echo '';
                    }   
                    @endphp
                </td>
            </tr> 
        </table>

        <div style="margin: 0 auto;">
            <p> KETERANGAN : </p>
            <table>
                <tr>
                    <td width="15%" class="no-border">Sangat Baik </td>
                    <td width="2%" class="no-border">:</td>
                    <td width="83%" class="no-border">86 - 100</td>
                </tr>
                <tr>
                    <td class="no-border">Baik</td>
                    <td class="no-border">:</td>
                    <td class="no-border">71 - 85</td>
                </tr>
                <tr>
                    <td class="no-border">Cukup</td>
                    <td class="no-border">:</td>
                    <td class="no-border">61 - 70</td>
                </tr>
                <tr>
                    <td class="no-border">Kurang</td>
                    <td class="no-border">:</td>
                    <td class="no-border">41 - 60</td>
                </tr>
                <tr>
                    <td class="no-border">Sangat Kurang</td>
                    <td class="no-border">:</td>
                    <td class="no-border">0 - 40</td>
                </tr>
            </table>
        </div>

        <div style="height: 40px;"></div>

        <div style="margin: 0 auto;">
            <table style="text-align: center;">
              <tr>
                <td class="no-border" colspan="3"></td>
                <td class="no-border center" style="text-align: center">Semarang, {{ $dateName }}  </td>
                <td class="no-border" colspan="2"></td>
              </tr>
              <tr style="height: 10px;">
              </tr>
              <tr>
                <td class="no-border" width="15%"></td>
                <td class="no-border center bold" width="30%">PEGAWAI YANG DINILAI</th\d>
                <td class="no-border" width="10%"></td>
                <td class="no-border center bold" width="30%">PEJABAT PENILAI</td>
                <td class="no-border" width="15%"></td>
              </tr>
              <tr>
                <td class="no-border"></td>
                <td class="no-border" height="80px"></td>
                <td class="no-border"></td>
                <td class="no-border" height="80px"></td>
                <td class="no-border"></td>
              </tr>
              <tr>
                <td class="no-border"></td>
                <td class="no-border center">{{ $pegawai->nama_pegawai }}</td>
                <td class="no-border"></td>
                <td class="no-border center">Kepala Puskesmas</td>
                <td class="no-border"></td>
              </tr>
              <tr>
                <td class="no-border"></td>
                <td class="no-border center">{{ $pegawai->nik }}</td>
                <td class="no-border"></td>
                <td class="no-border center">NIP</td>
                <td class="no-border"></td>
              </tr>
            </table>
        </div>
    </body>
</html>
