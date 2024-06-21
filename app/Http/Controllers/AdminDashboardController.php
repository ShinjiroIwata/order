<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminDashboardController extends Controller
{
    //
    public function user()
    {
        $users = User::where('role_id', 2)->get();


        return view('admin.user', compact('users'));
    }
    public function product()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }
    public function product_create()
    {
        return view('admin.product_create');
    }
    public function product_store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|integer',
        ]);
        $imagePath = $request->file('product_img')->store('products', 'public');
        // 商品データを保存
        $product = new Product();
        $product->name = $request->product_name;
        $product->image_path = $imagePath;
        $product->price = $request->product_price;
        $product->save();

        return back();
    }

    public function order(Request $request)
    {
        $products = Product::all();
        $order_date = $request->order_date;
        $orders = Order::where('order_date', $order_date)
            ->get();

        $groupedOrders = [];

        foreach ($orders as $order) {
            $userId = $order->user_id;
            $userName = $order->user->name;
            if (!isset($groupedOrders[$userId])) {
                $groupedOrders[$userId] = [
                    'user_id' => $userId,
                    'user_name' => $userName,
                    'orders' => []
                ];
            }
            $groupedOrders[$userId]['orders'][] = $order;
        }

        return view('admin.order', compact('groupedOrders', 'products'));
    }

    public function product_delete(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        if ($product) {
            $product->delete();
        }
        return to_route('admin.product');
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        return view('admin.product_edit', compact('product'));
    }
    public function product_update(Request $request)
    {

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::find($request->product_id);

        $product->name = $request->product_name;
        $product->price = $request->product_price;

        if ($request->hasFile('product_img')) {
            if ($product->image_path) {
                Storage::delete('public/' . $product->image_path);
            }

            $imagePath = $request->file('product_img')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return to_route('admin.product');
    }
}
