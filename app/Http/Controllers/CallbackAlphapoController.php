<?php

namespace App\Http\Controllers;

use App\Models\PayTransaction;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallbackAlphapoController extends Controller
{
    public function handleCallbackAlphapo(Request $request)
    {
        try {
            $dataReq = $request->all();
            $foreign_id = $dataReq['crypto_address']['foreign_id'] ?? null;
            
            // Получаем информацию о платеже
            $paymentObj = $this->getPayment($foreign_id);

            // Проверяем, что объект платежа не является null и содержит subdomainPay
            if ($paymentObj && isset($paymentObj['subdomainPay'])) {
                // Парсим URL-адрес с использованием GuzzleHttp\Psr7\Uri
                $uri = new Uri($paymentObj['subdomainPay']);
                
                // Получаем протокол и хост
                $protocolAndHost = $uri->getScheme() . '://' . $uri->getHost();

                // Формируем URL для отправки данных
                $urlSend = $protocolAndHost . '/payment/alphapo/result';

                Log::info('Received /api/v1/callback POST urlSend with parameters: ' . $urlSend);
                Log::info('Received /api/v1/callback POST urlSend with dataReq: ' . json_encode($dataReq));


                // Отправляем POST-запрос на указанный URL с данными из запроса
                $response = Http::post($urlSend, $dataReq);

                Log::info('Response from the server: ' . $response->body());

                return response()->json(['message' => 'Callback processed successfully']);
            } else {
                // Обработка случая, когда объект платежа не найден или не содержит subdomainPay
                Log::error('Payment information not found or invalid.');
                return response()->json(['error' => 'Internal Server Error: Payment information not found or invalid.'], 500);
            }

        } catch (\Exception $error) {
            Log::error('Internal Server Error: ' . $error->getMessage());
            return response()->json(['error' => 'Internal Server Error: ' . $error->getMessage()], 500);
        }
    }

    // Метод для получения информации о платеже
    private function getPayment($paymentId)
    {
        try {
            // Используем метод where для поиска всех записей с указанным paymentId
            // и метод latest для сортировки по убыванию даты создания
            $payment = PayTransaction::where('paymentId', $paymentId)->latest()->first();

            if ($payment) {
                // Если запись найдена, возвращаем данные
                return [
                    'paymentId' => $payment['paymentId'],
                    'subdomainPay' => $payment['subdomainPay'],
                ];
            } else {
                // Если запись не найдена, можно вернуть null или другое значение по умолчанию
                return null;
            }
        } catch (\Exception $error) {
            Log::error('Error getting payment: ' . $error->getMessage());
            // Обработка ошибки, например, выброс исключения или возврат null
            return null;
        }
    }


}


