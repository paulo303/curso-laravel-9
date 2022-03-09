<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Lesson extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'video',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
