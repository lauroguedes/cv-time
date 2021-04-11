<?php

namespace App\Models;

use App\Traits\InjectAuthUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory, InjectAuthUser;

    protected $fillable = [
        'name',
        'level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
