<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Comment extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
