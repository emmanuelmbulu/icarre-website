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

return array(
    'test' => array(
        'userId' => 'your_sandbox_user_id',
        'userPassword' => 'your_sandbox_user_password',
        'userApiKey' => 'your_sandbox_user_api_key',
        'verifyPeerSSL' => true, // or false
    ),
    'production' => array(
        'userId' => 'your_production_user_id',
        'userPassword' => 'your_production_user_password',
        'userApiKey' => 'your_produciton_user_api_key',
        'verifyPeerSSL' => true, // or false',
    ),
);
