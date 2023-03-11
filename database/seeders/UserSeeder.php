<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users() as $index => $user) {
            $user = User::create($user);

            Account::create([
                'user_id' => $user->id,
                'account_number' =>  $this->createAccount(),
                'balance' => 500
            ]);
        }
    }

    private function users()
    {
        return [
            [
                'email' => 'test1@gmail.com',
                'first_name' => 'alisha ',
                'last_name' => 'luna',
                'password' => 'test123'
            ],
            [
                'email' => 'test2@gmail.com',
                'first_name' => 'mathew',
                'last_name' => 'worthy',
                'password' => 'test123'
            ],
        ];
    }

    private function createAccount()
    {
        $lastAccount = User::orderBy('id', 'desc')->first();
        return str_pad((optional($lastAccount)->id + 1), 10, '0', STR_PAD_LEFT);
    }
}
