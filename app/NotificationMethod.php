<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationMethod extends Model
{
    protected $fillable =
    [
        'id', 'method',
    ];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
