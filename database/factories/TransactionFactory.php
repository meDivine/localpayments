<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $shopId = rand(1,4);
        $currences = [
            'RUB',
            'USD',
            'EUR',
            'UAH'
        ];
        $paymentType = [
            'Qiwi',
            'Yoomoney',
            'Crypto'
        ];
        $publicKey = Vendor::query()->find($shopId)->select('public_key')->first();
        return [
            'email'             => $this->faker->email(),
            'vendor_id'         => $shopId,
            'public_key'        => md5($publicKey->public_key),
            'sign'              => md5(time() + rand(1, 10)),
            'comment'           => Str::random(10),
            'amount'            => rand(1, 1000000),
            'converted_amount'  => rand(1, 100000),
            'payment_currency'  => array_rand($currences),
            'payment_type'      => array_rand($paymentType),
            'form_time'         => rand(1,6)
        ];
    }
}
