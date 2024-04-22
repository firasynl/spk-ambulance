## Sistem Penilaian Kinerja Pegawai Ambulance


#### Tutorial clone project:

1. git init
2. git clone https://github.com/firasynl/spk-ambulance.git
3. cd spk-ambulance
4. cp .env.example .env
5. composer install
6. npm install
7. php artisan key:generate
8. php artisan migrate
9. jika perlu seeder data (data tidak dipublish)
- php artisan db:seed --class=JabatanSeeder
- php artisan db:seed --class=UnitKerjaSeeder
- php artisan db:seed --class=IndikatorSeeder
- php artisan db:seed --class=PegawaiSeeder
- php artisan db:seed --class=UserSeeder

=== Run Application ===

10. npm run dev
11. php artisan serve



#### Menu Admin
1. Unit Kerja
2. Jabatan
3. Pegawai
4. Indikator
5. Periode
6. Register Akun
7. Penilaian Kinerja

#### Menu User
1. Penilaian Kinerja
