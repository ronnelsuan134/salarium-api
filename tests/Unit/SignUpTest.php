<?php

namespace Tests\Unit;

use Tests\TestCase;


class SignUpTest extends TestCase
{
    public function test_sign_up_email_required()
    {
        $this->post('/api/v1/register', [
            'email' => '',
            'first_name' => 'ronnel',
            'last_name' => 'suan ',
            'password' => 'asdqwe123'
        ])->assertUnprocessable();
    }
    public function test_sign_up_valid_email()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123',
            'first_name' => 'ronnel',
            'last_name' => 'suan ',
            'password' => 'asdqwe123'
        ])->assertUnprocessable();
    }
    public function test_sign_up_unique_email()
    {
        $this->post('/api/v1/register', [
            'email' => 'test1@gmail.com',
            'first_name' => 'ronnel',
            'last_name' => 'suan ',
            'password' => 'asdqwe123'
        ])->assertUnprocessable();
    }
    public function test_sign_up_password_request()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123@gmail.com',
            'first_name' => 'ronnel',
            'last_name' => 'suan ',
            'password' => ''
        ])->assertUnprocessable();
    }
    public function test_sign_up_password_min_6()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123@gmail.com',
            'first_name' => 'ronnel',
            'last_name' => 'suan ',
            'password' => 'asdwe'
        ])->assertUnprocessable();
    }
    public function test_sign_up_first_name_required()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123@gmail.com',
            'first_name' => '',
            'last_name' => 'suan ',
            'password' => 'asdqwe123'
        ])->assertUnprocessable();
    }
    public function test_sign_up_last_name_required()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123@gmail.com',
            'first_name' => 'ronnel',
            'last_name' => ' ',
            'password' => 'asdqwe123'
        ])->assertUnprocessable();
    }
    public function test_sign_up_successful()
    {
        $this->post('/api/v1/register', [
            'email' => 'test123@gmail.com',
            'first_name' => 'ronnel',
            'last_name' => 'suan',
            'password' => 'asdqwe123'
        ])->assertSuccessful();
    }
}
