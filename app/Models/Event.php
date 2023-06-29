<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Eventservice;
use App\Models\EventGallery;

class Event extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function servciesName()
    {
        return $this->belongsTo(Eventservice::class,'eventService');
    }

    public function gallery()
    {
        return $this->hasMany(EventGallery::class,'event_id');
    }

}
