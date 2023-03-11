<?php

namespace App\Http\Controllers;

use App\Services\Bank\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(private TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->transactionService->transactionHistory($request->query());
    }
}
