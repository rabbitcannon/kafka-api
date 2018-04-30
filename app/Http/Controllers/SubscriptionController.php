<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $user;

    /**
     * SubscriptionController constructor.
     */
    public function __construct() {
        $this->middleware(function($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }


    /**
     * @param Request $request
     */
//    public function create(Request $request) {
    public function create(Request $request) {
//        echo $this->user->id;
//        $services = json_encode($request->all());
        $services = $request->all()['data'];
        $count = count($services);

        var_dump($services);

//        foreach($services as $service) {
//            foreach($service as $key => $value) {
//                echo $value . '<br />';
//            }
//        }
//
//        for ($i = 0; $i < $count; $i++) {
//            foreach($services[$i] as $value) {
//                echo $value;
//            }
//        }

        $current = 0;
        while($current < $count) {
            foreach($services[$current] as $key => $value) {
                echo $value;
            }
            $current++;
        }
    }
}
