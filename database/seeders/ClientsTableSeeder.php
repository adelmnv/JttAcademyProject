<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'fio' => 'Баранов София Наталья',
                'date_of_birth' => '2004-02-07',
            ],
            [
                'fio' => 'Шалахова Стефанья',
                'date_of_birth' => '2004-05-25',
            ],
            [
                'fio' => 'Сидоров Никита',
                'date_of_birth' => '2003-10-02',
            ],
            [
                'fio' => 'Николенко Татьяна',
                'date_of_birth' => '2004-01-02',
            ],
            [
                'fio' => 'Махмудов Исфандиер',
                'date_of_birth' => '2002-06-22',
            ],
            [
                'fio' => 'Салибаева Амина',
                'date_of_birth' => '2005-06-12',
            ],
            [
                'fio' => 'Аргингазина Арай',
                'date_of_birth' => '2005-07-10',
            ],
            [
                'fio' => 'Аубакирова Сати',
                'date_of_birth' => '2005-05-05',
            ],
            [
                'fio' => 'Хан Константин',
                'date_of_birth' => '1995-07-05',
            ],
            [
                'fio' => 'Молдахметова Гаухар',
                'date_of_birth' => '1998-03-04',
            ],
            [
                'fio' => 'Синицин Петр',
                'date_of_birth' => '1999-04-03',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
