<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubscription;
use App\Subscription;
use Illuminate\Http\Request;
use function json_decode;
use function var_dump;

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
//    public function create(Request $request) {
    public function create(AddSubscription $request) {
//        echo $this->user->id;
//        $services = json_encode($request->all());
        $services = $request->all()['data'];

//        $subscription = new Subscription();

        $count = count($services);
//        $count_inner = 0;
//        for($i = 0;  $i <= $count; $i++) {
////            echo $count_inner;
////            echo "----------<br />";
////            echo $services['data'][$i] . '<br />';
//            echo $services[$i];
//        }
//
////        foreach($services['data'][0] as $k => $v) {
//

//        foreach($services as $service) {
//            echo $service;
//        }

//        echo $services->data;

        var_dump($services);
//        $this->validate($request, [
//           'service'    => 'required'
//        ]);

//        return response()->json(['success' => 'You have just created one item']);
    }
}
