<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'founded',
        'genre',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
