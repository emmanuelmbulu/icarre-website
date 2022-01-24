<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\Fieldset;
use Fuel\Core\Input;
use Fuel\Core\Str;
use Fuel\Core\View;

class Controller_Payment extends Controller_Hybrid {
    public $template = 'shared/layout';

    public function get_direct() {
        $lang = Helper::manageLanguage($this, "direct-payment");

        $route_name = "direct-payment";
        $this->buildPage($lang, $route_name, $route_name, "payment/direct", ["form" => null]);
    }

    public function post_direct() {
        $lang = Helper::manageLanguage($this, "direct-payment");
        $directForm = new Fieldset('payment');

        try {
            $id_payment = (int)Cookie::get("direct-payment", 0);           
            $payment = Dao_Payment::getOne($id_payment);
            if(null != $payment) {
                $route_name = "direct-payment";
                return $this->buildPage($lang, $route_name, $route_name, "payment/redirect", ["payment" => $payment]);
            }

            $payment = new Model_Payment();
            $directForm->add_model($payment);
            $directForm->populate(Input::post());
            $directForm->validation()->run();

            if(!$directForm->error("amount") && !$directForm->error("direct_payer")) {
                $payment = Dao_Payment::persistDirect($payment, $directForm);
                if($payment != null) {
                    Cookie::set("direct-payment", $payment->id, 5 * 60);
                    $route_name = "direct-payment";
                    return $this->buildPage($lang, $route_name, $route_name, "payment/redirect", ["payment" => $payment]);
                }
            }
        } catch(Throwable $e) {
            Helper::archiverErreur($e);
            throw new Exception("Error Processing Request", 1);           
        }

        $label_and_route = "direct-payment";
        return $this->buildPage($lang, $label_and_route, $label_and_route, "payment/direct", ["form" => $directForm]);
    }

    function buildPage($lang, $active_page, $route_name, $view_name, $data_context) {
        $mainMenu = View::forge("shared/menu/main", ["active" => $active_page, "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => $route_name]);

        $data_context["lang"] = $lang;
        $this->template->title = "Paiement";
        $this->template->header = $header;
        $this->template->content = View::forge($view_name, $data_context);
        $this->template->footer = View::forge("shared/footer", ["lang" => $lang]);
        return;
    }
}