<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'event_type_id', 'city_id', 'date', 'price', 'quota', 'description', 'image'];

    protected $with = ['eventType', 'city'];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function remainingQuota()
    {
        return $this->quota - $this->registrations()->count();
    }
}
