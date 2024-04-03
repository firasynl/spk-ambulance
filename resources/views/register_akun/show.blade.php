<x-admin-layout>
    <div class="overflow-auto ">
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow">
                <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            
                            <div class="p-10 bg-white rounded shadow-xl">
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('register_akun.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-2xl py-2 px-4 font-bold flex place-content-center">
                                            Data Akun
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Nama</label>
                                    <h2>{{ $jabatan->nama }}</h2>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">NIP</label>
                                    <h2>{{ $jabatan->nip }}</h2>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Pangkat</label>
                                    <h2>{{ $jabatan->pangkat }}</h2>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Jabatan</label>
                                    <h2>{{ $jabatan->jabatan_user->jabatan}}</h2> 
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Unit Kerja</label>
                                    <h2>{{ $jabatan->unit_kerja_pegawai->unit_kerja}}</h2> 
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Email</label>
                                    <h2>{{ $jabatan->email }}</h2> 
                                </div>
                                <div class="mb-2">
                                    <label class="block text-lg text-gray-600 font-bold" for="registrasi">Usertype</label>
                                    <h2>{{ $jabatan->usertype }}</h2> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>   
        </div> 
    </div>
</x-admin-layout>