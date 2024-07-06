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
                'name' => 'Баранов София Наталья',
                'date_of_birth' => '2004-02-07',
                'phone'=>'+77052578686',
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Шалахова Стефанья',
                'date_of_birth' => '2004-05-25',
                'phone'=>'+77012578776',
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Сидоров Никита',
                'date_of_birth' => '2003-10-02',
                'phone'=>'+77022579988',
                'group_id' => 4,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Николенко Татьяна',
                'date_of_birth' => '2004-01-02',
                'phone'=>'+77752558681',
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Махмудов Исфандиер',
                'date_of_birth' => '2002-06-22',
                'phone'=>'+77778689034',
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Салибаева Амина',
                'date_of_birth' => '2005-06-12',
                'phone'=>'+77052568566',
                'group_id' => 6,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Аргингазина Арай',
                'date_of_birth' => '2005-07-10',
                'phone'=>'+77017528690',
                'group_id' => 5,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Аубакирова Сати',
                'date_of_birth' => '2005-05-05',
                'phone'=>'+77052576868',
                'group_id' => 5,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Хан Константин',
                'date_of_birth' => '1995-07-05',
                'phone'=>'+77052456545',
                'group_id' => 2,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Молдахметова Гаухар',
                'date_of_birth' => '1998-03-04',
                'phone'=>'+77052540986',
                'group_id' => 9,
                'paid_until'=>'2024-08-06',
            ],
            [
                'name' => 'Синицин Петр',
                'date_of_birth' => '1999-04-03',
                'phone'=>'+77032690900',
                'group_id' => 9,
                'paid_until'=>'2024-08-06',
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }

    }
}
