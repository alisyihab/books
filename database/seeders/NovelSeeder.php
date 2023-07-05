<?php

namespace Database\Seeders;

use App\Models\Novel;
use Illuminate\Database\Seeder;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Novel::factory(50)->create();
    }
}
