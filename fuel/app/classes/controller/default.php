<?php

use Fuel\Core\Config;
use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\Lang;
use Fuel\Core\Response;
use Fuel\Core\Router;
use Fuel\Core\View;

class Controller_Default extends Controller_Hybrid {
    public $template = 'shared/layout';

    public function get_index() {
        $lang = Helper::manageLanguage($this, "index");
        Lang::load('index.json', null, $lang);

        $mainMenu = View::forge("shared/menu/main", ["active" => "home", "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => "index"]);

        $this->template->title = Lang::get("title", [], null, $lang);
        $this->template->header = $header;
        $this->template->content = View::forge("index", array("lang" => $lang));
        $this->template->footer = View::forge("shared/footer");
    }

    public function get_404() {
        $lang = Helper::manageLanguage($this, "page-not-found");
        Lang::load('404.json', null, $lang);

        $mainMenu = View::forge("shared/menu/main", ["active" => "home", "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => "page-not-found"]);

        $this->template->title = Lang::get("title", [], null, $lang);
        $this->template->header = $header;
        $this->template->content = View::forge("404", array("lang" => $lang));
        $this->template->footer = View::forge("shared/footer");
    }
}