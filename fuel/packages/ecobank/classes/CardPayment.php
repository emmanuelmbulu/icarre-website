<?php
namespace Ecobank;

use Fuel\Core\Uri;

class CardPayment {
    const TEST_BASE_URL = 'https://developer.ecobank.com/corporateapi';
    const LIVE_BASE_URL = 'https://developer.ecobank.com/corporateapi';

    /**
     * A flag.
     */
    protected $isSetToLive = false;
    
    /**
     * User Identifier. Unique ID provided in Ecobank Developper Portal to identify 
     * your application.
     *
     * @var string
     */
    protected $userId = '';

    /**
     * User Password. Used to sign/crypt the requests.
     *
     * @var string
     */
    protected $userPassword = '';

    /**
     * User ApiKey.
     *
     * @var string
     */
    protected $userApiKey = '';

    /**
     * The Token will be used for all further API calls.
     *
     * @var string
     */
    protected $token = '';

    /**
     * cURL option for whether to verify the peer's certificate or not.
     *
     * @var bool
     */
    protected $verifyPeerSSL = true;

    /**
     * Creates a new CardPayment instance. If the user doesn't know his token or doesn't have a
     * token yet, he can leave $token empty and retrieve a token with
     * getTokenFromConsumerKey() method later.
     *
     * @param string $mode A string that specifies the mode of use "test" or "production"
     * @param  array  $config  An associative array that contain array test and production 
     *                         that can contain userId, userPassword and verifyPeerSSL
     *
     * @return void
     */
    public function __construct($mode, $config = array()) {
        $mode = strtolower($mode);

        if(array_key_exists($mode, $config) && is_array($config[$mode])) {
            if("test" !== $mode) {
                $this->isSetToLive = true;
            }            
            $envConfig = (array)$config[$mode];

            if (array_key_exists('userId', $envConfig)) {
                $this->userId = $envConfig['userId'];
            }
            if (array_key_exists('userPassword', $envConfig)) {
                $this->userPassword = $envConfig['userPassword'];
            }
            if (array_key_exists('userPassword', $envConfig)) {
                $this->userApiKey = $envConfig['userApiKey'];
            }
            if (array_key_exists('verifyPeerSSL', $envConfig)) {
                $this->verifyPeerSSL = $envConfig['verifyPeerSSL'];
            } else {
                $this->verifyPeerSSL = true;
            }
        }
    }

    /**
     * Retrieves a token from CardPayment, that will be used for all further API calls  for payment (sell goods and services).
     * 
     * @return array
     */
    public function paymentAuthentification() {
        $url = self::TEST_BASE_URL . '/user/token';
        if($this->isSetToLive) {
            $url = self::LIVE_BASE_URL . '/user/token';
        }
        return $this->oAuth($url);
    }

    /**
     * Initiate card payment for goods or services
     * 
     * @param string $requestId         The payment request id
     *                                  Example: 998536080
     * @param string $productCode       The product code
     *                                  Example: 1020
     * @param string $description       A short description of the transaction
     *                                  Example: Paiement de 50USD pour la facture FAC12245
     * @param string $returnUrl         The url of the page where to redirect after payment
     *                                  Example: example.cd/payment/callback
     * @param float $amount             The amount to be paied by the payer
     *                                  Example: 50
     * @param string $currency          The currency ISO Code of the transaction
     *                                  Example: USD
     * @param string $language          The language Code of the language to use with the customer
     *                                  Example: en_EN
     * @return array 
     */
    public function initPayment(
        $requestId, 
        $productCode,
        $description,
        $returnUrl,
        $amount,
        $currency = 'USD',
        $language = 'en_EN'
    ) {
        $url = self::TEST_BASE_URL . '/merchant/Signature';
        if($this->isSetToLive) {
            $url = self::LIVE_BASE_URL . '/merchant/Signature';            
        }

        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Origin: ' . Uri::base(false),
            'Authorization: Bearer ' . $this->getToken(),
        );

        $args = array(
            "secureHash" => "1be4bf59f4917a306005fd8178b8ae9ac385b832a94b15c7a87945cf374edab099e9735379833a01053c33f0edae94ebd0ffa8beb5680871e78c3b7630582331",
            "merchantDetails" => array (
                "accessCode" => "31a95cc023dd35b88d4cad5e7f08fd9b",
                "merchantID" => $this->getUserId(),
                "secureSecret" => $this->getUserPassword(),
            ),
            "paymentDetails" => array (
                "requestId" => $requestId,
                "productCode" => $productCode,
                "locale" => $language,
                "orderInfo" => $description,
                "returnUrl" => $returnUrl,
                "amount" => floatval($amount),
                "currency" => $currency,
            ),
        );

