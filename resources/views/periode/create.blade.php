<x-admin-layout>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-2xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Input Periode
            </p>
            <div class="leading-loose">
                <form action="/home/periode" method="POST" class="p-10 bg-white rounded shadow-xl">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-m text-gray-600" for="nama_periode">Nama Periode</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama_periode" name="nama_periode" type="text" required="" placeholder="Contoh: Periode 2024-1" aria-label="Periode">
                    </div>
                    <div class="mb-3">
                        <label class="block text-m text-gray-600" for="tanggal_mulai">Tanggal Mulai</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="tanggal_mulai" name="tanggal_mulai" type="date" required="" aria-label="Tanggal Mulai">
                    </div>
                    <div class="mb-3">
                        <label class="block text-m text-gray-600" for="tanggal_selesai">Tanggal Selesai</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="tanggal_selesai" name="tanggal_selesai" type="date" required="" aria-label="Tanggal Selesai">
                    </div>
                    <div class="mb-3">
                        <label class="block text-m text-gray-600" for="kategori">Status</label>
                        <select class="rounded text-sm py-1 px-2 text-black w-[700px]  border-1 border-black" name="status" aria-label="Default select example">
                            <option selected>Pilih Status Periode</option>
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
    </div>
</x-admin-layout>