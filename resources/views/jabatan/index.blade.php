<x-admin-layout>
    <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Daftar Jabatan
                    </p>
                    <div class="mt-4 mb-4">
                    <a href="/jabatan/create" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">Tambah</a>
                    </div>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Jabatan</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                 @forelse ($jabatan as $key=>$value)
                                <tr>
                                    <td class="text-left py-3 px-4">{{$key + 1}}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{$value->jabatan}}</td>
                                    <td class="text-left py-3 px-4">
                                        <a href="/jabatan/{{$value->id}}/edit" class="px-4 py-1 text-white font-light tracking-wider bg-blue-700 rounded">Edit</a>
                                        <form action="/jabatan/{{$value->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded" value="Delete">
                                        </form>
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