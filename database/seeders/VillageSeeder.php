<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Path to your CSV file
          $csvFile = database_path('seeds/village.csv');

          // Open the CSV file for reading
          if (($handle = fopen($csvFile, 'r')) !== false) {
              // Get the header row (column names)
              $headers = fgetcsv($handle);
  
              // Loop through each row and insert data into the database
              while (($data = fgetcsv($handle)) !== false) {
                  $rowData = array_combine($headers, $data);
  
                  // Insert data into the database table
                  DB::table('villages')->insert($rowData);
              }
  
              // Close the file handle
              fclose($handle);
          }
    }
}
