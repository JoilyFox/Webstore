<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomePageController extends Controller
{
    public function men() {
        if (!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());

        return view('welcome-page.men');
    }
}
