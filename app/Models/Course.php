<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Course extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
