<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Jabatan
        </p>
        <div class="flex flex-col md:flex-row justify-between mt-4 mb-8">
        <a href="/home/jabatan/create" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Jabatan</a>
        <form method="GET" action="{{ route('jabatan.index') }}" class="flex w-full md:w-auto">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="p-2 border rounded-l w-full md:w-auto md:ml-2">
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-r flex items-center">
                    <span class="fas fa-search mr-2">
                        search
                    </span> Search
                </button>
        </form>
        </div>
        <div class="overflow-auto">
            <table class="table-auto bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm w-30">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jabatan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm ">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $no = ($jabatan->currentPage() - 1) * $jabatan->perPage() + 1;;
                    @endphp
                    @forelse ($jabatan as $key=>$value)
                    <tr>
                        <td class="text-center px-4">{{$no++}}</td>
                        <td class="text-center px-4 w-1/2">{{$value->jabatan}}</td>
                        <td class="text-center px-4">
                            <div class="mt-2 mb-2 flex justify-center">
                                <a href="/home/jabatan/{{$value->id}}/edit" class="px-4 py-1 mr-1 text-white font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                            <form action="/home/jabatan/{{$value->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" onclick="return confirm('Are you sure?')" value="Delete">
                                    <i class="fas fa-trash-alt"></i> Delete
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
            <div class="mt-3">
                {{ $jabatan->links() }}
            </div>
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