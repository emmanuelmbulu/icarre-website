<?php

use Orm\Model;

class Model_Bill extends Model {
	protected static $_table_name = 'bill';

	protected static $_primary_key = array('id');

	protected static $_conditions = array(
        'order_by' => array('id' => 'desc'),
    );

    protected static $_properties = array(
		"id",
        "reference",
        "amount" => array(
            "label" => "form.input.amount.label",
            "data_type" => "float",
            "validation" => array(
                "required",
            ),
            "form" => array(
                "type" => "number",
                "name" => "amount",
            )
        ),
        "currency",
        "tva",
        "client",
        "items",
        "payments",
        "amount_paid",
        "is_paid",
        "last_payment_date",
        "created_at",
    );

    /**
     * Function that add an item to the bill
     * @param Bill_Item $item : An object
     */
    public function add_item($item) {
        $this->amount += $item->total;

        $items = array();
        if(!empty($this->items)) {
            $items = (array)json_decode($this->items);
        }
        $items[] = $item;
        $this->items = json_encode($items);
    }

    /**
     * Function that add an array of items to the bill
     * @param array $item : An array of Bill_Item objects
     */
    public function add_items($items) {
        foreach ($items as $item) {
            $this->amount += $item->total;
        }

        $last_items = array();
        if(!empty($this->items)) {
            $last_items = (array)json_decode($this->items);
        }
        $last_items = array_merge($last_items, $items);
        $this->items = json_encode($last_items);
    }

    /**
     * Function that returns an array of Bill_Item objects
     * @param null : Nothing
     * @return array
     */
    public function get_items() {
        if(!empty($this->items)) {
            return (array)json_decode($this->items);
        }
        return [];
    }

    /**
     * Function that returns the vat amount of the bill
     * @param null : Nothing
     * @return float : The vat amount value
     */
    public function get_vat() {
        return $this->amount * $this->tva / 100;
    }

    /**
     * Function that returns the ttc amount of the bill
     * @param null : Nothing
     * @return float : The ttc amount value
     */
    public function get_ttc() {
        return $this->amount + $this->get_vat();
    }

    /**
     * Function that add the client to the bill
     * @param Bill_Client $client : An object
     */
    public function add_client($client) {
        $this->client = json_encode($client);
    }

    /**
     * Function that returns a Bill_Client object
     * @param null : Nothing
     * @return Bill_Client|null
     */
    public function get_client() {
        if(!empty($this->client)) {
            return json_decode($this->client);
        }
        return null;
    }

    /**
     * Function that add a payment item to the bill
     * @param Bill_Payment $payment : An object
     */
    public function add_payment($payment) {
        if($payment->status == "approved") {
            $this->amount_paid += $payment->amount;
            $total_to_pay = $this->get_ttc();

            if($this->amount_paid >= $total_to_pay) {
                $this->is_paid = true;
            }
        }
        $this->last_payment_date = $payment->date;

        $payments = array();
        if(!empty($this->payments)) {
            $payments = (array)json_decode($this->payments);
        }
        $payments[] = $payment;
        $this->payments = json_encode($payments);
    }

    /**
     * Function that returns an array of Bill_Payment objects
     * @param null : Nothing
     * @return array
     */
    public function get_payments() {
        if(!empty($this->payments)) {
            return (array)json_decode($this->payments);
        }
        return [];
    }

    /**
     * Function that returns the last Bill_Payment object occured for the bill
     * @param null : Nothing
     * @return Bill_Payment|null
     */
    public function get_lastPayment() {
        $all = (array)$this->get_payments();
        $count = count($all); 
        
        if($count != 0) {
            return $all[$count - 1];
        }
        return null;
    }

    public function set_reference() {
        $this->reference = self::createBillReference();
    }

    static function getOrdreIncremental() {
        $year = date('Y'); 
        $month = date('m');
        $sql = "SELECT count(*) as nbre
                FROM bill
                WHERE YEAR(created_at) = $year AND MONTH(created_at) = $month";
        
        $result = \Fuel\Core\DB::query($sql)->as_assoc()->execute();
        return $result[0]['nbre'] + 1;
    }

    static function createBillReference() {
        $reference = "ICIV-".date("Y")."-";
        $ordre = sprintf("%05d", self::getOrdreIncremental());
        $reference .= $ordre."-".date("m").date("d");
        return $reference;
    }
}

