<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh', ['-vvv' => true]);
        Artisan::call('db:seed', ['-vvv' => true]);
    }

    public function token(): string
    {
        $response =  $this->post('/api/v1/login', ['email'  =>  'test1@gmail.com', 'password' => 'test123']);
        $token = Arr::get($response, 'result.authorization.access_token', '');
        return "Bearer {$token}";
    }
}
