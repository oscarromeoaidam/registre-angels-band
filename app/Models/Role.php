<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function instrumentists()
{
    return $this->hasMany(\App\Models\Instrumentist::class);
}

}