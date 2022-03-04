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
        'merchantId' => 'ECOETG0002',
        'profileId' => '2698F8DE-C903-4D36-94BB-DAEF12C7D430',
        'accessKey' => '915664aad1c83f5e9ecc50c19180d75e',
        'secretKey' => '5d5b579bc30e42009e40392b0a9d3ce5615d9ae5bd3b4c51b00af31bee9cf4a46e40f2180c9643038db2abb2b067e64655fb01045ed24233aa307a9b227d1a24cc23c5b2caf94c2d9d1a350637b136bba6d617036dd44cbbb8493012fd513186216b9fa5774e4adfbe2d37e354e299225859eb44c167440791d9ace8cf0cc7fc',
        'dfOrg' => '1snn5n9w',
    ),
    'production' => array(
        'userId' => 'your_production_user_id',
        'userPassword' => 'your_production_user_password',
        'userApiKey' => 'your_produciton_user_api_key',
        'verifyPeerSSL' => true, // or false',
        'merchantId' => '',
        'profileId' => '',
        'accessKey' => '',
        'secretKey' => '',
        'dfOrg' => 'k8vif92e',
    ),
);
