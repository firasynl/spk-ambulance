<x-admin-layout>
    <div class="bg-white overflow-auto">
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="w-full text-3xl text-black pb-6">Register Akun</h1>

                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('register_akun.store') }}">
                                @csrf
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="nama">Nama</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nama" name="nama" type="text" required="" placeholder="Masukkan nama" aria-label="Nama">
                                </div>
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="unit_kerja">Unit Kerja</label>
                                    <select class="rounded text-sm py-1 px-2 text-black w-[700px]  border-1 border-black" name="unit_kerja" aria-label="Default select example">
                                        <option selected>Pilih Unit Kerja</option>
                                        @foreach ($unit_kerja as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->unit_kerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="email">Email</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required="" placeholder="Masukkan email" aria-label="email">
                                </div>
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="password">Password</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="password" required="" placeholder="Masukkan password" aria-label="Password">
                                </div>
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="usertype">Usertype</label>
                                    <select class="rounded text-sm py-1 px-2 text-black w-[700px]  border-1 border-black" name="usertype" aria-label="Default select example">
                                        <option selected disabled>Pilih User Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>                              
                                <div class="mt-6">
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