<?php


namespace App\Services\Bank;

use App\Http\Resources\TransactionHistoryResource;
use App\Models\Transaction;
use App\Traits\ResponseFormatterTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    use ResponseFormatterTrait;

    public function transactionHistory(array $query): JsonResponse
    {
        return $this->responseWithPagination(
            TransactionHistoryResource::collection(
                Transaction::orderBy('created_at', 'DESC')
                    ->with('toAccount')
                    ->whereUserId(Auth::user()->id)
                    ->paginate(Arr::get($query, 'per_page', 10), ['*'], 'page', Arr::get($query, 'current_page', 1))
            )
        );
    }
}
