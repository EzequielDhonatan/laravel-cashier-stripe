<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Plan\Plan;

class Feature extends Model
{
    use HasFactory;

    public function plan()
    {
        return $this->belongsTo( Plan::class );
    }

} // Feature
