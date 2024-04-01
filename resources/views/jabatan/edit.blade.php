<x-admin-layout>
    <div class="flex flex-wrap place-content-center">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <div class="leading-loose">
                <form action="/home/jabatan/{{$jabatan->id}}" method="POST" class="p-10 bg-white rounded shadow-xl">
                    @csrf
                    <div class=" grid grid-cols-4 mt-4 mb-4">
                        <div class="col-start-1 col-span-1 place-content-center">
                            <a href="{{ route('jabatan.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                        </div>
                        <div class="col-start-2 col-end-4 ">
                            <p class="text-2xl py-2 px-4 font-bold flex place-content-center">
                                <i class="mr-3"></i> Edit Jabatan
                            </p>
                        </div>
                    </div>
                    @method('PUT')
                    <div class="mb-2">
                        <label class="block text-m text-gray-600" for="jabatan">Nama Jabatan</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="jabatan" name="jabatan" type="text" required="" value="{{$jabatan->jabatan}}" placeholder="Contoh: Admin" aria-label="Jabatan">
                    </div>
                    <div class="mt-6 flex justify-center">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</x-admin-layout>