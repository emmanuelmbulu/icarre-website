<?php

use Fuel\Core\Config;
use Fuel\Core\Cookie;
use Fuel\Core\File;
use Fuel\Core\Lang;
use Fuel\Core\Response;
use Fuel\Core\Router;
use Fuel\Core\Uri;

/**
 * Created by Fabrice MANDEKE.
 */

class Helper {
    /**
     * Function to get the date by days
     * @param $date
     * @return bool|string
     */
    public static function Date($date)
    {
        //$date = strtotime($dt);

        $time_dd = date("d", $date);
        $time_MM = date("M", $date);
        $now = time();
        $c_dd = date("d", $now);
        $c_MM = date("M", $now);
        if ($time_MM == $c_MM) {
            if ($time_dd == $c_dd) {
                //days
                $newFormat = date('H:i', $date);
                return $newFormat;
            } else if ($time_dd == $c_dd - 1) {
                //yesterday
                $yesterday = 'Yesterday ';
                $newFormat = date('H:i', $date);
                return $yesterday . '' . $newFormat;
            } else if ($time_dd > $c_dd - 6 && $time_dd < $c_dd - 1) {
                //week
                $newFormat = date('l H:i', $date);
                return $newFormat;
            } else {
                //month
                $newFormat = date('D M H:i', $date);
                return $newFormat;
            }
        }
        //month
        $newFormat = date('D M Y', $date);
        return $newFormat;
    }
	
    /**
     * Function to uploads new images
     * @param $array
     * @param string $dir
     * @return null|string
     */
    public static function uploadImage($array)
    {
		//$dir = __DIR__ .'';
		//$dir = "/var/www/meetmyshop_prod/public";
        $dir = "C:\\wamp\\www\\goplatform\\public\\";
		$day_folder = date('d-m-y', time());
		/*$arr = array(	'error' => true,
						'message' => 'Image arrive quand memee'.$dir . '\uploads\\imagesFiles\\' . $day_folder);
		Api::toJSONResponse($arr);*/
		
        if (!empty($array)) {
			
            $tmp = "tmp_name";
            $name = "name";
			$file_path = "";
			$name = $file_path . basename( $_FILES['image']['name']);
			
            $new_name = md5(time() . '-' . $name) . '.jpg';
            $day_folder = date('d-m-y', time());
            //if (is_dir($dir . '/uploads/imagesFiles/' . $day_folder)) {
            if (is_dir($dir . '\uploads\\imagesFiles\\' . $day_folder)) {
                $img_folder = $day_folder;
            } else {
                //if (mkdir($dir . '/uploads/imagesFiles/' . $day_folder, 0777, true)) {
                if (mkdir($dir . '\uploads\\imagesFiles\\' . $day_folder, 0777, true)) {
                    $img_folder = $day_folder;
                } else {
                    $img_folder = '';
                }
            }
            //if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . '/uploads/imagesFiles/' . $img_folder . '/' . $new_name)) {
            if (move_uploaded_file($array, $dir . '\uploads\\imagesFiles\\' . $img_folder . '\\' . $new_name)) {
                //$imgHash = md5($tmp . $new_name . uniqid() . time());				
				$path = 'uploads/imagesFiles/' . $img_folder . '/' . $new_name;		
				return $path;
            } else {
                return null;
            }
        }
    }
	
    /**
     * Function that manage the parameter language set in the url
     * @param object $controller_instance : The object controller in wich this function is called
     * @param string $route_name : The route name related to the action in wich this function is 
     * @param array|null $route_args : An associative key -> value array of route parameters
     * @return string : The language set by the user
     */
    static public function manageLanguage($controller_instance, $route_name, $route_args = null) {
        $lang = $controller_instance->param("lang", null);
        $args = array();
        if($route_args != null && is_array($route_args)) {
            $args = $route_args;
        }

        if($lang == null) {
            $lang = Cookie::get("language", "fr");
            $args["lang"] = $lang;
            return Response::redirect(Router::get($route_name, $args));
        } else {
            Config::load("icarre-data-config.json");
            if(Config::get("$lang") == null) {
                $args["lang"] = "fr";
                return Response::redirect(Router::get($route_name, $args));
            } else Cookie::set("language", $lang, 30 * 24 * 60 * 60);
        }
        Lang::set_lang($lang, true);
        return $lang;
    }

    /**
     * Function that manage error occured and report it to a file
     * @param object $e : The error that occured
     * @return null
     */
    static public function archiverErreur($e) {
        $i = 0;
        try {
            $url = Uri::base(false) . substr($_SERVER['REQUEST_URI'], 1);
            $message = 'Error: "' . $e->getMessage() .'". File: "' . $e->getFile() . '". Line: ' . $e->getLine() . '. Uri: "'. $url . '"';

            if(File::exists(DOCROOT.'/error.log.text')) {
                File::append(DOCROOT, '/error.log.text', date("Y-m-d H:i:s")." ".$message."\n");
            } else {
                File::create(DOCROOT, '/error.log.text', date("Y-m-d H:i:s")." ".$message."\n");
            }
        } catch(Exception $e) {
            $i++;
        }
    }

