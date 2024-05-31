<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tournament;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tournament::create(['name'=>'Апрель Кап','start_date'=>'2024-04-08','end_date'=>'2024-04-12','deadline'=>'2024-04-01','tournament_category_id'=>2, 'status'=>1]);
        Tournament::create(['name'=>'Весенний турнир','start_date'=>'2024-05-25','end_date'=>'2024-05-30','deadline'=>'2024-05-21','tournament_category_id'=>3, 'status'=>1]);
        Tournament::create(['name'=>'Красный мяч','start_date'=>'2024-07-15','end_date'=>'2024-07-18','deadline'=>'2024-07-11','tournament_category_id'=>1, 'status'=>1]);
        Tournament::create(['name'=>'Интерконтиненталь Оупен','start_date'=>'2024-06-10','end_date'=>'2024-06-13','deadline'=>'2024-06-05','tournament_category_id'=>8, 'status'=>1]);
        Tournament::create(['name'=>'JTT Cup','start_date'=>'2024-06-20','end_date'=>'2024-06-24','deadline'=>'2024-06-15','tournament_category_id'=>7, 'status'=>1]);
        Tournament::create(['name'=>'Оранжевый мяч','start_date'=>'2024-07-01','end_date'=>'2024-07-05','deadline'=>'2024-06-29','tournament_category_id'=>2, 'status'=>1]);
    }
}
