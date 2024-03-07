<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Penilaian Kinerja Pegawai</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                font-size: 12px; 
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

            td.no-border, th.no-border {
                border: none;
                background-color: #ffffff;
            }

            .center {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h2 style="text-align: center;">Penilaian Kinerja Pegawai</h2>
        <p>PERIODE PENILAIAN: </p>
        <table>
            <tr>
                <th width="50%" colspan="3" class="center"> PEGAWAI YANG DINILAI</th>
                <th width="50%" colspan="3" class="center">PEJABAT PENILAI KINERJA</th>
            </tr>
            <tr>
                <td width="10%" class="no-r-border">NAMA</td>
                <td width="%" class="no-l-border no-r-border">:</td>
                <td width="38%" class="no-l-border"></td>
                <td width="10%" class="no-r-border">NAMA</td>
                <td width="2%" class="no-l-border no-r-border">:</td>
                <td width="38%" class="no-l-border"></td>
            </tr>
            <tr>
                <td class="no-r-border">NIK</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
                <td class="no-r-border">NIP</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
            </tr>
            <tr>
                <td class="no-r-border">JABATAN</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
                <td class="no-r-border">PANGKAT/GOL.RUANG</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
            </tr>
            <tr>
                <td class="no-r-border">UNIT KERJA</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
                <td class="no-r-border">JABATAN</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
            </tr>
            <tr>
                <td class="no-r-border"></td>
                <td class="no-l-border no-r-border"></td>
                <td class="no-l-border"></td>
                <td class="no-r-border">UNIT KERJA</td>
                <td class="no-l-border no-r-border">:</td>
                <td class="no-l-border"></td>
            </tr>
        </table>
        <table>
            <tr>
                <th rowspan="2" width="5px">NO</th>
                <th rowspan="2" class="center">KOMPONEN PENILAIAN KINERJA</th>
                <th colspan="5" class="center">NILAI</th>
            </tr>
            <tr>
                <th class="center">SB</th>
                <th class="center">B</th>
                <th class="center">C</th>
                <th class="center">K</th>
                <th class="center">SK</th>
            </tr>
            <tr>
                <th>I</th>
                <th colspan="6">PENILAIAN KINERJA</th>
            </tr>
            <tr>
                <th>II</th>
                <th colspan="6">PERILAKU KERJA</th>
            </tr>
            {{-- @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    {{-- <td>{{ $item->indikator }}</td> --}}
                    {{-- <td>{{ $item->nilai }}</td> --}}
                    {{-- <td>
                        @if ($item->nilai == 1)
                            Sangat Kurang
                        @elseif ($item->nilai == 2)
                            Kurang
                        @elseif ($item->nilai == 3)
                            Cukup
                        @elseif ($item->nilai == 4)
                            Baik
                        @else
                            Sangat Baik
                        @endif
                    </td> --}}
                {{-- </tr> --}}
            {{-- @endforeach --}} 
        </table>

        <div style="margin: 0 auto;">
            <table style="text-align: center;">
                <tr>
                    <td class="no-border" colspan="3"></td>
                    <td class="no-border">Semarang,</td>
                </tr>
              <tr>
                <td class="no-border" width="15%"></td>
                <th class="no-border center" width="30%" class="center">PEGAWAI YANG DINILAI</th>
                <td class="no-border" width="10%"></td>
                <th class="no-border center" width="30%" class="center">PEJABAT PENILAI</th>
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
                <td class="no-border center">Tanti Widiyanti</td>
                <td class="no-border"></td>
                <td class="no-border center">dr. KURNIA RIZQA AKBAR</td>
                <td class="no-border"></td>
              </tr>
              <tr>
                <td class="no-border"></td>
                <td class="no-border center">3327096404860009</td>
                <td class="no-border"></td>
                <td class="no-border center">19781110 2009 04 1 003</td>
                <td class="no-border"></td>
              </tr>
            </table>
        </div>

        {{-- <p>CAPAIAN KINERJA PEGAWAI: {{ $capaian_kinerja }} ({{ $keterangan_capaian }})</p>
        <p>NILAI PERILAKU: {{ $nilai_perilaku }} ({{ $keterangan_perilaku }})</p>
        <p>NILAI AKHIR PENILAIAN: {{ $nilai_akhir }} ({{ $keterangan_akhir }})</p>

        <p>{{ $tanggal }},</p>

        <p>PEGAWAI YANG DINILAI: {{ $pegawai->nama }}</p>
        <p>NIK: {{ $pegawai->nik }}</p>
        <p>JABATAN: {{ $pegawai->jabatan }}</p>
        <p>UNIT KERJA: {{ $pegawai->unit_kerja }}</p>
        <p>PEJABAT PENILAI: {{ $pejabat_penilai->nama }}</p>
        <p>NIP: {{ $pejabat_penilai->nip }}</p> --}}

    </body>
</html>
