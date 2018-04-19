<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view() {
        return View::make('profile.index');
    }
}
