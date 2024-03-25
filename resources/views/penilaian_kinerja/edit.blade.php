<x-admin-layout>
    <div class="bg-white overflow-auto">
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="w-full text-3xl text-black pb-6">Edit Penilaian Kinerja</h1>

                <div class="flex flex-wrap">
                    <div class="w-full my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded" method="POST" action="{{ route('penilaian_kinerja.update', $penilaianKinerja->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="bg-white overflow-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-800 text-white">
                                            <tr>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Indikator</th> 
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
                                <div class="flex justify-center mt-5">
                                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>   
        </div> 
    </div>
</x-admin-layout>