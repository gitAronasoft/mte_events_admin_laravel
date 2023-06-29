<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Package;

class Subscription extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function packages()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
