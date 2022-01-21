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

        $route_and_view = "index";
        return $this->buildPage($lang, $route_and_view, $route_and_view, Lang::get("title", [], null, $lang), []);
    }

    public function get_about() {
        $route_and_view = "about";
        $lang = Helper::manageLanguage($this, $route_and_view);
        Lang::load('about.json', null, $lang);

        return $this->buildPage($lang, $route_and_view, $route_and_view, Lang::get("title", [], null, $lang), []);
    }

    public function get_kyc() {
        $route_and_view = "kyc";
        $lang = Helper::manageLanguage($this, $route_and_view);
        Lang::load('kyc.json', null, $lang);

        return $this->buildPage($lang, $route_and_view, $route_and_view, Lang::get("title", [], null, $lang), []);
    }

    public function get_404() {
        $route = "page-not-found";
        $lang = Helper::manageLanguage($this, $route);
        Lang::load('404.json', null, $lang);

        return $this->buildPage($lang, $route, "404", Lang::get("title", [], null, $lang), []);
    }

    public function get_500() {
        $route = "error-500";
        $lang = Helper::manageLanguage($this, $route);
        Lang::load('500.json', null, $lang);

        return $this->buildPage($lang, $route, "500", Lang::get("title", [], null, $lang), []);
    }

    function buildPage($lang, $route_name, $view, $title, $array_context) {
        $array_context["lang"] = $lang;
        $mainMenu = View::forge("shared/menu/main", ["active" => $route_name, "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => $route_name]);

        $this->template->title = $title;
        $this->template->header = $header;
        $this->template->content = View::forge($view, $array_context);
        $this->template->footer = View::forge("shared/footer");
    }
}