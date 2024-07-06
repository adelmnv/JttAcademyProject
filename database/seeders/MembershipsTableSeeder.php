<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $memberships = [
            [
                'client_id' => 1,
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 2,
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 3,
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 4,
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 5,
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 6,
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 7,
                'group_id' => 5,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 8,
                'group_id' => 5,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 9,
                'group_id' => 2,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 10,
                'group_id' => 9,
                'paid_until'=>'2024-08-06',
            ],
            [
                'client_id' => 11,
                'group_id' => 9,
                'paid_until'=>'2024-08-06',
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }

    }
}
