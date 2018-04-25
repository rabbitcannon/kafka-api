<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\AddSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param AddSubscription $request
     */
    public function create(Request $request) {
//    public function create(AddSubscription $request) {
        $inputs = $request->all();
//        var_dump($request);
        var_dump($inputs);
        die;
    }
}
