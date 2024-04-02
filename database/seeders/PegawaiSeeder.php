<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pegawai::truncate();
        // \DB::table('pegawai')->truncate();
  
        $csvFile = fopen(base_path("database/data/pegawai.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                \DB::table('pegawai')->insert([
                    "nama_pegawai" => $data['0'],
                    "nik" => $data['1'],
                    "jabatan_id" => $data['2'],
                    "unit_kerja_pegawai" => $data['3']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
