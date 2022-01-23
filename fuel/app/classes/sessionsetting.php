<?php

class SessionSetting {

    public $cookieName = 'ckSettings';
    public $cookieExpire = 28800; // 8 hours
    public $saveCookie = TRUE;

    function __construct() {

        session_start();

        if (!isset($_SESSION['settings']) && isset($_COOKIE[$this->cookieName])) {
            $_SESSION['settings'] = json_decode($_COOKIE[$this->cookieName], true);
        }

    }

    public function AddUserData($userData)
    {
        $data["email"] = $userData["email"];
        $data["user_id"] = $userData["user_id"];

        if (isset($_SESSION['settings']["userdata"])) {
            $_SESSION['settings']["userdata"] = $data;
        } else {
            $_SESSION['settings']["userdata"] = $data;
        }
        $this->SetCookie();
        return true;
    }

    public function GetUserData()
    {
        if (isset($_SESSION['settings']["userdata"]))  return $_SESSION['settings']["userdata"];
        return null;
    }

    public function AddPackage($package)
    {
        $data["pack"] = $package["pack"];
        $data["unit_price"] = $package["unit_price"];
        $data["format_id"] = $package["format_id"];
        
        if (isset($_SESSION['settings']["package"])) {
            $_SESSION['settings']["package"] = $data;
        } else {
            $_SESSION['settings']["package"] = $data;
        }
        $this->SetCookie();
        return true;
    }

    public function GetPackage()
    {
        if (isset($_SESSION['settings']["package"]))  return $_SESSION['settings']["package"];
        return null;
    }

    public function SetCookie() {

        if ($this->saveCookie) {
            $string = json_encode($_SESSION['settings']);
            setcookie($this->cookieName, $string, time() + $this->cookieExpire, '/');
            return true;
        }
        
        return false;
    }

    public function SaveCookie($bool = TRUE) {
		$this->saveCookie = $bool;
		return true;
	}

}

?>