<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PackageFeature;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true;
    protected $dates = ['deleted_at'];
   
}
