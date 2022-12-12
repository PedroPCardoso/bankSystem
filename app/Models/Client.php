<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'balance',
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}