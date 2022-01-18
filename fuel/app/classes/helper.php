<?php

use Fuel\Core\Config;
use Fuel\Core\Cookie;
use Fuel\Core\Response;
use Fuel\Core\Router;

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
     * @return string : The language set by the user
     */
    static public function manageLanguage($controller_instance, $route_name) {
        $lang = $controller_instance->param("lang", null);
        if($lang == null) {
            $lang = Cookie::get("lang", "fr");
            return Response::redirect(Router::get($route_name, ["lang" => $lang]));
        } else {
            Config::load("icarre-data-config.json");
            if(Config::get("$lang") == null) {
                return Response::redirect(Router::get($route_name, ["lang" => "fr"]));
            } else Cookie::set("lang", $lang);
        }
        return $lang;
    }
}