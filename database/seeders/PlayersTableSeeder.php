<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            [
                'fio' => 'Баранов София Наталья',
                'date_of_birth' => '2004-02-07',
                'achievements' => 'Разряд: МС
                Победитель и призер международных турниров ITF, TE, ATF как в парном так и в одиночном разрядах
                Лучший игрок Казахстана 2020',
                'main_photo_url' => 'http://jttacademy_project.com/img/player1.jpeg',
                'is_visible' => true,
            ],
            [
                'fio' => 'Шалахова Стефанья',
                'date_of_birth' => '2004-05-25',
                'achievements' => 'Разряд: КМС
                Победитель и призер международных турниров ITF, ATF как в парном так и в одиночном разрядах
                Член сборной города Алматы',
                'main_photo_url' => 'http://jttacademy_project.com/img/player2.jpeg',
                'is_visible' => true,
            ],
            [
                'fio' => 'Сидоров Никита',
                'date_of_birth' => '2003-10-02',
                'achievements' => 'Разряд: МС
                Победитель и призер международных турниров ITF как в парном так и в одиночном разрядах
                Член сборной города Алматы',
                'main_photo_url' => 'http://jttacademy_project.com/img/player3.jpeg',
                'is_visible' => true,
            ],
            [
                'fio' => 'Николенко Татьяна',
                'date_of_birth' => '2004-01-02',
                'achievements' => 'Разряд: МС
                Победитель и призер международных турниров ITF, TE как в парном так и в одиночном разрядах
                Чемпионка Казахстана в парном разряде',
                'main_photo_url' => 'http://jttacademy_project.com/img/player4.jpeg',
                'is_visible' => true,
            ],
            [
                'fio' => 'Махмудов Исфандиер',
                'date_of_birth' => '2002-06-22',
                'achievements' => 'Разряд: МС
                Победитель и призер международных турниров ITF, ATF как в парном так и в одиночном разрядах
                Лучший игрок университета 2022',
                'main_photo_url' => 'http://jttacademy_project.com/img/player5.jpeg',
                'is_visible' => true,
            ],
            [
                'fio' => 'Салибаева Амина',
                'date_of_birth' => '2005-06-12',
                'achievements' => 'Разряд: КМС
                Победитель и призер международных турниров ITF, TE, ATF как в парном так и в одиночном разрядах
                Член сборной города Алматы',
                'main_photo_url' => 'http://jttacademy_project.com/img/player6.jpeg',
                'is_visible' => true,
            ],
        ];

        foreach ($players as $player) {
            PLayer::create($player);
        }
    }
}
