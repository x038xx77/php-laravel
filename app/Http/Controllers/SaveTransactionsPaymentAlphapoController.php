<?php

namespace App\Http\Controllers;

use App\Models\PayTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaveTransactionsPaymentAlphapoController extends Controller
{
    public function handleSaveTransactionsPayment(Request $request)
    {
        try {
            $data = $request->only(['foreign_id', 'current_domain', 'convert_to', 'currency']);
            $foreign_id = $data['foreign_id'];
            $current_domain = $data['current_domain'];

            if (!empty($foreign_id)) {
                // Создание платежа 
                $payment = $this->createPayment($foreign_id, $current_domain);
                
            }

            return response()->json(['status' => 'Ok'], 200);
        } catch (\Exception $error) {
            // Логирование ошибки
            Log::error('Error handling payment:', ['error' => $error->getMessage()]);

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    private function createPayment($paymentId, $subdomainPay)
    {
        try {
            // Создание записи в базе данных
            $payment = PayTransaction::create([
                'paymentId' => $paymentId,
                'subdomainPay' => $subdomainPay,
            ]);

            return $payment;
        } catch (\Exception $error) {
            // Логирование ошибки создания платежа
            Log::error('Error creating payment:', ['error' => $error->getMessage()]);

            return null;
        }
    }
}

