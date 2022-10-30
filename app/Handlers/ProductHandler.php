<?php


namespace App\Handlers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Exception;

class ProductHandler
{

    private ?Product $product;

    public function __construct(Product $product = null)
    {
        $this->product = $product;
    }

    public function create(array $data): Product
    {
        $this->product = new Product();
        $this->product->fill($data);
        $this->product->save();

        return $this->product;
    }

    public function update(array $data): Product
    {
        $this->product->fill($data);
        $this->product->save();

        return $this->product;
    }


    /**
     * @throws Exception
     */
    public function delete(): Product
    {
        $this->product->delete();
        return $this->product;
    }

}
