<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Order;
use App\Models\Event;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function setPurchaseEventDetailAttribute($value)
    {
        $this->attributes['purchase_event_detail'] = json_encode($value);
    }

    public function getPurchaseEventDetailAttribute($value) {
      return json_decode($value);
    }

    public function Orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function Events()
    {
        return $this->belongsTo(Event::class,'event_id');
    }
}
