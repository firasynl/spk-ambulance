<x-admin-layout>
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Pegawai
        </p>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Jabatan</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Unit Kerja</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Isi</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pegawai as $row)
                        <tr>
                            <td class="text-left py-3 px-4">{{ $no++ }}</td>
                            <td class="text-left py-3 px-4">{{ $row->nama_pegawai }}</td>
                            <td class="text-left py-3 px-4">{{ $row->jabatan_pegawai }}</td>
                            <td class="text-left py-3 px-4">{{ $row->unit_kerja_pegawai }}</td>
                            <td class="text-left py-3 px-4"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $pegawai->links() }} --}}
        </div>
    </div>
</x-admin-layout>