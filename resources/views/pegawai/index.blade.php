<x-admin-layout>
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Pegawai
        </p>
        <div class="mt-4 mb-4">
            <a href="{{ route('pegawai.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah</a>
            </div>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Jabatan</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Unit Kerja</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pegawai as $pegawai)
                        <tr>
                            <td class="text-left py-3 px-4">{{ $no++ }}</td>
                            <td class="text-left py-3 px-4">{{ $pegawai->nama_pegawai }}</td>
                            <td class="text-left py-3 px-4">{{ $pegawai->jabatan }}</td>
                            <td class="text-left py-3 px-4">{{ $pegawai->unit_kerja }}</td>
                            <td class="text-left py-3 px-4">
                                <a href="{{ route('pegawai.edit',$pegawai->id) }}" class="px-4 py-1 text-white font-light tracking-wider bg-blue-700 rounded">Edit</a>
                                <form action="{{ route('pegawai.destroy',$pegawai->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $pegawai->links() }} --}}
        </div>
    </div>
</x-admin-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Periksa apakah ada pesan sukses
        let successMessage = "{{ session('success') }}";

        // Jika ada pesan sukses, tampilkan pesan pop-up
        if (successMessage) {
            alert(successMessage);
        }
    });
</script>