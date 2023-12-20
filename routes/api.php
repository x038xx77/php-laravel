<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallbackAlphapoController;
use App\Http\Controllers\SaveTransactionsPaymentAlphapoController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GetPayTransactionController;

Route::get('/api/v1/payments', [GetPayTransactionController::class, 'index']);
Route::post('/api/v1/payments', [SaveTransactionsPaymentAlphapoController::class, 'handleSaveTransactionsPayment']);
Route::post('/api/v1/callback-alphapo', [CallbackAlphapoController::class, 'handleCallbackAlphapo']);
//Проврка базы данных - удалить
Route::get('/test-database', function () {
    try {
        DB::connection()->getPdo();
        echo "Successfully connected to the database!";
    } catch (\Exception $e) {
        die("Could not connect to the database. Error: " . $e->getMessage());
    }
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
