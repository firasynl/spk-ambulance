<x-admin-layout>
    <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <p class="text-xl pb-6 flex items-center">
                            <i class="fas fa-list mr-3"></i> Input Jabatan
                        </p>
                        <div class="leading-loose">
                            <form action="/home/jabatan/{{$jabatan->id}}" method="POST" class="p-10 bg-white rounded shadow-xl">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="jabatan">Nama Jabatan</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="jabatan" name="jabatan" type="text" required="" value="{{$jabatan->jabatan}}" placeholder="Contoh: Admin" aria-label="Jabatan">
                                </div>
                                <div class="mt-6">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
</x-admin-layout>