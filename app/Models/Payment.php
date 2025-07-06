<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    // Relation ships 
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getJsonDataAttribute(){
        return json_decode($this->data);
    }
}
