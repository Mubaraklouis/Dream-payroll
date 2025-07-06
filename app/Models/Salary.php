<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Salary extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

    public function scopeGross(Builder $query): void
    {
        $query->where("category", "gross");
    }

    public function scopeDeduction(Builder $query): void
    {
        $query->where("category", "deduction");
    }
}
