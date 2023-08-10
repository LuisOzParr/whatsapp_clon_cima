<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_statuses')->insert([
            ['id' => 1, 'name' => 'Enviando'],
            ['id' => 2, 'name' => 'Recibido en servidor'],
            ['id' => 3, 'name' => 'Usuario recibió mensaje'],
            ['id' => 4, 'name' => 'Leído']
        ]);
    }
}
