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
                    "name" => $data['0'],
                    "unit_kerja_pegawai" => $data['1'],
                    "email" => $data['2'],
                    "password" => $data['3'],
                    "usertype" => $data['4'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
