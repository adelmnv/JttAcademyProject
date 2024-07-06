<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentCourt;

class RentCourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rents = [
            [
                'client_id' => 1,
                'date' => '2024-06-11',
                'time' => '07:00:00',
                'court_number' => 1,
            ],
            [
                'client_id' => 2,
                'date' => '2024-06-11',
                'time' => '07:00:00',
                'court_number' => 2,
            ],
            [
                'client_id' => 3,
                'date' => '2024-06-11',
                'time' => '15:00:00',
                'court_number' => 1,
            ],
            
        ];

        foreach ($rents as $rent) {
            RentCourt::create($rent);
        }
    }
}
