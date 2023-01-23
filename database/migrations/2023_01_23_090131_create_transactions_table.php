<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Почта покупателя, обязательное поле
            $table->string('email', 64)->required();
            //ID магазина зарегистрированного в системе
            $table->integer('vendor_id')->required();
            //Публичный ключ на момент действия платежа
            $table->string('public_key')->required();
            // Подпись sha1($email.$vendor_id.$public_key.$amount)
            $table->string('sign', 64)->required();
            //Комментарий к платежу, необязательное поле
            $table->string('comment', 128)->nullable();
            //Сумма платежа
            $table->decimal('amount')->required();
            // Номер аккаунта в система, допустим его ид или почта по которомы вы идентифицируете пользователя
            $table->string('account')->nullable();
            /**
             * Статус платежа
             * 0 - не оплачен
             * 1 - оплачен
             */
            $table->boolean('payment_status')->default(false);
            /**
             * 1 - RUB
             * 2 - USD
             * 3 - EUR
             * 4 - UAH
             */
            $table->tinyInteger('payment_currency')->required();
            /***
             * Конвертированная сумма в рублях на момент создания платежа
             * После оплаты происходит повторная конвертация для обновления суммы
             * */

            $table->decimal('converted_amount')->required();
            /**
             * Qiwi/YooMoney
             * TODO: Crypto TRC-20/BEP20/ERC-20 USDT/BUSD/Native
             */
            $table->string('payment_type')->required();
            /**
             * Временная метка когда была оплачена транзакция
             */
            $table->dateTime('transaction_complete')->nullable();
            /**
             * Время жизни формы оплаты
             * 10S
             * 2D
             * 1M и т.д.
             */
            $table->integer('form_time')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
