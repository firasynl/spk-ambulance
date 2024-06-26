<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Periode
        </p>
        <div class="flex flex-col md:flex-row justify-between mt-4 mb-8">
        <a href="/home/periode/create" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Periode</a>
        <form method="GET" action="{{ route('periode.index') }}" class="flex w-full md:w-auto">
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
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 5%;">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Nama Periode</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Tanggal Mulai</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Tanggal Selesai</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 15%;">Status</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $no = ($periode->currentPage() - 1) * $periode->perPage() + 1;;
                    @endphp
                    @forelse ($periode as $key=>$value)
                    <tr>
                        <td class="text-center px-4">{{$no++}}</td>
                        <td class="text-left px-4">{{$value->nama_periode}}</td>
                        <td class="text-center px-4">{{$value->tanggal_mulai}}</td>
                        <td class="text-center px-4">{{$value->tanggal_selesai}}</td>
                        <td class="text-center px-4">{{$value->status}}</td>
                        <td class="text-center px-4">
                            <div class="mt-2 mb-2 flex justify-center">
                            <a href="{{ route('periode.edit', ['periode' => $value->id]) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                            <form action="/home/periode/{{$value->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">
                                    <a href="/home/periode/{{$value->id}}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
                                </button>                                        
                            </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr colspan="3">
                        <td>No data</td>
                    </tr>  
                    @endforelse
                </tbody>
            </table>
            {{ $periode->links() }}
        </div>
    </div>
</x-admin-layout>