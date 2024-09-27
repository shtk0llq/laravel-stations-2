<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    protected $fillable = [
        'movie_id',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        // Carbon インスタンスに変換
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
