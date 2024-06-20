<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //

    public function contact()
    {
        return view('user.contact');
    }
    public function contact_store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        dd($request->contact);
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
    }
}
