<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $fillable = ['name', 'category'];

    
    public function instrumentists()
{
    return $this->belongsToMany(Instrumentist::class)
        ->withPivot(['is_primary'])
        ->withTimestamps();
}

}
