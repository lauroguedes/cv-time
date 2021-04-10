<?php

namespace App\Models;

use App\Traits\InjectAuthUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory, InjectAuthUser;

    protected $fillable = [
        'icon',
        'name',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
