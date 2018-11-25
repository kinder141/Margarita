<?php

namespace App\Http\Controllers;

use App\Category;
use App\Laptop;
use App\Order;
use App\Products;
use App\Smartphone;
use App\Television;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __invoke($category, $id)
    {
        switch ($category) {
            case 'laptops':
                $product = Laptop::find($id);
                break;
            case 'smartphones':
                $product = Smartphone::find($id);
                break;
            case 'televisions':
                $product = Television::find($id);
                break;
            default:
                $product = null;
                break;
        }

        if (empty($product)) {
            return redirect()->route('laptops');
        }

        return view('pages.order', compact('product'));
    }

    public function handle(Request $request, $category, $id)
    {
        switch ($category) {
            case 'laptops':
                $product = Laptop::find($id);
                break;
            case 'smartphones':
                $product = Smartphone::find($id);
                break;
            case 'televisions':
                $product = Television::find($id);
                break;
            default:
                $product = null;
                break;
        }

        $categoryObj = Category::where('name', '=', $category)->first();

        $date = Carbon::now();

        $order = new Order();
        $order->payment_method = "PayPal";
        $order->status = "Obtain";
        $order->date = $date->format('Y-m-d H:i:s');
        $order->amount = $request->get('amount');
        $order->total = $product->price * $request->get('amount');
        $order->user()->associate($request->user());
        $order->save();

        $productOrder = new Products();
        $productOrder->total = $order->total;
        $productOrder->amount = $order->amount;
        $productOrder->product_id = $product->id;
        $productOrder->order()->associate($order);
        $productOrder->category()->associate($categoryObj);
        $productOrder->save();

        return redirect()->route('product', ['category' => $category, 'id' => $id]);
    }
}
