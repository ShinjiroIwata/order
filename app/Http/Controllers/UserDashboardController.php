<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactForm;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserDashboardController extends Controller
{
    //

    public function contact()
    {
        return view('user.contact');
    }
    public function contact_store(Request $request)
    {

        $request->validate([
            'message' => 'required|string',
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $user_email = $user->email;
        $message = $request->message;
        $contactForm = ContactForm::create([
            'user_id' => $user_id,
            'message' => $message
        ]);
        Mail::to($user_email)->send(new ContactFormMail($message));

        return to_route('user.contact.thanks');
    }

    public function contact_thanks()
    {
        return view('user.contact_thanks');
    }
    public function order(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->name;
        $order_date = $request->order_date;
        $orders = Order::where('order_date', $order_date)->where('user_id', $user_id)
            ->get();
        $products = Product::all();

        // dd($orders);
        return view('user.order', compact('products', 'orders', 'user_name'));
    }
    public function order_create()
    {
        $products = Product::all();
        return view('user.order_create', compact('products'));
    }
    public function order_store(Request $request)
    {

        $request->validate([
            'order_date' => 'required|date|after:today',
        ]);
        $user_id = Auth::user()->id;
        $order_date = $request->order_date;
        $orders = $request->order_num;

        foreach ($orders as $product_id => $num) {
            Order::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'order_date' => $order_date,
                ],
                [
                    'num' => $num,
                ]
            );
        }

        return to_route('user.thanks');
    }

    public function thanks()
    {
        return view('user.thanks');
    }
}
