<x-adminlayout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Penilaian Kinerja Pegawai
        </p>
        @php 
            $nama = App\Models\Pegawai::find($pegawai)->nama_pegawai;
            $periode = App\Models\Periode::where('status', '=', 'Aktif')->first()->nama_periode;
        @endphp
        <p class="text-l pb-3 flex items-center">Nama pegawai : {{ $nama }}</p>
        <p class="text-l pb-3 flex items-center">Periode penilaian : {{ $periode }}</p>
        <div class="flex flex-wrap">
            <div class="w-full pr-0 lg:pr-2">
                <div class="leading-loose">
                    <form class="bg-white rounded" action="{{ route('penilaian_kinerja.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pegawai" value="{{ $pegawai }}">

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
                                        <td class="text-center py-3 px-4">
                                            <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=1>
                                        </td>
                                        <td class="text-center py-3 px-4">
                                            <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=2>
                                        </td>
                                        <td class="text-center py-3 px-4">
                                            <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=3>
                                        </td>
                                        <td class="text-center py-3 px-4">
                                            <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=4>
                                        </td>
                                        <td class="text-center py-3 px-4">
                                            <input type="radio" id="nilai_{{$value->id}}" name="nilai[{{$value->id}}]" value=5>
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
    </div>
</x-adminlayout>