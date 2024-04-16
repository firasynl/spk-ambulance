<x-admin-layout>
    <h1 class="text-3xl text-black pb-6">Dashboard</h1>
        <div class="w-full mt-10 bg-white shadow-md rounded">
            <h2 class="text-2xl text-green-700 px-6 py-4">Hallo,</h2>
            <h3 class="text-xl px-6 pb-2">Selamat Datang di Sistem Penilaian Kinerja Ambulance Kegawatan</h3>
        </div>
        @auth
        @if(Auth::user()->usertype == 'admin')
        <div class=" w-full mt-6 p-6 bg-white w-full shadow-md rounded">
            <h2 class="text-xl font-bold text-red-700">
                <i class="fas fa-user-tie mr-3"></i> Panduan Sistem Untuk ADMIN</h2>
                <ol class="list-decimal px-6 py-4">
                    <li class="font-bold">Login ke dalam sistem dengan username dan password</li>
                    <li class="mt-2 font-bold">Input Unit Kerja :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Unit Kerja</li>
                        <li>Klik Tambah Unit Kerja, isi nama unit kerja</li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                    <li class="mt-2 font-bold">Input Jabatan :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Jabatan</li>
                        <li>Klik Tambah Jabatan, isi nama Jabatan</li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                    <li class="mt-2 font-bold">Input Pegawai :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Pegawai</li>
                        <li>Klik Tambah Pegawai</li>
                        <li>Masukkan informasi pegawai, seperti Nama Pegawai, NIK, Jabatan, dan Unit Kerja </li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                    <li class="mt-2 font-bold">Input Indikator :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Indikator</li>
                        <li>Klik Tambah Indikator</li>
                        <li>Isi detail Indikator, seperti Indikator Penilaian, Kategori Indikator, dan Jabatan yang dinilai</li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                    <li class="mt-2 font-bold">Input Periode :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Periode</li>
                        <li>Klik Tambah Periode</li>
                        <li>Isi detail Periode, seperti Nama Periode, Tanggal Mulai, Tanggal Selesai dan Status Periode</li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                    <li class="mt-2 font-bold">Buat akun untuk Penilai :</li>
                    <ul class="list-disc ml-5">
                        <li>Pilih menu Register Akun</li>
                        <li>Klik Tambah Akun</li>
                        <li>Masukkan detail informasi penilai, seperti Nama, NIP, Pangkat, Jabatan, Unit Kerja, Email, dan Password</li>
                        <li>Pilih Usertype User</li>
                        <li>Klik Submit untuk menyimpan data</li>
                    </ul>
                </ol>
        </div> 
        @endif
        @endauth 
        <div class=" w-full mt-6 p-6 bg-white w-full shadow-md rounded">
            <h2 class="text-xl font-bold">
                <i class="fas fa-book mr-3"></i> Panduan Penggunaan Sistem</h2>
                <ul class="list-disc px-6 py-4">
                    <li>Login ke dalam sistem dengan username dan password</li>
                    <li>Pilih menu penilaian kinerja</li>
                    <li>Pilih periode penilaian</li>
                    <li>Klik isi penilaian kinerja untuk melakukan penilaian</li>
                    <li>Klik submit</li>
                    <li>Pilih export pdf jika ingin mengexport nilai dalam bentuk pdf</li>
                </ul>
        </div>              

        <div class="w-full p-6 mt-6 bg-white rounded shadow-md">
            <h2 class="text-xl font-bold">
                <i class="fas fa-award mr-3"></i>Data Nilai Pegawai</h2>
            {!! $chart->container() !!}
        </div>
</x-admin-layout>

<script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}