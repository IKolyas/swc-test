<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

    public $casts = ['created_at' => 'date'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'users_events',
            'event_id',
            'user_id'
        );
    }
}