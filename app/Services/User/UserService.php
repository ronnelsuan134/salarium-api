<?php

namespace App\Services\User;

use App\Models\Account;
use App\Models\User;
use App\Services\AuditTrailLogService;

class UserService
{

    /**
     * @param string $username
     * @return Model User
     */
    public function getUserByEmail(string $email): User
    {
        return User::whereEmail($email)->firstOrFail();
    }


    /**
     * @param string $username
     * @return Model User
     */
    public function createUser(array $data): User
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        Account::create([
            'user_id' => $user->id,
            'account_number' =>  $this->createUserBankAccount(),
            'balance' => 0
        ]);


        AuditTrailLogService::logAuditTrail('user created', $user);

        return $user;
    }

    private function createUserBankAccount()
    {
        $lastAccount = User::orderBy('id', 'desc')->first();
        return str_pad((optional($lastAccount)->id + 1), 10, '0', STR_PAD_LEFT);
    }
}
