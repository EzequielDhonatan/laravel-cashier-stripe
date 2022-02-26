<?php

namespace App\Models\Plan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Feature\Feature;

class Plan extends Model
{
    use HasFactory;

    public function features()
    {
        return $this->hasMany( Feature::class );
    }

    public function getPriceBrAttribute()
    {
        return number_format( $this->price, 2, ',', '.' );
    }

} // Plan
