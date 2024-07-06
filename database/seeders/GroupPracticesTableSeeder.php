<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupPractice;

class GroupPracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'practice_id' => 3,
                'coach_id' => 1,
                'days_of_week' => '1,3,5',
                'time' => '10:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 2,
                'days_of_week' => '1,3,5',
                'time' => '10:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 10,
                'coach_id' => 2,
                'days_of_week' => '1,2,3,4,5',
                'time' => '08:00:00',
                'duration'=>2,
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 11,
                'coach_id' => 1,
                'days_of_week' => '1,2,3,4,5',
                'time' => '08:00:00',
                'duration'=>2,
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 10,
                'coach_id' => 2,
                'days_of_week' => '1,2,3,4,5',
                'time' => '16:00:00',
                'duration'=>2,
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 11,
                'coach_id' => 1,
                'days_of_week' => '1,2,3,4,5',
                'time' => '16:00:00',
                'duration'=>2,
                'court_number' => 1,
                'capacity'=>4,
            ],

            [
                'practice_id' => 1,
                'coach_id' => 1,
                'days_of_week' => '1,3,5',
                'time' => '10:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 3,
                'coach_id' => 1,
                'days_of_week' => '1,3,5',
                'time' => '18:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 2,
                'days_of_week' => '1,3,5',
                'time' => '18:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 3,
                'coach_id' => 2,
                'days_of_week' => '1,3,5',
                'time' => '19:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 1,
                'days_of_week' => '1,3,5',
                'time' => '19:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],

            [
                'practice_id' => 3,
                'coach_id' => 1,
                'days_of_week' => '2,4,6',
                'time' => '10:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 2,
                'days_of_week' => '2,4,6',
                'time' => '10:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 3,
                'coach_id' => 1,
                'days_of_week' => '2,4,6',
                'time' => '18:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 2,
                'days_of_week' => '2,4,6',
                'time' => '18:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 3,
                'coach_id' => 2,
                'days_of_week' => '2,4,6',
                'time' => '19:00:00',
                'court_number' => 1,
                'capacity'=>4,
            ],
            [
                'practice_id' => 1,
                'coach_id' => 1,
                'days_of_week' => '2,4,6',
                'time' => '19:00:00',
                'court_number' => 2,
                'capacity'=>4,
            ],
            
        ];

        foreach ($groups as $group) {
            GroupPractice::create($group);
        }

    }
}
