<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Commenmaz;
use App\Models\Likmaz;

class Posmaz extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentsmaz()
    {
        return $this->hasMany(Commenmaz::class);
    }

    public function likesmaz()
    {
        return $this->hasMany(Likmaz::class);
    }
}
