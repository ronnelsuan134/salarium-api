<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class BankTransferTest extends TestCase
{
    public function test_bank_transfer_send_request_with_out_token()
    {
        $this->post('/api/v1/bank-transfer', ['email' => 'test2@gmail.com', 'amount' => 1])->assertUnauthorized();
    }

    public function test_bank_transfer_provider_required()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => '', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 1])->assertUnprocessable();
    }
    public function test_bank_transfer_provider_type_instpay_or_pesonet()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'qqpay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 1])->assertUnprocessable();
    }

    public function test_bank_transfer_bank_required()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => '', 'account_number' => '0000000003', 'amount' => 1])->assertUnprocessable();
    }
    public function test_bank_transfer_bank_name_and_type_not_in_db()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Unknown Bank', 'account_number' => '0000000003', 'amount' => 1])->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function test_bank_transfer_account_number_required()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '', 'amount' => 1])->assertUnprocessable();
    }
    public function test_bank_transfer_invalid_account_number()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '00000000032', 'amount' => 1])->assertStatus(Response::HTTP_BAD_REQUEST);
    }
    public function test_bank_transfer_amount_required()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => ''])->assertUnprocessable();
    }
    public function test_bank_transfer_amount_is_number()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 'asdasd'])->assertUnprocessable();
    }
    public function test_bank_transfer_sender_and_recipient_account_are_same()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000002', 'amount' => 1])->assertStatus(Response::HTTP_BAD_REQUEST);
    }
    public function test_bank_transfer_sender_amount_zero()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 0])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_bank_transfer_sender_amount_greater_than_current_balance()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 1000])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_bank_transfer_successful()
    {
        $this->withHeaders([
            'Authorization' => $this->token(),
        ])->post('/api/v1/bank-transfer', ['provider' => 'instapay', 'bank' => 'Alipay', 'account_number' => '0000000003', 'amount' => 2])->assertSuccessful();
    }
}
