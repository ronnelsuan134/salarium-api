<?php


namespace App\Services\Bank;

use App\Models\{Account, Transaction};
use App\Services\AuditTrailLogService;
use App\Traits\ResponseFormatterTrait;

class TransactionLogService
{
    use ResponseFormatterTrait;

    public static function logTransfer(Account $fromAccount, Account $toAccount, $amount, $type): void
    {

        self::createTransactionLog(
            $fromAccount,
            (int) $fromAccount->id,
            (int) $toAccount->id,
            $amount,
            'debit',
            $type === 'user' ? 'send money to user' : 'send money to bank'
        );

        self::createTransactionLog(
            $toAccount,
            (int)$fromAccount->id,
            (int) $toAccount->id,
            $amount,
            'credit',
            $type === 'user' ? 'received money from user' : 'send money to bank'
        );
    }

    private static function createTransactionLog(Account $account, $fromAccountId, $toAccountId, $amount, $type, $desc): void
    {
        $transaction =  Transaction::create([
            'user_id' => $account->user_id,
            'from_account_id' => $fromAccountId,
            'to_account_id' => $toAccountId,
            'amount' => $amount,
            'transaction_type' => $type,
            'description' => $desc,
            'last_current_balance' => $account->balance
        ]);

        AuditTrailLogService::logAuditTrail('created', $transaction);
    }
}
