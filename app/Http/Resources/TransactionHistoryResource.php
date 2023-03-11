<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => $this->transaction_type,
            'last_current_balance' => $this->last_current_balance,
            'to_account_email' => $this->toAccount->email,
            'created_at' => date('Y-m-d H:is', strtotime($this->created_at))
        ];
    }
}
