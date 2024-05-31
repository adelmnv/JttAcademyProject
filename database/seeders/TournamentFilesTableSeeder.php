<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TournamentFile;

class TournamentFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TournamentFile::create(['tournament_id'=>1,'file_name' => 'Мальчики красный мяч.pdf', 'file_path'=>'http://jttacademy_project.com/files/Мальчики красный мяч.pdf']);
        TournamentFile::create(['tournament_id'=>1,'file_name' => 'Девочки красный мяч.pdf', 'file_path'=>'http://jttacademy_project.com/files/Девочки красный мяч.pdf']);
        TournamentFile::create(['tournament_id'=>2,'file_name' => 'Мальчики весенний турнир.pdf', 'file_path'=>'http://jttacademy_project.com/files/Мальчики весенний турнир.pdf']);
        TournamentFile::create(['tournament_id'=>2,'file_name' => 'Девочки весенний турнир.pdf', 'file_path'=>'http://jttacademy_project.com/files/Девочки весенний турнир.pdf']);
    }
}
