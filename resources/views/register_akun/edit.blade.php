<x-admin-layout>
    <div class="overflow-auto ">
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow">
                <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('register_akun.update', $register_akun->id) }}">
                                @csrf
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('register_akun.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-2xl py-2 px-4 font-bold flex place-content-center">
                                            <i class="mr-3"></i> Edit Akun
                                        </p>
                                    </div>
                                </div>
                                @method('PUT')
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nama">Nama</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama" name="nama" type="text" required="" value="{{ $register_akun -> nama }}" aria-label="Nama">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nip">NIP</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nip" name="nip" type="text" required="" value="{{ $register_akun -> nip }}" aria-label="NIP">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="pangkat">Pangkat</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="pangkat" name="pangkat" type="text" required="" value="{{ $register_akun -> pangkat }}" aria-label="Pangkat">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="jabatan">Jabatan</label>
                                    <select class="rounded text-m py-1 px-2 text-black w-full w-[700px] bg-gray-200 border-2 border-black" name="jabatan_pegawai" id="jabatan" value="{{ $register_akun->jabatan }}" aria-label="Default select example">
                                        <option selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $register_akun->jabatan_pegawai) selected @endif>
                                                {{ $item->jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="unit_kerja">Unit Kerja</label>
                                    <select class="rounded text-m py-1 px-2 text-black w-full w-[700px] bg-gray-200 border-2 border-black" name="unit_kerja" id="unit_kerja" value="{{ $register_akun->unit_kerja }}" aria-label="Default select example">
                                        <option selected>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerja as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $register_akun->unit_kerja) selected @endif>
                                                {{ $item->unit_kerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="email">Email</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required="" value="{{ $register_akun -> email }}" aria-label="email">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="password">Password</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="password" placeholder="Isi jika ingin mengubah password" aria-label="Password">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="usertype">Usertype</label>
                                    <select class="rounded text-m py-1 px-2 text-black w-full w-[700px] bg-gray-200 border-2 border-black" name="usertype" aria-label="Default select example">
                                        <option disabled>Pilih User Type</option>
                                        <option value="admin" {{ $register_akun->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $register_akun->usertype === 'user' ? 'selected' : '' }}>User</option>
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