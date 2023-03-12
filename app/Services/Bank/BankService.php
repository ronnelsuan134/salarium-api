<?php


namespace App\Services\Bank;

use App\Http\Resources\UserBankAccountResource;
use App\Models\{User, Account, Bank, Transaction};
use App\Services\AuditTrailLogService;
use App\Traits\ResponseFormatterTrait;
use Illuminate\Http\{Response, JsonResponse};
use Illuminate\Support\Facades\{DB, Auth};

class BankService
{
    public function __construct(private AuditTrailLogService $logAuditTrailService)
    {
        $this->logAuditTrailService = $logAuditTrailService;
    }
    use ResponseFormatterTrait;

    public function getByTypeBanks(string $type): JsonResponse
    {
        return $this->responseSuccess(data: Bank::whereType($type)->get());
    }

    public function userTransfer(array $payload): JsonResponse
    {
        try {
            $userId = Auth::user()->id;
            $senderAccount = Account::whereId($userId)->firstOrFail();

            $recipientAccount = User::with('account')->whereEmail($payload['email'])->first();

            if (Auth::user()->email == $payload['email']) {
                return $this->responseError(error: ['email' => ['The sender and recipient account numbers cannot be the same.']], status: Response::HTTP_BAD_REQUEST, message: 'Bad Request');
            }
            if (!$recipientAccount) {
                return $this->responseError(error: ['email' => ['Invalid Email Address']], status: Response::HTTP_BAD_REQUEST, message: 'Bad Request');
            }
            if (
                $payload['amount'] == 0 ||
                (float)$payload['amount'] > (float) $senderAccount->balance
            ) {
                return $this->responseError(error: ['amount' => ['Insufficient Funds']], status: Response::HTTP_BAD_REQUEST, message: 'Bad Request');
            }

            DB::beginTransaction();
            $senderAccount->balance -= $payload['amount'];
            $senderAccount->save();

            $recipientAccount->account->save();

            $this->sender($senderAccount, $payload['amount']);

            $this->recipient($recipientAccount, $payload['amount']);

            TransactionLogService::logTransfer($senderAccount, $recipientAccount->account, $payload['amount'], 'user');

            DB::commit();
            return $this->responseSuccess('Transfer Successful');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError(error: $e->getMessage(), status: Response::HTTP_INTERNAL_SERVER_ERROR, message: 'Transaction failed.');
        }
    }

    public function bankTransfer(array $payload): JsonResponse
    {
        try {

            $userId = Auth::user()->id;
            $senderAccount = Account::whereId($userId)->firstOrFail();
            Bank::whereType($payload['provider'])->whereName($payload['bank'])->firstOrFail();

            $recipientAccount = Account::with('user')->whereAccountNumber($payload['account_number'])->first();

            if ($senderAccount->account_number === $payload['account_number']) {
                return $this->responseError(error: ['account_number' => ['The sender and recipient account numbers cannot be the same.']], status: Response::HTTP_BAD_REQUEST, message: 'Bad Request');
            }
            if (!$recipientAccount) {
                return $this->responseError(error: ['account_number' => ['Invalid Account Number']], status: Response::HTTP_BAD_REQUEST, message: '');
            }
            if (
                $payload['amount'] == 0 ||
                (float)$payload['amount'] > (float) $senderAccount->balance
            ) {
                return $this->responseError(error: ['amount' => ['Insufficient Funds']], status: Response::HTTP_BAD_REQUEST, message: 'Bad Request');
            }


            DB::beginTransaction();

            $this->sender($senderAccount, $payload['amount']);

            $this->recipient($recipientAccount, $payload['amount'], 'bank');

            TransactionLogService::logTransfer($senderAccount, $recipientAccount, $payload['amount'], 'bank');

            DB::commit();
            return $this->responseSuccess('Transfer Successful');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError(error: $e->getMessage(), status: Response::HTTP_INTERNAL_SERVER_ERROR, message: 'Transaction failed.');
        }
    }

    public function getUserBankAccount(): JsonResponse
    {
        return $this->responseSuccess(data: Account::whereUserId(Auth::user()->id)->firstOrFail());
    }

    private function sender($senderAccount, $amount): void
    {
        $senderAccount->balance -= $amount;
        $senderAccount->save();
    }

    private function recipient($recipientAccount, float $amount, string $type = 'user'): void
    {
        if ($type == 'user') {
            $recipientAccount->account->balance += $amount;
        }

        if ($type == 'bank') {
            $recipientAccount->balance += $amount;
        }
        $recipientAccount->save();
    }
}
