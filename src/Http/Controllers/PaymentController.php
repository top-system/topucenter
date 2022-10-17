<?php

namespace TopSystem\UCenter\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use TopSystem\UCenter\Services\PaymentService;

class PaymentController extends BaseController {
    protected $payment;
    public function __construct()
    {
        $this->payment = new PaymentService();
        $this->payment->setGateway('AdaPay_Alipay');

    }

    public function gateway(Request $request, $gateway)
    {
        switch ($gateway){
            case 'AdaPay_Alipay':
                $gateway = $this->payment->gateway($gateway);
                $gateway->setAppId('app_95d8ac4b-754e-4856-83bf-88e05779da41');
                $gateway->setApiKey('api_live_1797d5d8-dd4f-4262-8020-88ef12adbd2b');
                $gateway->setPrivateKey('MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJRG4GhwMc8pVpTuLLFMSFLwOt5emfZ0Z0Atjo6v6FwMjXSDtYb3bBljjKoZ852qf49aoyMHjUwt0OANbfOQL3cUMwkIpPDxRsxk2vJ5FdJ4aCfu6r25eEziHDp7QmPVGOgNKC8mP+1OwgDtMk+AtFRbALzds2DwQyRaYNEFFMz9AgMBAAECgYAI9/CC4KZinWF7SJyzbKXDPnyRDq/JVGkaXKcOwl0PlELKFV1ZeIW1U2wirccqdjGY/iZ36/ED9pF3u9g2rzXvqcY36LUd1W6M+Kkpsy21SdHC3uYYbFg4JvMD+M3NLA8iKgPy9o+4euoVjYMT6jImj9Bupc8pYmu+cWZA4tVCkQJBAPNAASt1M2FMeXSQcHvLkfPoVvkOc4RpW4yWbfDVSUIfq7CI3SAK747jurcmIRkVt0IbSv8Ie1vCxTNMoasj7MsCQQCcDH8Faz/aF54pgFhghmldCXV4grHlc+ppucq+fkixsctmTV5C/5Rw6d5j/Rs02sEixw/R5I4p/6uLAXAe53xXAkA7IVTndn796PQhRLdDMJITI2h49G1aQ64wd6TUBVTgkQhQSoTONDpVlsAdo1QqX+ADXtUVN7+c57S+KqOmEX6PAkEAi/lhjtjPI6//vTZVD/BBXqT3bCu/qxQ49rEjPZBFYK8cxh0sKmjbHBWL2KDW4KhAihOJCzs6kk218DBQBEicbQJBANPW/4QKa9pZLWUuEjyqAe/bb1GfPRjJoFXgUHyf2+UNTsI2/4rd0Hvl86VGyImhcnu9gFWzj33jiuJ7qMfPRo4=');
                $gateway->setPublicKey('MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCwN6xgd6Ad8v2hIIsQVnbt8a3JituR8o4Tc3B5WlcFR55bz4OMqrG/356Ur3cPbc2Fe8ArNd/0gZbC9q56Eb16JTkVNA/fye4SXznWxdyBPR7+guuJZHc/VW2fKH2lfZ2P3Tt0QkKZZoawYOGSMdIvO+WqK44updyax0ikK6JlNQIDAQAB');
                $gateway->setPayChannel('alipay');
                $gateway->setNotifyUrl("https://www.baidu.com/adasdasd/adasd.php");
                $response = $gateway->purchase([
                    'order_no'  =>  'asdasdasd123123123',
                    'pay_amt'   =>  '100.00',
                    'goods_title'=>'test',
                    'goods_desc'=>'hahah',
                    'device_info'=>[
                        'device_ip' => '123.324.435.123'
                    ]
                ])->send();

                var_dump($response->isSuccessful());die;
                break;

        }
    }

    public function gatewayNotice(Request $request, $gateway){
        switch ($gateway){
            case 'AdaPay_Alipay':
                $gateway = $this->payment->gateway($gateway);
                $gateway->setSignType('RSA2'); // RSA/RSA2/MD5. Use certificate mode must set RSA2
                $gateway->setAppId('the_app_id');
                $gateway->setPrivateKey('the_app_private_key');
                $gateway->setAlipayPublicKey('the_alipay_public_key'); // Need not set this when used certificate mode
                $gateway->setReturnUrl('https://www.example.com/return');
                $gateway->setNotifyUrl('https://www.example.com/notify');
                $params = [
                    'request_params' => array_merge($_GET, $_POST), //Don't use $_REQUEST for may contain $_COOKIE
                ];
                $response = $gateway->completePurchase($params)->send();
                if ($response->isPaid()) {

                    // Paid success, your statements go here.

                    //For notify, response 'success' only please.
                    //die('success');
                } else {

                    //For notify, response 'fail' only please.
                    //die('fail');
                }
                break;
        }
    }
}