    /**
     * Function that return the current datetime in Y-m-d H:i:s format
     * @param null
     * @return string : The datetime value in string
     */
    static public function renvoyerNow() {
        return (new DateTime("NOW"))->format('Y-m-d H:i:s');
    }

    /**
     * Function that replace latino character to english character
     * @param string $s : The string to normalize
     * @return string : The normalized string
     */
    static public function NormalizeChars($s) {
        $replace = array(
            '??'=>'-', '??'=>'-', '??'=>'-', '??'=>'-',
            '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'Ae',
            '??'=>'B',
            '??'=>'C', '??'=>'C', '??'=>'C',
            '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'E',
            '??'=>'G',
            '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'I',
            '??'=>'L',
            '??'=>'N', '??'=>'N',
            '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'Oe',
            '??'=>'S', '??'=>'S', '??'=>'S', '??'=>'S',
            '??'=>'T',
            '??'=>'U', '??'=>'U', '??'=>'U', '??'=>'Ue',
            '??'=>'Y',
            '??'=>'Z', '??'=>'Z', '??'=>'Z',
            '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'ae', '??'=>'ae', '??'=>'ae', '??'=>'ae',
            '??'=>'b', '??'=>'b', '??'=>'b', '??'=>'b',
            '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'c', '??'=>'ch', '??'=>'ch',
            '??'=>'d', '??'=>'d', '??'=>'d', '??'=>'d', '??'=>'d', '??'=>'d', '??'=>'D', '??'=>'d',
            '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e',
            '??'=>'f', '??'=>'f', '??'=>'f',
            '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g', '??'=>'g',
            '??'=>'h', '??'=>'h', '??'=>'h', '??'=>'h', '??'=>'h', '??'=>'h', '??'=>'h', '??'=>'h',
            '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'ij', '??'=>'ij',
            '??'=>'j', '??'=>'j', '??'=>'j', '??'=>'j', '??'=>'ja', '??'=>'ja', '??'=>'je', '??'=>'je', '??'=>'jo', '??'=>'jo', '??'=>'ju', '??'=>'ju',
            '??'=>'k', '??'=>'k', '??'=>'k', '??'=>'k', '??'=>'k', '??'=>'k', '??'=>'k',
            '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l', '??'=>'l',
            '??'=>'m', '??'=>'m', '??'=>'m', '??'=>'m',
            '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n', '??'=>'n',
            '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'oe', '??'=>'oe', '??'=>'oe',
            '??'=>'p', '??'=>'p', '??'=>'p', '??'=>'p',
            '??'=>'q',
            '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r', '??'=>'r',
            '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'s', '??'=>'sch', '??'=>'sch', '??'=>'sh', '??'=>'sh', '??'=>'ss',
            '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '??'=>'t', '???'=>'tm',
            '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'ue',
            '??'=>'v', '??'=>'v', '??'=>'v',
            '??'=>'w', '??'=>'w', '??'=>'w',
            '??'=>'y', '??'=>'y', '??'=>'y', '??'=>'y', '??'=>'y', '??'=>'y',
            '??'=>'y', '??'=>'z', '??'=>'z', '??'=>'z', '??'=>'z', '??'=>'z', '??'=>'z', '??'=>'z', '??'=>'zh', '??'=>'zh',
            '/' => '-', '&'=>'et', '~'=>'_', '#'=>'_', '{'=>'_', '('=>'_', '['=>'_', '|'=>'_', '`'=>'', '\\'=>'_', '^'=>'_', 
            '@'=>'at', '??'=>'_', ')'=>'_', ']'=>'_', '='=>'egal', '+'=>'plus', '}'=>'_', '???'=>'eur', '??'=>'_', '$'=>'usd',
            '??'=>'_', '%'=>'percent', '*'=>'star', '??'=>'_', '<'=>'_', '>'=>'_', '?'=>'_', ','=>'_', ';'=>'_', '.'=>'_',
            ':'=>'_', '!'=>'_', '??'=>'_', ' ' => '_',
        );
        return strtr($s, $replace);
    }

    /**
     * Function that forces redirect to 404 status
     * @param string $lang The ISO Code of the language in which print 404 page
     * @return null
     */
    static public function redirectTo404($lang) {
        return self::redirect($lang, "page-not-found", 404);
    }

    /**
     * Function that forces redirect to 500 status
     * @param string $lang The ISO Code of the language in which print 500 page
     * @return null
     */
    static public function redirectTo500($lang) {
        return self::redirect($lang, "error-500");
    }

    /**
     * Function that forces redirect to a specific route with a specific HTTP Code status
     * @param string $lang The ISO Code of the language in which print the page
     * @param string $route_name The name of the route where to redirect
     * @param int $code  The HTTP Code
     * @return null
     */
    static function redirect($lang, $route_name, $code = 200) {
        $route = Router::get($route_name, ["lang" => $lang]);
        return Response::redirect($route, "location", $code);
    }
}