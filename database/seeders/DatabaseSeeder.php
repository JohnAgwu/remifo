<?php

namespace Database\Seeders;

use App\Models\Reminder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(1)->create();
//        Reminder::factory(15)->create();
        $dump = file_get_contents(database_path("seeders/dump.sql"));
        
        DB::getPdo()->exec($dump);
    }
}
