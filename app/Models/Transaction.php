<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_account_id',
        'to_account_id',
        'amount',
        'transaction_type',
        'last_current_balance',
        'description'
    ];

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_account_id', 'id');
    }
}
