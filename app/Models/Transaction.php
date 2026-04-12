<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'amount',
        'currency',
        'email',
        'status',
        'card_brand',
        'error_message'
    ];
}
