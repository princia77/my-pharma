<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $authUser = (new User)->find(Auth::id());

        if(count($authUser->orders) > 0){
            $existingOpenOrder = $authUser->orders()->whereNull('payment_id')->first();
            if($existingOpenOrder)
                $items = $existingOpenOrder->orderItems()->with('product')->get();
            $paidOrders = $authUser->orders()->with('orderItems.product')->whereNotNull('payment_id')->get();
        }


        $products = Product::all()->groupBy('category');
        return Inertia::render('Dashboard', [
            'products' => $products,
            'open_order_items' => $items?? null,
            'paid_order_items' => $paidOrders?? null,
            'count' => isset($items) ? $items->count() : 0,
            'order' => $existingOpenOrder?? null,
            'auth' => $authUser
        ]);
    }

}
