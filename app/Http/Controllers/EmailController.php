<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Email;

class EmailController extends Controller
{
    public function checkoutEmail($email, $order_id) {

        $details = [
            'title' => 'Success',
            'body' => 'Your order №'.$order_id.' has been completed successfully!'
        ];

        Mail::to($email)->send(new CheckoutEmail($details));

        return redirect()->route('menWelcomePage')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
    }

    public function registerEmail($email) {

        $details = [
            'title' => 'Success',
            'body' => 'You have been successfully registered via Google!'
        ];

        Mail::to($email)->send(new CheckoutEmail($details));

        return redirect('/');
    }
}
