<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user_email = User::where('email', 'superadmin@admin.com')->first();
        if(is_null($user_email)){
            $user = new User();
            $user->name= "superadmin";
            $user->email = "superadmin@admin.com";
            $user->password = Hash::make("1234");
            $user->save();
        }
    }
}
