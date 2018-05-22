<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param $id
     * @param Request $request
     */
    public function edit($id, Request $request) {
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->profile->phone = $request->input('phone');
        $user->push();
    }
}
