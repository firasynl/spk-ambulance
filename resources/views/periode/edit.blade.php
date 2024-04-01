<x-admin-layout>
    <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form action="{{ route('periode.update', $periode->id) }}" method="POST" class="p-10 bg-white rounded shadow-xl">                       
                                @csrf
                                @method('PUT')
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('periode.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-2xl py-2 px-4 font-bold flex place-content-center">
                                        Edit Periode
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-m text-gray-600" for="nama_periode">Nama Periode</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama_periode" name="nama_periode" type="text" required="" value="{{$periode->nama_periode}}" placeholder="Contoh: Periode 2024-1" aria-label="Nama Periode">
                                </div>

                                <div class="mb-3">
                                    <label class="block text-m text-gray-600" for="tanggal_mulai">Tanggal Mulai</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="tanggal_mulai" name="tanggal_mulai" type="date" required="" value="{{$periode->tanggal_mulai}}" aria-label="Tanggal Mulai">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-m text-gray-600" for="tanggal_selesai">Tanggal Selesai</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="tanggal_selesai" name="tanggal_selesai" type="date" required="" value="{{$periode->tanggal_selesai}}" aria-label="Tanggal Selesai">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-m text-gray-600" for="kategori">Status</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="status" value="{{$periode->status}}" aria-label="Default select example">
                                        <option selected>{{$periode->status}}</option>
                                            <option value="Aktif">
                                                Aktif
                                            </option>
                                            <option value="Tidak aktif">
                                                Tidak aktif
                                            </option>
                                    </select>  
                                </div>
                                <div class="mt-6 flex justify-center">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
</x-admin-layout>