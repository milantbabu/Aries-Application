<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(exam::class);
    }

}
