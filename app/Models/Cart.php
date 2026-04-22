<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getSessionId()
    {
        return $this->session_id;
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
