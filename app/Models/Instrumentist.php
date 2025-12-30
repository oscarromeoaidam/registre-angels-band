<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Instrumentist extends Model
{
    protected $fillable = [
        'photo_path','first_name','last_name','nickname',
        'sex','birth_date','residence','phone','instrument_id','role_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
    public function role()
{
    return $this->belongsTo(\App\Models\Role::class);
}


    // Âge calculé (ne pas stocker en DB)
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->birth_date)->age;
    }
    public function instruments()
{
    return $this->belongsToMany(Instrument::class)
        ->withPivot(['is_primary'])
        ->withTimestamps();
}

}
