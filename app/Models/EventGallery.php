<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventGallery extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function Eventgallery()
    {
         return $this->belongsTo(Event::class,'id');
    }
}
