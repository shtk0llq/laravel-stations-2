<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function sheet(): BelongsTo
    {
        return $this->belongsTo(Sheet::class);
    }

    protected $fillable = [
        'date',
        'schedule_id',
        'sheet_id',
        'user_id',
    ];
}
