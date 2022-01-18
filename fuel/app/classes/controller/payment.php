<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\View;

class Controller_Payment extends Controller_Hybrid {
    public $template = 'shared/layout';

    public function get_direct() {
        $lang = Helper::manageLanguage($this, "direct-payment");
        
        $mainMenu = View::forge("shared/menu/main", ["active" => "direct-payment", "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => "direct-payment"]);

        $this->template->title = "Paiement";
        $this->template->header = $header;
        $this->template->content = View::forge("payment/direct", ["lang" => $lang]);
        $this->template->footer = View::forge("shared/footer");
    }
}