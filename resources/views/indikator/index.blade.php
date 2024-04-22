<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Indikator
        </p>
        <div class="flex flex-col md:flex-row justify-between mt-4 mb-4">
            <a href="{{ route('indikator.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Indikator</a>
            <form method="GET" action="{{ route('indikator.index') }}" class="flex w-full md:w-auto">
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
                        <th class="w-10 text-center py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="w-1/2 text-center py-3 px-4 uppercase font-semibold text-sm">Indikator</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Kategori</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jabatan</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = ($indikator->currentPage() - 1) * $indikator->perPage() + 1;
                    @endphp
                    @foreach ($indikator as $indikator)
                        <tr>
                            <td class="text-center px-4">{{ $no++ }}</td>
                            <td class="text-left px-4">{{ $indikator->indikator }}</td>
                            <td class="text-center px-4">{{ $indikator->kategori }}</td>
                            <td class="text-center px-4">{{ $indikator->jabatan->jabatan }}</td>
                            <td class="text-left px-4">
                                <div class="mt-4 mb-4 flex justify-center">
                                <a href="{{ route('indikator.edit',$indikator->id) }}" class="px-4 py-1 mr-1 text-white font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                <form action="{{ route('indikator.destroy',$indikator->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">
                                        <a href="{{ route('indikator.destroy',$indikator->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
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
