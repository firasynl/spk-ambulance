<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/users.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                \DB::table('users')->insert([
                    "nama" => $data['0'],
                    "nip" => $data['1'],
                    "jabatan_pegawai" => $data['2'],
                    "unit_kerja" => $data['3'],
                    "email" => $data['4'],
                    "password" => $data['5'],
                    "usertype" => $data['6'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
