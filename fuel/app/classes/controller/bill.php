<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\Fieldset;
use Fuel\Core\Input;
use Fuel\Core\Lang;
use Fuel\Core\Response;
use Fuel\Core\Router;

class Controller_Bill extends Controller_Hybrid {
    public $template = "shared/bill/layout";

    public function get_details() {
        $ref = $this->param("ref", 0);
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => $ref]);

        try {
            $bill = new Model_Bill();
            if(is_numeric($ref)) {
                $bill = Model_Bill::find($ref);
                if($bill == null) {
                    $route = Router::get("page-not-found", ["lang" => $lang]);
                    return Response::redirect($route, "location", 404);
                }
                Cookie::set("invoice", $bill->id, 30 * 60);               
                $ref = Helper::NormalizeChars(strtolower("invoice-".$bill->reference));
                $ref = urlencode($ref);
                $route = Router::get("details-bill", ["lang" => $lang, "ref" => $ref]);
                return Response::redirect($route);
            }

            $ref = Cookie::get("invoice", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                $route = Router::get("page-not-found", ["lang" => $lang]);
                return Response::redirect($route, "location", 404);
            }
            
            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $context = [
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
            ];

            Lang::load("invoice_details.json", null, $lang);
            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            $route = Router::get("error-500", ["lang" => $lang]);
            return Response::redirect($route, "location", 500);
        }
    }

    public function post_details() {
        $lang = Helper::manageLanguage($this, "details-bill");

        try {
            Cookie::set("ip", Input::ip(), 60 * 60);

            $invoiceForm = new Fieldset('invoice');
            $ref = Input::post("ref", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                $route = Router::get("page-not-found", ["lang" => $lang]);
                return Response::redirect($route, "location", 404);
            }

            $invoiceForm->add_model('Model_Bill');
            $invoiceForm->populate(Input::post());
            $invoiceForm->validation()->field("amount")
                ->add_rule("numeric_between", 1, $bill->amount - $bill->amount_paid);
            $invoiceForm->validation()->run();

            if(!$invoiceForm->error("amount")) {
                $bill->amount = Input::post("amount");
                Lang::load("payment_redirect.json", null, $lang);
                $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
                return $this->buildPage($lang, "invoice/redirect", $title, ["invoice" => $bill]);
            }
            
            Lang::load("invoice_details.json", null, $lang);

            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $error = Lang::get("input.error", [], null, $lang);
            $context = [
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
                "error" => $error
            ];

            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);         
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            $route = Router::get("error-500", ["lang" => $lang]);
            return Response::redirect($route, "location", 500);
        }
    }

    public function post_callback() {
        $lang = Helper::manageLanguage($this, "details-bill");

        try {
            $ref = Input::post("transaction_id", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                $route = Router::get("page-not-found", ["lang" => $lang]);
                return Response::redirect($route, "location", 404);
            }

            $payment = new Bill_Payment();
            $status = Input::post("status", "cancelled");
            $payment->set_status($status);
            $payment->reference = $bill->reference;
            $payment->reference .= "-".Input::post("order");
            $payment->reference .= "-".Input::post("paymentID");
            $payment->amount = Input::post("amount", 0);
            $payment->channel = Input::post("paymentMethod");
            $payment->date = Input::post("transaction_date");
            $payment->ip_address = Cookie::get("ip", "0.0.0.0");
            $payment->receipt = "#";

            $bill->add_payment($payment);
            $bill->save();
            
            Lang::load("invoice_details.json", null, $lang);

            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $context = [
                "status" => $status,
                "receipt" => $payment->receipt,
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
            ];

            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/payment", $title, $context);         
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            $route = Router::get("error-500", ["lang" => $lang]);
            return Response::redirect($route, "location", 500);
        }
    }

    public function get_create() {
        $lang = Helper::manageLanguage($this, "details");

        $client = new Bill_Client();
        $client->address = "131B, avenue Songololo, commune de Kinshasa, ville de Kinshasa";
        $client->country = "République démocratique du Congo";
        $client->email = "emmanuel.mbulu@gmail.com";
        $client->fullname = "Emmabuel Mbulu";
        $client->phone = "+243813700243";

        $description = "Déploiement du premier livrable de l'application mobile";
        $price = 5000;
        $item = new Bill_Item($description, $price, 1);

        $bill = new Model_Bill();
        $bill->set_reference();
        $bill->currency = "USD";
        $bill->amount = $bill->amount_paid = 0;
        $bill->tva = 0; 
        $bill->add_item($item);
        $bill->add_client($client);
        $bill->is_paid = false;
        $bill->created_at = Helper::renvoyerNow();
        $bill->save();
        
        $route = Router::get("details-bill", ["lang" => $lang, "ref" => $bill->id]);
        return Response::redirect($route);
    }

    function buildPage($lang, $view, $title, $array_context) {
        $array_context["lang"] = $lang;
        $header = View::forge("shared/bill/header", ["lang" => $lang, "title" => $title]);

        $this->template->title = $title;
        $this->template->header = $header;
        $this->template->content = View::forge($view, $array_context);
        $this->template->footer = View::forge("shared/footer");
    }
}