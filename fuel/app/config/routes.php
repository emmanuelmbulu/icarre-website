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

	/**
	 * -------------------------------------------------------------------------
	 *  Page not found
	 * -------------------------------------------------------------------------
	 *
	 */

	'_404_' => 'default/404',

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
	 * Default routes
	 */
	'(:lang)/page-not-found' => array('default/404', 'name' => "page-not-found"),
	'page-not-found' => array('default/404', 'name' => "page-not-found-without-lang-param"),

	'(:lang)/home' => array('default/index', 'name' => "index"),
	'home' => array('default/index', 'name' => "index-without-lang-param"),
);
