<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Order::factory(5)->create();
         \App\Models\News_item::factory(5)->create();
         \App\Models\Device::factory(7)->create();
         //\App\Models\Chat::factory(7)->create();
         //\App\Models\Message::factory(15)->create();
    }
}
