<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GewogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Path to your CSV file
        $csvFile = database_path('seeds/gewog.csv');

        // Open the CSV file for reading
        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Get the header row (column names)
            $headers = fgetcsv($handle);

            // Loop through each row and insert data into the database
            while (($data = fgetcsv($handle)) !== false) {
                // Check if the number of columns in the row matches the number of headers
                if (count($headers) !== count($data)) {
                    // Log a warning and skip this row
                    Log::warning('Row skipped due to column mismatch:', $data);
                    continue; // Skip to the next row
                }

                // Combine the headers and row data into an associative array
                $rowData = array_combine($headers, $data);

                // Insert data into the database table
                DB::table('gewogs')->insert($rowData);
            }

            // Close the file handle
            fclose($handle);
        } else {
            // Log an error if the file cannot be opened
            Log::error('Failed to open the CSV file at: ' . $csvFile);
        }
    }
}
