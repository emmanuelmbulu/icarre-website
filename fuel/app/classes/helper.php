<?php

use Fuel\Core\Config;
use Fuel\Core\Cookie;
use Fuel\Core\File;
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
            $lang = Cookie::get("lang", "fr");
            $args["lang"] = $lang;
            return Response::redirect(Router::get($route_name, $args));
        } else {
            Config::load("icarre-data-config.json");
            if(Config::get("$lang") == null) {
                $args["lang"] = "fr";
                return Response::redirect(Router::get($route_name, $args));
            } else Cookie::set("lang", $lang, 30 * 24 * 60 * 60);
        }
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
            'ъ'=>'-', 'Ь'=>'-', 'Ъ'=>'-', 'ь'=>'-',
            'Ă'=>'A', 'Ą'=>'A', 'À'=>'A', 'Ã'=>'A', 'Á'=>'A', 'Æ'=>'A', 'Â'=>'A', 'Å'=>'A', 'Ä'=>'Ae',
            'Þ'=>'B',
            'Ć'=>'C', 'ץ'=>'C', 'Ç'=>'C',
            'È'=>'E', 'Ę'=>'E', 'É'=>'E', 'Ë'=>'E', 'Ê'=>'E',
            'Ğ'=>'G',
            'İ'=>'I', 'Ï'=>'I', 'Î'=>'I', 'Í'=>'I', 'Ì'=>'I',
            'Ł'=>'L',
            'Ñ'=>'N', 'Ń'=>'N',
            'Ø'=>'O', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe',
            'Ş'=>'S', 'Ś'=>'S', 'Ș'=>'S', 'Š'=>'S',
            'Ț'=>'T',
            'Ù'=>'U', 'Û'=>'U', 'Ú'=>'U', 'Ü'=>'Ue',
            'Ý'=>'Y',
            'Ź'=>'Z', 'Ž'=>'Z', 'Ż'=>'Z',
            'â'=>'a', 'ǎ'=>'a', 'ą'=>'a', 'á'=>'a', 'ă'=>'a', 'ã'=>'a', 'Ǎ'=>'a', 'а'=>'a', 'А'=>'a', 'å'=>'a', 'à'=>'a', 'א'=>'a', 'Ǻ'=>'a', 'Ā'=>'a', 'ǻ'=>'a', 'ā'=>'a', 'ä'=>'ae', 'æ'=>'ae', 'Ǽ'=>'ae', 'ǽ'=>'ae',
            'б'=>'b', 'ב'=>'b', 'Б'=>'b', 'þ'=>'b',
            'ĉ'=>'c', 'Ĉ'=>'c', 'Ċ'=>'c', 'ć'=>'c', 'ç'=>'c', 'ц'=>'c', 'צ'=>'c', 'ċ'=>'c', 'Ц'=>'c', 'Č'=>'c', 'č'=>'c', 'Ч'=>'ch', 'ч'=>'ch',
            'ד'=>'d', 'ď'=>'d', 'Đ'=>'d', 'Ď'=>'d', 'đ'=>'d', 'д'=>'d', 'Д'=>'D', 'ð'=>'d',
            'є'=>'e', 'ע'=>'e', 'е'=>'e', 'Е'=>'e', 'Ə'=>'e', 'ę'=>'e', 'ĕ'=>'e', 'ē'=>'e', 'Ē'=>'e', 'Ė'=>'e', 'ė'=>'e', 'ě'=>'e', 'Ě'=>'e', 'Є'=>'e', 'Ĕ'=>'e', 'ê'=>'e', 'ə'=>'e', 'è'=>'e', 'ë'=>'e', 'é'=>'e',
            'ф'=>'f', 'ƒ'=>'f', 'Ф'=>'f',
            'ġ'=>'g', 'Ģ'=>'g', 'Ġ'=>'g', 'Ĝ'=>'g', 'Г'=>'g', 'г'=>'g', 'ĝ'=>'g', 'ğ'=>'g', 'ג'=>'g', 'Ґ'=>'g', 'ґ'=>'g', 'ģ'=>'g',
            'ח'=>'h', 'ħ'=>'h', 'Х'=>'h', 'Ħ'=>'h', 'Ĥ'=>'h', 'ĥ'=>'h', 'х'=>'h', 'ה'=>'h',
            'î'=>'i', 'ï'=>'i', 'í'=>'i', 'ì'=>'i', 'į'=>'i', 'ĭ'=>'i', 'ı'=>'i', 'Ĭ'=>'i', 'И'=>'i', 'ĩ'=>'i', 'ǐ'=>'i', 'Ĩ'=>'i', 'Ǐ'=>'i', 'и'=>'i', 'Į'=>'i', 'י'=>'i', 'Ї'=>'i', 'Ī'=>'i', 'І'=>'i', 'ї'=>'i', 'і'=>'i', 'ī'=>'i', 'ĳ'=>'ij', 'Ĳ'=>'ij',
            'й'=>'j', 'Й'=>'j', 'Ĵ'=>'j', 'ĵ'=>'j', 'я'=>'ja', 'Я'=>'ja', 'Э'=>'je', 'э'=>'je', 'ё'=>'jo', 'Ё'=>'jo', 'ю'=>'ju', 'Ю'=>'ju',
            'ĸ'=>'k', 'כ'=>'k', 'Ķ'=>'k', 'К'=>'k', 'к'=>'k', 'ķ'=>'k', 'ך'=>'k',
            'Ŀ'=>'l', 'ŀ'=>'l', 'Л'=>'l', 'ł'=>'l', 'ļ'=>'l', 'ĺ'=>'l', 'Ĺ'=>'l', 'Ļ'=>'l', 'л'=>'l', 'Ľ'=>'l', 'ľ'=>'l', 'ל'=>'l',
            'מ'=>'m', 'М'=>'m', 'ם'=>'m', 'м'=>'m',
            'ñ'=>'n', 'н'=>'n', 'Ņ'=>'n', 'ן'=>'n', 'ŋ'=>'n', 'נ'=>'n', 'Н'=>'n', 'ń'=>'n', 'Ŋ'=>'n', 'ņ'=>'n', 'ŉ'=>'n', 'Ň'=>'n', 'ň'=>'n',
            'о'=>'o', 'О'=>'o', 'ő'=>'o', 'õ'=>'o', 'ô'=>'o', 'Ő'=>'o', 'ŏ'=>'o', 'Ŏ'=>'o', 'Ō'=>'o', 'ō'=>'o', 'ø'=>'o', 'ǿ'=>'o', 'ǒ'=>'o', 'ò'=>'o', 'Ǿ'=>'o', 'Ǒ'=>'o', 'ơ'=>'o', 'ó'=>'o', 'Ơ'=>'o', 'œ'=>'oe', 'Œ'=>'oe', 'ö'=>'oe',
            'פ'=>'p', 'ף'=>'p', 'п'=>'p', 'П'=>'p',
            'ק'=>'q',
            'ŕ'=>'r', 'ř'=>'r', 'Ř'=>'r', 'ŗ'=>'r', 'Ŗ'=>'r', 'ר'=>'r', 'Ŕ'=>'r', 'Р'=>'r', 'р'=>'r',
            'ș'=>'s', 'с'=>'s', 'Ŝ'=>'s', 'š'=>'s', 'ś'=>'s', 'ס'=>'s', 'ş'=>'s', 'С'=>'s', 'ŝ'=>'s', 'Щ'=>'sch', 'щ'=>'sch', 'ш'=>'sh', 'Ш'=>'sh', 'ß'=>'ss',
            'т'=>'t', 'ט'=>'t', 'ŧ'=>'t', 'ת'=>'t', 'ť'=>'t', 'ţ'=>'t', 'Ţ'=>'t', 'Т'=>'t', 'ț'=>'t', 'Ŧ'=>'t', 'Ť'=>'t', '™'=>'tm',
            'ū'=>'u', 'у'=>'u', 'Ũ'=>'u', 'ũ'=>'u', 'Ư'=>'u', 'ư'=>'u', 'Ū'=>'u', 'Ǔ'=>'u', 'ų'=>'u', 'Ų'=>'u', 'ŭ'=>'u', 'Ŭ'=>'u', 'Ů'=>'u', 'ů'=>'u', 'ű'=>'u', 'Ű'=>'u', 'Ǖ'=>'u', 'ǔ'=>'u', 'Ǜ'=>'u', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'У'=>'u', 'ǚ'=>'u', 'ǜ'=>'u', 'Ǚ'=>'u', 'Ǘ'=>'u', 'ǖ'=>'u', 'ǘ'=>'u', 'ü'=>'ue',
            'в'=>'v', 'ו'=>'v', 'В'=>'v',
            'ש'=>'w', 'ŵ'=>'w', 'Ŵ'=>'w',
            'ы'=>'y', 'ŷ'=>'y', 'ý'=>'y', 'ÿ'=>'y', 'Ÿ'=>'y', 'Ŷ'=>'y',
            'Ы'=>'y', 'ž'=>'z', 'З'=>'z', 'з'=>'z', 'ź'=>'z', 'ז'=>'z', 'ż'=>'z', 'ſ'=>'z', 'Ж'=>'zh', 'ж'=>'zh',
            '/' => '-',
        );
        return strtr($s, $replace);
    }

}