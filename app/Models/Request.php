<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function getAttachmentUrlAttribute()
    {
        return Storage::url($this->attachment);
    }

    public function hasReplies(): bool
    {
        return $this->replies->count() > 0;
    }

}
