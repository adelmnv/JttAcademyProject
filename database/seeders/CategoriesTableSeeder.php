<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Новости']);
        Category::create(['name' => 'О теннисе']);
        Category::create(['name' => 'Об академии']);
    }
}
