<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id', 'model', 'year', 'color',
        'plate_number', 'type', 'price', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
