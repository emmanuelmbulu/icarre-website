<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	/**
	 * -------------------------------------------------------------------------
	 *  Default route
	 * -------------------------------------------------------------------------
	 *
	 */

	'_root_' => 'default/index',
	'test' => 'default/test',

	/**
	 * -------------------------------------------------------------------------
	 *  Http Erros
	 * -------------------------------------------------------------------------
	 *
	 */

	'_404_' => 'default/404',
	'_500_' => 'default/500',

	/**
	 * -------------------------------------------------------------------------
	 *  Example for Presenter
	 * -------------------------------------------------------------------------
	 *
	 *  A route for showing page using Presenter
	 *
	 */

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	
	/**
	 * Payment routes
	 */
	'(:lang)/direct-payment' => array("payment/direct", 'name' => "direct-payment"),
	'direct-payment' => array("payment/direct", 'name' => "direct-payment-without-lang-param"),
	
	/**
	 * Bill routes
	 */
	'(:lang)/billing/:ref/details' => array("bill/details", 'name' => "details-bill"),
	'billing/:ref/details' => array("bill/details", 'name' => "details-bill-without-lang-param"),

	'(:lang)/create-invoice' => array("bill/create", 'name' => "create-invoice"),
	'create-invoice' => array("bill/create", 'name' => "create-invoice-without-lang-param"),

	'(:lang)/billing/:ref/payment-callback' => array("bill/callback", 'name' => "callback-invoice"),
	'billing/:ref/payment-callback' => array("bill/callback", 'name' => "callback-invoice-without-lang-param"),

	/**
	 * Default routes
	 */
	'(:lang)/page-not-found' => array('default/404', 'name' => "page-not-found"),
	'page-not-found' => array('default/404', 'name' => "page-not-found-without-lang-param"),

	'(:lang)/server-error-occured' => array('default/500', 'name' => "error-500"),
	'server-error-occured' => array('default/500', 'name' => "error-500-without-lang-param"),

	'(:lang)/home' => array('default/index', 'name' => "index"),
	'home' => array('default/index', 'name' => "index-without-lang-param"),

	'(:lang)/about-us' => array('default/about', 'name' => "about"),
	'about-us' => array('default/about', 'name' => "about-without-lang-param"),

	'(:lang)/invest-with-us' => array('default/kyc', 'name' => "kyc"),
	'invest-with-us' => array('default/kyc', 'name' => "kyc-without-lang-param"),

	/**
	 * Receipt route
	 */
	'payment/receipt/:ref/pdf-file' => array('receipt/pdf', 'name' => "receipt-pdf"),
	'billing/invoice/:ref/pdf-file' => array('billing/pdf', 'name' => "invoice-pdf"),
);
