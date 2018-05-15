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
    public function create(Request $request) {
        $services = $request->all()['data'];
        $count = count($services);
        $current = 0;

        while($current < $count) {
            $sub = new Subscription();
            $sub->user_id = $this->user->id;

            foreach($services[$current] as $key => $value) {
                $tag = substr($value, 0, strpos($value, "_"));
                $tag_value = substr($value, strpos($value, "_") + 1);

                switch($tag) {
                    case "service":
                        $sub->service_id = $tag_value;
                        break;
                    case "debug":
                        $sub->debug = true;
                        break;
                    case "warning":
                        $sub->warning = true;
                        break;
                    case "critical+":
                        $sub->critical = true;
                        break;
                    case "email":
                        $sub->email = true;
                        break;
                    case "push":
                        $sub->push = true;
                        break;
                    case "sms":
                        $sub->sms = true;
                        break;
                    case "allalerts":
                        $sub->alerts= true;
                        break;
                    case "hourly":
                        $sub->hourly = true;
                        break;
                    case "daily":
                        $sub->daily = true;
                        break;
                }
            }
            $sub->save();
            $current++;
        }
    }

    public function delete($id) {
        echo $id; die;
    }

    /**
     * @return string
     */
    public function listSubscriptions() {
        return json_encode(Subscription::where('user_id', $this->user->id)->get());
    }
}
