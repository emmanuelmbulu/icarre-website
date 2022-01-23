<?php

class Bill_Client {
    public $fullname;
    public $address;
    public $country;
    public $email;
    public $phone;

    function __construct() {
        $this->address = $this->country = $this->email = $this->phone = "";
    }
}