        return $this->callApi($headers, $args, $url, 'POST', 200);
    }

    /**
     *  Calls API Endpoints.
     *
     * @param  array   $headers         An array of HTTP header fields to set
     * @param  array   $args            The data to send
     * @param  string  $url             The URL to fetch
     * @param  string  $method          Whether to do a HTTP POST or a HTTP GET
     * @param  int     $successCode     The HTTP code that will be returned on
     *                                  success
     * @param  bool    $jsonEncodeArgs  Whether or not to json_encode $args
     *
     * @return array   Contains the results returned by the endpoint or an error
     *                 message
     */
    function callApi(
        $headers,
        $args,
        $url,
        $method,
        $successCode,
        $jsonEncodeArgs = true
    ) {
        $ch = curl_init();
    
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);

            if (!empty($args)) {
                if ($jsonEncodeArgs === true) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));
                } else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
                }
            }
        } else /* $method === 'GET' */ {
            if (!empty($args)) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($args));
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($this->getVerifyPeerSSL() === false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        // Make sure we can access the response when we execute the call
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);

        if ($data === false) {
            return array('error' => 'API call failed with cURL error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
        curl_close($ch);

        $response = json_decode($data, true);

        $jsonErrorCode = json_last_error();
        if ($jsonErrorCode !== JSON_ERROR_NONE) {
            return array(
                'error' => 'API response not well-formed (json error code: '
                    . $jsonErrorCode . ')'
            );
        }

        if ($httpCode !== $successCode) {
            $errorMessage = '';

            /*if (!empty($response['error_description'])) {
                $errorMessage = $response['error_description'];
            } elseif (!empty($response['error'])) {
                $errorMessage = $response['error'];
            } elseif (!empty($response['description'])) {
                $errorMessage = $response['description'];
            } elseif (!empty($response['message'])) {
                $errorMessage = $response['message'];
            } elseif (!empty($response['requestError']['serviceException'])) {
                $errorMessage = $response['requestError']['serviceException']['text']
                    . ' ' . $response['requestError']['serviceException']['variables'];
            } elseif (!empty($response['requestError']['policyException'])) {
                $errorMessage = $response['requestError']['policyException']['text']
                    . ' ' . $response['requestError']['policyException']['variables'];
            }*/
            $errorMessage = 'An error occured';
            return array('error' => $errorMessage, 'details' => $response);
        }

        return $response;
    }

    function oAuth($url) {
        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Origin: ' . Uri::base(false),
        );

        $args = array(
            "userId" => $this->userId,
            "password" => $this->userPassword,
        );

        $response = $this->callApi($headers, $args, $url, 'POST', 200);
        if (!empty($response['token'])) {
            $this->setToken($response['token']);
        }
        return $response;
    }

    /**
     *  Gets the User ID.
     *
     * @return string
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     *  Sets the User ID.
     *
     * @param  string  $userId  the User ID
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     *  Gets the User Password.
     *
     * @return string
     */
    public function getUserPassword() {
        return $this->userPassword;
    }

    /**
     *  Sets the User Password.
     *
     * @param  string  $userPassword  the User Password
     */
    public function setUserPassword($userPassword) {
        $this->userPassword = $userPassword;
    }

    /**
     *  Gets the User ApiKey.
     *
     * @return string
     */
    public function getUserApiKey() {
        return $this->userApiKey;
    }

    /**
     *  Sets the User ApiKey.
     *
     * @param  string  $userApiKey  the User ApiKey
     */
    public function setUserApiKey($userApiKey) {
        $this->userApiKey = $userApiKey;
    }

    /**
     *  Gets the (local/current) Token.
     *
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

    /**
     *  Sets the Token value.
     *
     * @param  string  $token  the token
     */
    public function setToken($token) {
        $this->token = $token;
    }

    /**
     *  Gets the CURLOPT_SSL_VERIFYPEER value.
     *
     * @return bool
     */
    public function getVerifyPeerSSL() {
        return $this->verifyPeerSSL;
    }

    /**
     *  Sets the CURLOPT_SSL_VERIFYPEER value.
     *
     * @param  bool  $verifyPeerSSL  FALSE to stop cURL from verifying the
     *                               peer's certificate. TRUE otherwise.
     */
    public function setVerifyPeerSSL($verifyPeerSSL)
    {
        $this->verifyPeerSSL = $verifyPeerSSL;
    }
}
