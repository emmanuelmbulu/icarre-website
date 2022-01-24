<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\File;
use Fuel\Core\Response;
use Fuel\Core\Router;

class Controller_Receipt extends Controller_Hybrid {
    public function get_pdf() {
        $lang = Cookie::get("lang", "fr");
        
        try {
            $ref = strtolower($this->param("ref"));
            $file = DOCROOT."receipts/receipt-".$ref.".pdf";

            if(File::exists($file)) {
                $response = new Response();

                $content = file_get_contents($file);

                // We'll be outputting a PDF
                $response->set_header('Content-Type', 'application/pdf');
                $response->set_header('Content-Length', strlen($content));

                $filename = "receipt-".$ref.".pdf";
                $response->set_header('Content-Disposition', 'inline; filename="'.$filename.'"');

                $response->set_header('Cache-Control', 'public, max-age=0, must-revalidate');
                $response->set_header('Pragma', 'public');
                $response->set_header('Author', 'iCarré - Des idées intelligentes');

                $response->body($content);
                return $response;
            } else {
                return Helper::redirectTo404($lang);
            }
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }
}