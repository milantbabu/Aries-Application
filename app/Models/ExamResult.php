<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function name(): Attribute
    {
        return Attribute::make(
          get: fn (string $value) => ucfirst($value),
          set: fn (string $value) => ucfirst($value),
        );
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(exam::class);
    }

}
