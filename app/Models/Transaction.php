<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Wallet;
use App\Models\Package;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    const WALLET_CASH_ID = 1;

    protected $fillable = [
        'package_id',
        'amount',
        'date',
        'note'
    ];

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (int) str_replace('.', '', $value);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}