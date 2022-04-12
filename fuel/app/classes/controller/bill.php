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
use Fuel\Core\View;
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
                    return Helper::redirectTo404($lang);
                }
                Cookie::set("invoice", $bill->id, 60 * 60 * 30);               
                $ref = Helper::NormalizeChars(strtolower("invoice-".$bill->reference));
                $ref = urlencode($ref);
                $route = Router::get("details-bill", ["lang" => $lang, "ref" => $ref]);
                return Response::redirect($route);
            }

            $ref = Cookie::get("invoice", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                return Helper::redirectTo404($lang);
            }
            
            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $payments_saved = Dao_Payment::getAllByBill($bill->id);
            $context = [
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
                "payments_saved" => $payments_saved,
            ];

            Lang::load("invoice_details.json", null, $lang);
            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function post_details() {
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

        try {
            $ip_address = Input::ip();
            /*Api::toPreResponse([
                "ip" => Input::ip(),
                "real_ip" => Input::real_ip()
            ]);*/
            Cookie::set("ip", Input::ip(), 60 * 60 * 30);

            $invoiceForm = new Fieldset('invoice');
            $ref = Input::post("ref", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                return Helper::redirectTo404($lang);
            }

            $invoiceForm->add_model('Model_Bill');
            $invoiceForm->populate(Input::post());
            $invoiceForm->validation()->field("amount")
                ->add_rule("numeric_between", 1, $bill->amount - $bill->amount_paid);
            $invoiceForm->validation()->run();

            if(!$invoiceForm->error("amount")) {
                Cookie::set("amount", Input::post("amount"), 60 * 60 * 30);

                $route = Router::get("check-out", array("lang" => $lang));
                $route .= "?ref=$bill->id&object=invoice";
                return Response::redirect($route);
            }
            
            Lang::load("invoice_details.json", null, $lang);

            $items = $bill->get_items();
            $client = $bill->get_client();
            $payments = $bill->get_payments();
            $payments_saved = Dao_Payment::getAllByBill($bill->id);
            $error = Lang::get("input.error", [], null, $lang);
            $context = [
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
                "payments_saved" => $payments_saved,
                "error" => $error
            ];

            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);         
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function post_signdata() {
        try {
            $ecobank = Config::get("ecobank");

            $dataToSign = array();
            foreach(Input::post() as $key => $value) {
                $dataToSign[] = $key . "=" . $value;
            }
            $dataToSign = implode(",", $dataToSign);
            $dataSigned = base64_encode(hash_hmac("sha256", $dataToSign, $ecobank["test"]["secretKey"], true));
            
            return Api::toJSONResponse(["code"=>0, "signature"=>$dataSigned]);
        } catch(Exception $e) {
            return Api::toJSONResponse(["code"=>-1, "error"=>$e->getMessage()]);
        }
    }

    public function get_callback() {
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

        try {
            $ref = Input::get("Reference", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                return Helper::redirectTo404($lang);
            }

            $payment = new Bill_Payment();
            $status = Input::get("status", "cancelled");
            $payment->set_status($status);
            //$payment->reference = $bill->reference;
            $payment->reference = "ICIP-".$bill->id;
            //$payment->reference .= "-".Input::get("paymentID", 0);
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

            $items = $bill->get_items();
            $client = $bill->get_client();

            if($payment->status == "approved") {
                Lang::load("invoice_details.json", null, $lang);

                $pathToModel = DOCROOT."assets/bills/".$lang."-model.docx";
                $phpdocx = new TemplateProcessor($pathToModel);

                $phpdocx->setValues(array(
                    /**
                     * PAYMENT
                     */
                    "reference" => $payment->reference,
                    "payment_date" => date($date_format, strtotime($payment->date)),
                    "payment_channel" => $payment->channel,
                    "channel_reference" => Input::get("transaction_id", "undefined"),

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
                    "item_unit" => "-",
                    "item_quantity" => 1,
                    "item_price" => $payment->amount,
                    "item_total" => $payment->amount,
                    "total_ht" => $payment->amount,
                    "tva_value" => 0,
                    "tva_amount" => 0,
                    "currency" => $bill->currency,
                    "total_ttc" => $payment->amount,
                ));

                $dossier = DOCROOT."receipts/";
                $receiptRef = strtolower(Helper::NormalizeChars($payment->reference));
                 
                $pathToQRCode = $dossier."receipt-".$receiptRef.".png";
                $contenuQRCode = Router::get("receipt-pdf", ["ref" => $receiptRef]);
                
                $payment->receipt = $contenuQRCode;
                $bill->add_payment($payment);

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
                 * Sending mail to client
                 */
                $subject = "Nouveau paiement | New payment - iCarré";
                $mail_payment_created_content = View::forge("mail/bill/payment/created", [
                    "lang" => $lang,
                    "bill" => $bill,
                ]);
                $mail_payment_created = View::forge("mail/layout", [
                    "lang" => $lang,
                    "content" => $mail_payment_created_content
                ]);
                
                $destinataire = [
                    "mail" => $client->email,
                    "name" => $client->fullname
                ];
                $attachments = [[
                        "path" => $dossier."receipt-".$receiptRef.".pdf",
                        "name" => "Proof of payment.pdf"
                ]];
                Sendmail::Send($destinataire, $subject, $mail_payment_created, $attachments);
                /**
                 * Mail to client sent
                 */

                /**
                 * Notify admins
                 */
                $mail_payment_received_content = View::forge("mail/bill/payment/received", [
                    "lang" => $lang,
                    "bill" => $bill,
                ]);
                $mail_payment_received = View::forge("mail/layout", [
                    "lang" => $lang,
                    "content" => $mail_payment_received_content
                ]);
                Sendmail::AutoNotify($subject, $mail_payment_received, $attachments);
                /**
                 * Notifications sent
                 */
            } else {
                $bill->add_payment($payment);
                /**
                 * Notify admins
                 */
                $subject = "Paiement échoué | Failed payment - iCarré";
                $mail_payment_received_content = View::forge("mail/bill/payment/received", [
                    "lang" => $lang,
                    "bill" => $bill,
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
            $bill->save();

            $payments = $bill->get_payments();
            $context = [
                "status" => $payment->status,
                "receipt" => $payment->receipt,
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
            ];
            
            /**
             * Loading again after mails sent
             */
            Lang::load("invoice_details.json", null, $lang);
            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);         
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function post_callback() {
        $lang = Helper::manageLanguage($this, "details-bill", ["ref" => 0]);

        try {
            $ref = Input::post("Reference", 0);
            $bill = Model_Bill::find($ref);
            if($bill == null) {
                return Helper::redirectTo404($lang);
            }

            $payment = new Bill_Payment();
            $status = Input::post("status", "cancelled");
            $payment->set_status($status);
            //$payment->reference = $bill->reference;
            $payment->reference = "ICIP-".$bill->id;
            //$payment->reference .= "-".Input::get("paymentID", 0);
            $payment->reference .= "-".Input::post("transaction_id", 0);
            $payment->amount = Input::post("amount", 0);
            $payment->channel = Input::post("PaymentMethod", "undefined");
            $payment->date = Input::post("transaction_date");
            $payment->ip_address = Cookie::get("ip", "0.0.0.0");
            $payment->receipt = "#";

            $date_format = "Y-m-d h:i:s";
            if($lang == "fr") {
                $date_format = "d/m/Y h:i:s";
            }

            $items = $bill->get_items();
            $client = $bill->get_client();

            if($payment->status == "approved") {
                Lang::load("invoice_details.json", null, $lang);

                $pathToModel = DOCROOT."assets/bills/".$lang."-model.docx";
                $phpdocx = new TemplateProcessor($pathToModel);

                $phpdocx->setValues(array(
                    /**
                     * PAYMENT
                     */
                    "reference" => $payment->reference,
                    "payment_date" => date($date_format, strtotime($payment->date)),
                    "payment_channel" => $payment->channel,
                    "channel_reference" => Input::post("transaction_id", "undefined"),

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
                    "item_unit" => "-",
                    "item_quantity" => 1,
                    "item_price" => $payment->amount,
                    "item_total" => $payment->amount,
                    "total_ht" => $payment->amount,
                    "tva_value" => 0,
                    "tva_amount" => 0,
                    "currency" => $bill->currency,
                    "total_ttc" => $payment->amount,
                ));

                $dossier = DOCROOT."receipts/";
                $receiptRef = strtolower(Helper::NormalizeChars($payment->reference));
                 
                $pathToQRCode = $dossier."receipt-".$receiptRef.".png";
                $contenuQRCode = Router::get("receipt-pdf", ["ref" => $receiptRef]);

                $payment->receipt = $contenuQRCode;
                $bill->add_payment($payment);

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
                 * Sending mail to client
                 */
                $subject = "Nouveau paiement | New payment - iCarré";
                $mail_payment_created_content = View::forge("mail/bill/payment/created", [
                    "lang" => $lang,
                    "bill" => $bill,
                ]);
                $mail_payment_created = View::forge("mail/layout", [
                    "lang" => $lang,
                    "content" => $mail_payment_created_content
                ]);
                
                $destinataire = [
                    "mail" => $client->email,
                    "name" => $client->fullname
                ];
                $attachments = [[
                        "path" => $dossier."receipt-".$receiptRef.".pdf",
                        "name" => "Proof of payment.pdf"
                ]];
                Sendmail::Send($destinataire, $subject, $mail_payment_created, $attachments);
                /**
                 * Mail to client sent
                 */

                /**
                 * Notify admins
                 */
                $mail_payment_received_content = View::forge("mail/bill/payment/received", [
                    "lang" => $lang,
                    "bill" => $bill,
                ]);
                $mail_payment_received = View::forge("mail/layout", [
                    "lang" => $lang,
                    "content" => $mail_payment_received_content
                ]);
                Sendmail::AutoNotify($subject, $mail_payment_received, $attachments);
                /**
                 * Notifications sent
                 */
            } else {
                $bill->add_payment($payment);
                /**
                 * Notify admins
                 */
                $subject = "Paiement échoué | Failed payment - iCarré";
                $mail_payment_received_content = View::forge("mail/bill/payment/received", [
                    "lang" => $lang,
                    "bill" => $bill,
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
            $bill->save();

            $payments = $bill->get_payments();
            $context = [
                "status" => $payment->status,
                "receipt" => $payment->receipt,
                "invoice" => $bill,
                "items" => $items,
                "client" => $client,
                "payments" => $payments,
            ];
            
            /**
             * Loading again after mails sent
             */
            Lang::load("invoice_details.json", null, $lang);
            $title = Lang::get("title", ["reference" => $bill->reference], null, $lang);
            return $this->buildPage($lang, "invoice/details", $title, $context);         
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            return Helper::redirectTo500($lang);
        }
    }

    public function get_create() {
        $lang = Helper::manageLanguage($this, "details");

        $client = new Bill_Client();
        $client->address = "1012, ave Mutombo-Katshi, Kinshasa - Gombe";
        $client->country = "Congo, Republic Democratic of the"; //45.130.83.98
        $client->email = "contact@icarre-rdc.com";
        $client->fullname = "Emmanuel MBULU";
        $client->phone = "+243813700243";

        $items = array();

        $description = "Android App Engineering";
        $price = 5000;
        $item = new Bill_Item($description, $price, 1, "Package");
        $items[] = $item;

        /*$description = "Remote iOS App Engineering";
        $price = 8000;
        $item = new Bill_Item($description, $price, 1, "Package");
        $items[] = $item;

        $description = "Ubuntu 20.04 LTS System configuration and security policy deployment";
        $price = 5000;
        $item = new Bill_Item($description, $price, 1, "Package");
        $items[] = $item;*/

        $bill = new Model_Bill();
        $bill->set_reference();
        $bill->currency = "USD";
        $bill->amount = $bill->amount_paid = 0;
        $bill->tva = 0; 
        $bill->add_items($items);
        $bill->add_client($client);
        $bill->bank_purchaser = Dao_Bill::$BankPurchaser["ECOBANK"];
        $bill->is_paid = false;
        $bill->created_at = Helper::renvoyerNow();
        $bill->save();

        try {
            $date_format = "Y-m-d h:i:s";
            if($lang == "fr") {
                $date_format = "d/m/Y h:i:s";
            }

            $pathToModel = DOCROOT."assets/bills/".$lang."-invoice-model.docx";
            $phpdocx = new TemplateProcessor($pathToModel);

            $phpdocx->setValues(array(
                /**
                 * INVOICE
                 */
                "reference" => $bill->reference,
                "invoice_date" => date($date_format, strtotime($bill->created_at)),
                /*"payment_channel" => $payment->channel,
                "channel_reference" => Input::post("order", "undefined"),*/

                /**
                 * CLIENT
                 */
                "payer_fullname" => $client->fullname,
                "payer_address" => $client->address,
                "payer_mail" => $client->email,

                /**
                 * ADD
                 */
                "total_ht" => $bill->amount,
                "tva_value" => $bill->tva,
                "tva_amount" => $bill->get_vat(),
                "currency" => $bill->currency,
                "total_ttc" => $bill->get_ttc(),
            ));

            $invoiceItems = array();

			foreach($items as $it) {
				$invoiceItems[] = [
					"item_description" => $it->description,
                    "item_unit" => $it->unit,
                    "item_quantity" => $it->quantity,
                    "item_price" => $it->price,
                    "item_total" => $it->total,
				];
			}
			$phpdocx->cloneRowAndSetValues('item_description', $invoiceItems);

            $dossier = DOCROOT."invoices/";
            $invoiceRef = strtolower(Helper::NormalizeChars($bill->reference));
                
            $pathToQRCode = $dossier."invoice-".$invoiceRef.".png";
            $contenuQRCode = Router::get("details-bill", ["ref" => $bill->id]);
            /**
             * TO ADD AFTER
             */
            //$bill->receipt = $contenuQRCode;
            QRcode::png($contenuQRCode, $pathToQRCode, QR_ECLEVEL_H, 4, 2);

            $phpdocx->setImageValue('qrcode', array(
                'path' => $pathToQRCode, 
                'width' => 100, 
                'height' => 100,
                'ratio' => false
                )
            );

            $fichier_docx = $dossier."invoice-".$invoiceRef.".docx";
            $phpdocx->saveAs($fichier_docx);

            // CONVERT THE DOCS DOCUMENT TO PDF DOCUMENT
            shell_exec('libreoffice --headless --convert-to pdf '.$fichier_docx.' --outdir '.$dossier);

            // DELETE THE DOCX DOCUMENT CREATED AND THE PNG FILE.
            File::delete($fichier_docx);
            File::delete($pathToQRCode);

            /**
             * Sending mail to client
             */
            $subject = "Nouvelle facture | New invoice - iCarré";
            $mail_invoice_created_content = View::forge("mail/bill/created", [
                "lang" => $lang,
                "bill" => $bill,
            ]);
            $mail_invoice_created = View::forge("mail/layout", [
                "lang" => $lang,
                "content" => $mail_invoice_created_content
            ]);
            
            $destinataire = [
                "mail" => $client->email,
                "name" => $client->fullname
            ];
            $attachments = [[
                    "path" => $dossier."invoice-".$invoiceRef.".pdf",
                    "name" => "Invoice ".$bill->reference.".pdf"
            ]];
            $bcc = array(
                [
                    "mail" => "emmanuel.mbulu@icarre-rdc.com",
                    "name" => "Emmanuel MBULU"
                ]
            );
            Sendmail::Send($destinataire, $subject, $mail_invoice_created, $attachments, $bcc);
            /**
             * Mail to client sent
            */
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
        }
        
        $route = Router::get("details-bill", ["lang" => $lang, "ref" => $bill->id]);
        return Response::redirect($route);
    }

    public function get_pdf() {
        $lang = Cookie::get("lang", "fr");
        
        try {
            $ref = strtolower($this->param("ref", 0));
            if(is_numeric($ref)) {
                $bill = Model_Bill::find((int)$ref);
                if(null == $bill) {
                    Helper::redirectTo404($lang);
                }
        
                $dossier = DOCROOT."invoices/";
                $invoiceRef = strtolower(Helper::NormalizeChars($bill->reference));

                if(!File::exists($dossier."invoice-".$invoiceRef.".pdf")) {
                    try {
                        $client = $bill->get_client();
                        $items = $bill->get_items();

                        $date_format = "Y-m-d h:i:s";
                        if($lang == "fr") {
                            $date_format = "d/m/Y h:i:s";
                        }
            
                        $pathToModel = DOCROOT."assets/bills/".$lang."-invoice-model.docx";
                        $phpdocx = new TemplateProcessor($pathToModel);
            
                        $phpdocx->setValues(array(
                            /**
                             * INVOICE
                             */
                            "reference" => $bill->reference,
                            "invoice_date" => date($date_format, strtotime($bill->created_at)),
                            /*"payment_channel" => $payment->channel,
                            "channel_reference" => Input::post("order", "undefined"),*/
            
                            /**
                             * CLIENT
                             */
                            "payer_fullname" => $client->fullname,
                            "payer_address" => $client->address,
                            "payer_mail" => $client->email,
            
                            /**
                             * ADD
                             */
                            "total_ht" => $bill->amount,
                            "tva_value" => $bill->tva,
                            "tva_amount" => $bill->get_vat(),
                            "currency" => $bill->currency,
                            "total_ttc" => $bill->get_ttc(),
                        ));
            
                        $invoiceItems = array();
            
                        foreach($items as $it) {
                            $invoiceItems[] = [
                                "item_description" => $it->description,
                                "item_unit" => $it->unit,
                                "item_quantity" => $it->quantity,
                                "item_price" => $it->price,
                                "item_total" => $it->total,
                            ];
                        }
                        $phpdocx->cloneRowAndSetValues('item_description', $invoiceItems);
                            
                        $pathToQRCode = $dossier."invoice-".$invoiceRef.".png";
                        $contenuQRCode = Router::get("details-bill", ["ref" => $bill->id]);
                        /**
                         * TO ADD AFTER
                         */
                        //$bill->receipt = $contenuQRCode;
                        QRcode::png($contenuQRCode, $pathToQRCode, QR_ECLEVEL_H, 4, 2);
            
                        $phpdocx->setImageValue('qrcode', array(
                            'path' => $pathToQRCode, 
                            'width' => 100, 
                            'height' => 100,
                            'ratio' => false
                            )
                        );
            
                        $fichier_docx = $dossier."invoice-".$invoiceRef.".docx";
                        $phpdocx->saveAs($fichier_docx);
            
                        // CONVERT THE DOCS DOCUMENT TO PDF DOCUMENT
                        shell_exec('libreoffice --headless --convert-to pdf '.$fichier_docx.' --outdir '.$dossier);
            
                        // DELETE THE DOCX DOCUMENT CREATED AND THE PNG FILE.
                        File::delete($fichier_docx);
                        File::delete($pathToQRCode);
                    } catch (\Throwable $th) {
                        Helper::archiverErreur($th);
                    }
                }
        
                $route = Router::get("invoice-pdf", ["lang"=>$lang, "ref"=>$invoiceRef]);
                return Response::redirect($route);
            }

            $file = DOCROOT."invoices/invoice-".$ref.".pdf";
            if(File::exists($file)) {
                $response = new Response();

                $content = file_get_contents($file);

                // We'll be outputting a PDF
                $response->set_header('Content-Type', 'application/pdf');
                $response->set_header('Content-Length', strlen($content));

                $filename = "invoice-".$ref.".pdf";
                $response->set_header('Content-Disposition', 'inline; filename="'.$filename.'"');

                $response->set_header('Cache-Control', 'public, max-age=0, must-revalidate');
                $response->set_header('Pragma', 'public');
                $response->set_header('Author', 'iCarré - Des idées intelligentes');

                $response->body($content);
                return $response;
            } else {
                Helper::redirectTo404($lang);
            }
        } catch (\Throwable $th) {
            Helper::archiverErreur($th);
            Helper::redirectTo500($lang);
        }
    }

    function buildPage($lang, $view, $title, $array_context) {
        $array_context["lang"] = $lang;
        $header = View::forge("shared/bill/header", ["lang" => $lang, "title" => $title]);
        $this->template->title = $title;
        $this->template->header = $header;
        $this->template->content = View::forge($view, $array_context);
        $this->template->footer = View::forge("shared/footer", ["lang" => $lang]);
    }
}