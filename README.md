# Проект API на PHP  (laravel/framework": "^10.10")
## Описание проекта
Доработаны файлы 
routes/api.php
routes/web.php
Созданы контрооллеры app/Http/Controllers
- CallbackAlphapoController.php
- GetPayTransactionController.php
- SaveTransactionsPaymentAlphapoController.php

Созданы Модели Models/PayTransaction.php и сделаны миграции для управления транзакциями

### Этот проект представляет собой PHP API для управления платежными транзакциями. В проекте реализованы следующие API-маршруты:

    Получение списка платежных транзакций:
        Метод: GET
        Маршрут: /api/v1/payments
        Контроллер: GetPayTransactionController
        Метод контроллера: index

    Сохранение платежных транзакций:
        Метод: POST
        Маршрут: /api/v1/payments
        Контроллер: SaveTransactionsPaymentAlphapoController
        Метод контроллера: handleSaveTransactionsPayment

    Обработка обратного вызова от Alphapo:
        Метод: POST
        Маршрут: /api/v1/callback-alphapo
        Контроллер: CallbackAlphapoController
        Метод контроллера: handleCallbackAlphapo

    Проверка соединения с базой данных (тестовый маршрут):
        Метод: GET
        Маршрут: /test-database
        Контроллер: Анонимная функция (тестовый маршрут)
        Действие: Проверка соединения с базой данных
