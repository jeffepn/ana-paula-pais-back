<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Renata Vita de Paula', 'email' => 'vitarenata6@gmail.com', 'password' => Hash::make('crash2020')]);
        User::create(['name' => 'Jefferson Pereira do Nascimento', 'email' => 'jefferson.pereira.nascimento10@gmail.com', 'password' => Hash::make('crash2020')]);
        // factory(User::class)->create();
    }
}
