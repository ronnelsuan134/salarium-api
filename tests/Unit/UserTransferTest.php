<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserTransferTest extends TestCase
{
    public function test_user_bank_transfer_send_request_with_out_token()
    {
        $this->post('/api/v1/user-transfer', ['email' => 'test2@gmail.com', 'amount' => 12])->assertUnauthorized();
    }

    public function test_user_bank_transfer_email_required()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => '', 'amount' => 12])->assertUnprocessable();
    }

    public function test_user_bank_transfer_invalid_email()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test123', 'amount' => 12])->assertUnprocessable();
    }

    public function test_user_bank_transfer_sender_and_recipient_email_are_same()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test1@gmail.com', 'amount' => 12])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_user_bank_transfer_invalid_recipient_email()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test12321@gmail.com', 'amount' => 12])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_user_bank_transfer_sender_amount_zero()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test2@gmail.com', 'amount' => 0])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_user_bank_transfer_sender_amount_greater_than_current_balance()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test2@gmail.com', 'amount' => 1000])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_user_bank_transfer_successful()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/user-transfer', ['email' => 'test2@gmail.com', 'amount' => 1])->assertSuccessful();
    }
}
