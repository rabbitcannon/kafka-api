<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationFrequency extends Model
{
    protected $fillable = [
        'id', 'frequency',
    ];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
