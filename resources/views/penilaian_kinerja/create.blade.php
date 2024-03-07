<x-adminlayout>
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Penilaian Kinerja Pegawai
        </p>
        <form action="" method="POST">
            @csrf
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
                            <td class="text-center py-3 px-4">
                                <input type="radio" id="nilai" name="nilai{{$value->id}}" value="1">
                            </td>
                            <td class="text-center py-3 px-4">
                                <input type="radio" id="nilai" name="nilai{{$value->id}}" value="2">
                            </td>
                            <td class="text-center py-3 px-4">
                                <input type="radio" id="nilai" name="nilai{{$value->id}}" value="3">
                            </td>
                            <td class="text-center py-3 px-4">
                                <input type="radio" id="nilai" name="nilai{{$value->id}}" value="4">
                            </td>
                            <td class="text-center py-3 px-4">
                                <input type="radio" id="nilai" name="nilai{{$value->id}}" value="5">
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
</x-adminlayout>