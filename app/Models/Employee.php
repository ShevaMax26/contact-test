<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
    ];
    protected static $unguarded = false;

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
