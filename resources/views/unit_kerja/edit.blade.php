<x-admin-layout>
    <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <p class="text-xl pb-6 flex items-center">
                            <i class="fas fa-list mr-3"></i> Edit Unit Kerja
                        </p>
                        <div class="leading-loose">
                            <form action="/home/unit_kerja/{{$unitKerja->id}}" method="POST" class="p-10 bg-white rounded shadow-xl">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="unit_kerja">Unit Kerja</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="unit_kerja" name="unit_kerja" type="text" required="" value="{{$unitKerja->unit_kerja}}" placeholder="Contoh: Puskesmas Pandanaran" aria-label="Unit Kerja">
                                </div>
                                <div class="mt-6">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
</x-admin-layout>