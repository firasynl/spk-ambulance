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
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nip" name="nip" type="text" value="{{ $register_akun -> nip }}" aria-label="NIP">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="pangkat">Pangkat</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="pangkat" name="pangkat" type="text" value="{{ $register_akun -> pangkat }}" aria-label="Pangkat">
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="jabatan">Jabatan</label>
                                    <select class="rounded text-m py-3 px-3 text-black w-full w-[700px] bg-gray-200 border-black" name="jabatan_pegawai" id="jabatan" value="{{ $register_akun->jabatan }}" aria-label="Default select example">
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
                                    <select data-hs-select='{
                                        "hasSearch": true,
                                                "searchPlaceholder": "Search...",
                                                "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
                                                "searchWrapperClasses": "bg-gray-200 p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                                                "placeholder": "<span class=\"justify-start\">Pilih Unit Kerja</span>",
                                                "toggleTag": "<button type=\"button\"><span class=\"text-black dark:text-neutral-200\" data-title></span><span class=\"me-2\" data-icon></span></button>",
                                                "toggleClasses": "rounded px-5 py-1 text-m text-left text-black w-[900px] w-full bg-gray-200 border-1 border-black",
                                                "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-gray-200 border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",                                                "optionClasses": "py-1 px-4 w-full text-m text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                "optionTemplate": "<div><div class=\"text-gray-800 text-m dark:text-neutral-20\" data-title></div><div class=\"flex\"><div class=\"me-2\" data-icon></div></div></div>",
                                                "extraMarkup": "<div class=\"absolute right-0 top-1/2 transform -translate-y-1/2 px-4 py-1 flex\"><svg class=\"flex-shrink-0 size-3.5 text-black dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"18\" height=\"18\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}'
                                                name="unit_kerja">
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
                                    <div class="relative">
                                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="password" placeholder="Isi jika ingin mengubah password" aria-label="Password">
                                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-0 top-1/2 transform -translate-y-1/2 px-4 py-1 flex items-center text-gray-600">
                                            <i id="toggleIcon" class="fas fa-eye"></i>
                                            <span id="toggleText" class="hidden ml-2">Show</span>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="mb-2">
                                    <label class="block text-m text-gray-600" for="usertype">Usertype</label>
                                    <select class="rounded text-m py-3 px-3 text-black w-full w-[700px] bg-gray-200" name="usertype" aria-label="Default select example">
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