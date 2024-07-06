<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndividualPractice;

class IndividualPracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practices = [
            [
                'practice_id' => 2,
                'coach_id' => 2,
                'client_id' => 6,
                'date' => '2024-06-10',
                'time' => '07:00:00',
                'court_number' => 1,
            ],
            [
                'practice_id' => 2,
                'coach_id' => 1,
                'client_id' => 8,
                'date' => '2024-06-10',
                'time' => '07:00:00',
                'court_number' => 2,
            ],
            [
                'practice_id' => 2,
                'coach_id' => 2,
                'client_id' => 3,
                'date' => '2024-06-10',
                'time' => '15:00:00',
                'court_number' => 1,
            ],
            
        ];

        foreach ($practices as $practice) {
            IndividualPractice::create($practice);
        }

    }
}
