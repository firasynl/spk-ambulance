<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UnitKerja::truncate();
  
        $csvFile = fopen(base_path("database/data/unit_kerja.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                \DB::table('unit_kerja')->insert([
                    "unit_kerja" => $data['0'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
