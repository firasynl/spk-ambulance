<x-admin-layout>
    <div class="overflow-auto">
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow">
                <div class="flex flex-wrap place-content-center">
                    <div class="w-full lg:w-1/2 my-6 pr-0">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('register_akun.store') }}">
                                @csrf
                                <div class=" grid grid-cols-4 mt-4 mb-4">
                                    <div class="col-start-1 col-span-1 place-content-center">
                                        <a href="{{ route('register_akun.index') }}" class="py-2 px-4 rounded"><i class="far fa-arrow-alt-circle-left text-2xl"></i></a>
                                    </div>
                                    <div class="col-start-2 col-end-4 ">
                                        <p class="text-2xl py-2 px-4 font-bold flex place-content-center">
                                            <i class="mr-3"></i> Register Akun
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nama">Nama</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama" name="nama" type="text" required="" placeholder="Masukkan nama" aria-label="Nama">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="nip">NIP</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nip" name="nip" type="text" required="" placeholder="Masukkan NIP" aria-label="NIP">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="pangkat">Pangkat</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="pangkat" name="pangkat" type="text" required="" placeholder="Masukkan pangkat/gol.ruang" aria-label="Pangkat">
                                </div>
                                 <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="unit_kerja">Jabatan</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="jabatan_pegawai" aria-label="Default select example">
                                        <option selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="unit_kerja">Unit Kerja</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="unit_kerja" aria-label="Default select example">
                                        <option selected>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerja as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->unit_kerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="email">Email</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required="" placeholder="Masukkan email" aria-label="email">
                                </div>
                                <div class="mb-2 relative">
                                    <label class="block text-m text-gray-600" for="password">Password</label>
                                    <div class="relative">
                                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded pr-10" id="password" name="password" type="password" required="" placeholder="Masukkan password" aria-label="Password">
                                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-0 top-1/2 transform -translate-y-1/2 px-4 py-1 flex items-center text-gray-600">
                                            <i id="toggleIcon" class="fas fa-eye"></i>
                                            <span id="toggleText" class="hidden ml-2">Show</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="usertype">Usertype</label>
                                    <select class="rounded px-5 py-2 text-m py-1 px-2 text-black w-[700px] w-full bg-gray-200 border-1 border-black" name="usertype" aria-label="Default select example">
                                        <option selected disabled>Pilih User Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
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

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var icon = document.getElementById("toggleIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>