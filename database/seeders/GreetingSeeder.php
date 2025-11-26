<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GreetingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('greetings')->insert([
            ['greeting_text' => 'Hello'],
            ['greeting_text' => 'Hi'],
            ['greeting_text' => 'Greetings'],
            ['greeting_text' => 'Salutations'],
        ]);
    }
}
