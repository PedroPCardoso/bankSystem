<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = [
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historic_balance()
    {
        return $this->belongsTo(HistoricBalance::class);
    }
}