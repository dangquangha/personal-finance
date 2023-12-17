<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_IN = 1;
    const TYPE_OUT = 2;

    protected $fillable = [
        'name',
        'type'
    ];
}