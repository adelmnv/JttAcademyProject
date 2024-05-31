<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'Для взрослых']);
        Type::create(['name' => 'Для детей']);
        Type::create(['name' => 'Аренда']);
    }
}
