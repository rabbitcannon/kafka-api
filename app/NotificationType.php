<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $fillable = [
        'id', 'type',
    ];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
