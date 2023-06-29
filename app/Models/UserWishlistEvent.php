<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class UserWishlistEvent extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    
}
