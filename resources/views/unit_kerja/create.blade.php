<x-admin-layout>
    <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form action="/home/unit_kerja" method="POST" class="p-10 bg-white rounded shadow-xl">
                                @csrf
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('unit_kerja.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-xl py-2 px-4 font-bold flex place-content-center">
                                        Input Unit Kerja
                                        </p>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="unit_kerja">Unit Kerja</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="unit_kerja" name="unit_kerja" type="text" required="" placeholder="Contoh: Puskesmas Pandanaran" aria-label="Unit Kerja">
                                </div>
                                <div class="mt-6 flex justify-center">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
</x-admin-layout>