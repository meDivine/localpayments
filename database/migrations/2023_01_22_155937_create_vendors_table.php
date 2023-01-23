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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            /**
             * Название магазина
             */
            $table->string('name', 64)->required();
            /**
             * Секретный ключ, автогенерация
             */
            $table->string('secret_key', '128')->required();
            // Публичный ключ, автогенерация
            $table->string('public_key', 64)->required();
            // Путь к картинке сайта
            $table->text('logo')->nullable();
            // Ссылка для отправки уведомлений
            $table->text('response_url')->required();
            // Редирект после успешной оплаты
            $table->text('success_url')->required();
            // Редирект после ошибки оплаты
            $table->text('fail_url')->required();
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
        Schema::dropIfExists('vendors');
    }
};
