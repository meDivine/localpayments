<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'vendor_id',
        'public_key',
        'sign',
        'comment',
        'amount',
        'account',
        'payment_status',
        'payment_currency',
        'converted_amount',
        'payment_type',
        'transaction_complete',
        'form_time',
    ];

    public function vendorTransactions() {
        return $this->hasMany(Transaction::class, 'vendor_id');
    }
}
