<?php
/**
 * Ecobank Collection for Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Ecobank
 * @version    1.0
 * @author     Emmanuel MBULU
 * @license    MIT License
 * @copyright  2022 iCarré Team
 * @link       https://icarre-rdc.com
 */

\Autoloader::add_namespace('Ecobank', __DIR__.'/classes/');

\Autoloader::add_classes(array(
	'Ecobank\\CardPayment'  => __DIR__.'/classes/CardPayment.php',
));

// Ensure the Ecobank's config is loaded for Temporal
\Config::load('ecobank', true);