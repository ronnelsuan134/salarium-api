<?php

namespace App\Http\Controllers;

use App\Http\Requests\{BankTransferRequest, UserTransferRequest};
use App\Services\Bank\BankService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct(
        private BankService $bankService,
    ) {
        $this->bankService = $bankService;
    }

    public function userTransfer(UserTransferRequest $request): JsonResponse
    {
        return $this->bankService->userTransfer($request->validated());
    }

    public function bankTransfer(BankTransferRequest $request): JsonResponse
    {
        return $this->bankService->bankTransfer($request->validated());
    }

    public function banks(Request $request): JsonResponse
    {
        return $this->bankService->getByTypeBanks($request->query('type') ?? 'instapay');
    }

    public function getUserAccount(): JsonResponse
    {
        return $this->bankService->getUserBankAccount();
    }
}
