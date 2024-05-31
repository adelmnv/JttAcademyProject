<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TournamentCategory;

class TournamentCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TournamentCategory::create(['name' => '6 и младше', 'age'=>6]);
        TournamentCategory::create(['name' => '8 и младше', 'age'=>8]);
        TournamentCategory::create(['name' => '10 и младше', 'age'=>10]);
        TournamentCategory::create(['name' => '12 и младше', 'age'=>12]);
        TournamentCategory::create(['name' => '14 и младше', 'age'=>14]);
        TournamentCategory::create(['name' => '16 и младше', 'age'=>16]);
        TournamentCategory::create(['name' => '18 и младше', 'age'=>18]);
        TournamentCategory::create(['name' => 'Взрослые', 'age'=>80]);
    }
}
