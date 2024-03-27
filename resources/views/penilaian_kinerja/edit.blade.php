<x-admin-layout>
    <head>
        <style>
            /* Styling untuk garis pinggir tabel */
            table {
                border-collapse: collapse;
                width: 100%;
            }

            /* Styling untuk garis pinggir th */
            th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                background-color: #424242;
            }

            /* Styling untuk garis pinggir td */
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            /* Styling untuk baris ganjil */
            tr:nth-child(odd) {
                background-color: #f2f2f2;
            }

            .td2 {
                background-color: #ffffff;
                border: 0px;
                text-align: left;
                padding: 3px;
            }
        </style>
    </head>
        <div class="w-full mt-12">
            <main class="w-full flex-grow">
                <p class="text-2xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Edit Penilaian Kinerja
                </p>
                @php 
                    $periode = App\Models\Periode::where('status', '=', 'Aktif')->first()->nama_periode;
                @endphp
                <p class="text-l pb-3 flex items-center">Nama pegawai : {{ $pegawaiName }}</p>
                <p class="text-l pb-3 flex items-center">Periode penilaian : {{ $periode }}</p>
                <div class="flex flex-wrap">
                    <div class="w-full pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="bg-white rounded" method="POST" action="{{ route('penilaian_kinerja.update', $penilaianKinerja->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="bg-white overflow-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-800 text-white">
                                            <tr>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-10">No</th> 
                                                <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Indikator</th> 
                                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">SK</th>  
                                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">K</th>
                                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">C</th>
                                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">B</th>
                                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">SB</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="text-gray-700">
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($indikator as $value)
                                                <tr>
                                                    <td class="text-left py-3 px-4">{{$no++}}</td>
                                                    <td class="text-left py-3 px-4">{{$value->indikator}}</td>
                                                    @php
                                                        $nilai = $penilaian_kinerja->nilai->where('indikator_id', $value->id)->first();
                                                    @endphp
                                                    <td class="text-center py-3 px-4">
                                                        <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=1 {{ $nilai ? ($nilai->nilai == 1 ? 'checked' : '') : '' }}>
                                                    </td>
                                                    <td class="text-center py-3 px-4">
                                                        <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=2 {{ $nilai ? ($nilai->nilai == 2 ? 'checked' : '') : '' }}>
                                                    </td>
                                                    <td class="text-center py-3 px-4">
                                                        <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=3 {{ $nilai ? ($nilai->nilai == 3 ? 'checked' : '') : '' }}>
                                                    </td>
                                                    <td class="text-center py-3 px-4">
                                                        <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=4 {{ $nilai ? ($nilai->nilai == 4 ? 'checked' : '') : '' }}>
                                                    </td>
                                                    <td class="text-center py-3 px-4">
                                                        <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=5 {{ $nilai ? ($nilai->nilai == 5 ? 'checked' : '') : '' }}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                    
                                </div>
                                <div class="m-8">
                                    <p> KETERANGAN : </p>
                                    <table class="">
                                        <tr>
                                            <td width="12%" class="td2">Sangat Baik </td>
                                            <td width="2%" class="td2">:</td>
                                            <td width="86%" class="td2">86 - 100</td>
                                        </tr>
                                        <tr>
                                            <td class="td2">Baik</td>
                                            <td class="td2">:</td>
                                            <td class="td2">71 - 85</td>
                                        </tr>
                                        <tr>
                                            <td class="td2">Cukup</td>
                                            <td class="td2">:</td>
                                            <td class="td2">61 - 70</td>
                                        </tr>
                                        <tr>
                                            <td class="td2">Kurang</td>
                                            <td class="td2">:</td>
                                            <td class="td2">41 - 60</td>
                                        </tr>
                                        <tr>
                                            <td class="td2">Sangat Kurang</td>
                                            <td class="td2">:</td>
                                            <td class="td2">0 - 40</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="flex justify-center">
                                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded m-10" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>   
        </div> 
    </div>
</x-admin-layout>