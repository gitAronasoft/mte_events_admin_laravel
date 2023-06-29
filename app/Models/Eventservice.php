<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Event;

class Eventservice extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function EventByService()
    {
        return $this->hasMany(Event::class,'eventService');        
    }

}
