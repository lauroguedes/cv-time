<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_uf',
        'phone',
        'date_birth',
        'about_me',
        'hobbies',
        'theme'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
