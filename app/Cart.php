<?php

namespace App;

class Cart
{

    public $items = null;
    public $totalPrice = 0;
    public $totalQty = 0;

    public function __construct($oldCart)
    {
        if ($oldCart != null) {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalQty = $oldCart->totalQty;
        }
    }

    public function add($product)
    {
        $productId = $product->id;
        $productPrice = $product->price;
        $oldItem = ['qty' => 0, 'price' => 0, 'item' => $product];

        if ($this->items) {
            if (array_key_exists($productId, $this->items)) {
                $oldItem = $this->items[$productId];
            }
        }


        ++$oldItem['qty'];
        $oldItem['price'] = $productPrice * $oldItem['qty'];
        $this->items[$productId] = $oldItem;

        $this->totalQty++;
        $this->totalPrice += $productPrice;

    }

    public function addItem($id, $newItem)
    {
        $oldItem = ['qty' => 0, 'price' => 0, 'item' => $newItem['item']];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $oldItem = $this->items[$id];
            }
        }

        $oldItem['qty'] += $newItem['qty'];
        $oldItem['price'] += $newItem['price'];
        $this->items[$id] = $oldItem;
    }

    public function reduceByOne($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']->price;
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']->price;

        if($this->items[$id]['qty'] === 0){
            unset($this->items[$id]);
        }

    }

    public function reduceItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

}