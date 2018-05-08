<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function services() {
        return $this->hasOne('App\Service', 'service_id', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getServiceIdAttribute($id) {
        $service = Service::where('id', $id)->first();
        return $service->name;
    }
}
