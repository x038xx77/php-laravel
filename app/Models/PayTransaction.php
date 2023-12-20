<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['paymentId', 'subdomainPay']; // Добавьте поля, которые вы хотите разрешить для массового заполнения

    protected $casts = [
        'id' => 'integer', // Приведение типа id к integer
        'created_at' => 'datetime:Y-m-d H:i:s', // Приведение типа created_at к datetime
    ];

    protected $table = 'pay_transactions'; // Указываем имя таблицы явно

    // Дополнительные настройки модели...

    // Можно добавить отношения с другими моделями, если это необходимо
    // public function relatedModel()
    // {
    //     return $this->belongsTo(RelatedModel::class);
    // }
}

