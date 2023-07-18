<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
