<?php
/**
 * Fuel PhpQRCode
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel PhpQRCode
 * @version    1.0
 * @author     Emmanuel MBULU
 * @license    MIT License
 * @copyright  2021 E-COM SAS
 * @link       https://e-comsas.com
 */

\Autoloader::add_namespace('PhpQRCode', __DIR__.'/classes/');

\Autoloader::add_classes(array(
	'PhpQRCode\\FrameFiller'                        => __DIR__.'/classes/framefiller.php',
	'PhpQRCode\\QRbitstream'                        => __DIR__.'/classes/qrbitstream.php',
	'PhpQRCode\\QRcode'                             => __DIR__.'/classes/qrcode.php',
	'PhpQRCode\\QRencode'                           => __DIR__.'/classes/qrencode.php',
	'PhpQRCode\\QRimage'                            => __DIR__.'/classes/qrimage.php',
	'PhpQRCode\\QRinput'                            => __DIR__.'/classes/qrinput.php',
	'PhpQRCode\\QRinputItem'                        => __DIR__.'/classes/qrinputitem.php',
	'PhpQRCode\\QRrawcode'                          => __DIR__.'/classes/qrrawcode.php',
	'PhpQRCode\\QRrs'                               => __DIR__.'/classes/qrrs.php',
	'PhpQRCode\\QRrsblock'                          => __DIR__.'/classes/qrrsblock.php',
	'PhpQRCode\\QRrsItem'                           => __DIR__.'/classes/qrrsitem.php',
	'PhpQRCode\\QRspec'                             => __DIR__.'/classes/qrspec.php',
	'PhpQRCode\\QRsplit'                            => __DIR__.'/classes/qrsplit.php',
	'PhpQRCode\\qrstr'                              => __DIR__.'/classes/qrstr.php',
	'PhpQRCode\\QRtools'                            => __DIR__.'/classes/qrtools.php',
));

// Ensure the PhpQRCode's config is loaded for Temporal
\Config::load('phpqrcode', true);