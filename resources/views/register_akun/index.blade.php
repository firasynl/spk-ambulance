<x-admin-layout>
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Daftar Akun
        </p>
        <div class="mt-4 mb-4">
            <a href="{{ route('register_akun.create') }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah</a>
            </div>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>  
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Unit Kerja</th>  
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>  
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Usertype</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $users)
                        <tr>
                            <td class="text-left py-3 px-4">{{ $no++ }}</td>
                            <td class="text-left py-3 px-4">{{ $users->nama }}</td>
                            <td class="text-left py-3 px-4">{{ $users->unit_kerja }}</td>
                            <td class="text-left py-3 px-4">{{ $users->email }}</td>
                            <td class="text-left py-3 px-4">{{ $users->usertype }}</td>
                            <td class="text-left py-3 px-4">
                                <div class="mt-4 mb-4 flex">
                                    <a href="{{ route('register_akun.edit',$users->id) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                <form action="{{ route('register_akun.destroy',$users->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" value="Delete">
                                        <i class="fas fa-trash-alt"></i> Delete
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