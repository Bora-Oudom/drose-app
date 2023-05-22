<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasFactory;


    /**
     * Get the User that owns the Roles.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
