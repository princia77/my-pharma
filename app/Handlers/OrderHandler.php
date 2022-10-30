<?php


namespace App\Handlers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Exception;

class OrderHandler
{

    private ?Order $order;

    public function __construct(Order $order = null)
    {
        $this->order = $order;
    }

    public function create(array $data, $user): ?Order
    {
        $this->order = new Order();
        $this->order->user_id = $user->id;
        $this->order->save();

        return $this->order;
    }


    /**
     * @throws Exception
     */
    public function delete(): ?Order
    {
        $this->order->delete();
        return $this->order;
    }

    /**
     * @throws Exception
     */
    public function addOrderItems(Order $order, Product $product, $productCount){

        $this->ensureSufficientStock($product, $productCount);
        $itemCount = $productCount;

        while ($itemCount){
            $orderItem = new OrderItems();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->save();
            $itemCount --;
        }

        $product->inventory_stock -= $productCount;
        $product->save();

        $this->recalculateOrder();
    }

    /**
     * @throws Exception
     */
    private function ensureSufficientStock($product, $productCount){
        if($productCount > $product->inventory_stock){
            throw new Exception('Item is out of stock');
        }
    }

    public function recalculateOrder(){
        $total = 0;
        foreach ($this->order->orderItems as $item) {
            $total += $item->product->price;
        }
        $this->order->total = $total;
        $this->order->save();
    }

}
