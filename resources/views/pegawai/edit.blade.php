<x-admin-layout>
    <div class="overflow-auto">
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow">
                <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('pegawai.update', $pegawai->id) }}">
                                @csrf
                                @method('PUT')
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('pegawai.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-xl py-2 px-4 font-bold flex place-content-center">
                                            Edit Data Pegawai
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nama_pegawai">Nama</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama_pegawai" name="nama_pegawai" type="text" required="" value="{{ $pegawai -> nama_pegawai }}" aria-label="Nama">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nik">NIK</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nik" name="nik" type="number" required="" value="{{ $pegawai -> nik }}" aria-label="NIK">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="jabatan_pegawai">Jabatan</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="jabatan_pegawai" id="jabatan_pegawai" value="{{ $pegawai->jabatan_pegawai }}" aria-label="Default select example">
                                        <option selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $pegawai->jabatan_pegawai) selected @endif>
                                                {{ $item->jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="unit_kerja_pegawai">Unit Kerja</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="unit_kerja_pegawai" id="unit_kerja_pegawai" value="{{ $pegawai->unit_kerja_pegawai }}" aria-label="Default select example">
                                        <option selected>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerja as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $pegawai->unit_kerja_pegawai) selected @endif>
                                                {{ $item->unit_kerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-6 flex justify-center">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>   
        </div> 
    </div>
</x-admin-layout>