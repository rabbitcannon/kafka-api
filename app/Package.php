<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable =
    [
        'id', 'services_id', 'notification_type_id', 'notification_frequencies_id',
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function notificationTypes() 
    {
        return $this->hasMany('App\NotificationType');
    }

    public function notificationFrequencies()
    {
     return $this->hasMany('App\NotificationFrequency');
    }

    public function notificationMethods()
    {
        return $this->hasMany('App\NotificationMethod');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
