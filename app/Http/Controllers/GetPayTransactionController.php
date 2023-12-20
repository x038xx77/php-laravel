<?php

namespace App\Http\Controllers;

use App\Models\PayTransaction;
use Illuminate\Support\Facades\Log;

class GetPayTransactionController extends Controller
{
    public function index()
    {
        try {
            // Получаем список записей из базы данных
            $payTransactions = PayTransaction::select('paymentId', 'subdomainPay', 'created_at')->get();
            Log::info('Fetched payTransactions:', $payTransactions->toArray());
            return response()->json(['payTransactions' => $payTransactions], 200);
        } catch (\Exception $error) {
            Log::error('Error fetching payTransactions: ' . $error->getMessage());
            return response()->json(['error' => 'Internal Server Error: ' . $error->getMessage()], 500);
        }
    }
}


