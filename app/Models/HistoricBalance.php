<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricBalance extends Model
{
    use HasFactory;
    CONST TYPE_DEPOSIT = 1;
    CONST TYPE_PAYMENT = 0;
    public $fillable = [
        'amount',
        'type',
        'Description',
    ];
}
