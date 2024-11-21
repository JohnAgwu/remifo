<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user  = User::updateOrCreate([
            'email'     => 'canaanetai@gmail.com',
            'phone'     => '0816324071',
            'name'      => 'Canaan Etai',
            'password'  => bcrypt('canaan55*')
        ]);

        User::updateOrCreate([
                'name'      => "John Agwu",
                'email'     => 'agujohnifeanyi69@gmail.com',
                'phone'     => '07067028318',
                'password'  => bcrypt('reminfo123*')
        ]);

        User::updateOrCreate([
                'name'      => "Lyte Onyema",
                'email'     => 'lyte.onyema@gmail.com',
                'phone'     => '09074756078',
                'password'  => bcrypt('onyema49')
        ]);
    }
}
