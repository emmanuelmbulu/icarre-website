<?php

class Bill_Payment {
    public $reference;
    public $amount;
    public $status;
    public $channel;
    public $date;
    public $receipt;
    public $ip_address;

    public function set_status($payment_status) {
        $payment_status = strtolower($payment_status);
        $this->status = $payment_status;
        if($this->status == "approved" || $this->status == "success") {
            $this->status = "approved";
        }
    }
}