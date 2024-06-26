<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Akun
        </p>
        <div class="flex flex-col md:flex-row justify-between mt-4 mb-4">
            <a href="{{ route('register_akun.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah Akun</a>
            <form method="GET" action="{{ route('register_akun.index') }}" class="flex w-full md:w-auto">
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
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama</th>  
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Unit Kerja</th>  
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Email</th>  
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Usertype</th> 
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = ($users->currentPage() - 1) * $users->perPage() + 1;;
                    @endphp
                    @foreach ($users as $users)
                        <tr>
                            <td class="text-center px-4">{{ $no++ }}</td>
                            <td class="text-center px-4">{{ $users->nama }}</td>
                            <td class="text-center px-4">{{ $users->unit_kerja_pegawai->unit_kerja }}</td>
                            <td class="text-center px-4">{{ $users->email }}</td>
                            <td class="text-center px-4">{{ $users->usertype }}</td>
                            <td class="text-center px-4">
                                <div class="mt-2 mb-2 flex justify-center">
                                    <a href="{{ route('register_akun.show',$users->id) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-yellow-500 rounded"><i class="fas fa-eye"></i>Show</a>
                                    <a href="{{ route('register_akun.edit',$users->id) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                <form action="{{ route('register_akun.destroy',$users->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">
                                        <a href="{{ route('register_akun.destroy',$users->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
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