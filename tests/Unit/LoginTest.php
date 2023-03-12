<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_login_email_is_required()
    {
        $this->post('/api/v1/login', ['email'  =>  '', 'password' => 'asdqwe123'])->assertUnprocessable();
    }
    public function test_login_valid_email()
    {
        $this->post('/api/v1/login', ['email'  =>  'test2', 'password' => 'asdqwe123'])->assertUnprocessable();
    }

    public function test_login_password_is_required()
    {
        $this->post('/api/v1/login', ['email'  =>  'test2', 'password' => ''])->assertUnprocessable();
    }

    public function test_login_user_not_exist()
    {
        $this->post('/api/v1/login', ['email'  =>  'test23@test.com', 'password' => 'asdqwe123'])->assertUnauthorized();
    }

    public function test_login_password_incorrect()
    {
        $this->post('/api/v1/login', ['email'  =>  'test1@gmail.com', 'password' => 'asdqwe123'])->assertUnauthorized();
    }

    public function test_login_success()
    {
        $this->post('/api/v1/login', ['email'  =>  'test1@gmail.com', 'password' => 'test123'])->assertSuccessful();
    }
}
