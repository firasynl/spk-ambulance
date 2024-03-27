<x-admin-layout>
    <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Daftar Periode
                    </p>
                    <div class="mt-4 mb-4">
                    <a href="/home/periode/create" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah</a>
                    </div>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 5%;">No</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Nama Periode</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Tanggal Mulai</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Tanggal Selesai</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 15%;">Status</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm" style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                 @forelse ($periode as $key=>$value)
                                <tr>
                                    <td class="text-left py-3 px-4">{{$key + 1}}</td>
                                    <td class="text-left py-3 px-4">{{$value->nama_periode}}</td>
                                    <td class="text-left py-3 px-4">{{$value->tanggal_mulai}}</td>
                                    <td class="text-left py-3 px-4">{{$value->tanggal_selesai}}</td>
                                    <td class="text-left py-3 px-4">{{$value->status}}</td>
                                    <td class="text-left py-3 px-4">
                                        <div class="mt-4 mb-4 flex">
                                        <a href="{{ route('periode.edit', ['periode' => $value->id]) }}" class="px-4 py-1 text-white mr-1 font-light tracking-wider bg-blue-700 rounded"><i class="far fa-edit"></i>Edit</a>
                                        <form action="/home/periode/{{$value->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" value="Delete">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>                                        </form>
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