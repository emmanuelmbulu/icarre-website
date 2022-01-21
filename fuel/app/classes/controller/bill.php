<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\Fieldset;
use Fuel\Core\File;
use Fuel\Core\Input;
use Fuel\Core\Lang;
use Fuel\Core\Response;
use Fuel\Core\Router;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpQRCode\QRcode;

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
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

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
                return $this->buildPage($lang, "invoice/redirect", $title, ["invoice" => $bill, "ref" => $this->param("ref")]);
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

    public function get_callback() {
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

        try {            
            Lang::load("invoice_details.json", null, $lang);

            $ref = Input::get("transaction_id", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                $route = Router::get("page-not-found", ["lang" => $lang]);
                return Response::redirect($route, "location", 404);
            }

            $payment = new Bill_Payment();
            $status = Input::get("status", "cancelled");
            $payment->set_status($status);
            //$payment->reference = $bill->reference;
            $payment->reference = "ICIP-".Input::get("order", 0);
            $payment->reference .= "-".Input::get("paymentID", 0);
            $payment->reference .= "-".Input::get("transaction_id", 0);
            $payment->amount = Input::get("amount", 0);
            $payment->channel = Input::get("PaymentMethod", "undefined");
            $payment->date = Input::get("transaction_date");
            $payment->ip_address = Cookie::get("ip", "0.0.0.0");
            $payment->receipt = "#";

            $date_format = "Y-m-d h:i:s";
            if($lang == "fr") {
                $date_format = "d/m/Y h:i:s";
            }

            if($payment->status == "approved") {
                $client = $bill->get_client();

                $pathToModel = DOCROOT."/assets/bills/".$lang."-model.docx";
                $phpdocx = new TemplateProcessor($pathToModel);

                $phpdocx->setValues(array(
                    /**
                     * PAYMENT
                     */
                    "reference" => $payment->reference,
                    "payment_date" => date($date_format, strtotime($payment->date)),
                    "payment_channel" => $payment->channel,
                    "channel_reference" => Input::get("order", "undefined"),

                    /**
                     * CLIENT
                     */
                    "payer_fullname" => $client->fullname,
                    "payer_address" => $client->address,
                    "payer_mail" => $client->email,

                    /**
                     * ITEM
                     */
                    "item_description" => Lang::get("callback.description", 
                        [
                            "amount" => $payment->amount,
                            "currency" => $bill->currency,
                            "reference" => $bill->reference
                        ], null, $lang
                    ),
                    "item_unit" => 1,
                    "item_quantity" => 1,
                    "item_price" => $payment->amount,
                    "item_total" => $payment->amount,
                    "total_ht" => $payment->amount,
                    "tva_value" => 0,
                    "tva_amount" => 0,
                    "currency" => $bill->currency,
                    "total_ttc" => $payment->amount,
                ));

                $dossier = DOCROOT."/receipts/";
                $receiptRef = strtolower(Helper::NormalizeChars($payment->reference));
                 
                $pathToQRCode = $dossier."receipt-".$receiptRef.".png";
                $contenuQRCode = Router::get("receipt-pdf", ["ref" => $receiptRef]);
                $payment->receipt = $contenuQRCode;
                QRcode::png($contenuQRCode, $pathToQRCode, QR_ECLEVEL_H, 4, 2);

                $phpdocx->setImageValue('qrcode', array(
                    'path' => $pathToQRCode, 
                    'width' => 100, 
                    'height' => 100,
                    'ratio' => false
                    )
                );

                $fichier_docx = $dossier."receipt-".$receiptRef.".docx";
                $phpdocx->saveAs($fichier_docx);

                // CONVERT THE DOCS DOCUMENT TO PDF DOCUMENT
                shell_exec('libreoffice --headless --convert-to pdf '.$fichier_docx.' --outdir '.$dossier);

                // DELETE THE DOCX DOCUMENT CREATED AND THE PNG FILE.
                File::delete($fichier_docx);
                File::delete($pathToQRCode);
            }

            $bill->add_payment($payment);
            $bill->save();

            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $context = [
                "status" => $payment->status,
                "receipt" => $payment->receipt,
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
            ];

            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);         
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