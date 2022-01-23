<?php

class Bill_Item {
    public $description;
    public $price ;
    public $quantity;
    public $total;
    public $unit;

    /**
     * @param string $description : A description of the item
     * @param double $price : The price of one unit of the item
     * @param int $quantity : The quantity of the item to add in the cart
     */
    function __construct($description, $price, $quantity, $unit) {
        $this->description = $description;
        $this->unit = $unit;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->total = $price * $quantity;
    }
}