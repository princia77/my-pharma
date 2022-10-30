<?php

namespace App\Http\Controllers;

use App\Handlers\OrderHandler;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderCreation;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $productID
     * @return RedirectResponse|void
     */
    public function store(Request $request, $productID)
    {
        try {
            $authUser = (new User)->find(Auth::id());
            $product = (new Product)->find($productID);

            $existingOpenOrder = $authUser->orders()->whereNull('payment_id')->first();
            $handler = new OrderHandler($existingOpenOrder);

            if (!$existingOpenOrder) {
                $existingOpenOrder = $handler->create($request->all(), $authUser);
            }
            $handler->addOrderItems($existingOpenOrder, $product, $request->get('count'));
            //$authUser->notify(new OrderCreation());
        } catch (Exception) {
            return redirect()->back()->withErrors([
                'error' => 'oops, there was an error'
            ]);
        }

    }

    public function paidOrders(Request $request): Response|RedirectResponse
    {
        try {
            $authUser = (new User)->find(Auth::id());
            $paidOrders = $authUser->orders()->with('orderItems')->whereNotNull('payment_id')->get();

            return Inertia::render('PaidOrders', [
                'orders' => $paidOrders,

            ]);
        } catch (Exception) {
            return redirect()->back()->withErrors([
                'error' => 'oops, there was an error'
            ]);
        }

    }

    public function deleteOrderItem($id)
    {
        $orderItem = (new OrderItems)->find($id);
        $orderItem->delete();
        $handler = new OrderHandler($orderItem->order);
        $handler->recalculateOrder();
    }
}
