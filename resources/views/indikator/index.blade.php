<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Indikator
        </p>
        <div class="mt-4 mb-8">
            <a href="{{ route('indikator.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Indikator</a>
            </div>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-10 text-center py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="w-1/2 text-center py-3 px-4 uppercase font-semibold text-sm">Indikator</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Kategori</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jabatan</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($indikator as $indikator)
                        <tr>
                            <td class="text-center px-4">{{ $no++ }}</td>
                            <td class="text-left px-4">{{ $indikator->indikator }}</td>
                            <td class="text-center px-4">{{ $indikator->kategori }}</td>
                            <td class="text-center px-4">{{ $indikator->jabatan }}</td>
                            <td class="text-left px-4">
                                <div class="mt-4 mb-4 flex justify-center">
                                <a href="{{ route('indikator.edit',$indikator->id) }}" class="px-4 py-1 mr-1 text-white font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                <form action="{{ route('indikator.destroy',$indikator->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" value="Delete">
                                        <i class="fas fa-trash-alt">
                                        </i> Delete
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pagination->links() }}
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