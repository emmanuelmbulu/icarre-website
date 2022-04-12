<?php

use Fuel\Core\Config;
use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Cookie;
use Fuel\Core\Fieldset;
use Fuel\Core\File;
use Fuel\Core\Input;
use Fuel\Core\Lang;
use Fuel\Core\Response;
use Fuel\Core\Router;
use Fuel\Core\Str;
use Fuel\Core\View;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpQRCode\QRcode;

class Controller_Payment extends Controller_Hybrid {
    public $template = 'shared/bill/layout';

    public function get_init() {
        $lang = Helper::manageLanguage($this, "direct-payment");

        try {
            $ref = Input::get("ref", null);
            $object = Input::get("object", null);

            if($ref == null || $object == null || !is_numeric($ref) || is_numeric($object)) {
                return Helper::redirectTo404($lang);
            }
            $element = new \stdClass();
            $amount = Cookie::get("amount", null);

            Lang::load("checkout.json", null, $lang);

            $object = strtolower($object);
            if($object == "invoice") {
                $bill = Model_Bill::find($ref);
                if($bill == null) {
                    return Helper::redirectTo404($lang);
                }

                if($amount == null) {
                    $route = Router::get("details-bill", ["lang" => $lang, "ref" => $ref]);
                    return Response::redirect($route);
                }
                $element->amount = $amount;
                $element->currency = $bill->currency;
                $element->reference = $bill->reference;
                $element->id = $bill->id;
                $element->type = $object;
                $element->bank_purchaser = $bill->bank_purchaser == null ? "random" : $bill->bank_purchaser;

                $object = Lang::get("invoice", [], null, $lang);
            }

            $title = Lang::get("title", ["reference" => $element->reference, "object" => $object], null, $lang);
            $context = array(
                "element" => $element,
            );
            return $this->buildPage($lang, "payment/checkout", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function post_init() {
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

        try { 
            Lang::load("checkout.json", null, $lang);

            $bill_id = Input::post("bill_id", 0);
            $bill = Model_Bill::find($bill_id);

            $investment_id = Input::post("investment_id", 0);
            $investment = null;

            if($bill == null && $investment == null) {
                return Helper::redirectTo404($lang);
            }

            $payment = null;
            $referenceInvoiceOrInvestment = $description = "";
            if($bill != null) {
                $payment = Dao_Payment::persistForBill($bill, $lang);
                $referenceInvoiceOrInvestment = $bill->reference;
                $description = Lang::get("payment.bill.description", [
                    "reference"=>$payment->reference, 
                    "amount"=>$payment->amount,
                    "currency"=>$payment->currency,
                    "invoice"=>$bill->reference
                ], null, $lang);
            }

            if($payment == null) {
                return Helper::redirectTo500($lang);
            }

            $payer = $payment->getPayer();
            if($payment->channel == Dao_Bill::$BankPurchaser[1]) {
                Config::load("ecomeasypay");
                $mode = Config::get("mode");
                $publishable_key = Config::get("publishable");
                $correlation_id = Config::get("correlation");

                $url = "https://www.e-com-easypay.com/sandbox/payment/initialization";
                if("live" == $mode) {
                    $url = "https://www.e-com-easypay.com/v1/payment/initialization";
                }
                $url_init = $url."?token=".$publishable_key."&cid=".$correlation_id;

                $channels = array();
                $channel = new \stdClass();
                $channel->channel = "CREDIT CARD";
                $channels[] = $channel;

                $customer_fullname = "$payer->firstname $payer->lastname";                
                $process_data = array(
                    "order_ref"         => $payment->id,
                    "amount"            => $payment->amount,
                    "currency"          => $payment->currency,
                    "description"       => $description,
                    "success_url"       => Router::get("payment-success", ["lang"=>$lang, "ref"=>$payment->reference]),
                    "error_url"         => Router::get("payment-declined", ["lang"=>$lang, "ref"=>$payment->reference]),
                    "cancel_url"        => Router::get("payment-cancelled", ["lang"=>$lang, "ref"=>$payment->reference]),
                    "language"          => $lang,
                    "channels"           => $channels,
                    "customer_name"     => $customer_fullname,
                    "customer_email"    => $payer->email
                );
                
                $process_data = json_encode($process_data);
                $response = $this->curlJsonDataToEasypay($url_init, $process_data);
                $response = json_decode($response);

                if($response->code == 0) {
                    Api::toPreResponse($response->message);
                } else {
                    return Response::redirect($url.'?reference='.$response->reference);
                }
            }
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }   
    }

    public function get_direct() {
        $lang = Helper::manageLanguage($this, "direct-payment");

        $route_name = "direct-payment";
        $this->buildPageWithSharedHeader($lang, $route_name, $route_name, "payment/direct", ["form" => null]);
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
                    Cookie::set("direct-payment", $payment->id, 60 * 60 * 30);
                    $route_name = "direct-payment";
                    return $this->buildPage($lang, $route_name, $route_name, "payment/redirect", ["payment" => $payment]);
                }
            }
        } catch(Throwable $e) {
            Helper::archiverErreur($e);
            return Helper::redirectTo500($lang);           
        }

        $label_and_route = "direct-payment";
        return $this->buildPage($lang, $label_and_route, $label_and_route, "payment/direct", ["form" => $directForm]);
    }

