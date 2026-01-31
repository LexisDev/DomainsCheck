<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'checked_at',
        'status_code',
        'is_success',
        'response_time_ms',
        'error_message',
    ];

    protected $casts = [
        'checked_at' => 'datetime',
        'is_success' => 'boolean',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}

