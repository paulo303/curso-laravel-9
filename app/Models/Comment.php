<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Comment extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function getComments(string|null $search = '', User $user)
    {
        $comments = $user->comments()
            ->where('body', 'LIKE', "%{$search}%")
            ->paginate(10);

        return $comments;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
