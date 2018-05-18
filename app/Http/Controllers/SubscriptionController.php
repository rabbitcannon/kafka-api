<?php

namespace App\Http\Controllers;

use App\AlertFrequency;
use App\AlertMethod;
use App\AlertType;
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

    /**
     * @param $id
     * @param Request $request
     */
    public function edit($id, Request $request) {
        $fields = $request->all()['data'];
        $frequencies = AlertFrequency::pluck('name')->toArray();
        $methods = AlertMethod::pluck('name')->toArray();
        $types = AlertType::pluck('name')->toArray();
        $array = array_merge($frequencies, $methods, $types);
        $subscription = Subscription::find($id);

        foreach($array as $item) {
            $replaceble = [" ", "+", "All"];
            $strip_spaces = str_replace($replaceble, "", $item);
            $text = strtolower($strip_spaces);
            $subscription->$text = $value = array_key_exists($text, $fields) ? 1 : 0;
        }

        $subscription->save();
    }

    public function delete($id) {
        echo $id; die;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSubscription($id) {
        return Subscription::find($id);
    }

    /**
     * @return string
     */
    public function listSubscriptions() {
        return json_encode(Subscription::where('user_id', $this->user->id)->get());
    }
}
