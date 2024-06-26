<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Pegawai
        </p>
        <div class="flex flex-col md:flex-row justify-between mt-4 mb-4">
            <a href="{{ route('pegawai.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Pegawai</a>
            <form method="GET" action="{{ route('pegawai.index') }}" class="flex w-full md:w-auto">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="p-2 border rounded-l w-full md:w-auto md:ml-2">
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-r flex items-center">
                    <span class="fas fa-search mr-2">
                        search
                    </span> Search
                </button>
        </form>
        </div>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm w-10">No</th> 
                        <th class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">Nama</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">NIK</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jabatan</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Unit Kerja</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1;;
                    @endphp
                    @foreach ($pegawai as $pegawai)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left px-5">{{ $pegawai->nama_pegawai }}</td>
                            <td class="text-left px-5">{{ $pegawai->nik }}</td>
                            <td class="text-center">{{ $pegawai->jabatan->jabatan}}</td>
                            <td class="text-center">{{ $pegawai->unit_kerja->unit_kerja }}</td>
                            <td class="text-left px-5">
                                <div class="mt-2 mb-2 flex justify-center">
                                    <a href="{{ route('pegawai.edit',$pegawai->id) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                <form action="{{ route('pegawai.destroy',$pegawai->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button href="{{ route('pegawai.destroy',$pegawai->id) }}" type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">
                                        <a href="{{ route('pegawai.destroy',$pegawai->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
                                    </button>       
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pagination->links() }}
        </div>
    </div>
</x-admin-layout>