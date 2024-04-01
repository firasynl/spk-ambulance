<x-admin-layout>
    <div class="overflow-auto">
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('indikator.update', $indikator->id) }}">
                                @csrf
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('indikator.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-span-3 ">
                                        <p class="text-2xl py-2 px-4 font-bold flex">
                                            <i class="mr-3"></i> Edit Indikator
                                        </p>
                                    </div>
                                </div>
                                @method('PUT')
                                <div class="">
                                    <label class="block text-m text-gray-600" for="indikator">Indikator</label>
                                    <textarea class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="indikator" name="indikator" required="" aria-label="Indikator" style="height: 180px;">{{ $indikator->indikator }}</textarea>
                                </div>
                                <div class="">
                                    <label class="block text-m text-gray-600" for="kategori">Kategori</label>
                                    <select class="w-full rounded text-m py-2 px-2 text-black w-[700px] bg-gray-200 border-1 border-black" name="kategori" aria-label="Default select example">
                                        <option selected>{{$indikator->kategori}}</option>
                                            <option value="Penilaian Kinerja">
                                                Penilaian Kinerja
                                            </option>
                                            <option value="Perilaku Kerja">
                                                Perilaku Kerja
                                            </option>
                                    </select>  
                                </div>
                                <div class="">
                                    <label class="block text-m text-gray-600" for="jabatan">Jabatan</label>
                                    <select class="w-full rounded text-m py-2 px-2 text-black w-[700px] bg-gray-200 border-1 border-black" name="jabatan" id="jabatan" value="{{ $indikator->jabatan }}" aria-label="Default select example">
                                        <option selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $indikator->jabatan->id) selected @endif>
                                                {{ $item->jabatan }}
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