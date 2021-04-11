<?php

namespace App\Models;

use App\Traits\InjectAuthUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory, InjectAuthUser;

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'description',
        'company',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
