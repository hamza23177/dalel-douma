<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Commenmaz extends Model
{
    use HasFactory;

    protected $fillable = [
        'commenmaz',
        'user_id',
        'posmaz_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
