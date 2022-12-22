<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricBalance extends Model
{
    use HasFactory;
    CONST TYPE_PAYMENT = 0;
    CONST TYPE_DEPOSIT = 1;
    public $fillable = [
        'amount',
        'type',
        'Description',
        'client_id',
        'receipt',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static $rules = [
        'Description' => ['required', 'max:90'],
        'amount' => ['required'],
        'type' => ['required'],
        'receipt' => ['required_if:type,1']
    ];

}
