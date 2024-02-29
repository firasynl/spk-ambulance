<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jabatan::truncate();
  
        $csvFile = fopen(base_path("database/data/jabatan.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                \DB::table('jabatan')->insert([
                    "jabatan" => $data['0'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