    public function get_success() {
        $lang = Helper::manageLanguage($this, "payment-success");

        try {
            $ref = $this->param("ref");
            $payment = Dao_Payment::getOneByReference($ref);
            if($payment == null) {
                return Helper::redirectTo404($lang);
            } else if($payment->status == Dao_Payment::$StatusCanceled) {
                $route = Router::get("payment-cancelled", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            } else if($payment->status == Dao_Payment::$StatusDeclined || $payment->status == Dao_Payment::$StatusInit) {
                $route = Router::get("payment-declined", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            }

            $element = null;
            $client = null;
            $object = "invoice";
            if($payment->bill_id != null) {
                $element = Model_Bill::find($payment->bill_id);
                $client = $element->get_client();
            }

            $title = Lang::get("title", ["reference" => $element->reference, "object" => $object], null, $lang);
            $context = array(
                "model" => $payment,
                "element" => $element,
                "client" => $client,
                "object" => $object,
            );
            return $this->buildPage($lang, "payment/approved", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function get_cancelled() {
        $lang = Helper::manageLanguage($this, "payment-cancelled");

        try {
            $ref = $this->param("ref");
            $payment = Dao_Payment::getOneByReference($ref);
            if($payment == null) {
                return Helper::redirectTo404($lang);
            } else if($payment->status == Dao_Payment::$StatusApproved) {
                $route = Router::get("payment-success", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            } else if($payment->status == Dao_Payment::$StatusDeclined) {
                $route = Router::get("payment-declined", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            }

            $element = null;
            $client = null;
            $object = "invoice";
            if($payment->bill_id != null) {
                $element = Model_Bill::find($payment->bill_id);
                $client = $element->get_client();
            }

            $title = Lang::get("title", ["reference" => $element->reference, "object" => $object], null, $lang);
            $context = array(
                "model" => $payment,
                "element" => $element,
                "client" => $client,
                "object" => $object,
            );
            return $this->buildPage($lang, "payment/cancelled", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function get_declined() {
        $lang = Helper::manageLanguage($this, "payment-declined");

        try {
            $ref = $this->param("ref");
            $payment = Dao_Payment::getOneByReference($ref);
            if($payment == null) {
                return Helper::redirectTo404($lang);
            } else if($payment->status == Dao_Payment::$StatusApproved) {
                $route = Router::get("payment-success", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            } else if($payment->status == Dao_Payment::$StatusCanceled || $payment->status == Dao_Payment::$StatusInit) {
                $route = Router::get("payment-cancelled", ["lang"=>$lang, "ref"=>$payment->reference]);
                return Response::redirect($route);
            }

            $error = json_decode($payment->payloads);
            $error = $error->error;

            $element = null;
            $client = null;
            $object = "invoice";
            if($payment->bill_id != null) {
                $element = Model_Bill::find($payment->bill_id);
                $client = $element->get_client();
            }

            $title = Lang::get("title", ["reference" => $element->reference, "object" => $object], null, $lang);
            $context = array(
                "model" => $payment,
                "element" => $element,
                "client" => $client,
                "object" => $object,
                "error" => $error,
            );
            return $this->buildPage($lang, "payment/approved", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function post_callbackeasypay() {
        try {
            $params = array (
                "transaction" => ["order_ref", "reference"],
                "payment" => ["channel", "status", "reference"],
            );
    
            $data = file_get_contents("php://input");
            $data = (object)json_decode($data);
    
            foreach($params as $objet => $attributs) {
                if(!isset($data->$objet)) {
                    return;
                } else {
                    foreach($attributs as $key => $attribut) {
                        if(!isset($data->$objet->$attribut)) {
                            return;
                        }
                    }
                }
            }

            $transaction_data = $data->transaction;
            $payment_data = $data->payment;

            $payment = Dao_Payment::getOne($transaction_data->order_ref);
            if($payment == null) {
                return;
            }

            $bill = Model_Bill::find($payment->bill_id);

            $client = $payment->getPayer();
            $fullname = $client->firstname . " " . $client->lastname;
            $address = $client->address;
            if(!empty($address)) {
                $address .= "\n";
            }
            $address .= $client->city;
            if(!empty($address) && !empty($client->state)) {
                $address .= ", " . $client->state;
            } else if(!empty($client->state)) {
                $address .= $client->state;
            }
            if(!empty($address) && !empty($client->country)) {
                $address .= ", " . $client->country;
            } else if(!empty($client->country)) {
                $address .= $client->country;
            }
            if(!empty($address) && !empty($client->zipcode)) {
                $address .= ", ZIP " . $client->zipcode;
            } else if(!empty($client->zipcode)) {
                $address .= "ZIP " . $client->zipcode;
            }

            $lang = $payment->language;
            $date_format = "Y-m-d h:i:s";
            if($lang == "fr") {
                $date_format = "d/m/Y h:i:s";
            }

            if("success" == strtolower($payment_data->status)) {
                $payment->status = Dao_Payment::$StatusApproved;
                $payment->payloads = json_encode(array(
                    "channel" => $payment_data->channel,
                    "reference" => $payment_data->reference
                ));

                if($bill != null) {
                    $bill->set_payment($payment);
                    Lang::load("invoice_details.json", null, $lang);

                    $pathToModel = DOCROOT."assets/bills/".$lang."-model.docx";
                    $phpdocx = new TemplateProcessor($pathToModel);

                    $phpdocx->setValues(array(
                        /**
                         * PAYMENT
                         */
                        "reference" => $payment->reference,
                        "payment_date" => date($date_format, strtotime($payment->created_at)),
                        "payment_channel" => $payment->channel . " - " . $payment_data->channel,
                        "channel_reference" => $payment_data->reference,

                        /**
                         * CLIENT
                         */
                        "payer_fullname" => $fullname,
                        "payer_address" => $address,
                        "payer_mail" => $client->email,

                        /**
                         * ITEM
                         */
                        "item_description" => Lang::get("callback.description", 
                            [
                                "amount" => $payment->amount,
                                "currency" => $payment->currency,
                                "reference" => $bill->reference
                            ], null, $lang
                        ),
                        "item_unit" => "-",
                        "item_quantity" => 1,
                        "item_price" => $payment->amount,
                        "item_total" => $payment->amount,
                        "total_ht" => $payment->amount,
                        "tva_value" => 0,
                        "tva_amount" => 0,
                        "currency" => $payment->currency,
                        "total_ttc" => $payment->amount,
                    ));

                    $dossier = DOCROOT."receipts/";
                    $receiptRef = strtolower(Helper::NormalizeChars($payment->reference));
                    
                    $pathToQRCode = $dossier."receipt-".$receiptRef.".png";
                    $contenuQRCode = Router::get("receipt-pdf", ["ref" => $receiptRef]);

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

                    /**
                     * Creating Client Commitment File
                     */
                    $date_format = "Y-m-d";
                    if($lang == "fr") {
                        $date_format = "d/m/Y";
                    }

                    $pathToModel = DOCROOT."assets/bills/".$lang."-commitment-model.docx";
                    $phpdocx = new TemplateProcessor($pathToModel);

                    $phpdocx->setValues(array(
                        /**
                         * PAYMENT
                         */
                        "payment_date" => date($date_format, strtotime($payment->created_at)),
                        "payment_time" => date("H:i:s", strtotime($payment->created_at)),
                        "amount" => $payment->amount,
                        "currency" => $payment->currency,
                        "ip_address" => $payment->ip_address,

                        /**
                         * CLIENT
                         */
                        "fullname" => $fullname,
                        "address" => $address,
                        "email" => $client->email,
                        "phone" => $client->phone,

                        /**
                         * INVOICE
                         */
                        "invoice_reference" => $bill->reference,

                        /**
                         * ADD ON
                         */
                        "date" => date($date_format)                        
                    ));

                    $dossierCommitment = DOCROOT."commitments/";
                    $refCommitment = $fullname . "-" . $payment->reference;
                    $refCommitment = strtolower(Helper::NormalizeChars($refCommitment));
                    $fichier_docx = $dossierCommitment."commitment-".$refCommitment.".docx";
                    $phpdocx->saveAs($fichier_docx);

                    // CONVERT THE DOCS DOCUMENT TO PDF DOCUMENT
                    shell_exec('libreoffice --headless --convert-to pdf '.$fichier_docx.' --outdir '.$dossierCommitment);

                    // DELETE THE DOCX DOCUMENT CREATED AND THE PNG FILE.
                    File::delete($fichier_docx);

                    /**
                     * Sending mail to client
                     */
                    $subject = "Nouveau paiement | New payment - iCarré";
                    $mail_payment_created_content = View::forge("mail/bill/payment/saved/created", [
                        "lang" => $lang,
                        "bill" => $bill,
                        "payment" => $payment,
                        "fullname" => $fullname,
                        "address" => $address,
                    ]);
                    $mail_payment_created = View::forge("mail/layout", [
                        "lang" => $lang,
                        "content" => $mail_payment_created_content
                    ]);
                    
                    $destinataire = [
                        "mail" => $client->email,
                        "name" => $fullname
                    ];
                    $attachments = [
                        [
                            "path" => $dossier."receipt-".$receiptRef.".pdf",
                            "name" => "Proof of payment.pdf"
                        ],
                        [
                            "path" => $dossierCommitment."commitment-".$refCommitment.".pdf",
                            "name" => "Client commitment.pdf"
                        ]
                    ];
                    Sendmail::Send($destinataire, $subject, $mail_payment_created, $attachments);
                    /**
                     * Mail to client sent
                     */

                    /**
                     * Notify admins
                     */
                    $mail_payment_received_content = View::forge("mail/bill/payment/saved/received", [
                        "lang" => $lang,
                        "bill" => $bill,
                        "payment" => $payment,
                        "client" => $client,
                        "fullname" => $fullname,
                        "address" => $address,
                    ]);
                    $mail_payment_received = View::forge("mail/layout", [
                        "lang" => $lang,
                        "content" => $mail_payment_received_content
                    ]);
                    Sendmail::AutoNotify($subject, $mail_payment_received, $attachments);
                    /**
                     * Notifications sent
                     */
                }
                
            } elseif("canceled" == strtolower($payment_data->status)) {
                $payment->status = Dao_Payment::$StatusCanceled;

                if($bill != null) {
                    /**
                     * Notify admins
                     */
                    $subject = "Paiement annulé | Canceled payment - iCarré";
                    $mail_payment_received_content = View::forge("mail/bill/payment/saved/received", [
                        "lang" => $lang,
                        "bill" => $bill,
                        "payment" => $payment,
                        "client" => $client,
                        "fullname" => $fullname,
                        "address" => $address,
                    ]);
                    $mail_payment_received = View::forge("mail/layout", [
                        "lang" => $lang,
                        "content" => $mail_payment_received_content
                    ]);
                    Sendmail::AutoNotify($subject, $mail_payment_received);
                    /**
                     * Notifications sent
                     */
                }
            } else {
                $payment->status = Dao_Payment::$StatusDeclined;
                $payment->payloads = json_encode(array(
                    "channel" => $payment_data->channel,
                    "reference" => $payment_data->reference,
                    "error" => $payment_data->error_message,
                ));

                if($bill != null) {
                    /**
                     * Notify admins
                     */
                    $subject = "Paiement échoué | Failled payment - iCarré";
                    $mail_payment_received_content = View::forge("mail/bill/payment/saved/received", [
                        "lang" => $lang,
                        "bill" => $bill,
                        "payment" => $payment,
                        "client" => $client,
                        "fullname" => $fullname,
                        "address" => $address,
                    ]);
                    $mail_payment_received = View::forge("mail/layout", [
                        "lang" => $lang,
                        "content" => $mail_payment_received_content
                    ]);
                    Sendmail::AutoNotify($subject, $mail_payment_received);
                    /**
                     * Notifications sent
                     */
                }

                // FOR LATER
                //$payment->channel.' via e-COM Easypay was declined. The reason: '.$payment_data->error_message, 'ecom_easypay';
            }
            return $payment->save();
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return;
        }
    }

    function buildPageWithSharedHeader($lang, $active_page, $route_name, $view_name, $data_context) {
        $mainMenu = View::forge("shared/menu/main", ["active" => $active_page, "lang" => $lang,]);
        $phoneMenu = View::forge("shared/menu/phone");
        $header = View::forge("shared/header", ["mainMenu" => $mainMenu, "phoneMenu" => $phoneMenu, "lang" => $lang, "route_name" => $route_name]);

        $data_context["lang"] = $lang;
        $this->template->title = "Paiement";
        $this->template->header = $header;
        $this->template->content = View::forge($view_name, $data_context);
        $this->template->footer = View::forge("shared/footer", ["lang" => $lang]);
    }

    function buildPage($lang, $view, $title, $array_context) {
        $array_context["lang"] = $lang;
        $header = View::forge("payment/header", ["lang" => $lang, "title" => $title]);
        $this->template->title = $title;
        $this->template->header = $header;
        $this->template->content = View::forge($view, $array_context);
        $this->template->footer = View::forge("shared/footer", ["lang" => $lang]);
    }

    function curlJsonDataToEasypay($url, $json_data) {
        $options = array( 
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,         // return web page 
            CURLOPT_HTTPHEADER     => ['Content-type: application/json'],
            CURLOPT_FOLLOWLOCATION => true,         // follow redirects  
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect 
            CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect 
            CURLOPT_TIMEOUT        => 120,          // timeout on response 
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects 
            CURLOPT_POST           => 1,            // i am sending post data 
            CURLOPT_POSTFIELDS     => $json_data,    // this are my post vars 
            CURLOPT_SSL_VERIFYHOST => false,            // don't verify ssl 
            CURLOPT_SSL_VERIFYPEER => false,        // 
            CURLOPT_VERBOSE        => 1                // 
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch); 
        $err     = curl_errno($ch); 
        $errmsg  = curl_error($ch) ;
        $strerror = curl_strerror($err);
        $decode = curl_unescape($ch, $url);
        $header  = curl_getinfo($ch); 
        curl_close($ch); 

        $header['errno']   = $err; 
        $header['errmsg']  = $errmsg; 
        $header['strerror']   = $strerror; 
        $header['decode']   = $decode;
        $header['content'] = $content;
        //return $header;
        return $content;
    }
}